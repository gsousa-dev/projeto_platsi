<?php
namespace backend\models\forms;

use yii\base\Model;
//-
use common\models\User;

class UpdateUserForm extends Model
{
    public $id;
    public $name;
    public $username;
    //public $current_password;
    public $new_password;
    public $email;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'username', 'email'], 'required'],
            [['name', 'username', 'email'], 'trim'],
            ['name', 'string', 'max' => 100],

            //['username', 'unique', 'targetClass' => '\common\models\User', 'on'=>'insert', 'message' => 'This username has already been taken.'],
            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],

            //['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            [['new_password'], 'string', 'min' => 6],
            ['email', 'email'],

            [['username'], 'checkUniqueUsername', 'on' => 'insert'],
            [['email'], 'checkUniqueEmail'],
            ['username', 'string', 'min' => 2, 'max' => 32],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
        ];
    }

    public function checkUniqueUsername($attribute, $params)
    {
        $user = $this->getUser();
        if($user && $user->username != $this->username) {
            $this->addError($attribute, 'This username has already been taken.');
        }
    }

    public function checkUniqueEmail($attribute, $params)
    {
        $user = User::findOne(['email' => $this->email]);
        if($user) {
            $this->addError($attribute, 'This email address has already been taken.');
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    public function save() {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne($this->id);
        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->new_password);

        return $user->save();
    }
}