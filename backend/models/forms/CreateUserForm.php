<?php
namespace backend\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;
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
    public $profile_picture;
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            ['user_type', 'exist', 'skipOnError' => true, 'targetClass' => UserType::className(), 'targetAttribute' => ['user_type' => 'id']],
            [['user_type', 'username', 'password', 'email', 'name', 'birthday', 'gender'], 'required'],
            [['name', 'username', 'email'], 'trim'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 32],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['email', 'email'],
            ['name', 'string', 'max' => 100],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            ['gender', 'in', 'range' => ['M', 'F']],
            ['imageFile', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if (empty($this->imageFile)) {
            return false;
        } else {
            $this->imageFile->saveAs('uploads/' . $this->username . '_avatar.' . $this->imageFile->extension);
            return true;
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
        if(!empty($this->imageFile)) {
            $user->profile_picture = 'uploads/' . $this->username . '_avatar.' . $this->imageFile->extension;
        }

        return $user->save() ? $user : null;
    }
}