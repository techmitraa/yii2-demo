<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\Common;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Forgot Password';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Pre-loader end -->
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <?php 
                $form = ActiveForm::begin(['fieldConfig' => ['template' => "{input}{error}"]],
                                ['id' => 'forgotpassword-form',
                                'enableAjaxValidation' => true]); 
                ?>
                    <div class="text-center">
                        <img src="<?= Common::getSiteLogos('header_logo') ?>" alt="logo" class="back-end-site-logo">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-left">Recover your password</h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder'=> 'Email']) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?= Html::submitButton('Reset Password', ['class' => 'btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20']) ?>
                                </div>
                            </div>
                            <p class="f-w-600 text-right">Back to <a href="<?= Yii::$app->urlManager->createUrl(['site/login']); ?>">Login.</a></p>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
