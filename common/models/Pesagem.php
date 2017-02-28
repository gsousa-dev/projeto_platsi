<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idPesagem
 *
 * @property string $data_pesagem
 * @property string $peso
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
            [['peso', 'idCliente'], 'required'],
            [['data_pesagem'], 'safe'],
            [['peso'], 'number'],
            [['idCliente'], 'integer'],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
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
