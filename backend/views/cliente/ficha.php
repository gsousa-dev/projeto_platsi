<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */

/* @var $idCliente */
/* @var $cliente yii\data\ActiveDataProvider */
/* @var $objetivo yii\data\ActiveDataProvider */
/* @var $objetivo_exists */
/* @var $dadosAvaliacao yii\data\ActiveDataProvider */
/* @var $dadosAvaliacao_exists */
/* @var $pesagens yii\data\ActiveDataProvider */

$this->title = 'Ficha do Cliente';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ficha-do-cliente">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">Meus Clientes</a>
            </li>
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <div class="dados-pessoais">
        <h2>Informação pessoal do cliente</h2>
        <?= GridView::widget([
            'dataProvider' => $cliente,
            //'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::img("/$model->profile_picture", ['alt' => 'My logo', 'height' => '100', 'width' => '100']);
                        }
                    ],
                    'template' => '{view}'
                ],
                //'idCliente',
                ['attribute' => 'Nome', 'value' => 'name'],
                ['attribute' => 'Username', 'value' => 'username'],
                ['attribute' => 'Email', 'value' => 'email'],
                ['attribute' => 'Data de Nascimento', 'value' => 'birthday'],
                ['attribute' => 'Género', 'value' => 'gender'],
                //'idPersonal_trainer',
            ],
        ]); ?>
    </div>
    <div class="objetivo">
        <h2>Objetivo</h2>
        <?= GridView::widget([
            'dataProvider' => $objetivo,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'idCliente',
                'objetivo',
                'peso_pretendido',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/cliente/editar-objetivo?idCliente='.$key, []);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/cliente/apagar-objetivo?idCliente='.$key, []);
                        },
                    ],
                    'template' => '{update} {delete}'
                ],
            ],
        ]); ?>
        <div class="form-group">
            <?php
            if($objetivo_exists == 0) {
                echo Html::a('Criar Objetivo', '/cliente/novo-objetivo?idCliente='.$idCliente, ['class' => 'btn btn-primary']);
            }
            ?>
        </div>
    </div>
    <div class="dados-avaliacao">
        <h2>Avaliação Física</h2>
        <?= GridView::widget([
            'dataProvider' => $dadosAvaliacao,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'idCliente',
                'altura',
                'massa_corporal',
                'massa_gorda',
                'massa_muscular',
                'agua_no_organismo',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/cliente/editar-dados-avaliacao?idCliente='.$key, []);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/cliente/apagar-dados-avaliacao?idCliente='.$key, []);
                        },
                    ],
                    'template' => '{update} {delete}'
                ],
            ],
        ]); ?>
        <div class="form-group">
            <?php
            if($dadosAvaliacao_exists == 0) {
                echo Html::a('Registar Dados da Avaliação Física', '/cliente/registar-avaliacao-fisica?idCliente='.$idCliente, ['class' => 'btn btn-primary']);
            }
            ?>
        </div>
    </div>
    <div class="pesagens">
        <h2>Pesagens</h2>
        <?= GridView::widget([
            'dataProvider' => $pesagens,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'data_pesagem',
                ['attribute' => 'Peso (Kg)', 'value' => 'peso'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttons' => [
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', '/cliente/apagar-pesagem?id='.$key.'&idCliente='.$model->idCliente, []);
                        },
                    ],
                    'template' => '{delete}'
                ],
            ],
        ]); ?>
        <?= Html::a('Registar Pesagem', '/cliente/registar-pesagem?idCliente='.$idCliente, ['class' => 'btn btn-primary']); ?>
    </div>
</div>
