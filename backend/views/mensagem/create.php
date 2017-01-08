<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */

$this->title = 'Create Mensagem';
$this->params['breadcrumbs'][] = ['label' => 'Mensagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mensagem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
