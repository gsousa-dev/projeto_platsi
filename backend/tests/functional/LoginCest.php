<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\User;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
        $I->amOnPage('/user/login');
    }

    public function _after()
    {
        User::deleteAll();
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function loginAsAdmin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', '123456'));
        $I->see('BEM-VINDO, ADMIN');
        $I->am('admin');
    }

    public function loginAsSecretaria(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('secretaria', '123456'));
        $I->see('BEM-VINDO, SECRETARIA');
        $I->am('secretaria');
    }

    public function loginAsPersonalTrainer(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('personal-trainer', '123456'));
        $I->see('BEM-VINDO, PERSONAL-TRAINER');
        $I->am('personal_trainer');
    }

    public function loginAsNotAllowedUser(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('cliente', '123456'));
        $I->click('login-button');
        $I->seeValidationError('Incorrect username or password.');
    }

    public function checkEmpty(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('', ''));
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');
    }

    public function checkWrongPassword(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', 'wrong_password'));
        $I->seeValidationError('Incorrect username or password.');
    }
}