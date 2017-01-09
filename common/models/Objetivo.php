<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property Cliente $idCliente
 *
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
            [['objetivo'], 'string', 'max' => 255],
            [['idCliente'], 'unique'],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCliente' => 'Id Cliente',
            'objetivo' => 'Objetivo',
            'peso_pretendido' => 'Peso Pretendido',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::className(), ['idCliente' => 'idCliente']);
    }
}
