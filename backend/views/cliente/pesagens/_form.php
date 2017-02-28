<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model backend\models\forms\PesagemForm */
?>

<div class="dados-avaliacao-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'dados-avaliacao-form', 'role' => 'form']]); ?>

    <?= $form->field($model, 'peso')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
