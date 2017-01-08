<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PlanoPessoal */

$this->title = $model->idPlano;
$this->params['breadcrumbs'][] = ['label' => 'Plano Pessoals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-pessoal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idPlano], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idPlano], [
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
            'idPlano',
            'descricao',
            'idCliente',
        ],
    ]) ?>

</div>
