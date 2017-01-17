<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $exercicioForm backend\models\forms\ExercicioForm */

$this->title = 'Editar Exercício';
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
            <li class="active"><?= $exercicioForm->descricao ?></li>
        </ol>
    </div>

    <?= $this->render('_form', [
        'exercicioForm' => $exercicioForm,
    ]) ?>

</div>
