<?php
namespace backend\models\forms;

use yii\base\Model;
use yii\web\UploadedFile;
//-
use common\models\User;

class UpdateUserForm extends Model
{
    const SCENARIO_UPDATE_PERSONAL_INFO = 'update-personal-info';
    const SCENARIO_CHANGE_AVATAR = 'change-avatar';
    const SCENARIO_CHANGE_PASSWORD = 'change-password';

    /** @var \common\models\User */
    private $user;


    //SCENARIO_CHANGE_PERSONAL_INFO
    /** @var string */
    public $name;
    /** @var string */
    public $username;
    /** @var string */
    public $email;


    //SCENARIO_CHANGE_AVATAR
    /** @var string */
    public $profile_picture;
    /** @var UploadedFile */
    public $avatar;


    //SCENARIO_CHANGE_PASSWORD
    public $old_password;
    public $new_password;


    public function __construct(User $user, array $config = [])
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;

        $this->profile_picture = $user->profile_picture;

        parent::__construct($config);
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Nome',
            'username' => 'Username',
            'email' => 'Email',

            'avatar' => 'Avatar',

            'old_password' => 'Password Atual',
            'new_password' => 'Nova Password',
        ];
    }

    public function rules()
    {
        return [
            //SCENARIO_CHANGE_PERSONAL_INFO
            [['name'], 'required', 'when' => function() { return $this->name <> $this->user->name; }],
            [['name', 'username', 'email'], 'trim'],
            [['name'], 'string', 'max' => 100],

            [['username'], 'required', 'when' => function() { return $this->username <> $this->user->username; }],
            [['username'], 'string', 'min' => 2, 'max' => 32],
            [['username'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['username'],
                'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.',
                'when' => function() {
                    return $this->username <> $this->user->username;
                }
            ],

            [['email'], 'required', 'when' => function() { return $this->email <> $this->user->email; }],
            [['email'], 'email'],
            [['email'],
                'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.',
                'when' => function() {
                    return $this->email <> $this->user->email;
                }
            ],


            //SCENARIO_CHANGE_AVATAR
            [['avatar'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],


            //SCENARIO_CHANGE_PASSWORD
            [['old_password', 'new_password'], 'required'],
            [['old_password', 'new_password'], 'string', 'min' => 6, 'max' => 30],
            [['old_password'], 'validatePassword'],
        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_UPDATE_PERSONAL_INFO => ['name', 'username', 'email'],
            self::SCENARIO_CHANGE_AVATAR => ['avatar'],
            self::SCENARIO_CHANGE_PASSWORD => ['old_password', 'new_password'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if(!$this->user->validatePassword($this->old_password)) {
            $this->addError($attribute, 'Password is incorrect');
        }
    }

    public function updatePersonalInfo()
    {
        if(!$this->validate()) {
            return null;
        }

        if($this->name <> $this->user->name) {
            $this->user->name = $this->name;
        }
        if($this->username <> $this->user->username) {
            $this->user->username = $this->username;
        }
        if($this->email <> $this->user->email) {
            $this->user->email = $this->email;
        }

        return $this->user->save();
    }

    public function upload()
    {
        if ($this->validate())
        {
            $default_avatar = strpos($this->user->profile_picture, 'default-avatar');

            if($default_avatar !== false) {
                //user has default avatar
                $this->avatar->saveAs('uploads/' . $this->user->username . '_avatar_' . \Yii::$app->formatter->asDatetime('now', 'yyyymmddhhmmss'). '.' . $this->avatar->extension);

                return true;
            } else {
                //user doesn't have default avatar
                $directory_exists = file_exists(\Yii::getAlias('@webroot') . '/uploads');
                if($directory_exists) {
                    //directory exists
                    $all_files = scandir(\Yii::getAlias('@webroot') . '/uploads', 1); //scans uploads directory and puts its files in an array
                    $files = array_diff($all_files, array('.', '..')); //removes '.' and '..' from $all_files array

                    //Deletes every image containing the username of the current user on its filename
                    while((list($index, $filename) = each($files))) {
                        if(strpos($filename, $this->user->username) !== false) {
                            //files containing the username of current user
                            if(file_exists(\Yii::getAlias('@webroot') . '/uploads/' . $filename)) {
                                //file exists
                                unlink(\Yii::getAlias('@webroot') . '/uploads/' . $filename); //Deletes file
                            }
                        }
                    }

                    $this->avatar->saveAs('uploads/' . $this->user->username . '_avatar_' . \Yii::$app->formatter->asDatetime('now', 'yyyymmddhhmmss'). '.' . $this->avatar->extension);

                    return true;
                } else {
                    //directory doesn't exist
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function saveAvatarInDb()
    {
        $this->user->profile_picture = 'uploads/' . $this->user->username . '_avatar_' . \Yii::$app->formatter->asDatetime('now', 'yyyymmddhhmmss'). '.' . $this->avatar->extension;

        return $this->user->save();
    }

    public function changePassword()
    {
        if(!$this->validate()){
            return null;
        }

        $this->user->setPassword($this->new_password);

        return $this->user->save();
    }
}