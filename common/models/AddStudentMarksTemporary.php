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
class AddStudentMarksTemporary extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_marks_temporary';
    }
    
    public static function getExistingStudentsMarks($year, $studentid, $stage){
	    if($year == 1){
		    $sem1 = 1;
		    $sem2 = 2;
	    }else if($year == 2){
		    $sem1 = 3;
		    $sem2 = 4;
	    }else if($year == 3){
		    $sem1 = 5;
		    $sem2 = 6;
	    }else if($year == 4){
		    $sem1 = 7;
		    $sem2 = 8;
	    }
	    $uQuery = (new Query())->select('*')
        ->from('student_marks_temporary')
		->where(['semister' => $sem1])
		->orWhere(['semister' => $sem2])
		->andWhere(['student_id' => $studentid]);
		if($stage){
			$uQuery->andWhere(['stage' => $stage]);
		}
		$uQuery = $uQuery->all();
    //print_r($uQuery);exit;
		return $uQuery;
    }
    
    public static function getAllExistingStudentsMarks($year, $studentid, $stage, $is_submit){
	    if($year == 1){
		    $sem1 = 1;
		    $sem2 = 2;
	    }else if($year == 2){
		    $sem1 = 3;
		    $sem2 = 4;
	    }else if($year == 3){
		    $sem1 = 5;
		    $sem2 = 6;
	    }else if($year == 4){
		    $sem1 = 7;
		    $sem2 = 8;
	    }
	    $uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, ew_percentage,cw_percentage')
		->from('student_marks_temporary as sm')
		->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mrp', 'mrp.module_id = sm.module_id')
		->where(['sm.semister' => $sem1])
		->orWhere(['sm.semister' => $sem2])
		->andWhere(['sm.student_id' => $studentid]);
		if($stage){
			if($stage == 'pa' && $is_submit == 'save'){
				$uQuery->andWhere(['stage' => 'pasaved']);
			}else if($stage == 'pa' && $is_submit == 'submit'){
				$uQuery->andWhere(['stage' => 'pasubmit']);
			}else if($stage == 'pa' && $is_submit == 'savesubmit'){
				$uQuery->andWhere('stage = "pasaved" OR stage = "pasubmit"');
			}else if($stage == 'fs' && $is_submit == 'save'){
				$uQuery->andWhere(['stage' => 'fssaved']);
			}else if($stage == 'fs' && $is_submit == 'submit'){
				$uQuery->andWhere(['stage' => 'fssubmit']);
			}else if($stage == 'fs' && $is_submit == 'savesubmit'){
				$uQuery->andWhere('stage = "fssaved" OR stage = "fssubmit"');
			}else if($stage == 'ueb' && $is_submit == 'save'){
				$uQuery->andWhere(['stage' => 'uebsaved']);
			}else if($stage == 'ueb' && $is_submit == 'submit'){
				$uQuery->andWhere(['stage' => 'uebsubmit']);
			}else if($stage == 'ueb' && $is_submit == 'savesubmit'){
				$uQuery->andWhere('stage = "uebsaved" OR stage = "uebsubmit"');
			}
			
			
			
		}
		$uQuery = $uQuery->groupBy(['sm.id'])->all();
		return $uQuery;
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
