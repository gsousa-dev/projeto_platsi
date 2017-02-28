<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
//-
use common\models\TipoExercicio;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model backend\models\forms\PlanoPessoalForm */

/* @var $searchModel backend\models\filters\ExercicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Criar Plano de Treino'
?>
<div>
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#"></a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>

    <div id="plano-pessoal-form">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'plano-pessoal-form', 'role' => 'form']]) ?>

        <?= $form->field($model, 'descricao')->textInput() ?>

        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary', 'onClick' => '']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>
<script>
    window.onbeforeunload = function () {
        localStorage.clear();
    };
</script>