<?php

namespace common\models\base;

use Yii;
use common\models\UserRulesMenu;

/**
 * This is the model class for table "site_default_rules".
*
    * @property integer $id
    * @property string $controller
    * @property string $actions
    * @property integer $is_active
    *
            * @property UserRulesMenu[] $userRulesMenus
    */
class SiteDefaultRulesBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'site_default_rules';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['controller', 'actions'], 'required'],
            [['is_active'], 'integer'],
            [['controller', 'actions'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'controller' => 'Controller',
    'actions' => 'Actions',
    'is_active' => 'Is Active',
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUserRulesMenus()
    {
    return $this->hasMany(UserRulesMenu::className(), ['site_default_rule_id' => 'id']);
    }
}