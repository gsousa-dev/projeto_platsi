<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
//-
use common\models\User;
use common\models\UserType;

/* @var $this yii\web\View */
/* @var $model backend\models\forms\UserForm */
/* @var $form yii\widgets\ActiveForm */

if (Yii::$app->user->can('admin')) {
    $this->params['user_types'] = ArrayHelper::map(UserType::find()->where('user_type != "Admin"')->andWhere('user_type != "Cliente"')->all(), 'id', 'user_type');
} else if (Yii::$app->user->can('secretaria')) {
    $this->params['user_types'] = ArrayHelper::map(UserType::find()->where('user_type != "Admin"')->all(), 'id', 'user_type');
    $this->params['personal_trainers'] = ArrayHelper::map(User::find()->where(['user_type' => 3])->all(), 'id', 'name');
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

    <?php $form = ActiveForm::begin(['options' => ['role' => 'form']]); ?>

    <?= $form->field($model, 'user_type')->dropDownList(Yii::$app->view->params['personal_trainers'])->label('Tipo de Utilizador') ?>

    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'birthday')->widget(dosamigos\datepicker\DatePicker::className(), [
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ],
    ]) ?>

    <?= $form->field($model, 'gender')->dropDownList(['F' => 'Feminino', 'M' => 'Masculino']) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Submeter', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
