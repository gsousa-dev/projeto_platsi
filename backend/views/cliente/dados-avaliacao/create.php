<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dadosAvaliacaoForm backend\models\forms\DadosAvaliacaoForm */

$this->title = 'Registar Dados da Avaliação Física';
?>
<div class="dados-avaliacao">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Ficha do Cliente</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>

    <div class="dados-avaliacao-create">
        <?= $this->render('_form', [
                'dadosAvaliacaoForm' => $dadosAvaliacaoForm,
        ]) ?>
    </div>
</div>