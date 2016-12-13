<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idExercicio
 * @property string $descricao
 */
class Exercicio extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exercicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'required'],
            [['descricao'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idExercicio' => 'Id Exercicio',
            'descricao' => 'Descricao',
        ];
    }
}
