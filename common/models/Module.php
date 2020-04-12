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
class Module extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modules';
    }
	
	public static function getModuleIfExists($modulename){
        $data = (new Query())->select('*')
        ->from('modules')->where('LOWER(module_name) = LOWER("'.$modulename.'")')->all();
        return $data;
    }
	
	public static function getModuleIdIfExists($moduleid){
        $data = (new Query())->select('*')
        ->from('modules')->where('LOWER(module_id) = LOWER("'.$moduleid.'")')->all();
        return $data;
    }
	
	public static function getModuleNames(){
        $data = (new Query())->select('*')
        ->from('modules')->where(['status' => 1])->orderBy(['module_name'=>SORT_ASC])->all();
        return $data;
    }
	
	public static function getModuleNamesByUserID($uid){
        $data = (new Query())->select(['m.id','m.module_name'])
        ->from('modules as m')
		->join('LEFT JOIN', 'lecturer_to_module AS lm', 'm.id = lm.module_id')
		->where(['m.status' => 1])
		->andWhere(['lm.lecturer_id' => $uid])
		->orderBy(['module_name'=>SORT_ASC])->all();
        return $data;
    }
	
	public static function getAllModuleList(){
        $data = (new Query())->select('*')
        ->from('modules')->orderBy(['module_name'=>SORT_ASC])->all();
        return $data;
    }
	
	public static function getAllModuleListRecords(){
        $data = (new Query())->select('*')
        ->from('modules')->orderBy(['module_name'=>SORT_ASC]);
        return $data;
    }
	
	public static function getModulesByLecturer($semister,$userid){
        $data = (new Query())->select(['m.id AS moduleid','m.module_name AS modulename'])
        ->from('modules as m')
		->join('LEFT JOIN', 'lecturer_to_module AS lm', 'm.id = lm.module_id')
		->join('LEFT JOIN', 'module_to_programme AS mp', 'lm.module_id = mp.module_id')
		->where(['m.status' => 1])
		->andWhere(['mp.semister' => $semister])
		->andWhere(['lm.lecturer_id' => $userid])
		->orderBy(['module_name'=>SORT_ASC])->distinct()->all();
        return $data;
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
