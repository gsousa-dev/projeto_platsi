<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//-
use common\models\TipoExercicio;

/* @var $this yii\web\View */
/* @var $exercicioForm backend\models\forms\ExercicioForm */
/* @var $form yii\widgets\ActiveForm */

$tipos_exercicio = ArrayHelper::map(TipoExercicio::find()->all(), 'id', 'tipo'); //Apanhar o id do tipo de tipo de exercicio
?>

<div class="exercicio-form">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'exercicio-form', 'role' => 'form']]); ?>

    <?= $form->field($exercicioForm, 'descricao')->textInput(['maxlength' => true]) ?>
    <?= $form->field($exercicioForm, 'tipo_exercicio')->dropDownList($tipos_exercicio) ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
