<?php

namespace common\models;
use yii\base\Model;

class AddStudentMarksForm extends \yii\db\ActiveRecord
{
    public $semister;
	public $previd;
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
	public $updated_by;
	public $studentid;
   
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