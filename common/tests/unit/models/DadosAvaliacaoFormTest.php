<?php
namespace common\tests\unit\models;

use common\fixtures\DadosAvaliacaoFixture;
//-
use backend\models\forms\DadosAvaliacaoForm;

class DadosAvaliacaoFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function fixtures ()
    {
        return [
            'avaliacoes' => DadosAvaliacaoFixture::className(),
        ];
    }

    public function testCorrectDadosAvaliacao()
    {
        $model = new DadosAvaliacaoForm([
            'altura' => 'some_altura',
            'massa_corporal' => 'some_massa_corporal',
            'massa_gorda' => 'some_massa_gorda',
            'massa_muscular' => 'some_massa_muscular',
            'agua_no_organismo' => 'some_agua_no_organismo',
        ]);

        $dadosAvaliacao = $model->save();

        expect($dadosAvaliacao)->isInstanceOf('common\models\DadosAvaliacao');

        expect($dadosAvaliacao->altura)->equals('some_altura');
        expect($dadosAvaliacao->massa_corporal)->equals('some_massa_corporal');
        expect($dadosAvaliacao->massa_gorda)->equals('some_massa_gorda');
        expect($dadosAvaliacao->massa_muscular)->equals('some_massa_muscular');
        expect($dadosAvaliacao->agua_no_organismo)->equals('some_agua_no_organismo');
    }

    public function testNotCorrectDadosAvaliacao()
    {
        $model = new DadosAvaliacaoForm([
            'altura' => 'ss',
            'massa_corporal' => null,
            'massa_gorda' => 2,
            'massa_muscular' => 'as',
            'agua_no_organismo' => 20,
        ]);

        expect_not($model->save());

        expect($model->getFirstError('altura'))
            ->equals('Altura must be a number.');
        expect($model->getFirstError('massa_corporal'))
            ->equals('Massa Corporal cannot be blank.');
        expect($model->getFirstError('massa_muscular'))
            ->equals('Massa Muscular must be a number.');
    }
}
