<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//-
use common\models\TipoExercicio;

/* @var $this yii\web\View */
/* @var $model backend\models\forms\ExercicioForm */
/* @var $form yii\widgets\ActiveForm */

$tipos_exercicio = ArrayHelper::map(TipoExercicio::find()->all(), 'id', 'tipo'); //Apanhar o id do tipo de tipo de exercicio
?>

<div class="exercicio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_exercicio')->dropDownList($tipos_exercicio) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
