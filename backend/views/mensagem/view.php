<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */

$this->title = $model->idMensagem;
$this->params['breadcrumbs'][] = ['label' => 'Mensagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensagem-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idMensagem], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idMensagem], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idMensagem',
            'mensagem:ntext',
            'data_envio',
            'idEmissor',
            'idReceptor',
        ],
    ]) ?>

</div>
