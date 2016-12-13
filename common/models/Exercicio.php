<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idExercicio
 * @property string $descricao
 * @property integer $tipo_exercicio
 *
 * @property TipoExercicio $tipoExercicio
 * @property ExerciciosPlano[] $exerciciosPlanos
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
            [['tipo_exercicio'], 'integer'],
            [['descricao'], 'string', 'max' => 45],
            [['tipo_exercicio'], 'exist', 'skipOnError' => true, 'targetClass' => TipoExercicio::className(), 'targetAttribute' => ['tipo_exercicio' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idExercicio' => 'Id Exercicio',
            'descricao' => 'Descrição',
            'tipo_exercicio' => 'Tipo de Exercício',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoExercicio()
    {
        return $this->hasOne(TipoExercicio::className(), ['id' => 'tipo_exercicio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExerciciosPlanos()
    {
        return $this->hasMany(ExerciciosPlano::className(), ['idExercicio' => 'idExercicio']);
    }
}
