<?php
namespace common\tests\unit\models;

use Codeception\Test\Unit;
//-
use common\models\UserType;

class UserTypeTest extends Unit
{
    protected function tearDown()
    {
        UserType::deleteAll();
    }

    public function testCRUD()
    {
        $model = new UserType();
        $model->user_type = "Testing";

        expect('Criar UserType', $model->save())->true();

        $model = UserType::findOne(['user_type' => "Testing"]);
        expect('Encontrar UserType', $model !== null)->true();
    }

    public function testValidate()
    {
        $model = new UserType();
        $model->user_type = null;

        expect('tipo obrigatório', $model->save())->false();
    }
}