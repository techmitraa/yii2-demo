<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\assets\CommonAsset;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Analytics Code Settings';
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
                    <?php 
                    $form = ActiveForm::begin(['fieldConfig' => ['template' => "{input}{error}"]]); 
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Google Analytics');?></label>
                        <div class="col-sm-10">
                            <?= $form->field($globalSettingsModel, 'google_analytics')->textarea(['value'=> isset($data->google_analytics) ? $data->google_analytics : '', 'rows'=> 10]) ?>
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