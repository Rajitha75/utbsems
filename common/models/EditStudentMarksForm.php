<?php

namespace common\models;
use yii\base\Model;

class EditStudentMarksForm extends \yii\db\ActiveRecord
{
    public $marks_id;
    public $semister;
    public $module_id;
    public $student_id;
    public $ew_percentage;
    public $ew_marks;
    public $cw_percentage;
    public $cw_marks;
    public $ew_total_percentage;
    public $cw_total_percentage;
    public $total_percentage;
    public $is_pass;
    public $grade;
    public $grade_definition;
    public $entered_by;
    public $module_name;
    public $moduleid;
    public $studentname;
    public $ic_no;
    public $updated_by;
    public $is_submit;
    public $stage;
    public $year;
    
    public $prev_marks_id;
    public $prev_semister;
    public $prev_module_id;
    public $prev_student_id;
    public $prev_ew_percentage;
    public $prev_ew_marks;
    public $prev_cw_percentage;
    public $prev_cw_marks;
    public $prev_ew_total_percentage;
    public $prev_cw_total_percentage;
    public $prev_total_percentage;
    public $prev_is_pass;
    public $prev_grade;
    public $prev_grade_definition;
    public $prev_entered_by;
    public $prev_module_name;
    public $prev_moduleid;
    public $prev_studentname;
    public $prev_ic_no;
    public $prev_updated_by;
    public $prev_is_submit;
    public $prev_stage;
    public $prev_year;
    
    public $prev2_marks_id;
    public $prev2_semister;
    public $prev2_module_id;
    public $prev2_student_id;
    public $prev2_ew_percentage;
    public $prev2_ew_marks;
    public $prev2_cw_percentage;
    public $prev2_cw_marks;
    public $prev2_ew_total_percentage;
    public $prev2_cw_total_percentage;
    public $prev2_total_percentage;
    public $prev2_is_pass;
    public $prev2_grade;
    public $prev2_grade_definition;
    public $prev2_entered_by;
    public $prev2_module_name;
    public $prev2_moduleid;
    public $prev2_studentname;
    public $prev2_ic_no;
    public $prev2_updated_by;
    public $prev2_is_submit;
    public $prev2_stage;
    public $prev2_year;
    
    public $prev3_marks_id;
    public $prev3_semister;
    public $prev3_module_id;
    public $prev3_student_id;
    public $prev3_ew_percentage;
    public $prev3_ew_marks;
    public $prev3_cw_percentage;
    public $prev3_cw_marks;
    public $prev3_ew_total_percentage;
    public $prev3_cw_total_percentage;
    public $prev3_total_percentage;
    public $prev3_is_pass;
    public $prev3_grade;
    public $prev3_grade_definition;
    public $prev3_entered_by;
    public $prev3_module_name;
    public $prev3_moduleid;
    public $prev3_studentname;
    public $prev3_ic_no;
    public $prev3_updated_by;
    public $prev3_is_submit;
    public $prev3_stage;
    public $prev3_year;
   
    /**
     * @inheritdoc
     */
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
    public function attributeLabels()
    {
        return [
        ];
    }
}