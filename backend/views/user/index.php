<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#"><?= Html::encode($this->title) ?></a>
            </li>
            <li class="active">Ver <?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'status',
            'birthday',
            'gender',
            // 'created_at',
            // 'updated_at',
            //'profile_picture',
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view} {update}'],
        ],
    ]); ?>
</div>
