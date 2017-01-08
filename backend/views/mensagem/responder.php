<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\forms\MensagemForm */
/* @var $form ActiveForm */

$this->title = 'Responder';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="backend-views-mensagem-responder">
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
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'mensagem')->textarea() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- backend-views-mensagem-responder -->
