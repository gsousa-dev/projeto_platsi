<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 *
 * @property string $tipo
 *
 * @property Exercicio[] $exercicios
 */

class TipoExercicio extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_exercicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo'], 'required'],
            [['tipo'], 'string', 'max' => 45],
            [['tipo'], 'unique'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercicios()
    {
        return $this->hasMany(Exercicio::className(), ['tipo_exercicio' => 'id']);
    }
}