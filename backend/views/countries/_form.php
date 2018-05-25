<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([                                            
    'fieldConfig' => ['template' => "{input}{error}"]
]); 
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Sortname');?></label>
    <div class="col-sm-6">
       <?= $form->field($model, 'sortname')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Name');?></label>
    <div class="col-sm-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Phonecode');?></label>
    <div class="col-sm-6">
        <?= $form->field($model, 'phonecode')->textInput() ?>
    </div>
</div>
<div class="form-group pull-right">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
