<?php
namespace backend\tests\fixtures;

use yii\test\ActiveFixture;

class ClienteFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Cliente';
    public $depends = ['backend\tests\fixtures\UserFixture'];
}