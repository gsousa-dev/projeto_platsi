<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * @property integer $id
 * @property string $user_type
 */
class UserType extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type'], 'required'],
            [['user_type'], 'string', 'max' => 45],
            [['user_type'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type' => 'User Type',
        ];
    }
}
