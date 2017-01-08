<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\PlanoPessoalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plano Pessoal';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plano-pessoal-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Plano Pessoal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idPlano',
            'descricao',
            'idCliente',

            ['class' => 'yii\grid\ActionColumn' , 'template' => '{view} {update}'],
        ],
    ]); ?>
</div>
