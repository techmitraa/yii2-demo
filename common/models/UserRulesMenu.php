<?php

namespace common\models;

use Yii;
use Yii\helpers\ArrayHelper;

class UserRulesMenu extends \common\models\base\UserRulesMenuBase
{
	const PARENT_FLAG = 0;

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
    //To get list of menu
    public static function getListofMenu($isActive){
    	return ArrayHelper::map(UserRulesMenu::find()->where(['is_active'=> $isActive, 'parent_id'=> self::PARENT_FLAG])->all(), 'id', 'title');
    }

    //TO GET CHILD MENUS
    public static function getChildMenu($parentId){
		return ArrayHelper::getColumn(UserRulesMenu::find()->where(['is_active'=> Yii::$app->params['IS_ACTIVE']['ACTIVE'], 'parent_id'=> $parentId])->asArray()->all(), 'id');
    }
}