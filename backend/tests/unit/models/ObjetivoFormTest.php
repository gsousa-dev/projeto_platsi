<?php
namespace backend\tests\unit\models;

use common\fixtures\UserFixture;
use backend\fixtures\ClienteFixture;
//-
use backend\models\forms\ObjetivoForm;
//-
use common\models\Objetivo;
use common\models\Cliente;
use common\models\User;

class ObjetivoFormTest extends \Codeception\Test\Unit
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
        Objetivo::deleteAll();
        Cliente::deleteAll();
        User::deleteAll();
    }

    public function testCreateObjetivoCorrect()
    {
        $form = new ObjetivoForm([
            'objetivo' => 'Objetivo Teste',
            'peso_pretendido' => 70,
        ]);
        $form->idCliente = 2;

        $objetivo = $form->save();
        expect($objetivo)->isInstanceOf('common\models\Objetivo');

        expect($objetivo->objetivo)->equals('Objetivo Teste');
        expect($objetivo->peso_pretendido)->equals(70);
    }

    public function testCreateObjetivoNotCorrect()
    {
        $form = new ObjetivoForm([
            'objetivo' => null,
            'peso_pretendido' => 'some text',
        ]);
        $form->idCliente = 2;

        expect_not($form->save());

        expect($form->getFirstError('objetivo'))
            ->equals('Objetivo cannot be blank.');
        expect($form->getFirstError('peso_pretendido'))
            ->equals('Peso Pretendido must be an integer.');
    }
}