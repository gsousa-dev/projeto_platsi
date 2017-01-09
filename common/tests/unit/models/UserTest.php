<?php
namespace common\tests\unit\models;

use Codeception\Test\Unit;
//-
use common\models\UserType;
use common\models\User;

class UserTest extends Unit
{
    private $user_type;

    protected function setUp()
    {
        $this->user_type = new UserType();
        $this->user_type->user_type = 'Testing';
        $this->user_type->save();
    }

    protected function tearDown()
    {
        User::deleteAll();
    }

    public function testCRUD()
    {

    }

    public function testValidate()
    {

    }
}