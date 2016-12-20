<?php
namespace common\models;

use GuzzleHttp\Client;
use Yii;
use yii\db\ActiveRecord;
use yii\web\ServerErrorHttpException;

/**
 * @property User $idCliente
 * @property User $idPersonal_trainer
 *
 * @property DadosAvaliacao $dadosAvaliacao
 * @property Objetivo $objetivo
 *
 * @property Feedback[] $feedbacks
 * @property FotoDeProgresso[] $fotosDeProgresso
 * @property Mensagem[] $mensagens
 * @property Pesagem[] $pesagens
 * @property PlanoPessoal[] $planosPessoais
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
            [['idPersonal_trainer'], 'validatePersonalTrainer']
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validatePersonalTrainer ($attribute, $params)
    {
        $personal_trainer = User::findOne(['id' => $this->idPersonal_trainer]);
        if (!($personal_trainer->user_type == 3)) {
            $this->addError($attribute, 'User must be a personal trainer.');
        }
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $personal_trainer = User::findOne(['id' => Yii::$app->request->post('idPersonal_trainer')]);
        if ($personal_trainer->user_type == 3) {
            $this->idPersonal_trainer = $personal_trainer->id;
            return true;
        } else {
            User::deleteAll(['id' => $this->idCliente]);
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCliente' => 'Id Cliente',
            'idPersonal_trainer' => 'Id Personal Trainer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(User::className(), ['id' => 'idCliente']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPersonalTrainer()
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
        return $this->hasMany(FotoDeProgresso::className(), ['idCliente' => 'idCliente']);
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
    public function getPlanosPessoais()
    {
        return $this->hasMany(PlanoPessoal::className(), ['idCliente' => 'idCliente']);
    }
}
