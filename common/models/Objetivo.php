<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property Cliente $idCliente
 * @property string $objetivo
 * @property integer $peso_pretendido
 */

class Objetivo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'objetivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCliente', 'objetivo', 'peso_pretendido'], 'required'],
            [['idCliente', 'peso_pretendido'], 'integer'],
            [['objetivo'], 'string', 'max' => 45],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idObjetivo' => 'Id Objetivo',
            'objetivo' => 'Objetivo',
            'peso_pretendido' => 'Peso Pretendido',
            'idCliente' => 'Id Cliente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(Cliente::className(), ['idCliente' => 'idCliente']);
    }
}
