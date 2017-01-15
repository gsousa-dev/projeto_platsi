<?php
namespace backend\tests\functional;

use backend\fixtures\ClienteFixture;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use common\models\Objetivo;
use common\models\User;
use common\models\Cliente;

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

        $personal_trainer = User::findByUsername('personal-trainer');
        $I->amLoggedInAs($personal_trainer);
        $I->amOnPage('cliente/novo-objetivo?idCliente=4');
    }

    public function _after(){
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
        $I->see('CRIAR OBJETIVO', 'h1');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Objetivo cannot be blank.');
        $I->seeValidationError('Peso Pretendido cannot be blank.');
    }

    public function createObjetivoWithWrongObjetivo(FunctionalTester $I)
    {
        $I->submitForm('#objetivo-form', $this->formParams(4, null, 'peso pretendido'));

        $I->See('Objetivo cannot be blank.', '.help-block');
        $I->dontSee('Peso Pretendido cannot be blank.', '.help-block');
    }

    public function createObjetivoWithWrongPesoPretendido(FunctionalTester $I)
    {
        $I->submitForm('#objetivo-form', $this->formParams(4, 'some_objetivo', 'peso pretendido'));

        $I->dontSee('Objetivo cannot be blank.', '.help-block');
        $I->see('Peso Pretendido must be an integer.', '.help-block');
    }

    public function createObjetivoSuccessfully(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'ObjetivoForm[idCliente]'  => 4,
                'ObjetivoForm[objetivo]'  => 'tester_objetivo',
                'ObjetivoForm[peso_pretendido]'  => 75,
            ]
        );

        $I->seeRecord('common\models\Objetivo', [
            'objetivo' => 'tester_objetivo',
            'peso_pretendido' => 75,
        ]);
    }
}