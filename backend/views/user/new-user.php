<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//-
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
//-
use common\models\UserType;

/* @var $this yii\web\View */
/* @var $model backend\models\forms\CreateUserForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Novo Utilizador';

if (Yii::$app->user->can('admin')) {
    $this->params['user_types'] = ArrayHelper::map(UserType::find()->where('user_type != "Admin"')->andWhere('user_type != "Cliente"')->all(), 'id', 'user_type');
} else if (Yii::$app->user->can('secretaria')) {
    $this->params['user_types'] = ArrayHelper::map(UserType::find()->where('user_type != "Admin"')->all(), 'id', 'user_type');
}
?>
<div class="breadcrumbs">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Utilizadores</a>
        </li>
        <li class="active">Criar Utilizador</li>
    </ol>
</div>
<div class="create-user-form">
    <p>Preencha os seguintes campos para criar um novo utilizador:</p>
    <p style="color: red">(*) campos de preenchimento obrigatório</p>

    <?php $form = ActiveForm::begin(['options' => ['id' => 'create-user-form', 'role' => 'form']]); ?>

    <?= $form->field($model, 'user_type')->dropDownList(Yii::$app->view->params['user_types'], [
            'id' => 'user-types',
            'prompt' => 'Selecione o tipo de utilizador',
            'onchange' => 'myFunction()',
        ])->label('Tipo de Utilizador <span style="color:red">*</span>')
    ?>

    <?= $form->field($model, 'idPersonal_trainer')->widget(DepDrop::classname(), [
            'pluginOptions'=> [
                'depends'=> ['user-types'],
                'loading' => false,
                'placeholder'=> 'Selecione um personal trainer para este cliente',
                'url'=> ['/user/get-personal-trainers']
            ]
        ])->label(false)
    ?>

    <?= $form->field($model, 'name')->textInput()->label('Nome <span style="color:red">*</span>') ?>

    <?= $form->field($model, 'username')->textInput()->label('Username <span style="color:red">*</span>') ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => '********'])->label('Password <span style="color:red">*</span>') ?>

    <?= $form->field($model, 'email')->textInput(['placeholder' => 'example@mail.com'])->label('Email <span style="color:red">*</span>') ?>

    <?= $form->field($model, 'birthday')->widget(dosamigos\datepicker\DatePicker::className(), [
            'inline' => false,
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
            ],
        ])->label('Data de Nascimento <span style="color:red">*</span>')
    ?>

    <?= $form->field($model, 'gender')->dropDownList(['F' => 'Feminino', 'M' => 'Masculino'], [
            'prompt' => 'Selecione o género do utilizador'
        ])->label('Género <span style="color:red">*</span>')
    ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>