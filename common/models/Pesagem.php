<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idPesagem
 * @property string $data_pesagem
 * @property integer $peso
 *
 * @property Cliente $idCliente
 */
class Pesagem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pesagem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_pesagem', 'peso', 'idCliente'], 'required'],
            [['data_pesagem'], 'safe'],
            [['peso', 'idCliente'], 'integer'],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPesagem' => 'Id Pesagem',
            'data_pesagem' => 'Data Pesagem',
            'peso' => 'Peso',
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
