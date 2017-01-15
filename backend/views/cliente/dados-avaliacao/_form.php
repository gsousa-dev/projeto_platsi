<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dadosAvaliacaoForm backend\models\forms\DadosAvaliacaoForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dados-avaliacao-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'dados-avaliacao-form', 'role' => 'form']]); ?>

    <?= $form->field($dadosAvaliacaoForm, 'altura')->input('double', []) ?>
    <?= $form->field($dadosAvaliacaoForm, 'massa_corporal')->input('double', []) ?>
    <?= $form->field($dadosAvaliacaoForm, 'massa_gorda')->input('double', []) ?>
    <?= $form->field($dadosAvaliacaoForm, 'massa_muscular')->input('double', []) ?>
    <?= $form->field($dadosAvaliacaoForm, 'agua_no_organismo')->input('double', []) ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
