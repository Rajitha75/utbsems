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
class AssignLecturerModule extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lecturer_to_module';
    }
	
	public static function checkExistingRecords($module_id, $lecturer_id){
        $data = (new Query())->select('*')
        ->from('lecturer_to_module')->where(['lecturer_id' => $lecturer_id])->andWhere(['module_id' => $module_id])->all();
        return $data;
    }
	
	public static function getAllRecords(){
        $data = (new Query())->select(['pf.id', 'pf.lecturer_id', 'pf.module_id', 'name', 'module_name'])
        ->from('lecturer_to_module AS pf')
		->join('LEFT JOIN', 'lecturers AS p', 'p.user_ref_id = pf.lecturer_id')
		->join('LEFT JOIN', 'modules AS f', 'f.id = pf.module_id')
		->orderBy(['pf.id'=>SORT_ASC]);
        return $data;
    }
	
	
	public static function deleteRecord($id){
        $result = Yii::$app->db->createCommand()->delete('lecturer_to_module', ['id' => $id])->execute();
        return true;
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

}
