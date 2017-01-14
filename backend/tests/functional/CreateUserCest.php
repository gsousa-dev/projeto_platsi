<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;

class CreateUserCest
{
    protected $formId = '#create-user-form';

    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
        $admin = User::findByUsername('admin');
        $I->amLoggedInAs($admin);
        $I->amOnPage('user/create');
    }

    protected function formParams($user_type, $name, $username, $password, $email, $birthday, $gender)
    {
        return [
            'CreateUserForm[user_type]' => $user_type,
            'CreateUserForm[name]' => $name,
            'CreateUserForm[username]' => $username,
            'CreateUserForm[password]' => $password,
            'CreateUserForm[email]' => $email,
            'CreateUserForm[birthday]' => $birthday,
            'CreateUserForm[gender]' => $gender,
        ];
    }

    public function createUserWithEmptyFields(FunctionalTester $I)
    {
        $I->see('NOVO UTILIZADOR', 'h1');
        $I->see('Preencha os seguintes campos para criar um novo utilizador:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Name cannot be blank.');
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Birthday cannot be blank.');
    }

    public function createUserWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', '123456'));
        $I->submitForm(
            $this->formId, [
                'UserForm[user_type]'  => 'tester_user_type',
                'UserForm[name]'  => 'tester_name',
                'UserForm[username]'  => 'tester',
                'UserForm[password]'  => 'tester_password',
                'UserForm[email]'     => 'ttttt',
            ]
        );
        $I->dontSee('Name cannot be blank.', '.help-block');
        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function createUserSuccessfully(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'UserForm[user_type]'  => 1,
                'UserForm[name]'  => 'tester_name',
                'UserForm[username]'  => 'tester_username',
                'UserForm[password]'  => 'tester_password',
                'UserForm[email]'     => 'tester.email@example.com',
                'UserForm[birthday]'  => '1999-05-11',
                'UserForm[gender]'  => 'M',
            ]
        );

        $I->seeRecord('common\models\User', [
            'username' => 'tester_username',
            'email' => 'tester.email@example.com',
        ]);
    }
}