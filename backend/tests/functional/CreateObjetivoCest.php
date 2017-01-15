<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
//-
use common\fixtures\UserFixture;
use backend\fixtures\ClienteFixture;
//-
use common\models\Objetivo;
use common\models\Cliente;
use common\models\User;

class CreateObjetivoCest
{
    protected $formId = '#objetivo-form';

    public function _before(FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ],
            'cliente' => [
                'class' => ClienteFixture::className(),
                'dataFile' => codecept_data_dir() . 'cliente.php'
            ]
        ]);

        $personal_trainer = User::findByUsername('personal_trainer');
        $I->amLoggedInAs($personal_trainer);
        $I->amOnPage('cliente/novo-objetivo?idCliente=4');
        $I->see('CRIAR OBJETIVO', 'h1');
    }

    public function _after()
    {
        Objetivo::deleteAll();
        Cliente::deleteAll();
        User::deleteAll();
    }

    protected function formParams($idCliente = 4, $objetivo = null, $peso_pretendido = null)
    {
        return [
            'ObjetivoForm[idCliente]' => $idCliente,
            'ObjetivoForm[objetivo]' => $objetivo,
            'ObjetivoForm[peso_pretendido]' => $peso_pretendido,
        ];
    }

    public function createObjetivoWithEmptyFields(FunctionalTester $I)
    {
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Objetivo cannot be blank.');
        $I->seeValidationError('Peso Pretendido cannot be blank.');
    }

    public function createObjetivoWithWrongObjetivo(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, null, 75));
        $I->See('Objetivo cannot be blank.', '.help-block');
    }

    public function createObjetivoWithWrongPesoPretendido(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 'some_objetivo', 'peso pretendido'));
        $I->see('Peso Pretendido must be a number.', '.help-block');
    }

    public function createObjetivoSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 'tester_objetivo', 75));
        $I->seeRecord('common\models\Objetivo', [
            'objetivo' => 'tester_objetivo',
            'peso_pretendido' => 75,
        ]);
    }
}