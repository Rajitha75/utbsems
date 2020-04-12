<?php

namespace common\models;
use yii\base\Model;

class CreateModuleToProgrammeForm extends \yii\db\ActiveRecord
{
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