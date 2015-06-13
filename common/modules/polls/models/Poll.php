<?php

namespace bioengine\common\modules\polls\models;

use bioengine\common\components\BioActiveRecord;
use bioengine\common\helpers\UrlHelper;
use bioengine\common\helpers\UserHelper;
use bioengine\common\modules\ipb\models\IpbMember;
use Yii;

/**
 * This is the model class for table "poll".
 *
 * @property string  $poll_id
 * @property string  $question
 * @property integer $startdate
 * @property string  $options
 * @property string  $votes
 * @property integer $num_choices
 * @property integer $multiple
 * @property integer $onoff
 */
class Poll extends BioActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%poll}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num_choices'], 'default', 'value' => 1],
            [['startdate', 'num_choices', 'multiple', 'onoff'], 'integer'],
            [['options', 'votes', 'optionsEdit'], 'string'],
            [['question'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'poll_id'     => Yii::t('app', 'Poll'),
            'question'    => Yii::t('app', 'Question'),
            'startdate'   => Yii::t('app', 'Start date'),
            'options'     => Yii::t('app', 'Options'),
            'optionsEdit' => Yii::t('app', 'Options'),
            'votes'       => Yii::t('app', 'Votes'),
            'num_choices' => Yii::t('app', 'Num Choices'),
            'multiple'    => Yii::t('app', 'Multiple'),
            'onoff'       => Yii::t('app', 'Onoff'),
        ];
    }

    public function getOptionsEdit()
    {
        $opts = json_decode($this->options, true);
        $items = [];
        if ($opts) {
            foreach ($opts as $opt) {
                $items[] = $opt['text'];
            }
        }

        return implode(PHP_EOL, $items);
    }

    public function setOptionsEdit($text)
    {
        $options = [];
        $opts = explode('\r\n', $text);
        $i = 0;
        if ($opts) {
            foreach ($opts as $opt) {
                $options[] = [
                    'id'   => $i,
                    'text' => $opt
                ];
                $i++;
            }
        }
        $this->options = json_encode($options);
    }

    public static function getCurrent()
    {
        /***
         * @var self $poll
         */
        $poll = self::find()->where(['onoff' => 1])->orderBy(['poll_id' => SORT_DESC])->one();
        if ($poll) {
            $poll->isVoted();
        }

        return $poll;
    }

    public $voted = false;

    /**
     * @return bool
     */
    public function isVoted()
    {
        $query = PollWho::find();
        $user = UserHelper::getUser();
        if ($user instanceof IpbMember) {
            $query->where(['poll_id' => $this->poll_id, 'user_id' => $user->member_id]);
        } else {
            $query->where([
                'poll_id'    => $this->poll_id,
                'user_id'    => 0,
                'ip'         => $_SERVER['REMOTE_ADDR'],
                'session_id' => UserHelper::getSessionId()
            ]);
        }
        if ($query->count() > 0) {
            $this->voted = true;
        }

        return $this->voted;
    }

    public function getOptionsArr()
    {
        return json_decode($this->options);
    }

    public function getResults()
    {
        $options = json_decode($this->options);
        $votes = $this->getVotesArr();
        $all = 0;
        foreach ($votes as $vote) {
            $all += $vote;
        }
        $results = [];
        foreach ($options as $k => $option) {
            $optVotes = $votes['opt_' . $option->id];
            $arr = [
                'id'     => $option->id,
                'text'   => $option->text,
                'result' => $all > 0 ? round($optVotes / $all, 4) : 0
            ];
            $results[] = $arr;
        }
        return $results;
    }

    public function getVotesArr()
    {
        return json_decode($this->votes, true);
    }

    public function getVoteUrl($absolute = false)
    {
        return UrlHelper::createUrl(
            '/polls/vote',
            [
                'pollId' => $this->poll_id
            ], $absolute, true);
    }

    public function recount()
    {
        $votes = [];
        $query = PollWho::find();
        foreach ($this->getOptionsArr() as $k => $v) {
            $query->where(['poll_id' => $this->poll_id, 'voteoption' => $k]);
            $count = $query->count();
            $votes['opt_' . $k] = $count;
        }

        $this->votes = json_encode($votes);
        $this->save();
    }
}
