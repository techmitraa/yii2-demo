<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UserRoles;
use backend\controllers\CommonController;
use common\assets\CommonAsset;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
//echo $this->registerCssFile('@commonWeb/plugins\bootstrap-datepicker/css/bootstrap-datepicker3.css', [CommonAsset::className(), AppAsset::className()]);
//echo $this->registerJsFile('@commonWeb/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js', [CommonAsset::className(), AppAsset::className()]);
?>
<?php 
$form = ActiveForm::begin(['fieldConfig' => [
            'options' => [
               // 'tag' => false,
            ],
            'template' => "{input}{error}"
        ]]);
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'First Name');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Last Name');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Email');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
    <?php 
    //SHOW PASSWORD BASED ON CREATE ONLY
    (!$model->isNewRecord) ? $disableField = true : $disableField = false; ?>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Password');?>&nbsp;
            <span class="password-visible"><i class="fa fa-eye-slash"></i></span>
    </label>
    <div class="col-sm-4">
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class'=> 'passwordInput form-control', 'disabled'=> $disableField]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'DOB');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'dob')->textInput(['type'=> 'date']) ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Gender');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'gender')->dropdownlist(Yii::$app->params['GENDER']) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Street Address');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'street_address')->textInput(['maxlength' => true]) ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Country');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'country_id')->dropdownlist(CommonController::actionGetCountries()) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'State');?></label>
    <div class="col-sm-4">
        <?php 
        //SHOW STATES BASED ON CREATE/UPDATE
        if($model->isNewRecord){
            echo $form->field($model, 'state_id')->dropdownlist([]);
        }
        else
        {
            echo $form->field($model, 'state_id')->dropdownlist(CommonController::actionGetStates($model->country_id));   
        }
        ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'City');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'city_id')->dropdownlist([]); ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Zip Code');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true]) ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Mobile');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'User Role');?></label>
    <div class="col-sm-10">
        <?= $form->field($model, 'user_role_id')->dropdownlist(UserRoles::getUserRoles()) ?>
    </div>
</div>
<div class="form-group pull-right">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
