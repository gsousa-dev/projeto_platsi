<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

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
        <?= Html::a('Editar', ['editar-perfil', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if ($model->id != Yii::$app->user->id) {
            echo Html::a('Apagar', ['apagar', 'id' => $model->id], ['class' => 'btn btn-danger']);
        }
        ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => '',
                'value' => '/'.$model->profile_picture,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            //'id',
            'name',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            'birthday',
            'gender',
            // 'created_at',
            // 'updated_at',
            //'profile_picture',
        ],
    ]) ?>
</div>
