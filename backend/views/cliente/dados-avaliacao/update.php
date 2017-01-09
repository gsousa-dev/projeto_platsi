<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DadosAvaliacao */
/* @var $dadosAvaliacaoForm backend\models\forms\DadosAvaliacaoForm */

$this->title = 'Editar Dados da Avaliação';
?>
<div class="dados-avaliacao-update">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'dadosAvaliacaoForm' => $model,
    ]) ?>
</div>
