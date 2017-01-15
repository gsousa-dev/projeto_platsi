<?php
namespace backend\tests\functional;

use backend\tests\FunctionalTester;
//-
use common\fixtures\UserFixture;
use backend\fixtures\ClienteFixture;
//-
use common\models\DadosAvaliacao;
use common\models\Cliente;
use common\models\User;

class CreateDadosAvaliacaoCest
{
    protected $formId = '#dados-avaliacao-form';

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
        $I->amOnPage('cliente/registar-avaliacao-fisica?idCliente=4');
        $I->see('REGISTAR DADOS DA AVALIAÇÃO FÍSICA', 'h1');
    }

    public function _after()
    {
        DadosAvaliacao::deleteAll();
        Cliente::deleteAll();
        User::deleteAll();
    }

    protected function formParams($idCliente = 4, $altura = null, $massa_corporal = null, $massa_gorda = null, $massa_muscular = null, $agua_no_organismo)
    {
        return [
            'DadosAvaliacaoForm[idCliente]' => $idCliente,
            'DadosAvaliacaoForm[altura]' => $altura,
            'DadosAvaliacaoForm[massa_corporal]' => $massa_corporal,
            'DadosAvaliacaoForm[massa_gorda]' => $massa_gorda,
            'DadosAvaliacaoForm[massa_muscular]' => $massa_muscular,
            'DadosAvaliacaoForm[agua_no_organismo]' => $agua_no_organismo,
        ];
    }

    public function createDadosAvaliacaoWithEmptyFields(FunctionalTester $I)
    {
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Altura cannot be blank.');
        $I->seeValidationError('Massa Corporal cannot be blank.');
        $I->seeValidationError('Massa Gorda cannot be blank.');
        $I->seeValidationError('Massa Muscular cannot be blank.');
        $I->seeValidationError('Agua No Organismo cannot be blank.');
    }

    public function createDadosAvaliacaoWithWrongAltura(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 'altura', 22, 22, 35, 35));
        $I->dontSee('Altura cannot be blank.', '.help-block');
        $I->see('Altura must be a number.', '.help-block');
        $I->dontSee('Massa Corporal cannot be blank.', '.help-block');
        $I->dontSee('Massa Gorda cannot be blank.', '.help-block');
        $I->dontSee('Massa Muscular cannot be blank.', '.help-block');
        $I->dontSee('Agua No Organismo cannot be blank.', '.help-block');
    }

    public function createDadosAvaliacaoWithWrongMassaCorporal(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 1.75, 'massa corporal', 35, 35, 35));
        $I->dontSee('Altura cannot be blank.', '.help-block');
        $I->dontSee('Massa Corporal cannot be blank.', '.help-block');
        $I->see('Massa Corporal must be a number.', '.help-block');
        $I->dontSee('Massa Gorda cannot be blank.', '.help-block');
        $I->dontSee('Massa Muscular cannot be blank.', '.help-block');
        $I->dontSee('Agua No Organismo cannot be blank.', '.help-block');
    }

    public function createDadosAvaliacaoWithWrongMassaGorda(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 1.75, 45, 'massa gorda', 35, 35));
        $I->dontSee('Altura cannot be blank.', '.help-block');
        $I->dontSee('Massa Corporal cannot be blank.', '.help-block');
        $I->dontSee('Massa Gorda cannot be blank.', '.help-block');
        $I->see('Massa Gorda must be a number.', '.help-block');
        $I->dontSee('Massa Muscular cannot be blank.', '.help-block');
        $I->dontSee('Agua No Organismo cannot be blank.', '.help-block');
    }

    public function createDadosAvaliacaoWithWrongMassaMuscular(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 1.75, 45, 35, 'massa muscular', 35));
        $I->dontSee('Altura cannot be blank.', '.help-block');
        $I->dontSee('Massa Corporal cannot be blank.', '.help-block');
        $I->dontSee('Massa Gorda cannot be blank.', '.help-block');
        $I->dontSee('Massa Muscular cannot be blank.', '.help-block');
        $I->see('Massa Muscular must be a number.', '.help-block');
        $I->dontSee('Agua No Organismo cannot be blank.', '.help-block');
    }

    public function createDadosAvaliacaoWithWrongAguaNoOrganismo(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 1.75, 45, 35, 45, 'agua no organismo'));
        $I->dontSee('Altura cannot be blank.', '.help-block');
        $I->dontSee('Massa Corporal cannot be blank.', '.help-block');
        $I->dontSee('Massa Gorda cannot be blank.', '.help-block');
        $I->dontSee('Massa Muscular cannot be blank.', '.help-block');
        $I->dontSee('Agua No Organismo cannot be blank.', '.help-block');
        $I->see('Agua No Organismo must be a number.', '.help-block');
    }

    public function createDadosAvaliacaoSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(4, 1.80, 45, 35, 43, 75));
        $I->seeRecord('common\models\DadosAvaliacao', [
            'altura' => 1.80,
            'massa_corporal' => 45,
            'massa_gorda' => 35,
            'massa_muscular' => 43,
            'agua_no_organismo' => 75,
        ]);
    }
}