<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $Tipo
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
            [['Tipo'], 'required'],
            [['Tipo'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Tipo' => 'Tipo',
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
