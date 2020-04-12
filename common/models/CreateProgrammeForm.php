<?php

namespace common\models;
use yii\base\Model;

class CreateProgrammeForm extends \yii\db\ActiveRecord
{
    public $programme_name;
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