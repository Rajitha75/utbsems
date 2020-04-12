<?php

namespace common\models;
use yii\base\Model;

class CreateModuleForm extends \yii\db\ActiveRecord
{
    public $module_name;
	public $programme_id;
	public $module_id;
	public $semister;
   
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