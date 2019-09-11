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
}
