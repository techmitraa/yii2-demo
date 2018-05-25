<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use yii;

class UserRoles extends \common\models\base\UserRolesBase
{
    public $site_default_rule_id;

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

    /**
	* @inheritdoc
	*/
	public function rules()
	{
	        return [
	            [['name', 'description', 'site_default_rule_id'], 'required'],
	            [['is_active'], 'integer'],
	            [['created_at', 'updated_at'], 'safe'],
	            [['name', 'description'], 'string', 'max' => 255],
	        ];
	}

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
		    'id' => 'ID',
		    'parent_id' => 'Parent ID',
		    'site_default_rule_id' => 'Modules',
		    'title' => 'Title',
		    'class_icon' => 'Class Icon',
		    'url' => 'Url',
		    'position' => 'Position',
		    'is_active' => 'Is Active',
		    'created_at' => 'Created At',
		    'updated_at' => 'Updated At',
		];
	}

	/*
	* GET SELECTED MENUS FOR A USER ROLE
	*/
	public static function getSelectedMenusByRole($roleId)
	{
		return ArrayHelper::getColumn(UserRoles::find('userRules')->with(['userRules'])->where(['id'=> $roleId, 'is_active'=> Yii::$app->params['IS_ACTIVE']['ACTIVE']])->asArray()->one()['userRules'], 'user_rule_menu_id');
	}

	/*
	* GET LIST OF USER ROLES - IN A DROP DOWN
	*/
	public static function getUserRoles()
	{
		return ArrayHelper::map(UserRoles::find()->where(['is_active'=> Yii::$app->params['IS_ACTIVE']['ACTIVE']])->asArray()->all(), 'id', 'name');
	}
}