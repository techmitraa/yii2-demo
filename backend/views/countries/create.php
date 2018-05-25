<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Countries */

$this->title = 'Create Country';
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
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
				    <?= $this->render('_form', [
				        'model' => $model,
				    ]) ?>
				</div>
            </div>
        </div>
    </div>
</div>
