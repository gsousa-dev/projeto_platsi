<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\forms\ExercicioPlanoForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exercicios-plano-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idExercicio_plano')->textInput() ?>

    <?= $form->field($model, 'idPlano')->textInput() ?>

    <?= $form->field($model, 'idExercicio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
