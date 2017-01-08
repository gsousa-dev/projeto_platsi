<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Exercicio */

$this->title = 'Novo Exercício';
$this->params['breadcrumbs'][] = ['label' => 'Exercicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicio-create">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Exercícios</a>
            </li>
            <li class="active">Criar Exercício</li>
        </ol>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
