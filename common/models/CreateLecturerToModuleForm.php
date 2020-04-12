<?php

namespace common\models;
use yii\base\Model;

class CreateLecturerToModuleForm extends \yii\db\ActiveRecord
{
    public $lecturer_id;
	public $module_id;
   
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