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
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'Tipo de utilizador',
                'value' => 'userType.user_type',
            ],
            'name',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            'birthday',
            'gender',
            // 'created_at',
            // 'updated_at',
            //'profile_picture',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['perfil', 'id' => $model->id], []);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['editar', 'id' => $model->id], []);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['apagar', 'id' => $model->id], []);
                    },
                ],
                'template' => '{view} {update} {delete}'
            ],
        ],
    ]); ?>
</div>
