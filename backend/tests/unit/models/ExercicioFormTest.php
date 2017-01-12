<?php
namespace backend\tests\unit\models;

use backend\models\forms\ExercicioForm;
use common\models\Exercicio;

class ExercicioFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
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