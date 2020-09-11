<?php
namespace common\models;
use yii\db\Query;
use Yii;
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
 * @property string $type_of_residential  
 */
class StudentKinDetails extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'student_kin_details';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
	 
	 public static function deleteRecord($id){
        $result = Yii::$app->db->createCommand()->delete('student_kin_details', ['kin_id' => $id])->execute();
        return true;
    }
	
	public function attributeLabels()
    {
        return [
        ];
    }
	
	public static function getStudentKinDetailsByStudentId($id){
		$data = (new Query())->select(['sk.*'])
        ->from('student_kin_details AS sk')->where(['student_id' => $id])->all();
        return $data;
	}
}
