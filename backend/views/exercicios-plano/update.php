<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExerciciosPlano */

$this->title = 'Update Exercicios Plano: ' . $model->idPlano;
$this->params['breadcrumbs'][] = ['label' => 'Exercicios Planos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPlano, 'url' => ['view', 'idPlano' => $model->idPlano, 'idExercicio' => $model->idExercicio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exercicios-plano-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
