<?php
namespace backend\tests\unit\models;

use common\fixtures\UserFixture;
use backend\fixtures\ClienteFixture;
//-
use backend\models\forms\DadosAvaliacaoForm;
//-
use common\models\DadosAvaliacao;
use common\models\Cliente;
use common\models\User;

class DadosAvaliacaoFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
            'cliente' => [
                'class' => ClienteFixture::className(),
                'dataFile' => codecept_data_dir() . 'cliente.php',
            ],
        ]);
    }

    protected function _after()
    {
        DadosAvaliacao::deleteAll();
        Cliente::deleteAll();
        User::deleteAll();
    }

    public function testCorrectDadosAvaliacao()
    {
        $model = new DadosAvaliacaoForm([
            'idCliente' => 2,
            'altura' => 1.89,
            'massa_corporal' => 24.3,
            'massa_gorda' => 30.1,
            'massa_muscular' => 23.2,
            'agua_no_organismo' => 60.7,
        ]);

        $dadosAvaliacao = $model->save();

        expect($dadosAvaliacao)->isInstanceOf('common\models\DadosAvaliacao');

        expect($dadosAvaliacao->altura)->equals(1.89);
        expect($dadosAvaliacao->massa_corporal)->equals(24.3);
        expect($dadosAvaliacao->massa_gorda)->equals(30.1);
        expect($dadosAvaliacao->massa_muscular)->equals(23.2);
        expect($dadosAvaliacao->agua_no_organismo)->equals(60.7);
    }

    public function testCreateDadosAvaliacaoNotCorrect()
    {
        $form = new DadosAvaliacaoForm([
            'altura' => 'ss',
            'massa_corporal' => null,
            'massa_gorda' => 2,
            'massa_muscular' => 'as',
            'agua_no_organismo' => 20,
        ]);

        expect_not($form->save());

        expect($form->getFirstError('altura'))
            ->equals('Altura must be a number.');
        expect($form->getFirstError('massa_corporal'))
            ->equals('Massa Corporal cannot be blank.');
        expect($form->getFirstError('massa_muscular'))
            ->equals('Massa Muscular must be a number.');
    }
}