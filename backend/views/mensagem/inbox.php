<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Caixa de Entrada';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-index">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Mensagens</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idMensagem',
            'data_envio',
            'mensagem',
            ['attribute' => 'Enviada por', 'value' => 'emissor.name'],
            'estado',
            //'idEmissor',
            //'idReceptor'
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Responder', '/mensagem/responder?idMensagem='.$key, []);
                    }
                ],
                'template' => '{view}',
            ],
        ],
    ]); ?>
</div>
