<?php
namespace common\tests\unit\models;

use common\models\UserType;

class UserTypeTest extends \Codeception\Test\Unit
{
    protected $tester;

    public function testValidation()
    {
        $user_type = new UserType();

        $user_type->user_type = null;
        $this->assertFalse($user_type->validate(['user_type']));

        $user_type->user_type = 'toolooooongnaaaaaaameeeeddddddddddddddddddddddddddsssssssssssssssssssssddddddddddddddddddd';
        $this->assertFalse($user_type->validate(['user_type']));

        $user_type->user_type = 'Cliente';
        $this->assertFalse($user_type->validate(['user_type']));

        $user_type->user_type = 'Novo User Type';
        $this->assertTrue($user_type->validate(['user_type']));
    }


    public function testSaveModel()
    {
        $model = new UserType();
        $model->user_type = "Novo User Type";
        expect('User Type criado com sucesso.', $model->save())->true();

        $model = UserType::findOne(['user_type' => "Novo User Type"]);
        expect('Encontrar UserType', $model !== null)->true();
    }
}