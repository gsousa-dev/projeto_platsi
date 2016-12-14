<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idMensagem
 * @property string $mensagem
 * @property string $data_envio
 * @property Cliente $idCliente
 * @property User $idPersonal_trainer
 */

class Mensagem extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mensagem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mensagem', 'data_envio', 'idCliente', 'idPersonal_trainer'], 'required'],
            [['mensagem'], 'string'],
            [['data_envio'], 'safe'],
            [['idCliente', 'idPersonal_trainer'], 'integer'],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
            [['idPersonal_trainer'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idPersonal_trainer' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMensagem' => 'Id Mensagem',
            'mensagem' => 'Mensagem',
            'data_envio' => 'Data Envio',
            'idCliente' => 'Id Cliente',
            'idPersonal_trainer' => 'Id Personal Trainer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(Cliente::className(), ['idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonalTrainer()
    {
        return $this->hasOne(User::className(), ['id' => 'idPersonal_trainer']);
    }
}
