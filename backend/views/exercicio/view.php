<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Exercicio */

$this->title = $model->descricao;
$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicio-view">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Exercícios</a>
            </li>
            <li>
                <a href="/exercicio/">Lista de Exercícios</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idExercicio], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idExercicio',
            'descricao',
            'tipo_exercicio',
        ],
    ]) ?>

</div>
