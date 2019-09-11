<?php

namespace backend\models;

use Yii;
use yii\db\Query;
use yii\base\Model;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $confirmation_token
 * @property integer $status
 * @property integer $superadmin
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $email
 * @property integer $email_confirmed
 * @property string $user_role_ref_id
 * @property integer $category_ref_id
 * @property integer $created_by
 * @property integer $modified_by
 * @property integer $is_profile_set
 * @property integer $media_agency_ref_id
 * 
 * @property AdminAssignedUserTypes[] $adminAssignedUserTypes
 * @property AdminLocation[] $adminLocations
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Communique[] $communiques
 * @property UserCategory $categoryRef
 * @property UserType $userTypeRef
 * @property UserProfile[] $userProfiles
 * @property UserProfileByUsertype $userProfileByUsertype
 * @property UserSettings[] $userSettings
 * @property UserVisitLog[] $userVisitLogs
 */
class User extends \yii\db\ActiveRecord
{
    public $location, $userEmail, $from_date, $to_date, $userrole, $verifystatus;
   
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['username', 'email'];
        $scenarios['create'] = ['username', 'email'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required', 'on'=>'create'],
            [['username', 'email'], 'required', 'on'=>'update'],
            [['status', 'superadmin', 'updated_at', 'email_confirmed', 'category_ref_id', 'created_by', 'modified_by','is_profile_set', 'media_agency_ref_id'], 'integer'],
            [['user_role_ref_id'], 'string'],
            [['username', 'password_hash', 'confirmation_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 128],
            //['email','email', 'on'=>'create'],
            //['email','email', 'on'=>'update'],
            ['email', 'filter', 'filter' => 'trim','on'=>'create'],
            ['email', 'filter', 'filter' => 'trim','on'=>'update'],
            ['email','unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on'=>'create'],
            ['username','unique','on'=>'create'],
            [['location', 'userEmail', 'from_date', 'to_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'confirmation_token' => 'Confirmation Token',
            'status' => 'Status',
            'superadmin' => 'Superadmin',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'registration_ip' => 'Registration Ip',
            'email' => 'Email',
            'email_confirmed' => 'Email Confirmed',
            'user_role_ref_id' => 'User Role',
            'category_ref_id' => 'Category Ref ID',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
            'media_agency_ref_id' => 'Media Agency', 
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

   /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getAdminLocations()
    {
        return $this->hasMany(AdminLocation::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommuniques()
    {
        return $this->hasMany(Communique::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqs()
    {
        return $this->hasMany(Faq::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryRef()
    {
        return $this->hasOne(UserCategory::className(), ['user_category_id' => 'category_ref_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   
		
		public static function getUserRole($id){
			$data = (new Query())->select('user_role_ref_id')	
						->from('user')
						->where(['id' => $id])
						->one();
			return $data['user_role_ref_id'];
		}
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfile::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfileByUsertype()
    {
        return $this->hasOne(UserProfileByUsertype::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSettings()
    {
        return $this->hasMany(UserSettings::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitLogs()
    {
        return $this->hasMany(UserVisitLog::className(), ['user_id' => 'id']);
    }
    
    public function signup($randomPwd, $userrole, $usertyperefid)
    {
        if (!$this->validate()) {
            return null;
        }        
        
        $user = new \common\models\User();
        $this->password_hash = $randomPwd;
        if(\common\controllers\CommonController::checkForXss($this->username))
            $user->username = $this->username;
        if(\common\controllers\CommonController::checkForXss($this->email))
            $user->email = $this->email;  
        $user->status = 1;
        $user->user_role_ref_id = $userrole;
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();       
        
        
        /* $location = new \app\models\AdminLocation();
        $location->location_ref_id = $this->location;
        $location->user_ref_id = $user->id;   */
              
        
        return $user->save() ? $user : null;
    } 
	

    public static function getAllUserData()
    {
        $users = (new Query())->select(['CONCAT( username) AS value','u.id','u.email', 'u.auth_key'])
                    ->from('user AS u')
                    ->where(['u.status' => 1])
                    ->andWhere(['not', ['u.username' => null]])
                    ->andWhere(['not', ['up.fname' => null]])
                    ->groupBy('u.id')
                    ->orderBy('email')->all();
        return $users;
    }
	public static function getUserDetails($id)
    { 
        $userData = (new Query())->select(['u.id','u.email', 'u.username AS uname', 'u.auth_key', 'u.is_profile_set', 'u.created_at', 'u.username'])
			->from('user AS u')
            ->join('LEFT JOIN', 'status AS s', 's.status_id=u.status')
			->where(['id' => $id])->all();
        return $userData;
    }

    public static function getAdminList($email,$fromDate,$toDate,$mediaAgency,$userType,$userStatus,$userRole)
    {
        $uQuery = (new Query())->select(['id', 'username', 'email', 'user.status', 'us.status_name AS status_name', 'created_at'])
                    ->from('user')
                    ->join('LEFT JOIN', 'user_status AS us', 'us.user_status_id = user.status');
                    
        if(!empty($email) || !empty($fromDate) || !empty($toDate) || !empty($userType) || !empty($userStatus) || !empty($mediaAgency) || !empty($userRole)) {	   
            if(!empty($email))   $uQuery->andWhere(['LIKE' , 'user.email', trim($email)])->orWhere(['LIKE' , 'user.username', trim($email)])->orWhere(['LIKE' , 'ut.company_name', trim($email)]);
            if(!empty($fromDate))   $uQuery->andWhere('DATE_FORMAT(FROM_UNIXTIME(user.created_at), "%Y-%m-%d") >= "'.date('Y-m-d', strtotime($fromDate)).'"');
            if(!empty($toDate))   $uQuery->andWhere('DATE_FORMAT(FROM_UNIXTIME(user.created_at), "%Y-%m-%d") <= "'.date('Y-m-d', strtotime($toDate)).'"');
            if(!empty($userRole)) $uQuery->andWhere(['user.user_role_ref_id' => $userRole]);				   
        }
		 $sort = Yii::$app->getRequest()->getQueryParam('sort') ? Yii::$app->getRequest()->getQueryParam('sort') : "";
        if (empty($sort))
        $uQuery->orderBy(['user.created_at'=>SORT_DESC]);

        return $uQuery;
    }

  
    public static function getAllUserDetails($uid)
    {
        $userDetails = (new Query())->select(['u.id', 'id as id'])
        ->from('user AS u')
        ->where(['u.id' => $uid])->all();
        return $userDetails;
    }

    public static function getUserCount()
    {
		$uQuery = (new Query())->select('u.id')
                ->from('user AS u')
                ->where('(u.user_role_ref_id = 2)')
                ->andWhere(['u.superadmin' => 0]);
        return $uQuery;
    }

	/*-----------------------------------------------*/
	
    public static function getUserByEmail($email)
    {
        $userprofile = (new Query())->select('u.id, u.email, up.fname, up.lname')
                    ->from('user AS u')
                    ->join('LEFT JOIN', 'user_profile AS up', 'u.id=up.user_ref_id')
                    ->where(['u.email' => $email]);
        return $userprofile;
    }
	
	public static function getUserByUsername($username)
    {
        $user = (new Query())->select('u.id')
                    ->from('user')
                    ->where(['username' => $username]);
        return $user;
    }
  
	public static function getUserNameById($id){
		$uQuery = (new Query())
					->select(['CONCAT(fname, " ", lname) AS username'])
					->from('user_profile')
					->where(['user_ref_id' => $id])->all();
		return !empty($uQuery[0]['username']) ? $uQuery[0]['username'] : '';
    }
    
	
	public static function getViewDetails($uid,$utypeid) {
		$result=(new Query())->select(['u.id','u.username','u.email'])->from('user as u')
				->where(['u.id'=>$uid]);
		$result=$result->all();
		return $result;
	}

}
