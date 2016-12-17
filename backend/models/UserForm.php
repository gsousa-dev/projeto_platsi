<?php
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
//-
use common\models\User;
//-

/* @property string $auth_key */

class UserForm extends Model
{
    public $user_type;
    public $username;
    public $password;
    public $email;
    public $name;
    public $birthday;
    public $gender;
    public $profile_picture;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_type', 'integer'],
            [['username', 'email', 'name'], 'trim'],
            [['user_type', 'username', 'password', 'email', 'name', 'birthday', 'gender'], 'required'],
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
        $user->username = $this->username;
        $user->generateAuthKey();
        $user->setPassword($this->password);
        $user->email = $this->email;
        $user->name = $this->name;
        $user->birthday = $this->birthday;
        $user->gender = $this->gender;
        $user->profile_picture = $this->profile_picture;

        return $user->save(false) ? $user : null; //TODO: FIX SAVE
    }
}
