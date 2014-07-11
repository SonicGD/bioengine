<?php

namespace bioengine\common\models;

use Yii;

/**
 * This is the model class for table "be_poll_who".
 *
 * @property string $poll_who_id
 * @property string $poll_id
 * @property string $user_id
 * @property string $login
 * @property string $vote_date
 * @property string $voteoption
 * @property string $ip
 * @property string $session_id
 */
class PollWho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%be_poll_who}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id', 'user_id', 'vote_date', 'voteoption'], 'integer'],
            [['session_id'], 'required'],
            [['login', 'ip'], 'string', 'max' => 16],
            [['session_id'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'poll_who_id' => Yii::t('app', 'Poll Who ID'),
            'poll_id' => Yii::t('app', 'Poll ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'login' => Yii::t('app', 'Login'),
            'vote_date' => Yii::t('app', 'Vote Date'),
            'voteoption' => Yii::t('app', 'Voteoption'),
            'ip' => Yii::t('app', 'Ip'),
            'session_id' => Yii::t('app', 'Session ID'),
        ];
    }
}
