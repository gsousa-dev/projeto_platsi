<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cliente */

$this->title = 'Update Cliente: ' . $model->idCliente;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCliente, 'url' => ['view', 'id' => $model->idCliente]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cliente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
