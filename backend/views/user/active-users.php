<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
$this->params['current_user'] = Yii::$app->user->id;
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
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Tipo de utilizador',
                'value' => 'userType.user_type',
            ],
            'name',
            'username',
            'email:email',
            'birthday',
            'gender',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['profile', 'id' => $model->id], []);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id],
                            [
                                'data' => [
                                    'confirm' => 'Tem a certeza que quer eliminar este utilizador?',
                                    'method' => 'post',
                                ],
                            ]
                        );
                    },
                ],
                'template' => '{view} {delete}'
            ],
        ],
    ]); ?>
</div>
