<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$this->title = 'Perfil';
?>
<div class="user-view">
    <div class="breadcrumbs">
        <h1><?= Html::encode($this->title) ?></h1>
        <ol class="breadcrumb">
            <li class="active"><?= Html::encode($this->title) ?></li>
        </ol>
    </div>
    <p>
        <?php
        if($user->id == Yii::$app->user->identity->getId()) {
            echo Html::a('Editar Perfil', ['update-personal-info'], ['class' => 'btn btn-primary']);
        } else {
            echo Html::a('Apagar', ['delete', 'id' => $user->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Tem a certeza que quer eliminar este utilizador?',
                        'method' => 'post',
                    ],
            ]);
        }
        ?>
    </p>
    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            [
                'attribute' => '',
                'value' => '/'.$user->profile_picture,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'name',
            'username',
            'email:email',
            'birthday',
            'gender',
        ],
    ]) ?>
</div>
