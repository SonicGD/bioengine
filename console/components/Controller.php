<?php

namespace bioengine\console\components;


class Controller extends \yii\console\Controller
{
    public $settings = [];

    public function Init()
    {
        parent::init();

        /**
         * @var Settings[] $settings
         */
        if ($settings = Settings::find()->all()) {
            foreach ($settings as $setting) {
                $this->settings[$setting->name] = $setting->value;
            }
        }
    }
} 