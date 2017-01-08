<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idMensagem
 *
 * @property string $data_envio
 * @property string $mensagem
 * @property string estado
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
            [['mensagem', 'estado'], 'string'],
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
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmissor()
    {
        return $this->hasOne(User::className(), ['id' => 'idEmissor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceptor()
    {
        return $this->hasOne(User::className(), ['id' => 'idReceptor']);
    }
}
