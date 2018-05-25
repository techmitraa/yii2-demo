<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "smtp_settings".
*
    * @property integer $id
    * @property string $name
    * @property string $host
    * @property string $port
    * @property string $authentication
    * @property string $username
    * @property string $password
    * @property integer $is_active
    * @property string $created_at
    * @property string $updated_at
*/
class SmtpSettingsBase extends \yii\db\ActiveRecord
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'smtp_settings';
}

/**
* @inheritdoc
*/
public function rules()
{
        return [
            [['name', 'host', 'port', 'authentication', 'username', 'password'], 'required'],
            [['is_active'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'host', 'port', 'authentication', 'username', 'password'], 'string', 'max' => 255],
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => 'ID',
    'name' => 'Name',
    'host' => 'Host',
    'port' => 'Port',
    'authentication' => 'Authentication',
    'username' => 'Username',
    'password' => 'Password',
    'is_active' => 'Is Active',
    'created_at' => 'Created At',
    'updated_at' => 'Updated At',
];
}
}