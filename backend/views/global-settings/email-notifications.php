<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\assets\CommonAsset;
use backend\assets\AppAsset;
use common\models\SmtpSettings;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Email Notifications Settings';
?>
<!-- Page body start -->
<div class="page-body">
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><?= Html::encode($this->title) ?></h5>
                <!--<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>-->
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="sub-title"><?= Yii::t('app', 'Email Settings')?></h4>
                    </div>
                </div>
                <?php 
                $form = ActiveForm::begin(['fieldConfig' => ['template' => "{input}{error}"]]); 
                ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'From Name');?></label>
                    <div class="col-sm-10">
                        <?= $form->field($globalSettingsModel, 'from_name')->textInput(['value'=> isset($data->from_name) ? $data->from_name : '']) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'From Email');?></label>
                    <div class="col-sm-10">
                        <?= $form->field($globalSettingsModel, 'from_email')->textInput(['value'=> isset($data->from_email) ? $data->from_email : '']) ?>
                    </div>
                </div>
                <?php $globalSettingsModel->current_SMTP = isset($data->current_SMTP) ? $data->current_SMTP : ''?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'SMTP Enable (Current in use)');?></label>
                    <div class="col-sm-10">
                        <?= $form->field($globalSettingsModel, 'current_SMTP')->dropdownlist(SmtpSettings::getListOfSMTP()) ?>
                    </div>
                </div>
                <div class="form-group row">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="sub-title"><?= Yii::t('app', 'Company Details')?></h4>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Company Name');?></label>
                    <div class="col-sm-4">
                        <?= $form->field($globalSettingsModel, 'company_name')->textInput(['value'=> isset($data->company_name) ? $data->company_name : '']) ?>
                    </div>
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Street Address');?></label>
                    <div class="col-sm-4">
                        <?= $form->field($globalSettingsModel, 'street_address')->textInput(['value'=> isset($data->street_address) ? $data->street_address : '']) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'City');?></label>
                    <div class="col-sm-4">
                        <?= $form->field($globalSettingsModel, 'city')->textInput(['value'=> isset($data->city) ? $data->city : '']) ?>
                    </div>
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'State');?></label>
                    <div class="col-sm-4">
                        <?= $form->field($globalSettingsModel, 'state')->textInput(['value'=> isset($data->state) ? $data->state : '']) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Zip');?></label>
                    <div class="col-sm-4">
                        <?= $form->field($globalSettingsModel, 'zip')->textInput(['value'=> isset($data->zip) ? $data->zip : '']) ?>
                    </div>
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Country');?></label>
                    <div class="col-sm-4">
                        <?= $form->field($globalSettingsModel, 'country')->textInput(['value'=> isset($data->country) ? $data->country : '']) ?>
                    </div>
                </div>
                <div class="form-group pull-right">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
</div>

