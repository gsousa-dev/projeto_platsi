<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ExerciciosPlano */

$this->title = $model->idPlano;
$this->params['breadcrumbs'][] = ['label' => 'Exercicios Planos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicios-plano-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idPlano' => $model->idPlano, 'idExercicio' => $model->idExercicio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idPlano' => $model->idPlano, 'idExercicio' => $model->idExercicio], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idExercicio_plano',
            'idPlano',
            'idExercicio',
        ],
    ]) ?>

</div>
