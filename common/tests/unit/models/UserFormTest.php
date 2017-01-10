<?php
namespace common\tests\unit\models;

use common\fixtures\UserFixture;
use backend\models\forms\UserForm;

class UserFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    public function testCreateUserCorrect()
    {
        $form = new UserForm([
            'user_type' => 1,
            'name' => 'some_name',
            'username' => 'some_username',
            'email' => 'some_email@example.com',
            'password' => 'some_password',
            'birthday' => 'some_birthday',
            'gender' => 'some_gender',
        ]);

        $user = $form->save();

        expect($user)->isInstanceOf('common\models\User');
        expect($user->user_type)->equals('some_user_type');
        expect($user->username)->equals('some_username');
        expect($user->email)->equals('some_email@gmail.com');
        expect($user->validatePassword('some_password'))->true();
        expect($user->birthday)->equals('some_birthday');
        expect($user->gender)->equals('some_gender');
    }

    public function testCreateUserNotCorrect()
    {
        $form = new UserForm([
            'user_type' => 2,
            'name' => 'Testing User',
            'username' => 'testing_user',
            'email' => 'testing_user@gmail.com',
            'password' => '123456',
            'birthday' => '1989-10-20',
            'gender' => 'M',
        ]);

        expect_not($form->save());
        expect_that($form->getErrors('username'));
        expect_that($form->getErrors('email'));

        expect($form->getFirstError('username'))
            ->equals('This username has already been taken.');
        expect($form->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}