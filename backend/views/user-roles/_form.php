<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\UserRulesMenu;
use common\assets\CommonAsset;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\UserRoles */
/* @var $form yii\widgets\ActiveForm */
echo $this->registerCssFile('@commonWeb/plugins/bootstrap-multiselect/css/bootstrap-multiselect.css', [CommonAsset::className(), AppAsset::className()]);
echo $this->registerCssFile('@commonWeb/plugins/multiselect/css/multi-select.css', [CommonAsset::className(), AppAsset::className()]);
echo $this->registerJsFile('@commonWeb/plugins/bootstrap-multiselect/js/bootstrap-multiselect.js', [CommonAsset::className(), AppAsset::className()]);
echo $this->registerJsFile('@commonWeb/plugins/multiselect/js/jquery.multi-select.js', [CommonAsset::className(), AppAsset::className()])
?>
<?php 
$form = ActiveForm::begin([                                            
    'fieldConfig' => ['template' => "{input}{error}"]
]); 
?>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Name');?></label>
    <div class="col-sm-10">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Description');?></label>
    <div class="col-sm-10">
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Modules');?></label>
    <div class="col-sm-10">
        <?php 
        $userRules = UserRulesMenu::getListofMenu(Yii::$app->params['IS_ACTIVE']['ACTIVE']);
        //ON UPDATE PAGE GET SELECTED RULES
        if(!$model->isNewRecord)
        {
            $model->site_default_rule_id = common\models\UserRoles::getSelectedMenusByRole($model->id); 
        }?>
        <?= $form->field($model, 'site_default_rule_id')->dropdownlist($userRules,['multiple'=> 'multiple', 'class'=> 'hc-multiselect']); ?>
    </div>
</div>
<div class="form-group pull-right">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>

