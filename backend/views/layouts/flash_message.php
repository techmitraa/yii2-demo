<?php
use yii\bootstrap\Alert;

//Loop all the flashes
foreach (Yii::$app->session->getAllFlashes() as $key=> $flash) { 
    echo '<div class="alert alert-' . $key . ' background-'.$key.'">'.
    		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="icofont icofont-close-line-circled text-white"></i>
            </button>'.
		     $flash . 
	     "</div>\n";
}
/*if($flash = Yii::$app->session->getFlash('success')){
	
    echo Alert::widget(['options' => ['class'=> 'class=alert alert-success'], 'body'=> $flash]);
} 
if($flash = Yii::$app->session->getFlash('fail')){
        echo Alert::widget(['options' => ['class'=> 'alert alert-danger background-danger'], 'body'=> $flash]);
} 
if($flash = Yii::$app->session->getFlash('warning')){
        echo Alert::widget(['options' => ['class'=> 'alert alert-warning background-warning'], 'body'=> $flash]);
}*/
?>
<!-- <div class="alert alert-success' background-success">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <i class="icofont icofont-close-line-circled text-white"></i>
</button>testazdf asdf asdf 
</div> -->
