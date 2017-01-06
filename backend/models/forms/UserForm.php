<?php
namespace backend\models\forms;

use yii\base\Model;
use yii\web\UploadedFile; //TODO: Adicionar funcionalidade para adicionar Foto de Perfil
//-
use common\models\User;

class UserForm extends Model
{
    public $user_type;
    public $name;
    public $username;
    public $email;
    public $password;
    public $birthday;
    public $gender;
    public $profile_picture;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'username', 'password', 'email', 'name', 'birthday', 'gender'], 'required'],
            [['username', 'email', 'name'], 'trim'],
            ['user_type', 'integer'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 32],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6],
            [['email', 'name', 'gender', 'birthday', 'profile_picture'], 'string', 'max' => 255],
        ];
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
        $user->profile_picture = $this->profile_picture;

        return $user->save() ? $user : null;
    }
}
