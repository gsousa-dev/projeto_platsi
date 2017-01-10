<?php
namespace backend\tests\fixtures;

use yii\test\ActiveFixture;

class DadosAvaliacaoFixture extends ActiveFixture
{
    public $modelClass = 'common\models\DadosAvaliacao';
    public $depends = ['backend\tests\fixtures\ClienteFixture'];
}