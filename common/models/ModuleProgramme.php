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
class ModuleProgramme extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'module_programme';
    }

    /**
     * @inheritdoc
     */
	public static function checkModuleProgrammeExists($programmeid, $moduleid, $semister){
        $data = (new Query())->select('*')
        ->from('module_programme')->where(['programme_id' => $programmeid])->andWhere(['module_id' => $moduleid])->andWhere(['semister' => $semister])->count();
        return $data;
    }
	
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
