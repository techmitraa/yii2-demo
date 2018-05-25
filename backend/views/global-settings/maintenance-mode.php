<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\assets\CommonAsset;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Countries */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Maintenance Mode Settings';
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
                    <div class="form-group row">
                    <label class="col-sm-4 col-form-label"><?= Yii::t('app', 'Maintenance Mode (Enable/Disable)');?></label>
                    <div class="btn-group btn-toggle col-sm-4"> 
                        <button class="btn btn-sm<?= ($data->is_active) ? ' active btn-primary' : ' btn-default' ?>" value="1">ON</button>
                        <button class="btn btn-sm<?= (!$data->is_active) ? ' active btn-primary' : ' btn-default' ?> " value="0">OFF</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>