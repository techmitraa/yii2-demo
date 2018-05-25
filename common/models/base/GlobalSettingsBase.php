<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "global_settings".
*
    * @property integer $id
    * @property string $slug
    * @property string $type
    * @property string $data
    * @property string $created_at
    * @property string $updated_at
*/
class GlobalSettingsBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'global_settings';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['slug', 'type', 'data'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug', 'type'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'slug' => 'Slug',
    'type' => 'Type',
    'data' => 'Data',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
}
}