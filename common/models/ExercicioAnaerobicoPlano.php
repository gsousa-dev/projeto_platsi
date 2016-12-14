<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property ExerciciosPlano $idExercicio
 * @property integer $series
 * @property integer $repeticoes
 */

class ExercicioAnaerobicoPlano extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exercicio_anaerobico_plano';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idExercicio', 'series', 'repeticoes'], 'required'],
            [['idExercicio', 'series', 'repeticoes'], 'integer'],
            [['idExercicio'], 'exist', 'skipOnError' => true, 'targetClass' => ExerciciosPlano::className(), 'targetAttribute' => ['idExercicio' => 'idExercicio_plano']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idExercicio' => 'Id Exercício',
            'series' => 'Séries',
            'repeticoes' => 'Repetições',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdExercicio0()
    {
        return $this->hasOne(ExerciciosPlano::className(), ['idExercicio_plano' => 'idExercicio']);
    }
}
