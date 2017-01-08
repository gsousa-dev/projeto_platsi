<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Planos';
$this->params['breadcrumbs'][] = $this->title;
$_POST['idPlano'] = function ($dataProvider) { return $dataProvider->idPlano; };
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
            <li class="active">Planos</li>
        </ol>
    </div>
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
        ],
    ]); ?>
</div>
