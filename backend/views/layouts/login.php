<?php
use common\assets\CommonAsset;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

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
    <?php $this->head() ?>
</head>
<body themebg-pattern="theme1">
    <?php $this->beginBody() ?>
    	<section class="login-block">	
	    <!-- Container-fluid starts -->
	    <div class="container">
			<div class="row">
				<div class="col-md-4"></div>
	    		<div class="col-sm-4">
	    		<div class="text-center">
	    			<?php include_once('flash_message.php'); ?>	
	    		</div>
	    		</div>
	    	</div>
	    </div>
		</section>
        <?= $content ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
