<?php
namespace common\tests\unit\models;

use Codeception\Util\Fixtures;
use common\fixtures\ClienteFixture;
//-
use common\models\Cliente;

class ClienteTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function fixtures()
    {
        return [
            'clientes' => ClienteFixture::className(),
        ];
    }

    public function testValidation()
    {

    }


    public function testSaveModel()
    {

    }
}