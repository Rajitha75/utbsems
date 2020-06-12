<?php

namespace common\models;
use yii\base\Model;

class ChangePasswordForm extends \yii\db\ActiveRecord
{
    public $oldpassword;
	public $password;
	public $reenterpassword;
   
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