<?php

use backend\assets\MetronicAsset;
use yii\helpers\Html;

/* @var $content string */

MetronicAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    </head>

    <body class=" login">
    <?php $this->beginBody() ?>
        <div class="logo">
            <?= Html::a('<img src="../assets/pages/img/logo-big.png" />'); ?>
        </div>
        <?= $content ?>
        <div class="copyright">2014 © Metronic. Admin Dashboard Template.</div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>