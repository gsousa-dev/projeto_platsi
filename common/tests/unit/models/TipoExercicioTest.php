<?php
namespace common\tests\unit\models;

use Codeception\Test\Unit;
//-
use common\models\TipoExercicio;

class TipoExercicioTest extends Unit
{
    protected function tearDown()
    {
        TipoExercicio::deleteAll();
    }

    public function testCRUD()
    {
        $model = new TipoExercicio();
        $model->tipo = "tipoDeExercicio";

        expect('Criar TipoExercicio', $model->save())->true();

        $model = TipoExercicio::findOne(['tipo' => "tipoDeExercicio"]);
        expect('Encontrar TipoExercicio', $model !== null)->true();
    }

    public function testValidate()
    {
        $model = new TipoExercicio();
        $model->tipo = null;

        expect('tipo obrigatório', $model->save())->false();
    }
}