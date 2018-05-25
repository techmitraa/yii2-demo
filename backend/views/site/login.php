<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\components\Common;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="login-block">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                    <!-- <form class="md-float-material form-material"> -->
                    <?php 
                    $form = ActiveForm::begin([                                           
                        'fieldConfig' => ['template' => "{input}{error}"]
                    ]); 
                    ?>
                        <div class="text-center">
                            <img src="<?= Common::getSiteLogos('header_logo') ?>" alt="logo.png" class="back-end-site-logo">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Sign In</h3>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder'=> 'Email']) ?>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder'=> 'Password']) ?>
                                    </div>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary d-">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['users/forgot-password']); ?>" class="text-right f-w-600"> Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20']) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php ActiveForm::end(); ?>
                    <!-- end of form -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>
<!-- Warning Section Starts -->
