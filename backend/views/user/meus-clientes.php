<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Os Meus Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Clientes</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //'id',
            'name',
            'username',
            'email:email',
            'birthday',
            'gender',
            'profile_picture',
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{view}'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'<form action="/cliente/planos-cliente" method="post"><input type="hidden" value="'.$dataProvider->key.'">{view}</form>',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::submitButton('Planos');
                    },
                ]
            ],
        ],
    ]); ?>
</div>
