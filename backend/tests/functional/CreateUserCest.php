<?php
namespace backend\tests\functional;

use frontend\tests\FunctionalTester;

class CreateUserCest
{
    protected $formId = '#create-user-form';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('user/create');
    }

    public function createUserWithEmptyFields(FunctionalTester $I)
    {
        //$I->see('Novo Utilizador', 'h1');
        $I->see('Preencha os seguintes campos para criar um novo utilizador:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');

    }

    public function createUserWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'UserForm[username]'  => 'tester',
                'UserForm[password]'  => 'tester_password',
                'UserForm[email]'     => 'ttttt',
        ]
        );
        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function createUserSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'tester',
            'SignupForm[email]' => 'tester.email@example.com',
            'SignupForm[password]' => 'tester_password',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'tester',
            'email' => 'tester.email@example.com',
        ]);

        $I->see('Logout (tester)', 'form button[type=submit]');
    }
}
