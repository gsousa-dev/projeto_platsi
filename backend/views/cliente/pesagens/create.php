<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\forms\PesagemForm */

$this->title = 'Registar Pesagem';
?>
<div class="pesagem">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Ficha do Cliente</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>

    <div class="pesagem-create">
        <?= $this->render('_form', [
                'model' => $model,
        ]) ?>
    </div>
</div>