<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\controllers\CommonController;

/* @var $this yii\web\View */
/* @var $model common\models\States */
/* @var $form yii\widgets\ActiveForm */
?>
<?php 
$form = ActiveForm::begin([                                            
    'fieldConfig' => ['template' => "{input}{error}"]
]); 
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Name');?></label>
    <div class="col-sm-6">
        <?= $form->field($model, 'name')->textInput() ?>
    </div>
</div>
<div class="form-group row">
	<label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Country');?></label>
	 <div class="col-sm-6">
 		<?= $form->field($model, 'country_id')->dropdownlist(CommonController::actionGetCountries()) ?>
 	</div>
</div>
<div class="form-group pull-right">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
