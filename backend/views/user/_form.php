<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//-
use common\models\UserType;
//-

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\widgets\ActiveForm */

$items = ArrayHelper::map(UserType::find()->where('user_type != "Admin"')->all(), 'id', 'user_type');
?>

<div class="user-form">
    <p>Please fill out the following fields to register a user:</p>

    <?php $form = ActiveForm::begin(['options' => ['role' => 'form']]); ?>

    <?= $form->field($model, 'user_type')->dropDownList($items) ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'gender')->dropDownList(['F' => 'Female', 'M' => 'Male'], ['prompt'=>'Select your Gender']) ?>

    <?= $form->field($model, 'profile_picture')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
