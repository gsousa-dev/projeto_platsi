<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */

$this->title = 'Update Mensagem: ' . $model->idMensagem;
$this->params['breadcrumbs'][] = ['label' => 'Mensagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMensagem, 'url' => ['view', 'id' => $model->idMensagem]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mensagem-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
