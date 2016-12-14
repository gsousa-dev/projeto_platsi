<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idObjetivo
 * @property string $objetivo
 * @property integer $peso_pretendido
 *
 * @property Cliente $idCliente
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
            [['objetivo', 'peso_pretendido', 'idCliente'], 'required'],
            [['peso_pretendido', 'idCliente'], 'integer'],
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
    public function getIdCliente0()
    {
        return $this->hasOne(Cliente::className(), ['idCliente' => 'idCliente']);
    }
}
