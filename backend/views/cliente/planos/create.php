<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $planoPessoalModel backend\models\forms\PlanoDeTreinoForm */
/* @var $exercicios yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Novo Plano';
?>
<div class="plano-de-treino">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Planos de Treino</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <div class="plano-pessoal-form">
        <h2>Nome do plano</h2>
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($planoPessoalModel, 'descricao')->textInput(['maxlength' => true])->label(false) ?>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="exercicios-plano-form">
        <h2>Selecione os exercícios que quer adicionar a este plano de treino</h2>
        <?= GridView::widget([
            'dataProvider' => $exercicios,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                ['class' => 'yii\grid\CheckboxColumn'],
                'descricao',
                'tipoExercicio.tipo',
            ],
        ]); ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>
</div>