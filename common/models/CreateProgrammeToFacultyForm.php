<?php

namespace common\models;
use yii\base\Model;

class CreateProgrammeToFacultyForm extends \yii\db\ActiveRecord
{
    public $programme_id;
	public $faculty_id;
   
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