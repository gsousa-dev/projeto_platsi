<?php
namespace backend\tests\fixtures;

use yii\test\ActiveFixture;

class ExercicioFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Exercicio';
    public $depends = ['backend\tests\fixtures\TipoExercicio'];
}