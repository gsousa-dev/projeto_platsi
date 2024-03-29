<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $objetivoForm backend\models\forms\ObjetivoForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetivo-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'objetivo-form', 'role' => 'form']]); ?>

    <?= $form->field($objetivoForm, 'objetivo')->textInput(['maxlength' => true])->label('Objetivo do Cliente') ?>
    <?= $form->field($objetivoForm, 'peso_pretendido')->input('integer', []) ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
