<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $idCliente */
/* @var $planosCount */

$this->title = 'Planos de Treino';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Clientes</a>
            </li>
            <li>
                <a href="#">Os Meus Clientes</a>
            </li>
            <li>
                <a href="#">Cliente</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <p>
        <?php
        if($planosCount < 3) {
            echo Html::a('Criar Plano de Treino', '/cliente/novo-plano?idCliente='.$idCliente, ['class' => 'btn btn-primary']);
        }
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'descricao',
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Ver Lista de Exercícios', '/exercicios-plano/plano-de-treino?idPlano='.$key, []);
                    }
                ],
                'template' => '{view}'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/cliente/apagar-plano?id='.$key, []);
                        }
                ],
                'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
