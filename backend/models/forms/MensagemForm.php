<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\Mensagem;

class MensagemForm extends Model
{
    public $mensagem;
    public $idReceptor;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mensagem'], 'required'],
            [['mensagem'], 'trim'],
            [['mensagem'], 'string'],
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $mensagem = new Mensagem();
        $mensagem->mensagem = $this->mensagem;
        $mensagem->idEmissor = \Yii::$app->user->id;
        $mensagem->idReceptor = $this->idReceptor;
        $mensagem->estado = 'por responder';
        Mensagem::updateAll(['estado' => 'respondida'],['idEmissor' => $this->idReceptor]);

        return $mensagem->save() ? $mensagem : null;
    }
}