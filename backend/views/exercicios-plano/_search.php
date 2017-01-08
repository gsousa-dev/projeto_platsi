<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\filters\ExerciciosPlanoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exercicios-plano-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idExercicio_plano') ?>

    <?= $form->field($model, 'idPlano') ?>

    <?= $form->field($model, 'idExercicio') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
