<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\User;
use common\models\UserType;

class CreateUserForm extends Model
{
    public $user_type;
    public $name;
    public $username;
    public $email;
    public $password;
    public $birthday;
    public $gender;

    public $idPersonal_trainer;

    public function rules()
    {
        return [
            [['user_type'], 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type' => 'id']],
            [['user_type'], 'required', 'message' => 'Tem que selecionar um tipo de utilizador'],
            [['name', 'username', 'password', 'email', 'birthday'], 'required', 'message' => ''],
            [['gender'], 'required', 'message' => 'Tem que selecionar um género'],
            [['name', 'username', 'email'], 'trim'],
            [['username'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            [['username'], 'string', 'min' => 2, 'max' => 32],
            [['username'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['email'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            [['password'], 'string', 'min' => 6],
            [['email'], 'email'],
            [['name'], 'string', 'max' => 100],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['gender'], 'in', 'range' => ['M', 'F']],

            [['idPersonal_trainer'], 'required', 'when' => function($model) { return $model->user_type == 4; }, 'message' => 'Tem que selecionar um personal trainer'],
            [['idPersonal_trainer'], 'integer'],
            [['idPersonal_trainer'], 'validatePersonalTrainer']
        ];
    }

    public function validatePersonalTrainer ($attribute, $params)
    {
        $personal_trainer = User::findOne(['id' => $this->idPersonal_trainer]);
        if (!($personal_trainer->user_type == 3)) {
            $this->addError($attribute, 'O utilizador tem que ser um personal trainer');
        }
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->user_type = $this->user_type;
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->generateAuthKey();
        $user->setPassword($this->password);
        $user->birthday = $this->birthday;
        $user->gender = $this->gender;

        return $user->save() ? $user : null;
    }
}