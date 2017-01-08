<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Exercicio */

$this->title = 'Editar Exercício: ' . $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idExercicio, 'url' => ['view', 'id' => $model->idExercicio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exercicio-update">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="">Exercícios</a>
            </li>
            <li>
                <a href="/exercicio/">Lista de Exercícios</a>
            </li>
            <li>
                <a href="#">Editar</a>
            </li>
            <li class="active"><?= $model->descricao ?></li>
        </ol>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
