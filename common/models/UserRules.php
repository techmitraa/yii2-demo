<?php

namespace common\models;

use Yii;

class UserRules extends \common\models\base\UserRulesBase
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
    //DELETE USER RULES BY ROLE
    public static function deleteUserRulesByRole($ruleId)
    {
    	return UserRules::deleteAll(['user_role_id'=> $ruleId]);
    }

    /*
	* GET LIST OF ACCESSIBLE MENU LIST BY ROLE
	*/
	public static function getAccessibleMenuByRole($roleId)
	{
		$menuList = UserRules::find()
				->select('user_rules_menu.*')
				->leftJoin('user_rules_menu', 'user_rules_menu.id = user_rules.user_rule_menu_id')
				->where(
					[
						'user_rules.user_role_id'=> $roleId, 
						'user_rules_menu.is_active'=> Yii::$app->params['IS_ACTIVE']['ACTIVE']
					])
				->asArray()
				->all();
		$returnMenuList=[];
		//FILTER AS PARENT CHILD
		foreach ($menuList as $key => $value) {
			if($value['parent_id'] == 0)
			{
				$returnMenuList[] = $value;
			}
			else
			{
				//FILD MAIN MENU
				$idFlag = array_search($value['parent_id'], array_column($returnMenuList, 'id'));
				//FIND SUB MENU
				$parentFlag = array_search($value['parent_id'], array_column($menuList, 'parent_id'));
				if($returnMenuList[$idFlag])
				{
					//ADD SUB INTO MAIN MENU
					$returnMenuList[$idFlag]['subMenus'][] = $menuList[$parentFlag];
					unset($menuList[$parentFlag]);
					$menuList = array_values($menuList);
				}
			}
		}
		return $returnMenuList;
	}

	/*
	* GET LIST OF RULES BY ROLE
	*/
	public static function getAccessibleRulesByRole($roleId)
	{
		return UserRules::find()
				->select('site_default_rules.*')
				->leftJoin('user_rules_menu', 'user_rules_menu.id = user_rules.user_rule_menu_id')
				->leftJoin('site_default_rules', 'site_default_rules.id = user_rules_menu.site_default_rule_id')
				->where(['user_rules.user_role_id'=> $roleId])
				->asArray()
				->all();
	}

}