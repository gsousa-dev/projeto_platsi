<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

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

        $I->amOnRoute('/user/login');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
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


    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('admin', '123456'));
        $I->see('BEM-VINDO, ADMIN');
        $I->dontSeeLink('Login');
    }

    /**
     * @param FunctionalTester $I
     */
    public function loginUser(FunctionalTester $I)
    {
        $I->amOnPage('/user/login');
        $I->fillField('Username', 'admin');
        $I->fillField('Password', '123456');
        $I->click('login-button');
        $I->see('BEM-VINDO, ADMIN');
    }
}