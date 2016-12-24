<?php
namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $idFoto
 *
 * @property string $descricao
 * @property string $data_foto
 * @property string $path
 * @property Cliente $idCliente
 */

class FotosDeProgresso extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fotos_de_progresso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'path', 'idCliente'], 'required'],
            [['data_foto'], 'safe'],
            [['idCliente'], 'integer'],
            [['descricao'], 'string', 'max' => 100],
            [['path'], 'string', 'max' => 250],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFoto' => 'Id Foto',
            'descricao' => 'Descrição',
            'data_foto' => 'Data Foto',
            'path' => 'Path',
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
