<?php
namespace common\tests\unit\models;

use backend\models\forms\ExercicioForm;
use common\models\Exercicio;

class ExercicioFormTestTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function _before()
    {
    }

    public function _after()
    {
        Exercicio::deleteAll();
    }

    public function testCreateExercicioCorrect()
    {
        $form = new ExercicioForm([
            'descricao' => 'Exercício Teste',
            'tipo_exercicio' => 1,
        ]);

        $exercicio = $form->save();
        expect($exercicio)->isInstanceOf('common\models\Exercicio');

        expect($exercicio->descricao)->equals('Exercício Teste');
        expect($exercicio->tipo_exercicio)->equals(1);
    }

    public function testCreateExercicioNotCorrect()
    {
        $form = new ExercicioForm([
            'descricao' => 'Exercício Teste',
            'tipo_exercicio' => 3, //Tipo de exercício que não existe
        ]);

        expect_not($form->save());
        expect_that($form->getErrors('tipo_exercicio'));
    }
}