<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
//-
use common\fixtures\UserFixture;
use backend\fixtures\ClienteFixture;
//-
use common\models\Exercicio;
use common\models\Cliente;
use common\models\User;

class CreateExercicioCest
{
    protected $formId = '#exercicio-form';

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
        $I->amOnPage('exercicio/create');
        $I->see('NOVO EXERCÍCIO', 'h1');
    }

    public function _after()
    {
        Exercicio::deleteAll();
        Cliente::deleteAll();
        User::deleteAll();
    }

    protected function formParams($descricao = null, $tipo_exercicio = null)
    {
        return [
            'ExercicioForm[descricao]' => $descricao,
            'ExercicioForm[tipo_exercicio]' => $tipo_exercicio,
        ];
    }

    public function createExercicioWithEmptyFields(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams('', 2));
        $I->see('Descricao cannot be blank.', '.help-block');
    }

    public function createExercicioWithInvalidTipoExercicio(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams('exercicio', 3));
        $I->dontSee('Descricao cannot be blank.', '.help-block');
        $I->see('Tipo Exercicio is invalid.', '.help-block');
    }

    public function createExercicioSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams('teste_descricao', 2));
        $I->seeRecord('common\models\Exercicio', [
            'descricao' => 'teste_descricao',
            'tipo_exercicio' => 2,
        ]);
    }
}