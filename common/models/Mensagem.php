<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idMensagem
 *
 * @property string $mensagem
 * @property string $data_envio
 * @property User $idEmissor
 * @property User $idReceptor
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
            [['mensagem', 'idEmissor', 'idReceptor'], 'required'],
            [['mensagem'], 'string'],
            [['data_envio'], 'safe'],
            [['idEmissor', 'idReceptor'], 'integer'],
            [['idEmissor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idEmissor' => 'id']],
            [['idReceptor'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idReceptor' => 'id']],
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
            'data_envio' => 'Data de Envio',
            'idEmissor' => 'Id Emissor',
            'idReceptor' => 'Id Receptor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEmissor()
    {
        return $this->hasOne(User::className(), ['id' => 'idEmissor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdReceptor()
    {
        return $this->hasOne(User::className(), ['id' => 'idReceptor']);
    }
}
