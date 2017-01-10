<?php

use backend\assets\MetronicAsset;
use yii\helpers\Html;

MetronicAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <?= Html::csrfMetaTags() ?>
        <title></title>
        <link rel="shortcut icon" href="favicon.ico" />
        <?php $this->head() ?>
    </head>

    <body class=" page-404-3">
    <?php $this->beginBody() ?>
    <div class="page-inner">
        <img src="../assets/pages/media/pages/earth.jpg" class="img-responsive" alt=""> </div>
    <div class="container error-404">
        <h1>404</h1>
        <h2>Houston, we have a problem.</h2>
        <p> Actually, the page you are looking for does not exist. </p>
        <p>
            <?= Html::a('Return home', Yii::$app->getHomeUrl(), ['class' => 'btn red btn-outline'])?><br>
        </p>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>