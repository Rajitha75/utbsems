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
class Faculty extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

	 public static function getAllFaculty(){
        $data = (new Query())->select('*')
        ->from('faculty')->where(['status' => 1])->orderBy(['faculty_name'=>SORT_ASC])->all();
        return $data;
    }
	
	public static function getAllFacultyList($faculty_name){
        $uQuery = (new Query())->select('*')
        ->from('faculty')
		->where(1);
		if(!empty($faculty_name)){
			if(!empty($faculty_name))   $uQuery->andWhere(['LIKE' , 'faculty_name', $faculty_name]);
		}
		$uQuery->orderBy(['faculty_name'=>SORT_ASC]);
        return $uQuery;
    }
	
	public static function getFacultyIfExists($faculty_name){
        $data = (new Query())->select('*')
        ->from('faculty')->where('LOWER(faculty_name) = LOWER("'.$faculty_name.'")')->all();
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
