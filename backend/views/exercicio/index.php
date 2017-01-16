<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exercícios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicio-index">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#"><?= Html::encode($this->title) ?></a>
            </li>
            <li class="active">Lista de <?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idExercicio',
            'descricao',
            'tipoExercicio.tipo',
            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update} {delete}'],
        ],
    ]); ?>
</div>
