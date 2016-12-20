<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idExercicio_plano
 *
 * @property PlanoPessoal $idPlano
 * @property Exercicio $idExercicio
 *
 * @property ExercicioAerobicoPlano $exercicioAerobicoPlano
 * @property ExercicioAnaerobicoPlano $exercicioAnaerobicoPlano
 */

class ExerciciosPlano extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exercicios_plano';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPlano', 'idExercicio'], 'required'],
            [['idPlano', 'idExercicio'], 'integer'],
            [['idExercicio'], 'exist', 'skipOnError' => true, 'targetClass' => Exercicio::className(), 'targetAttribute' => ['idExercicio' => 'idExercicio']],
            [['idPlano'], 'exist', 'skipOnError' => true, 'targetClass' => PlanoPessoal::className(), 'targetAttribute' => ['idPlano' => 'idPlano']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idExercicio_plano' => 'Id Exercicio Plano',
            'idPlano' => 'Id Plano',
            'idExercicio' => 'Id Exercício',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicioAerobicoPlano()
    {
        return $this->hasOne(ExercicioAerobicoPlano::className(), ['idExercicio' => 'idExercicio_plano']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicioAnaerobicoPlano()
    {
        return $this->hasOne(ExercicioAnaerobicoPlano::className(), ['idExercicio' => 'idExercicio_plano']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdExercicio()
    {
        return $this->hasOne(Exercicio::className(), ['idExercicio' => 'idExercicio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPlano()
    {
        return $this->hasOne(PlanoPessoal::className(), ['idPlano' => 'idPlano']);
    }
}
