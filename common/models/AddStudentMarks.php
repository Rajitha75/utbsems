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
class AddStudentMarks extends \yii\db\ActiveRecord
{
	
   // public $password_reset_token;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_marks';
    }
	
	public static function getModuleIfExists($modulename){
        $data = (new Query())->select('*')
        ->from('modules')->where('LOWER(module_name) = LOWER("'.$modulename.'")')->all();
        return $data;
    }
	
	public static function getStudentsMarks($semister, $moduleid, $userid){
	    $uQuery = (new Query())->select('sm.*')
		->from('student_marks AS sm')
		->where(['sm.module_id' => $moduleid])
		->andWhere(['sm.semister' => $semister])->distinct()->all();
		return $uQuery;
    }
	
	public static function getStudentFirstYearMarks($studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno, s.id AS studentid, ew_percentage, cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->where(1);
		if($studentid){
		$uQuery->andWhere(['sm.student_id' => $studentid]);
		}
		$uQuery->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mp', 'mp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->andWhere('sm.semister = 1 or sm.semister = 2');
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->all();
		return $uQuery;
	}
	
	public static function getStudentSecondYearMarks($studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno, s.id AS studentid, ew_percentage, cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->where(1);
		if($studentid){
		$uQuery->where(['sm.student_id' => $studentid]);
		}
		$uQuery->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mp', 'mp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->andWhere('sm.semister = 3 or sm.semister = 4');
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->all();
		return $uQuery;
	}
	
	public static function getStudentThirdYearMarks($studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno, s.id AS studentid, ew_percentage, cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->where(1);
		if($studentid){
		$uQuery->where(['sm.student_id' => $studentid]);
		}
		$uQuery->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mp', 'mp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->andWhere('sm.semister = 5 or sm.semister = 6');
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->all();
		return $uQuery;
	}
	
	public static function getStudentFourthYearMarks($studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno, s.id AS studentid, ew_percentage, cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->where(1);
		if($studentid){
		$uQuery->where(['sm.student_id' => $studentid]);
		}
		$uQuery->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mp', 'mp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->andWhere('sm.semister = 7 or sm.semister = 8');
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->all();
		return $uQuery;
	}
	
	public static function getStudentFirstYearMarksLecturer($uid,$studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno, ew_percentage,cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('INNER JOIN', 'lecturer_to_module AS lm', 'm.id = lm.module_id')
		->join('INNER JOIN', 'module_to_programme AS mp', 'lm.module_id = mp.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mrp', 'mrp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->where('sm.semister = 1 or sm.semister = 2');
		if($uid){
		$uQuery->andWhere(['lm.lecturer_id' => $uid]);
		}
		if($studentid){
		$uQuery->andWhere(['sm.student_id' => $studentid]);
		}
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->groupBy(['semister','moduleid','student_id'])->all();
		return $uQuery;
	}
	
	public static function getStudentSecondYearMarksLecturer($uid,$studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno,ew_percentage,cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('INNER JOIN', 'lecturer_to_module AS lm', 'm.id = lm.module_id')
		->join('INNER JOIN', 'module_to_programme AS mp', 'lm.module_id = mp.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mrp', 'mrp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->where('sm.semister = 3 or sm.semister = 4');
		if($uid){
		$uQuery->andWhere(['lm.lecturer_id' => $uid]);
		}
		if($studentid){
		$uQuery->andWhere(['sm.student_id' => $studentid]);
		}
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->groupBy(['semister','moduleid','student_id'])->all();
		return $uQuery;
	}
	
	public static function getStudentThirdYearMarksLecturer($uid,$studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno,ew_percentage,cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('INNER JOIN', 'lecturer_to_module AS lm', 'm.id = lm.module_id')
		->join('INNER JOIN', 'module_to_programme AS mp', 'lm.module_id = mp.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mrp', 'mrp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->where('sm.semister = 5 or sm.semister = 6');
		if($uid){
		$uQuery->andWhere(['lm.lecturer_id' => $uid]);
		}
		if($studentid){
		$uQuery->andWhere(['sm.student_id' => $studentid]);
		}
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->groupBy(['semister','moduleid','student_id'])->all();
		return $uQuery;
		$uQuery = $uQuery->all();
		return $uQuery;
	}
	
	public static function getStudentFourthYearMarksLecturer($uid,$studentid){
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno,ew_percentage,cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('INNER JOIN', 'lecturer_to_module AS lm', 'm.id = lm.module_id')
		->join('INNER JOIN', 'module_to_programme AS mp', 'lm.module_id = mp.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mrp', 'mrp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->where('sm.semister = 7 or sm.semister = 8');
		if($uid){
		$uQuery->andWhere(['lm.lecturer_id' => $uid]);
		}
		if($studentid){
		$uQuery->andWhere(['sm.student_id' => $studentid]);
		}
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->groupBy(['semister','moduleid','student_id'])->all();
		return $uQuery;
	}
	
	public static function getStudentSemWiseMarks($year, $studentid){
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
		$uQuery = (new Query())->select('sm.*, m.module_name, m.module_id AS moduleid, s.name AS studentname, s.ic_no, s.rollno, ew_percentage,cw_percentage, p.programme_name, f.faculty_name')
		->from('student_marks AS sm')
		->join('INNER JOIN', 'student AS s', 's.id = sm.student_id')
		->join('INNER JOIN', 'modules AS m', 'm.id = sm.module_id')
		->join('LEFT JOIN', 'marks_percentage AS mrp', 'mrp.module_id = sm.module_id')
		->join('LEFT JOIN', 'programme AS p', 'p.id = s.programme_name')
		->join('LEFT JOIN', 'programme_to_faculty AS pf', 'pf.programme_id = s.programme_name')
		->join('LEFT JOIN', 'faculty AS f', 'f.id = pf.faculty_id')
		->where(1);
		if($year){
		$uQuery->andWhere(['sm.semister' => $sem1])->orWhere(['sm.semister' => $sem2]);
		}
		if($studentid){
		$uQuery->andWhere(['sm.student_id' => $studentid]);
		}
		$uQuery = $uQuery->orderBy(['sm.semister'=>SORT_ASC])->groupBy(['sm.id'])->all();
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
