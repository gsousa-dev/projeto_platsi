<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PlanoPessoal */
/* @var $objetivoForm backend\models\forms\ObjetivoForm */

$this->title = 'Editar Objetivo';
?>
<div class="objetivo-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'objetivoForm' => $model,
    ]) ?>
</div>
