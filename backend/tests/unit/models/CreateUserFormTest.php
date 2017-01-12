<?php
namespace backend\tests\unit\models;

use backend\models\forms\UserForm;
use common\fixtures\UserFixture;
use common\models\User;

class CreateUserFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    protected function _after()
    {
        User::deleteAll();
    }

    public function testCreateUserCorrect()
    {
        $form = new UserForm([
            'user_type' => 1,
            'name' => 'some name',
            'username' => 'some_username',
            'email' => 'some_email@gmail.com',
            'password' => '123456',
            'birthday' => '1989-10-20',
            'gender' => 'M',
        ]);

        $user = $form->save();
        expect($user)->isInstanceOf('common\models\User');

        expect($user->user_type)->equals(1);
        expect($user->name)->equals('some name');
        expect($user->username)->equals('some_username');
        expect($user->email)->equals('some_email@gmail.com');
        expect($user->validatePassword('123456'))->true();
        expect($user->birthday)->equals('1989-10-20');
        expect($user->gender)->equals('M');
    }

    public function testCreateUserThatAlreadyExists()
    {
        $form = new UserForm([
            'user_type' => 1,
            'name' => 'some name',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => 'some_password',
            'birthday' => 'some_birthday',
            'gender' => 'M',
        ]);

        expect_not($form->save());

        expect_that($form->getErrors('username'));
        expect_that($form->getErrors('email'));

        expect($form->getFirstError('username'))
            ->equals('This username has already been taken.');
        expect($form->getFirstError('email'))
            ->equals('This email address has already been taken.');
        expect($form->getFirstError('birthday'))
            ->equals('The format of Birthday is invalid.');
    }
}