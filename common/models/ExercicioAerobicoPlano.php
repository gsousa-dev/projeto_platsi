<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property ExerciciosPlano $idExercicio
 *
 * @property integer $duracao
 */

class ExercicioAerobicoPlano extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exercicio_aerobico_plano';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idExercicio', 'duracao'], 'required'],
            [['idExercicio', 'duracao'], 'integer'],
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
            'duracao' => 'Duração',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicio()
    {
        return $this->hasOne(ExerciciosPlano::className(), ['idExercicio_plano' => 'idExercicio']);
    }
}
