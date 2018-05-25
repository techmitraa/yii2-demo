<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_role_id',
            'first_name',
            'last_name',
            'email:email',
            'password',
            'dob',
            'gender',
            'street_address',
            'city_id',
            'state_id',
            'zipcode',
            'country_id',
            'mobile_number',
            'profile_pic',
            'is_seller',
            'is_newsletter_subscribed',
            'is_active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
