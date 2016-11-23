<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\SignupForm */
/* @var $dateFormatter \backend\models\DateFormatter */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <!-- Campos que adicionei posteriormente -->

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'birthday')->widget(\yii\jui\DatePicker::className(), [
                'class' => 'SignupForm',
                'clientOptions' => [
                    'dateFormat' => 'php:Y-m-d',
                    'changeYear' => true,
                    'changeMonth' => true,
                    'yearRange' => '1850:2017',
                ],
            ]) ?>

            <?= $form->field($model, 'gender')->dropDownList(['Female','Male']) ?>

            <?= $form->field($model, 'profile_picture')->fileInput() ?>

            <!-- Fim -->

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
