<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
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
                <?php $form = ActiveForm::begin(['fieldConfig' => ['template' => "{input}{error}"]],['id' => 'changepassword-form','enableAjaxValidation'=>true]); ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Current Password');?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'New Password');?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?= Yii::t('app', 'Retype Password');?></label>
                    <div class="col-sm-10">
                        <?= $form->field($model, 'retypePassword')->passwordInput(['maxlength' => true]) ?>
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