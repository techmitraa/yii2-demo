<?php

namespace common\models;

use yii;
use yii\helpers\ArrayHelper;
class SmtpSettings extends \common\models\base\SmtpSettingsBase
{
	//BEFORE SAVE ACTION
	public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {
            $this->created_at = date('Y-m-d H:i:s'); 
        }
        else
        {
        	$this->updated_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
    //GET LIST OF SMTP AVAILABLE OPTIONS
    static function getListOfSMTP(){
    	return ArrayHelper::map(SmtpSettings::find()->where(['is_active'=> Yii::$app->params['IS_ACTIVE']['ACTIVE']])->asArray()->all(), 'id', 'name');
    }
    //GET A SMTP DETAILS BY ID
    static function getSMTPDetailsById($id){
        return SmtpSettings::find()
                ->where(['is_active'=> Yii::$app->params['IS_ACTIVE']['ACTIVE']])
                ->andWhere(['id'=> $id])
                ->asArray()
                ->one();
    }

}