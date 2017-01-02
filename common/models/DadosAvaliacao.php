<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property Cliente $idCliente
 *
 * @property string $altura
 * @property string $massa_corporal
 * @property string $massa_gorda
 * @property string $massa_muscular
 * @property string $agua_no_organismo
 */

class DadosAvaliacao extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dados_avaliacao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCliente', 'altura', 'massa_corporal', 'massa_gorda', 'massa_muscular', 'agua_no_organismo'], 'required'],
            [['idCliente'], 'integer'],
            [['altura', 'massa_corporal', 'massa_gorda', 'massa_muscular', 'agua_no_organismo'], 'number'],
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
            'altura' => 'Altura',
            'massa_corporal' => 'Massa Corporal',
            'massa_gorda' => 'Massa Gorda',
            'massa_muscular' => 'Massa Muscular',
            'agua_no_organismo' => 'Água No Organismo',
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
