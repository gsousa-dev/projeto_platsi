<?php
namespace backend\tests\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'common\models\User';
    //public $depends = ['backend\tests\fixtures\UserTypeFixture'];
}