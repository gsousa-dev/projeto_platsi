<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PlanoPessoal */

$this->title = 'Update Plano Pessoal: ' . $model->idPlano;
$this->params['breadcrumbs'][] = ['label' => 'Plano Pessoals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPlano, 'url' => ['view', 'id' => $model->idPlano]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plano-pessoal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
