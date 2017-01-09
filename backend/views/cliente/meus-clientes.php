<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Os Meus Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">
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
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idCliente',
            'cliente.name',
            'cliente.username',
            'cliente.email',
            'cliente.birthday',
            'cliente.gender',
            //'idPersonal_trainer',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Ficha do Cliente', '/cliente/ficha?idCliente='.$key, []);
                    }
                ],
                'template' => '{view}'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Ver Planos', '/cliente/planos?idCliente='.$key, []);
                    }
                ],
                'template' => '{view}'
            ],
        ],
    ]); ?>
</div>
