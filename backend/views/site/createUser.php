<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model backend\models\CreateUserForm */

$this->title = 'Create user';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create-user">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register a user:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <!-- Campos que adicionei posteriormente -->

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'birthday')->widget(DatePicker::className(), [
                'inline' => false,
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ],
            ]) ?>

            <?= $form->field($model, 'gender')->dropDownList(['F' => 'Female', 'M' => 'Male'], ['prompt'=>'Select your Gender']) ?>

            <?= $form->field($model, 'profile_picture')->fileInput() ?>

            <!-- Fim -->

            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
