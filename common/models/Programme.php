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
class Programme extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'programme';
    }

    /**
     * @inheritdoc
     */
	public static function getAllProgrammes(){
        $data = (new Query())->select('*')
        ->from('programme')->where(['status' => 1])->orderBy(['programme_name'=>SORT_ASC])->all();
        return $data;
    }
	
	public static function getAllProgrammeList(){
        $data = (new Query())->select(['p.id AS pid', 'p.programme_name', 'p.faculty_id', 'f.id AS fid', 'faculty_name', 'p.status'])
        ->from('programme AS p')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = p.faculty_id')
		->orderBy(['programme_name'=>SORT_ASC]);
        return $data;
    }
	
	public static function getProgrammeIfExists($programme_name){
        $data = (new Query())->select('*')
        ->from('programme')->where('LOWER(programme_name) = LOWER("'.$programme_name.'")')->all();
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
