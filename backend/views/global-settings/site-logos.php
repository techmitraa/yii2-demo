<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\assets\CommonAsset;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Site Logos Settings';
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
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 
                    ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Header Logo');?></label>
                        <div class="col-sm-4">
                            <?= $form->field($globalSettingsModel, 'header_logo')->fileInput() ?>
                        </div>
                        <?php if(!empty($data['header_logo'])) { ?>
                        <div class="col-md-4">
                            <?= Html::img(Yii::getAlias('@commonWeb').'/img/'. $data['header_logo'], ['class'=> 'fixed-image']); ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Footer Logo');?></label>
                        <div class="col-sm-4">
                            <?= $form->field($globalSettingsModel, 'footer_logo')->fileInput() ?>
                        </div>
                        <?php if(!empty($data['footer_logo'])) { ?>
                        <div class="col-md-4">
                            <?= Html::img(Yii::getAlias('@commonWeb').'/img/'. $data['footer_logo'], ['class'=> 'fixed-image']); ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Favicon ICON');?></label>
                        <div class="col-sm-4">
                            <?= $form->field($globalSettingsModel, 'favicon_icon')->fileInput() ?>
                        </div>
                        <?php if(!empty($data['favicon_icon'])) { ?>
                        <div class="col-md-4">
                            <?= Html::img(Yii::getAlias('@commonWeb').'/img/'. $data['favicon_icon'], ['class'=> 'fixed-image']); ?>
                        </div>
                        <?php } ?>
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