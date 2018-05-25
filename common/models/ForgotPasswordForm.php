<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * ForgotPasswordForm form
 */
class ForgotPasswordForm extends Model {

    public $email;
    
   /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['email'], 'required'],
            ['email', 'email'],
            ['email','emailExists']
        ];
    }

    public function emailExists($attribute, $params){
            //CHECK EMAIL EXISTS
            $checkEmailExists = Users::find()->where(['email' => $this->email])->one();
            //ADD ERROR
            if(empty($checkEmailExists)){
                $this->addError('email', 'Enter correct email');
                return false;
            }
    }
    

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
           'email' => Yii::t('app', 'Email'),
        );
    } 
}
