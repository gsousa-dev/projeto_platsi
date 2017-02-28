<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
//-
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

    protected function formParams($user_type = null, $name = null, $username = null, $password = null, $email = null, $birthday = null, $gender = null)
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
        $I->seeValidationError('Tem que selecionar um tipo de utilizador');
        $I->seeValidationError('Tem que selecionar um género');
    }

    public function createUserWithInvalidUsername(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(2, 'some name', 'some username', 'some_password', 'some_email'));

        $I->dontSee('User Type is invalid.', '.help-block');
        $I->dontSee('Name cannot be blank.', '.help-block');
        $I->see('Username is invalid.', '.help-block');
    }

    public function createUserWithInvalidEmail(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(2, 'some name', 'some_username', 'some_password', 'some_email'));

        $I->dontSee('User Type is invalid.', '.help-block');
        $I->dontSee('Name cannot be blank.', '.help-block');
        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function createUserSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(1, 'some name', 'some_username', 'some_password', 'some_email@mail.com', '1999-05-11', 'M'));

        $I->seeRecord('common\models\User', [
            'user_type' => 1,
            'name' => 'some name',
            'username' => 'some_username',
            'email' => 'some_email@mail.com',
            'birthday' => '1999-05-11',
            'gender' => 'M'
        ]);
    }
}