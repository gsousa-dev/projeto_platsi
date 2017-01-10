<?php
namespace common\tests\unit\models;

use common\models\TipoExercicio;

class TipoExercicioTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    public function testValidation()
    {
        $tipo_exercicio = new TipoExercicio();

        $tipo_exercicio->tipo = null;
        $this->assertFalse($tipo_exercicio->validate(['tipo']));

        $tipo_exercicio->tipo = 'toolooooongnaaaaaaameeeeddddddddddddddddddddddddddsssssssssssssssssssssddddddddddddddddddd';
        $this->assertFalse($tipo_exercicio->validate(['tipo']));

        $tipo_exercicio->tipo = 'Aeróbico';
        $this->assertFalse($tipo_exercicio->validate(['tipo']));

        $tipo_exercicio->tipo = 'Novo Tipo de Exercício';
        $this->assertTrue($tipo_exercicio->validate(['tipo']));
    }


    public function testSaveModel()
    {
        $model = new TipoExercicio();
        $model->tipo = "Novo Tipo de Exercício";
        expect('Tipo de Exercício criado com sucesso.', $model->save())->true();

        $model = TipoExercicio::findOne(['tipo' => "Novo Tipo de Exercício"]);
        expect('Encontrar TipoExercicio', $model !== null)->true();
    }
}