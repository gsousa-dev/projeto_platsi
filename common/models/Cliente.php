<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property User $idCliente
 * @property User $idPersonal_trainer
 *
 * @property DadosAvaliacao $dadosAvaliacao
 * @property Objetivo $objetivo
 *
 * @property Feedback[] $feedbacks
 * @property FotosDeProgresso[] $fotosDeProgresso
 * @property Mensagem[] $mensagens
 * @property Pesagem[] $pesagens
 * @property PlanoPessoal[] $planos
 */

class Cliente extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCliente'], 'required'],
            [['idCliente', 'idPersonal_trainer'], 'integer'],
            [['idCliente'], 'unique'],
            [['idCliente'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idCliente' => 'id']],
            [['idPersonal_trainer'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['idPersonal_trainer' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(User::className(), ['id' => 'idCliente']);
    }

    public function getImageurl()
    {
        $profile_picture = $this->getCliente()->select('profile_picture')->all();
        return Yii::$app->basePath.'/'.$profile_picture;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalTrainer()
    {
        return $this->hasOne(User::className(), ['id' => 'idPersonal_trainer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDadosAvaliacao()
    {
        return $this->hasOne(DadosAvaliacao::className(), ['idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFotosDeProgresso()
    {
        return $this->hasMany(FotosDeProgresso::className(), ['idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMensagens()
    {
        return $this->hasMany(Mensagem::className(), ['idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetivo()
    {
        return $this->hasOne(Objetivo::className(), ['idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesagens()
    {
        return $this->hasMany(Pesagem::className(), ['idCliente' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanos()
    {
        return $this->hasMany(PlanoPessoal::className(), ['idCliente' => 'idCliente']);
    }
}