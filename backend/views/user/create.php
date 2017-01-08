<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Novo Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Utilizadores</a>
            </li>
            <li class="active">Criar Utilizador</li>
        </ol>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
