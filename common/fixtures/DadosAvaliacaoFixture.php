<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class DadosAvaliacaoFixture extends ActiveFixture
{
    public $modelClass = 'common\models\DadosAvaliacao';
    public $depends = ['common\fixtures\ClienteFixture'];
}