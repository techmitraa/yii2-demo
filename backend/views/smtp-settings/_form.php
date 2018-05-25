<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\SmtpSettings */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([                                            
    'fieldConfig' => ['template' => "{input}{error}"]
]); 
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Name');?></label>
    <div class="col-sm-4">
       <?= $form->field($model, 'name')->textInput() ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Host');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'host')->textInput() ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Port');?></label>
    <div class="col-sm-4">
       <?= $form->field($model, 'port')->textInput() ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Authentication');?></label>
    <div class="col-sm-4">
        <?= $form->field($model, 'authentication')->textInput() ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Username');?></label>
    <div class="col-sm-4">
       <?= $form->field($model, 'username')->textInput() ?>
    </div>
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Password');?>&nbsp;
        <span class="password-visible"><i class="fa fa-eye-slash"></i></span>
    </label>
    <div class="col-sm-4">
        <?= $form->field($model, 'password')->passwordInput(['class'=> 'passwordInput form-control']) ?>
    </div>
</div>
<div class="form-group pull-right">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>