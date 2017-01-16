<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exercícios do Plano';
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
            <li>
                <a href="#">Planos</a>
            </li>
            <li class="active">Exercícios do Plano</li>
        </ol>
    </div>
    <p>
        <?= Html::a('Adicionar exercício', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idExercicio_plano',
            //'idPlano',
            'exercicio.descricao',
            [
                'attribute' => 'Duração (min)',
                'value' => 'exercicioAerobicoPlano.duracao',
            ],
            'exercicioAnaerobicoPlano.series',
            'exercicioAnaerobicoPlano.repeticoes',
            //'idExercicio',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
