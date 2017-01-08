<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ExerciciosPlano */

$this->title = 'Create Exercicios Plano';
$this->params['breadcrumbs'][] = ['label' => 'Exercicios Planos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicios-plano-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
