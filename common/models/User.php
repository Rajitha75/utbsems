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
        "British Indian Ocean Territory"=>"British Indian Ocean Territory",
        "Brunei"=>"Brunei",
        "Bulgaria"=>"Bulgaria",
        "Burkina Faso"=>"Burkina Faso",
        "Burundi"=>"Burundi",
        "Cambodia"=>"Cambodia",
        "Cameroon"=>"Cameroon",
        "Canada"=>"Canada",
        "Cape Verde"=>"Cape Verde",
        "Cayman Islands"=>"Cayman Islands",
        "Central African Republic"=>"Central African Republic",
        "Chad"=>"Chad",
        "Chile"=>"Chile",
        "China"=>"China",
        "Christmas Island"=>"Christmas Island",
        "Cocos Island"=>"Cocos Island",
        "Colombia"=>"Colombia",
        "Comoros"=>"Comoros",
        "Congo"=>"Congo",
        "Cook Islands"=>"Cook Islands",
        "Costa Rica"=>"Costa Rica",
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
        "Gabon"=>"Gabon",
        "Gambia"=>"Gambia",
        "Georgia"=>"Georgia",
        "Germany"=>"Germany",
        "Ghana"=>"Ghana",
        "Gibraltar"=>"Gibraltar",
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
        "Turks &amp; Caicos Island"=>"Turks &amp; Caicos Island",
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
        "Wallis &amp; Futana Island"=>"Wallis &amp; Futana Island",
        "Yemen"=>"Yemen",
        "Zaire"=>"Zaire",
        "Zambia"=>"Zambia",
        "Zimbabwe"=>"Zimbabwe");
    }
	
	public static function countrieslistByIsoCode()
    {
        return $countries = array(
        "93"=>"Afganistan",
        "355"=>"Albania",
        "213"=>"Algeria",
        "1-684"=>"American Samoa",
        "376"=>"Andorra",
        "244"=>"Angola",
        "1-264"=>"Anguilla",
        "1-268"=>"Antigua &amp; Barbuda",
        "54"=>"Argentina",
        "374"=>"Armenia",
        "297"=>"Aruba",
        "61"=>"Australia",
        "43"=>"Austria",
        "994"=>"Azerbaijan",
        "1-242"=>"Bahamas",
        "973"=>"Bahrain",
        "880"=>"Bangladesh",
        "1-246"=>"Barbados",
        "375"=>"Belarus",
        "32"=>"Belgium",
        "501"=>"Belize",
        "229"=>"Benin",
        "1-441"=>"Bermuda",
        "975"=>"Bhutan",
        "591"=>"Bolivia",
        "599-7"=>"Bonaire",
        "387"=>"Bosnia &amp; Herzegovina",
        "267"=>"Botswana",
        "55"=>"Brazil",
        "246"=>"British Indian Ocean Territory",
        "673"=>"Brunei",
        "359"=>"Bulgaria",
        "226"=>"Burkina Faso",
        "257"=>"Burundi",
        "855"=>"Cambodia",
        "237"=>"Cameroon",
        "1"=>"Canada",
        "238"=>"Cape Verde",
        "1-345"=>"Cayman Islands",
        "236"=>"Central African Republic",
        "235"=>"Chad",
        "56"=>"Chile",
        "86"=>"China",
        "61"=>"Christmas Island",
        "61"=>"Cocos Island",
        "57"=>"Colombia",
        "269"=>"Comoros",
        "242"=>"Congo",
        "682"=>"Cook Islands",
        "506"=>"Costa Rica",
        "385"=>"Croatia",
        "53"=>"Cuba",
        "599"=>"Curaco",
        "357"=>"Cyprus",
        "420"=>"Czech Republic",
        "45"=>"Denmark",
        "253"=>"Djibouti",
        "1-767"=>"Dominica",
        "1-809, 1-829, 1-849"=>"Dominican Republic",
        "670"=>"East Timor",
        "593"=>"Ecuador",
        "20"=>"Egypt",
        "503"=>"El Salvador",
        "240"=>"Equatorial Guinea",
        "291"=>"Eritrea",
        "372"=>"Estonia",
        "251"=>"Ethiopia",
        "500"=>"Falkland Islands",
        "298"=>"Faroe Islands",
        "679"=>"Fiji",
        "358"=>"Finland",
        "33"=>"France",
        "594"=>"French Guiana",
        "689"=>"French Polynesia",
        "241"=>"Gabon",
        "220"=>"Gambia",
        "995"=>"Georgia",
        "49"=>"Germany",
        "233"=>"Ghana",
        "350"=>"Gibraltar",
        "30"=>"Greece",
        "299"=>"Greenland",
        "1-473"=>"Grenada",
        "590"=>"Guadeloupe",
        "1-671"=>"Guam",
        "502"=>"Guatemala",
        "224"=>"Guinea",
        "592"=>"Guyana",
        "509"=>"Haiti",
        "808"=>"Hawaii",
        "504"=>"Honduras",
        "852"=>"Hong Kong",
        "36"=>"Hungary",
        "354"=>"Iceland",
        "91"=>"India",
        "62"=>"Indonesia",
        "98"=>"Iran",
        "964"=>"Iraq",
        "353"=>"Ireland",
        "44-1624"=>"Isle of Man",
        "972"=>"Israel",
        "39"=>"Italy",
        "1-876"=>"Jamaica",
        "81"=>"Japan",
        "962"=>"Jordan",
        "7"=>"Kazakhstan",
        "254"=>"Kenya",
        "686"=>"Kiribati",
        "850"=>"Korea North",
        "82"=>"Korea South",
        "965"=>"Kuwait",
        "996"=>"Kyrgyzstan",
        "856"=>"Laos",
        "371"=>"Latvia",
        "961"=>"Lebanon",
        "266"=>"Lesotho",
        "231"=>"Liberia",
        "218"=>"Libya",
        "423"=>"Liechtenstein",
        "370"=>"Lithuania",
        "352"=>"Luxembourg",
        "853"=>"Macau",
        "389"=>"Macedonia",
        "261"=>"Madagascar",
        "60"=>"Malaysia",
        "265"=>"Malawi",
        "960"=>"Maldives",
        "223"=>"Mali",
        "356"=>"Malta",
        "692"=>"Marshall Islands",
        "596"=>"Martinique",
        "222"=>"Mauritania",
        "230"=>"Mauritius",
        "262"=>"Mayotte",
        "52"=>"Mexico",
        "373"=>"Moldova",
        "377"=>"Monaco",
        "976"=>"Mongolia",
        "1-664"=>"Montserrat",
        "212"=>"Morocco",
        "258"=>"Mozambique",
        "95"=>"Myanmar",
        "264"=>"Nambia",
        "674"=>"Nauru",
        "977"=>"Nepal",
        "31"=>"Netherland Antilles",
        "31"=>"Netherlands",
        "1-869"=>"Nevis",
        "687"=>"New Caledonia",
        "64"=>"New Zealand",
        "505"=>"Nicaragua",
        "227"=>"Niger",
        "234"=>"Nigeria",
        "683"=>"Niue",
        "672-3"=>"Norfolk Island",
        "47"=>"Norway",
        "968"=>"Oman",
        "92"=>"Pakistan",
        "680"=>"Palau Island",
        "970"=>"Palestine",
        "507"=>"Panama",
        "675"=>"Papua New Guinea",
        "595"=>"Paraguay",
        "51"=>"Peru",
        "63"=>"Phillipines",
        "64"=>"Pitcairn Island",
        "48"=>"Poland",
        "351"=>"Portugal",
        "1-787, 1-939"=>"Puerto Rico",
        "974"=>"Qatar",
        "382"=>"Republic of Montenegro",
        "381"=>"Republic of Serbia",
        "262"=>"Reunion",
        "40"=>"Romania",
        "7"=>"Russia",
        "250"=>"Rwanda",
        "590"=>"St Barthelemy",
        "599-3"=>"St Eustatius",
        "290"=>"St Helena",
        "1-869"=>"St Kitts-Nevis",
        "1-758"=>"St Lucia",
        "590"=>"St Maarten",
        "508"=>"St Pierre &amp; Miquelon",
        "1-784"=>"St Vincent &amp; Grenadines",
        "1-670"=>"Saipan",
        "685"=>"Samoa",
        "1-684"=>"Samoa American",
        "378"=>"San Marino",
        "239"=>"Sao Tome &amp; Principe",
        "966"=>"Saudi Arabia",
        "221"=>"Senegal",
        "381"=>"Serbia",
        "248"=>"Seychelles",
        "232"=>"Sierra Leone",
        "65"=>"Singapore",
        "421"=>"Slovakia",
        "386"=>"Slovenia",
        "677"=>"Solomon Islands",
        "252"=>"Somalia",
        "27"=>"South Africa",
        "34"=>"Spain",
        "94"=>"Sri Lanka",
        "249"=>"Sudan",
        "597"=>"Suriname",
        "268"=>"Swaziland",
        "46"=>"Sweden",
        "41"=>"Switzerland",
        "963"=>"Syria",
        "689"=>"Tahiti",
        "886"=>"Taiwan",
        "992"=>"Tajikistan",
        "255"=>"Tanzania",
        "66"=>"Thailand",
        "228"=>"Togo",
        "690"=>"Tokelau",
        "676"=>"Tonga",
        "1-868"=>"Trinidad &amp; Tobago",
        "216"=>"Tunisia",
        "90"=>"Turkey",
        "993"=>"Turkmenistan",
        "1-649"=>"Turks &amp; Caicos Island",
        "688"=>"Tuvalu",
        "256"=>"Uganda",
        "380"=>"Ukraine",
        "971"=>"United Arab Erimates",
        "44"=>"United Kingdom",
        "1"=>"United States of America",
        "598"=>"Uraguay",
        "998"=>"Uzbekistan",
        "678"=>"Vanuatu",
        "379"=>"Vatican City State",
        "58"=>"Venezuela",
        "84"=>"Vietnam",
        "1-284"=>"Virgin Islands (Brit)",
        "1-340"=>"Virgin Islands (USA)",
        "681"=>"Wallis &amp; Futana Island",
        "967"=>"Yemen",
        "243"=>"Zaire",
        "260"=>"Zambia",
        "263"=>"Zimbabwe");
    }

    public static function getReportDetails($category){
        if($category){
			if($category == 'programme_name'){
				$sql = "SELECT p.".$category." AS category,COUNT(*) AS studentscount FROM student AS s LEFT JOIN programme AS p ON p.id = s.programme_name WHERE s.".$category." IS NOT NULL GROUP BY s.".$category ;
				$studentdata = yii::$app->db->createCommand($sql)->queryAll();
			}else{
            $sql = "SELECT ".$category." AS category,COUNT(*) AS studentscount FROM student WHERE ".$category." IS NOT NULL GROUP BY ".$category ;
            $studentdata = yii::$app->db->createCommand($sql)->queryAll();
			}
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
