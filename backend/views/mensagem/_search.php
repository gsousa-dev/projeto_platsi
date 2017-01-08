<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\filters\MensagemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensagem-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idMensagem') ?>

    <?= $form->field($model, 'mensagem') ?>

    <?= $form->field($model, 'data_envio') ?>

    <?= $form->field($model, 'idEmissor') ?>

    <?= $form->field($model, 'idReceptor') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
