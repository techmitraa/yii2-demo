<?php

namespace common\models\base;

use Yii;
use common\models\UserRules;
use common\models\SiteDefaultRules;

/**
 * This is the model class for table "user_rules_menu".
*
    * @property integer $id
    * @property integer $parent_id
    * @property integer $site_default_rule_id
    * @property string $title
    * @property string $class_icon
    * @property string $url
    * @property integer $position
    * @property integer $is_active
    * @property string $created_at
    * @property string $updated_at
    *
            * @property UserRules[] $userRules
            * @property SiteDefaultRules $siteDefaultRule
    */
class UserRulesMenuBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'user_rules_menu';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['parent_id', 'site_default_rule_id', 'title', 'class_icon', 'url', 'position'], 'required'],
            [['parent_id', 'site_default_rule_id', 'position', 'is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'class_icon', 'url'], 'string', 'max' => 255],
            [['site_default_rule_id'], 'exist', 'skipOnError' => true, 'targetClass' => SiteDefaultRules::className(), 'targetAttribute' => ['site_default_rule_id' => 'id']],
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
    'site_default_rule_id' => 'Site Default Rule ID',
    'title' => 'Title',
    'class_icon' => 'Class Icon',
    'url' => 'Url',
    'position' => 'Position',
    'is_active' => 'Is Active',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getUserRules()
    {
    return $this->hasMany(UserRules::className(), ['user_rule_menu_id' => 'id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSiteDefaultRule()
    {
    return $this->hasOne(SiteDefaultRules::className(), ['id' => 'site_default_rule_id']);
    }
}