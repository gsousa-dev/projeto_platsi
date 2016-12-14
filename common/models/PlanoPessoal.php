<?php
namespace common\models;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "plano_pessoal".
 *
 * @property integer $idPlano
 * @property string $descricao
 * @property Cliente $idCliente
 *
 * @property ExerciciosPlano[] $exerciciosPlano
 */
class PlanoPessoal extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plano_pessoal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao', 'idCliente'], 'required'],
            [['idCliente'], 'integer'],
            [['descricao'], 'string', 'max' => 255],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['idCliente' => 'idCliente']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPlano' => 'Id Plano',
            'descricao' => 'Descrição',
            'idCliente' => 'Id Cliente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExerciciosPlano()
    {
        return $this->hasMany(ExerciciosPlano::className(), ['idPlano' => 'idPlano']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(Cliente::className(), ['idCliente' => 'idCliente']);
    }
}