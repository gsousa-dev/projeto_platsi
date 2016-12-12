<?php
namespace api\modules\v1\models;

use yii\db\ActiveRecord;
//-
use common\models\User;
//-

/**
 * @property integer $id
 * @property string $access_token
 * @property string $created_at
 * @property integer $valid
 * @property integer $userId
 *
 * @property User $user
 */

class Session extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_at = date('Y-m-d H:i:s');
                $this->valid = 1;
            }
            return true;
        }
        return false;
    }
}
