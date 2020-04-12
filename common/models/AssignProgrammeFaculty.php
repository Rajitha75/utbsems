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
class AssignProgrammeFaculty extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'programme_to_faculty';
    }
	
	public static function checkExistingRecords($programme_id, $faculty_id){
        $data = (new Query())->select('*')
        ->from('programme_to_faculty')->where(['programme_id' => $programme_id])->andWhere(['faculty_id' => $faculty_id])->all();
        return $data;
    }
	
	public static function getAllRecords(){
        $data = (new Query())->select(['pf.id', 'pf.programme_id', 'pf.faculty_id', 'programme_name', 'faculty_name'])
        ->from('programme_to_faculty AS pf')
		->join('LEFT JOIN', 'programme AS p', 'p.id = pf.programme_id')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->orderBy(['pf.id'=>SORT_ASC]);
        return $data;
    }
	
	
	public static function deleteRecord($id){
        $result = Yii::$app->db->createCommand()->delete('programme_to_faculty', ['id' => $id])->execute();
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
