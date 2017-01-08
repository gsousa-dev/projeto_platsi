<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\ExerciciosPlanoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exercicios Planos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicios-plano-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Exercicios Plano', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idExercicio_plano',
            'idPlano',
            'idExercicio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
