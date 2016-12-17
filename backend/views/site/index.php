<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Dashboard';
?>

<div class="breadcrumbs">
    <h1>Blank Page Layout</h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Pages</a>
        </li>
        <li class="active">System</li>
    </ol>
</div>
<div class="note note-info">
    <p> A black page template with a minimal dependency assets to use as a base for any custom page you create </p>
</div>
<?= Html::beginForm(['/site/logout'], 'post')
    . Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout'])
    . Html::endForm();
?>

