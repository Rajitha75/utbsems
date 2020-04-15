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
class AssignModuleProgramme extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_to_programme';
    }
	
	public static function checkExistingRecords($module_id, $programme_id, $semister){
        $data = (new Query())->select('*')
        ->from('module_to_programme')->where(['programme_id' => $programme_id])->andWhere(['module_id' => $module_id])->andWhere(['semister' => $semister])->all();
        return $data;
    }
	
	public static function getAllRecords(){
        $data = (new Query())->select(['pf.id', 'pf.programme_id', 'pf.module_id', 'programme_name', 'module_name', 'semister'])
        ->from('module_to_programme AS pf')
		->join('LEFT JOIN', 'programme AS p', 'p.id = pf.programme_id')
		->join('LEFT JOIN', 'modules AS f', 'f.id = pf.module_id')
		->orderBy(['pf.id'=>SORT_ASC]);
        return $data;
    }
	
	
	public static function deleteRecord($id){
        $result = Yii::$app->db->createCommand()->delete('module_to_programme', ['id' => $id])->execute();
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