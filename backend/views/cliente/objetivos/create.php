<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $objetivoForm backend\models\forms\ObjetivoForm */

$this->title = 'Criar Objetivo';
?>
<div class="objetivo">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Ficha do Cliente</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>

    <div class="objetivo-create">
        <?= $this->render('_form', [
                'objetivoForm' => $objetivoForm,
        ]) ?>
    </div>
</div>