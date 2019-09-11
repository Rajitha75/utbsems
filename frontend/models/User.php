<?php

namespace frontend\models;

use yii\base\Model;
use yii;
use yii\db\Query;
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
 * @property string $registration_ip
 * @property string $bind_to_ip
 * @property string $email
 * @property integer $email_confirmed
 * @property integer $user_type_ref_id
 * @property string $user_role_ref_id
 * @property integer $category_ref_id
 * @property integer $created_by
 * @property integer $modified_by
 * @property string $pagename
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Communique[] $communiques
 * @property Faq[] $faqs
 * @property ProjectCoOwners[] $projectCoOwners
 * @property ProjectComments[] $projectComments
 * @property ProjectParticipation[] $projectParticipations
 * @property ProjectRating[] $projectRatings
 * @property ProjectRecommend[] $projectRecommends
 * @property ProjectRecommend[] $projectRecommends0
 * @property ProjectSearch[] $projectSearches
 * @property UserProfile[] $userProfiles
 * @property UserProfileByUsertype $userProfileByUsertype
 * @property UserSettings[] $userSettings
 * @property UserVisitLog[] $userVisitLogs
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'superadmin', 'created_at', 'updated_at', 'email_confirmed', 'user_type_ref_id', 'category_ref_id', 'created_by', 'modified_by'], 'integer'],
            [['user_role_ref_id'], 'string'],
            [['username', 'password_hash', 'confirmation_token', 'bind_to_ip'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 128],
            [['otp_code','pagename'], 'safe'],
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
            'password_hash' => 'Password Hash',
            'confirmation_token' => 'Confirmation Token',
            'status' => 'Status',
            'superadmin' => 'Superadmin',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'registration_ip' => 'Registration Ip',
            'bind_to_ip' => 'Bind To Ip',
            'email' => 'Email',
            'email_confirmed' => 'Email Confirmed',
            'user_type_ref_id' => 'User Type Ref ID',
            'user_role_ref_id' => 'User Role Ref ID',
            'category_ref_id' => 'Category Ref ID',
            'created_by' => 'Created By',
            'modified_by' => 'Modified By',
			'pagename' => 'Page Name'
        ];
    }
	public static function findByEmail($email)
    {
        //return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['email' => $email]);
    }
	
	public static function findByUsername($username)
    {
        //return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['username' => $username]);
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
    public function getProjectCoOwners()
    {
        return $this->hasMany(ProjectCoOwners::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectComments()
    {
        return $this->hasMany(ProjectComments::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectParticipations()
    {
        return $this->hasMany(ProjectParticipation::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRatings()
    {
        return $this->hasMany(ProjectRating::className(), ['user_ref_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRecommends()
    {
        return $this->hasMany(ProjectRecommend::className(), ['user_ref_id_recommended_to' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectRecommends0()
    {
        return $this->hasMany(ProjectRecommend::className(), ['user_ref_id_recommended_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectSearches()
    {
        return $this->hasMany(ProjectSearch::className(), ['user_ref_id' => 'id']);
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
    
    public static function getUserDetails($id, $user_type = '')
    { 
        if(empty($user_type))
        {
            $userData = (new Query())->select(['u.id','u.email', 'u.username AS uname', 'u.auth_key', 'u.is_profile_set', 'u.user_type_ref_id', 'IF((u.user_type_ref_id=5 OR u.user_type_ref_id=10), upt.company_name, CONCAT(fname, " ", lname)) as username', 'fname', 'lname', 'up.mobile', 'IF(u.country_code, u.country_code, up.country_code) as country_code'])
                    ->from('user AS u')
                    ->join('LEFT JOIN', 'user_profile AS up', 'u.id=up.user_ref_id')
					->join('LEFT JOIN', 'user_profile_by_usertype AS upt', 'upt.user_ref_id = u.id')
                    ->where(['id' => $id])->all();
        } else {
            $userData = (new Query())->select(['u.id','u.email', 'u.username AS uname', 'u.auth_key', 'u.is_profile_set', 'u.user_type_ref_id', 'IF((u.user_type_ref_id=5 OR u.user_type_ref_id=10), upt.company_name, CONCAT(fname, " ", lname)) as username', 'fname', 'lname', 'up.mobile', 'IF(u.country_code, u.country_code, up.country_code) as country_code'])
                    ->from('user AS u')
                    ->join('LEFT JOIN', 'user_profile AS up', 'u.id=up.user_ref_id')
					->join('LEFT JOIN', 'user_profile_by_usertype AS upt', 'upt.user_ref_id = u.id')
                    ->where(['id' => $id])->all();
        }
        return $userData;
    }
    
    public function forgotpassword($randomPwd, $uid)
    {
        $user =  \common\models\User::find()->where(['id' => $uid])->one();
        $this->password_hash = $randomPwd;   
        $user->setPassword($this->password_hash);
        $user->generateAuthKey();
        $user->save();   
        return $user->save() ? $user : null;
    }      
	
	public static function getUserByEmail($email)
	{
	$userprofile = (new Query())->select(['u.id', 'u.email', 'IF((u.user_type_ref_id=5 OR u.user_type_ref_id=10), upt.company_name, CONCAT(fname, " ", lname)) as username', 'up.fname', 'up.lname'])
				   ->from('user AS u')
				   ->join('LEFT JOIN', 'user_profile AS up', 'u.id=up.user_ref_id')
					->join('LEFT JOIN', 'user_profile_by_usertype AS upt', 'upt.user_ref_id = u.id')
				   ->where(['u.email' => $email])->all();
	return $userprofile;
	}
    
    public static function getUserData($id,$uid)
    {
        $userTypeId = (new Query())->select('u.user_type_ref_id')->from('projects AS p')
							->join('LEFT JOIN', 'user AS u', 'p.user_ref_id = u.id')
							->where(['project_id' => $id]);
		$subquery = (new Query())->select('user_ref_id')->from('project_co_owners')->where(['project_ref_id' => $id]);					
		$users = (new Query())->select(['IF((user_type_ref_id=5 OR user_type_ref_id=10), CONCAT(upt.company_name, " ", username, " ", user_type), CONCAT(fname, " ", lname, " ", username, " ", user_type)) as value','id as id', 'user.user_type_ref_id'])
					->from('user')
				   ->join('LEFT JOIN', 'project_co_owners AS pc', 'pc.user_ref_id = user.id')
				   ->join('LEFT JOIN', 'user_profile AS up', 'user.id = up.user_ref_id')
				   ->join('LEFT JOIN', 'user_type AS ut', 'user.user_type_ref_id = ut.user_type_id')
				   ->join('LEFT JOIN', 'user_profile_by_usertype AS upt', 'upt.user_ref_id = user.id')
				   ->where(['<>','user.id', $uid])
				   ->andWhere(['user.user_type_ref_id' => $userTypeId])
				   ->andWhere(['user.status' => 1])
				   ->andWhere(['not in','user.id',$subquery])
				   ->groupBy('user.id')
				   ->orderBy('email')->all();
        return $users;
    }


    public static function getUserRole($id){
        $data = (new Query())->select('user_role_ref_id')	
                    ->from('user')
                    ->where(['id' => $id])
                    ->one();
        return $data['user_role_ref_id'];
    }
	
	public static function getUserTypeId($id){
        $data = (new Query())->select('user_type_ref_id')	
                    ->from('user')
                    ->where(['id' => $id])
                    ->one();
        return $data['user_type_ref_id'];
    }
	
	public static function getUserTypeName($id){
	
        $data = (new Query())->select('user_type')	
                    ->from('user_type')
                    ->where(['user_type_id' => $id])
                    ->one();
        return !empty($data['user_type']) ? $data['user_type'] : '';
    }

	public static function getUserTypes()
    {	
	try{
		$userscount = (new Query())->select(['ut.user_type', 'ut.user_type_id', 'ut.user_type_image'])
					->from('user_type AS ut')
					->where(['ut.status' => 1])
					->orderby('ut.orderid')
					->all();
        return $userscount;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public static function getUserTypeCount($utypeid)
    {	
	try{
		$userscount = (new Query())->select(['COUNT(u.id) AS usercount'])
					->from('user AS u')
					->where(['NOT', ['u.user_type_ref_id' => null]])
					->andWhere(['u.user_type_ref_id' => $utypeid])
					->count();
        return $userscount;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public static function getUserListByUserType($usertype,$username)
    {		
		try{
		$subquery = (new Query())->select('COUNT(project_sme_id)')->from('project_smes AS sme')->where(['AND','sme.project_ref_id = p.project_id'])->createCommand()->rawSql;  
		$projectsquery = (new Query())->select('COUNT(project_id)')->from('projects AS p')->where(['AND','p.user_ref_id = u.id', 'IF(('.$subquery.')>0, (p.sme_project_status=1 OR p.sme_project_status=13), (p.project_status=1 OR p.project_status=13))']);
		$participationquery = (new Query())->select('COUNT(project_participation_id)')->from('project_participation AS pp')->join('LEFT JOIN', 'projects AS pj', 'pp.project_ref_id = pj.project_id')->where(['AND','pp.user_ref_id = u.id','pj.user_ref_id <> pp.user_ref_id']);
		$users = (new Query())->select(['u.id','u.pagename', 'u.is_profile_set', 'IF((u.user_type_ref_id=5 OR u.user_type_ref_id=10), upt.company_name, CONCAT(up.fname, " ", up.lname)) as profilename', 'up.user_image', 'projectscount' => $projectsquery, 'participationcount' => $participationquery, 'u.admin_verification', 'u.user_type_ref_id'])
					->from('user AS u')
					->join('LEFT JOIN', 'user_profile AS up', 'u.id = up.user_ref_id')
				   ->join('LEFT JOIN', 'user_profile_by_usertype AS upt', 'upt.user_ref_id = u.id')
					->where(['u.user_type_ref_id' => $usertype]);
		(!empty($username)) ? $users->andWhere(['LIKE' , 'IF((u.user_type_ref_id=5 OR u.user_type_ref_id=10), upt.company_name, CONCAT(up.fname, " ", up.lname))', $username]) : "";
		$users->orderby(['created_at'=>SORT_DESC]);
        return $users;
		} catch (\Exception $e) {
            \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public static function getTotalVerifiedUsers()
    {		
		try{
		$subquery = (new Query())->select('COUNT(project_sme_id)')->from('project_smes AS sme')->where(['AND','sme.project_ref_id = p.project_id'])->createCommand()->rawSql;  
		$projectsquery = (new Query())->select('COUNT(project_id)')->from('projects AS p')->where(['AND','p.user_ref_id = u.id', 'IF(('.$subquery.')>0, (p.sme_project_status=1 OR p.sme_project_status=13), (p.project_status=1 OR p.project_status=13))'])->createCommand()->rawSql;
		$participationquery = (new Query())->select('COUNT(project_participation_id)')->from('project_participation AS pp')->join('LEFT JOIN', 'projects AS pj', 'pp.project_ref_id = pj.project_id')->where(['AND','pp.user_ref_id = u.id','pj.user_ref_id <> pp.user_ref_id'])->createCommand()->rawSql;
		$users = (new Query())->select(['u.id'])
					->from('user AS u')
					->where($projectsquery.'>0')
					->orWhere($participationquery.'>0')
					->orWhere('u.admin_verification=1');
		$userscount = $users->count();
		return $userscount;		   
		} catch (\Exception $e) {
          \common\controllers\CommonController::exceptionMessage($e->getMessage());
        }
    }
	
	public static function isprofileset($uid){
		$user = (new Query())->select('is_profile_set')->from('user')->where(['id' => $uid])->all();
		return $user[0]['is_profile_set'];
	}
}
