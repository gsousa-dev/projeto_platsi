<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PlanoPessoal */

$this->title = 'Create Plano Pessoal';
$this->params['breadcrumbs'][] = ['label' => 'Plano Pessoals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-pessoal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
