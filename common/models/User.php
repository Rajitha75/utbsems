<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\db\Query;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
	public $otp_code;
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          //  ['status', 'default', 'value' => self::STATUS_ACTIVE],
           // ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        //return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
	public static function getUserRole($id){
        $data = (new Query())->select('user_role_ref_id')	
                    ->from('user')
                    ->where(['id' => $id])
                    ->one();
        return $data['user_role_ref_id'];
    }

	
	public static function getGlobalSearchResult($searchval) {
		$subquery = (new Query())->select('COUNT(project_sme_id)')->from('project_smes AS sme')->where(['AND','sme.project_ref_id = p.project_id'])->createCommand()->rawSql;  
		$projectsquery = (new Query())->select('COUNT(project_id)')->from('projects AS p')->where(['AND','p.user_ref_id = u.id', 'IF(('.$subquery.')>0, (p.sme_project_status=1 OR p.sme_project_status=13), (p.project_status=1 OR p.project_status=13))'])->createCommand()->rawSql;
		$participationquery = (new Query())->select('COUNT(project_participation_id)')->from('project_participation AS pp')->join('LEFT JOIN', 'projects AS pj', 'pp.project_ref_id = pj.project_id')->where(['AND','pp.user_ref_id = u.id','pj.user_ref_id <> pp.user_ref_id'])->createCommand()->rawSql;
		$query1 = (new Query())->select(['u.id', 'u.pagename AS username', 'u.pagename as pagename'])
					   ->from('user AS u')
					   ->where($projectsquery.'>=5')
					   ->orWhere($participationquery.'>=5')
					   ->orWhere('u.admin_verification=1');
		if(!empty($searchval)) {
		$query1->andWhere(['LIKE' , 'u.pagename', $searchval]);
		}
		
		$query2 = (new Query())->select(['u.id', 'CONCAT(fname, " ", lname) as username', 'u.pagename as pagename'])
					   ->from('user AS u')
					   ->join('LEFT JOIN', 'user_profile AS up', 'up.user_ref_id=u.id');
		if(!empty($searchval)) {
		$query2->andWhere(['LIKE' , 'up.fname', $searchval]);
		$query2->orWhere(['LIKE' , 'up.lname', $searchval]);
		}
		$query2->andWhere('('.$projectsquery.'>=5) OR ('.$participationquery.'>=5) OR (u.admin_verification=1)'); 
		
		$query3 = (new Query())->select(['u.id', 'ut.company_name as username', 'u.pagename as pagename'])
					   ->from('user AS u')
					   ->join('LEFT JOIN', 'user_profile_by_usertype AS ut', 'ut.user_ref_id=u.id');
		if(!empty($searchval)) {
		$query3->andWhere(['LIKE' , 'ut.company_name', $searchval]);
		}
	   $query3->andWhere('('.$projectsquery.'>=5) OR ('.$participationquery.'>=5) OR (u.admin_verification=1)'); 
		
		$uQuery = (new Query())
					->select('id, username, pagename')
					->from([$query1->union($query2, true)->union($query3, true)]);
		$uQuery = $uQuery->orderBy(['username'=>SORT_DESC])->all();
					//print_r($uQuery);exit;
		$result = '<ul class="gresults "  >';
		foreach($uQuery as $user){
			$result .= '<li class="pgusername"><a href="'.Yii::$app->urlManager->createAbsoluteUrl("../../social-partner/".$user['pagename']).'">'.$user['username'].'</a></li>';
		}
		$result .= '<ul>';
		print_r($result);exit;
    }
    
    public static function countrieslist()
    {
        return $countries = array(
        "Afganistan"=>"Afghanistan",
        "Albania"=>"Albania",
        "Algeria"=>"Algeria",
        "American Samoa"=>"American Samoa",
        "Andorra"=>"Andorra",
        "Angola"=>"Angola",
        "Anguilla"=>"Anguilla",
        "Antigua &amp; Barbuda"=>"Antigua and Barbuda",
        "Argentina"=>"Argentina",
        "Armenia"=>"Armenia",
        "Aruba"=>"Aruba",
        "Australia"=>"Australia",
        "Austria"=>"Austria",
        "Azerbaijan"=>"Azerbaijan",
        "Bahamas"=>"Bahamas",
        "Bahrain"=>"Bahrain",
        "Bangladesh"=>"Bangladesh",
        "Barbados"=>"Barbados",
        "Belarus"=>"Belarus",
        "Belgium"=>"Belgium",
        "Belize"=>"Belize",
        "Benin"=>"Benin",
        "Bermuda"=>"Bermuda",
        "Bhutan"=>"Bhutan",
        "Bolivia"=>"Bolivia",
        "Bonaire"=>"Bonaire",
        "Bosnia &amp; Herzegovina"=>"Bosnia &amp; Herzegovina",
        "Botswana"=>"Botswana",
        "Brazil"=>"Brazil",
        "British Indian Ocean Ter"=>"British Indian Ocean Ter",
        "Brunei"=>"Brunei",
        "Bulgaria"=>"Bulgaria",
        "Burkina Faso"=>"Burkina Faso",
        "Burundi"=>"Burundi",
        "Cambodia"=>"Cambodia",
        "Cameroon"=>"Cameroon",
        "Canada"=>"Canada",
        "Canary Islands"=>"Canary Islands",
        "Cape Verde"=>"Cape Verde",
        "Cayman Islands"=>"Cayman Islands",
        "Central African Republic"=>"Central African Republic",
        "Chad"=>"Chad",
        "Channel Islands"=>"Channel Islands",
        "Chile"=>"Chile",
        "China"=>"China",
        "Christmas Island"=>"Christmas Island",
        "Cocos Island"=>"Cocos Island",
        "Colombia"=>"Colombia",
        "Comoros"=>"Comoros",
        "Congo"=>"Congo",
        "Cook Islands"=>"Cook Islands",
        "Costa Rica"=>"Costa Rica",
        "Cote DIvoire"=>"Cote D'Ivoire",
        "Croatia"=>"Croatia",
        "Cuba"=>"Cuba",
        "Curaco"=>"Curacao",
        "Cyprus"=>"Cyprus",
        "Czech Republic"=>"Czech Republic",
        "Denmark"=>"Denmark",
        "Djibouti"=>"Djibouti",
        "Dominica"=>"Dominica",
        "Dominican Republic"=>"Dominican Republic",
        "East Timor"=>"East Timor",
        "Ecuador"=>"Ecuador",
        "Egypt"=>"Egypt",
        "El Salvador"=>"El Salvador",
        "Equatorial Guinea"=>"Equatorial Guinea",
        "Eritrea"=>"Eritrea",
        "Estonia"=>"Estonia",
        "Ethiopia"=>"Ethiopia",
        "Falkland Islands"=>"Falkland Islands",
        "Faroe Islands"=>"Faroe Islands",
        "Fiji"=>"Fiji",
        "Finland"=>"Finland",
        "France"=>"France",
        "French Guiana"=>"French Guiana",
        "French Polynesia"=>"French Polynesia",
        "French Southern Ter"=>"French Southern Ter",
        "Gabon"=>"Gabon",
        "Gambia"=>"Gambia",
        "Georgia"=>"Georgia",
        "Germany"=>"Germany",
        "Ghana"=>"Ghana",
        "Gibraltar"=>"Gibraltar",
        "Great Britain"=>"Great Britain",
        "Greece"=>"Greece",
        "Greenland"=>"Greenland",
        "Grenada"=>"Grenada",
        "Guadeloupe"=>"Guadeloupe",
        "Guam"=>"Guam",
        "Guatemala"=>"Guatemala",
        "Guinea"=>"Guinea",
        "Guyana"=>"Guyana",
        "Haiti"=>"Haiti",
        "Hawaii"=>"Hawaii",
        "Honduras"=>"Honduras",
        "Hong Kong"=>"Hong Kong",
        "Hungary"=>"Hungary",
        "Iceland"=>"Iceland",
        "India"=>"India",
        "Indonesia"=>"Indonesia",
        "Iran"=>"Iran",
        "Iraq"=>"Iraq",
        "Ireland"=>"Ireland",
        "Isle of Man"=>"Isle of Man",
        "Israel"=>"Israel",
        "Italy"=>"Italy",
        "Jamaica"=>"Jamaica",
        "Japan"=>"Japan",
        "Jordan"=>"Jordan",
        "Kazakhstan"=>"Kazakhstan",
        "Kenya"=>"Kenya",
        "Kiribati"=>"Kiribati",
        "Korea North"=>"Korea North",
        "Korea Sout"=>"Korea South",
        "Kuwait"=>"Kuwait",
        "Kyrgyzstan"=>"Kyrgyzstan",
        "Laos"=>"Laos",
        "Latvia"=>"Latvia",
        "Lebanon"=>"Lebanon",
        "Lesotho"=>"Lesotho",
        "Liberia"=>"Liberia",
        "Libya"=>"Libya",
        "Liechtenstein"=>"Liechtenstein",
        "Lithuania"=>"Lithuania",
        "Luxembourg"=>"Luxembourg",
        "Macau"=>"Macau",
        "Macedonia"=>"Macedonia",
        "Madagascar"=>"Madagascar",
        "Malaysia"=>"Malaysia",
        "Malawi"=>"Malawi",
        "Maldives"=>"Maldives",
        "Mali"=>"Mali",
        "Malta"=>"Malta",
        "Marshall Islands"=>"Marshall Islands",
        "Martinique"=>"Martinique",
        "Mauritania"=>"Mauritania",
        "Mauritius"=>"Mauritius",
        "Mayotte"=>"Mayotte",
        "Mexico"=>"Mexico",
        "Midway Islands"=>"Midway Islands",
        "Moldova"=>"Moldova",
        "Monaco"=>"Monaco",
        "Mongolia"=>"Mongolia",
        "Montserrat"=>"Montserrat",
        "Morocco"=>"Morocco",
        "Mozambique"=>"Mozambique",
        "Myanmar"=>"Myanmar",
        "Nambia"=>"Nambia",
        "Nauru"=>"Nauru",
        "Nepal"=>"Nepal",
        "Netherland Antilles"=>"Netherland Antilles",
        "Netherlands"=>"Netherlands (Holland, Europe)",
        "Nevis"=>"Nevis",
        "New Caledonia"=>"New Caledonia",
        "New Zealand"=>"New Zealand",
        "Nicaragua"=>"Nicaragua",
        "Niger"=>"Niger",
        "Nigeria"=>"Nigeria",
        "Niue"=>"Niue",
        "Norfolk Island"=>"Norfolk Island",
        "Norway"=>"Norway",
        "Oman"=>"Oman",
        "Pakistan"=>"Pakistan",
        "Palau Island"=>"Palau Island",
        "Palestine"=>"Palestine",
        "Panama"=>"Panama",
        "Papua New Guinea"=>"Papua New Guinea",
        "Paraguay"=>"Paraguay",
        "Peru"=>"Peru",
        "Phillipines"=>"Philippines",
        "Pitcairn Island"=>"Pitcairn Island",
        "Poland"=>"Poland",
        "Portugal"=>"Portugal",
        "Puerto Rico"=>"Puerto Rico",
        "Qatar"=>"Qatar",
        "Republic of Montenegro"=>"Republic of Montenegro",
        "Republic of Serbia"=>"Republic of Serbia",
        "Reunion"=>"Reunion",
        "Romania"=>"Romania",
        "Russia"=>"Russia",
        "Rwanda"=>"Rwanda",
        "St Barthelemy"=>"St Barthelemy",
        "St Eustatius"=>"St Eustatius",
        "St Helena"=>"St Helena",
        "St Kitts-Nevis"=>"St Kitts-Nevis",
        "St Lucia"=>"St Lucia",
        "St Maarten"=>"St Maarten",
        "St Pierre &amp; Miquelon"=>"St Pierre &amp; Miquelon",
        "St Vincent &amp; Grenadines"=>"St Vincent &amp; Grenadines",
        "Saipan"=>"Saipan",
        "Samoa"=>"Samoa",
        "Samoa American"=>"Samoa American",
        "San Marino"=>"San Marino",
        "Sao Tome &amp; Principe"=>"Sao Tome &amp; Principe",
        "Saudi Arabia"=>"Saudi Arabia",
        "Senegal"=>"Senegal",
        "Serbia"=>"Serbia",
        "Seychelles"=>"Seychelles",
        "Sierra Leone"=>"Sierra Leone",
        "Singapore"=>"Singapore",
        "Slovakia"=>"Slovakia",
        "Slovenia"=>"Slovenia",
        "Solomon Islands"=>"Solomon Islands",
        "Somalia"=>"Somalia",
        "South Africa"=>"South Africa",
        "Spain"=>"Spain",
        "Sri Lanka"=>"Sri Lanka",
        "Sudan"=>"Sudan",
        "Suriname"=>"Suriname",
        "Swaziland"=>"Swaziland",
        "Sweden"=>"Sweden",
        "Switzerland"=>"Switzerland",
        "Syria"=>"Syria",
        "Tahiti"=>"Tahiti",
        "Taiwan"=>"Taiwan",
        "Tajikistan"=>"Tajikistan",
        "Tanzania"=>"Tanzania",
        "Thailand"=>"Thailand",
        "Togo"=>"Togo",
        "Tokelau"=>"Tokelau",
        "Tonga"=>"Tonga",
        "Trinidad &amp; Tobago"=>"Trinidad &amp; Tobago",
        "Tunisia"=>"Tunisia",
        "Turkey"=>"Turkey",
        "Turkmenistan"=>"Turkmenistan",
        "Turks &amp; Caicos Is"=>"Turks &amp; Caicos Is",
        "Tuvalu"=>"Tuvalu",
        "Uganda"=>"Uganda",
        "Ukraine"=>"Ukraine",
        "United Arab Erimates"=>"United Arab Emirates",
        "United Kingdom"=>"United Kingdom",
        "United States of America"=>"United States of America",
        "Uraguay"=>"Uruguay",
        "Uzbekistan"=>"Uzbekistan",
        "Vanuatu"=>"Vanuatu",
        "Vatican City State"=>"Vatican City State",
        "Venezuela"=>"Venezuela",
        "Vietnam"=>"Vietnam",
        "Virgin Islands (Brit)"=>"Virgin Islands (Brit)",
        "Virgin Islands (USA)"=>"Virgin Islands (USA)",
        "Wake Island"=>"Wake Island",
        "Wallis &amp; Futana Is"=>"Wallis &amp; Futana Is",
        "Yemen"=>"Yemen",
        "Zaire"=>"Zaire",
        "Zambia"=>"Zambia",
        "Zimbabwe"=>"Zimbabwe");
    }

    public static function getReportDetails($category){
        if($category){
            $sql = "SELECT ".$category." AS category,COUNT(*) AS studentscount FROM student WHERE ".$category." IS NOT NULL GROUP BY ".$category ;
            $studentdata = yii::$app->db->createCommand($sql)->queryAll();
            return json_encode($studentdata);
        }
        }
		
	public static function validateEmail($email)
    {
       $data = (new Query())->select('id')	
                    ->from('user')
                    ->where(['email' => $email])
                    ->all();
		return count($data);
	}
	
	public static function validateRollno($rollno)
    {
       $data = (new Query())->select('id')	
                    ->from('student')
                    ->where(['rollno' => $rollno])
                    ->all();
		return count($data);
	}
}
