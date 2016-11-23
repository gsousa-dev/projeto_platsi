<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
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
            /* common rules */
            [['username', 'email', 'name'], 'trim'], // trims the white spaces surrounding "username", "email" and "name"
            [['username', 'email', 'password', 'name', 'birthday', 'gender'], 'required'],
            /* end of common rules */

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'string', 'min' => 6],

            ['name', 'string', 'max' => 255],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->name = $this->name;
        $user->birthday = $this->birthday;
        $user->gender = $this->gender;
        $user->profile_picture = $this->profile_picture;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
