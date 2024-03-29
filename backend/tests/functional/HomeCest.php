<?php
namespace backend\tests\functional;

use common\fixtures\UserFixture;
use backend\tests\FunctionalTester;
use common\models\User;

class HomeCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
        $admin= User::findByUsername('admin');
        $I->amLoggedInAs($admin);
        $I->amOnPage('/');
    }

    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnRoute('/site/index');
    }

    public function logout(FunctionalTester $I)
    {
        $I->am('admin');
        $I->click('Logout');
        $I->dontSee('BEM-VINDO, ADMIN');
    }
}