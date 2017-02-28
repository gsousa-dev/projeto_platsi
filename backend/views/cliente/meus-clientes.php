<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'Nome', 'value' => 'cliente.name'],
            ['attribute' => 'Username', 'value' => 'cliente.username'],
            ['attribute' => 'Email', 'value' => 'cliente.email'],
            ['attribute' => 'Data de Nascimento', 'value' => 'cliente.birthday'],
            ['attribute' => 'Género', 'value' => 'cliente.gender'],
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
                        return Html::a('Ver Planos de Treino', '/cliente/planos?idCliente='.$key, []);
                    }
                ],
                'template' => '{view}'
            ],
        ],
    ]); ?>
</div>
