<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idExercicio
 *
 * @property string $descricao
 * @property TipoExercicio $tipo_exercicio
 *
 * @property ExerciciosPlano[] $exerciciosPlano
 */

class Exercicio extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exercicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'tipo_exercicio'], 'required'],
            [['descricao'], 'unique'],
            [['tipo_exercicio'], 'integer'],
            [['descricao'], 'string', 'max' => 45],
            [['tipo_exercicio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoExercicio::className(), 'targetAttribute' => ['tipo_exercicio' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoExercicio()
    {
        return $this->hasOne(TipoExercicio::className(), ['id' => 'tipo_exercicio']);
    }

    public function getTipo()
    {
        return TipoExercicio::findOne($this->tipo_exercicio)->tipo;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExerciciosPlanos()
    {
        return $this->hasMany(ExerciciosPlano::className(), ['idExercicio' => 'idExercicio']);
    }
}