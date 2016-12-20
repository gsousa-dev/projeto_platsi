<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idFeedback
 *
 * @property string $mensagem
 * @property string $rating
 * @property Cliente $idCliente
 */

class Feedback extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mensagem', 'rating', 'idCliente'], 'required'],
            [['mensagem'], 'string'],
            [['rating'], 'number'],
            [['idCliente'], 'integer'],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFeedback' => 'Id Feedback',
            'mensagem' => 'Mensagem',
            'rating' => 'Rating',
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
