<?php
use common\assets\CommonAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\components\Common;

/* @var $this \yii\web\View */
/* @var $content string */
CommonAsset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <!-- CONSTANTS -->
    <script type="text/javascript">
        var BASE_URL = "<?= Yii::$app->request->baseUrl; ?>";
    </script>
    <?php 
    //GET HEADER LOGO
    $headerLogo = Common::getSiteLogos('header_logo');
    ?>
    <!-- Favicon icon -->
    <link rel="icon" href="<?= Common::getSiteLogos('favicon_icon') ?>" type="image/x-icon">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="<?= Yii::getAlias('@web') ?>/css/jquery.mCustomScrollbar.css">
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <!-- <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->first_name . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?> -->
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <!-- Main content -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <?php include_once('header.php'); ?>
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <?php include_once('sidebar.php'); ?>

                        <div class="pcoded-content">
                            <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                   <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10"><?= isset($this->params['page']['title']) ? $this->params['page']['title'] : ''; ?></h5>
                                            <!-- <p class="m-b-0">Lorem Ipsum is simply dummy text of the printing</p> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <?=
                                            Breadcrumbs::widget([
                                                'options' => ['class' => 'breadcrumb'],
                                                'itemTemplate' => '<li>{link} <i class="fa fa-angle-right"></i>&nbsp;</li>',
                                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                                'homeLink' => ['label' => 'Home', 'template' => '<li><i class="fa fa-home"></i>&nbsp;{link}&nbsp;<i class="fa fa-angle-right"></i>&nbsp;</li>', 'url' => Yii::$app->request->baseUrl . '/site/index'],
                                            ])
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                            <div class="page-wrapper">
                                <?php include_once('flash_message.php'); ?>
                                <?= $content ?>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
    <!-- Warning Section Ends -->



        <!-- </div>
    </div> -->

    <!-- <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
 -->
 <?php
 echo $this->registerJsFile('@web/js/excanvas.js', [CommonAsset::className(), AppAsset::className()]);
    //<!-- slimscroll js -->
 echo $this->registerJsFile('@web/js/SmoothScroll.js', [CommonAsset::className(), AppAsset::className()]);
 echo $this->registerJsFile('@web/js/jquery.mCustomScrollbar.concat.min.js', [CommonAsset::className(), AppAsset::className()]);
 
    //<!-- menu js -->
 echo $this->registerJsFile('@web/js/pcoded.min.js', [CommonAsset::className(), AppAsset::className()]);
 echo $this->registerJsFile('@web/js/vertical-layout.min.js', [CommonAsset::className(), AppAsset::className()]);
    //<!-- custom js -->
 echo $this->registerJsFile('@web/js/script.js', [CommonAsset::className(), AppAsset::className()]);
 ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
