
<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
//-
use common\models\TipoExercicio;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\filters\ExercicioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exercícios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exercicio-index">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li>
                <a href="#"><?= Html::encode($this->title) ?></a>
            </li>
            <li class="active">Lista de <?= Html::encode($this->title) ?></li>
        </ol>
    </div>

    <p>
        <?= Html::a('Criar Exercício', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'descricao',
            [
                'attribute' => 'tipo_exercicio',
                'value' => 'tipoExercicio.tipo',
                'filter' => Html::activeDropDownList($searchModel, 'tipo_exercicio',
                    ArrayHelper::map(TipoExercicio::find()->asArray()->all(), 'id', 'tipo'), ['class' => 'form-control', 'prompt' => 'Selecione o tipo de exercício']),
            ],
            ['class' => 'yii\grid\ActionColumn', 'template'=> '{view} {update} {delete}'],
        ],
    ]); ?>
</div>