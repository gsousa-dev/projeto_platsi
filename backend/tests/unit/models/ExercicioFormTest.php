<?php
namespace backend\tests\unit\models;

use backend\tests\fixtures\ExercicioFixture;
use backend\models\forms\ExercicioForm;
use common\models\TipoExercicio;

class ExercicioFormTestTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'tipo_exercicio' => [
                'class' => TipoExercicio::className(),
                'dataFile' => codecept_data_dir() . 'tipo_exercicio.php'
            ]
        ]);
        $this->tester->haveFixtures([
            'exercicio' => [
                'class' => ExercicioFixture::className(),
                'dataFile' => codecept_data_dir() . 'exercicio.php'
            ]
        ]);
    }


    public function testCriarExercicioValido()
    {
        $exercicioForm = new ExercicioForm([
            'descricao' => 'Teste',
            'tipo_exercicio' => 1,
        ]);

        expect('Exercício deverá ser criado', $exercicioForm->save())->true();
    }
}