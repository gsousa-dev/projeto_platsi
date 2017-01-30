<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\MensagemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model backend\models\forms\MensagemForm */
/* @var $form ActiveForm */

$this->title = 'Conversa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conversa-index">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Mensagens</a>
            </li>
            <li>
                <a href="#">Caixa de Entrada</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'idMensagem',
            'data_envio',
            'mensagem',
            ['attribute' => 'Enviada por', 'value' => 'emissor.name'],
            'estado',
            //'idEmissor',
            //'idReceptor'
        ],
    ]); ?>
</div>
<div class="mensagem-responder">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'mensagem')->textarea() ?>
    <div class="form-group">
        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>