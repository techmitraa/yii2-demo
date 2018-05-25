<?php

namespace common\models;

use yii;
use yii\helpers\ArrayHelper;

class SiteDefaultRules extends \common\models\base\SiteDefaultRulesBase
{
    //GET DEFAULT RULES BY STATUS
    public static function getDefaultRules($isActive){
    	return ArrayHelper::getColumn(SiteDefaultRules::find()->where(['is_active'=> $isActive])->all(), 'id');

    }
}