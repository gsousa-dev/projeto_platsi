<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensagem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mensagem')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'data_envio')->textInput() ?>

    <?= $form->field($model, 'idEmissor')->textInput() ?>

    <?= $form->field($model, 'idReceptor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
