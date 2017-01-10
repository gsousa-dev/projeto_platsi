<?php
namespace backend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->getHomeUrl());
        $I->amLoggedInAs(1);

        $I->see('BEM-VINDO, TESTING_USER');
        $I->see('Blank Page Layout');
        $I->see('Logout (testing_user)', 'form button[type=submit]');
    }
}