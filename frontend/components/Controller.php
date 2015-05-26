<?php

namespace bioengine\frontend\components;

use bioengine\common\modules\ipb\models\IpbMember;
use bioengine\common\modules\main\models\Settings;
use IPBWI\ipbwi;
use IPBWI\ipbwi_member;
use yii\web\Cookie;

/**
 * Class Controller
 * @package bioengine\frontend\components
 */
class Controller extends \yii\web\Controller
{
    public $breadcrumbs = [];
    public $title = "";
    public $pageTitle = "";
    public $session_id = false;
    public $session = false;
    public $session_member_id = 0;
    public $currentUrl = "";
    public $guest = true;
    public $keywords = "";
    public $description = "";
    public $video = 0;
    public $settings = [];

    public function Init()
    {

        if (\Yii::$app->request->get('module') && \Yii::$app->request->get('module') == 'rss') {
            $this->redirect(\Yii::$app->params["site_url"] . "/rss/", true, 301);
        }
        //if (\Yii::$app->request->get('theme',false) && \Yii::$app->request->get('theme') != '') \Yii::$app-> = $_GET['theme'];
        $this->currentUrl = \Yii::$app->params["site_url"] . $_SERVER["REQUEST_URI"];

        parent::init();

        $requestUri = \Yii::$app->request->url;
        if (!\Yii::$app->request->isAjax && !strpos($requestUri, '.html') && !strpos($requestUri, '?')) {
            if ("/" != $requestUri{strlen($requestUri) - 1}) {
                $this->redirect($requestUri . "/", true, 301);
            }
        }

        /**
         * @var Settings[] $settings
         */
        if ($settings = Settings::find()->all()) {
            foreach ($settings as $setting) {
                $this->settings[$setting->name] = $setting->value;
            }
        }

        $ipbwi = new ipbwi();
        /**
         * @var ipbwi_member $member
         */
        $member = $ipbwi->member;
        if (\Yii::$app->user->isGuest) {

            if ($member->isLoggedIn()) {
                /**
                 * @var IpbMember $user
                 */
                $user = IpbMember::findOne($member->info()['member_id']);
                if ($user) {
                    \Yii::$app->user->login($user, 3600 * 24 * 30);
                }
            }
        } else {
            \Yii::$app->user->identity->getAvatarUrl();
        }


        /**
         * @var Settings[] $settings
         */
        if ($settings = Settings::find()->all()) {
            foreach ($settings as $setting) {
                $this->settings[$setting->name] = $setting->value;
            }
        }

        $this->keywords = $this->settings['keywords'];
        $this->description = $this->settings['description'];

        if (isset($_POST['hash'])) {
            $this->layout = "//layouts/hash";
        }
    }

    public function hasCookie($name)
    {
        return !empty(\Yii::$app->request->cookies[$name]->value);
    }

    public function getCookie($name)
    {
        return $this->hasCookie($name) ? \Yii::$app->request->cookies[$name]->value : false;
    }

    public function setCookie($name, $value)
    {
        $cookie = new Cookie($name, $value);
        \Yii::$app->request->getCookies()->add($cookie);
    }

    public function removeCookie($name)
    {
        \Yii::$app->request->getCookies()->remove($name);
    }

    private function getMember($memberdata)
    {

    }
} 