<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class ExercicioFixture extends ActiveFixture
{
    public $modelClass = 'common\models\Exercicio';
    public $depends = ['common\fixtures\TipoExercicio'];
}