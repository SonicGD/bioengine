<?php

namespace bioengine\frontend\components;

use bioengine\common\modules\ipb\models\IpbMember;
use bioengine\common\modules\main\models\Settings;
use yii\web\Cookie;

/**
 * Class Controller
 * @package bioengine\frontend\components
 */
class Controller extends \yii\web\Controller
{
    public $breadcrumbs = [];
    public $title = '';
    public $siteTitle = '';
    public $description = '';
    public $image = '';
    public $pageTitle = '';
    public $session_id = false;
    public $session = false;
    public $session_member_id = 0;
    public $currentUrl = '';
    public $guest = true;
    public $keywords = '';
    public $video = 0;
    public $settings = [];
    public $themeName = 'default';

    public function Init()
    {

        \Yii::trace('Start init');
        if (\Yii::$app->request->get('module') && \Yii::$app->request->get('module') === 'rss') {
            $this->redirect(\Yii::$app->params['site_url'] . '/rss/', 301);
        }
        //if (\Yii::$app->request->get('theme',false) && \Yii::$app->request->get('theme') != '') \Yii::$app-> = $_GET['theme'];
        $this->currentUrl = \Yii::$app->params['site_url'] . $_SERVER['REQUEST_URI'];
        \Yii::trace('Parent init');
        parent::init();
        \Yii::trace('Load settings');
        /**
         * @var Settings[] $settings
         */
        if ($settings = Settings::find()->all()) {
            foreach ($settings as $setting) {
                $this->settings[$setting->name] = $setting->value;
            }
        }

        if (\Yii::$app->user->isGuest) {
            \Yii::trace('User is guest');
            //get userId
            $currentMember = $this->doIpsRequest('api/user.php');
            if ($currentMember['member_id'] > 0) {
                \Yii::trace('Member logged in');
                /**
                 * @var IpbMember $user
                 */
                \Yii::trace('Find User');
                $user = IpbMember::findOne($currentMember['member_id']);
                if ($user) {
                    \Yii::trace('Login...');
                    $user->avatarUrl = $currentMember['avatarUrl'];
                    \Yii::$app->user->login($user, 3600 * 24 * 30);
                }
            }
        }

        \Yii::trace('Set keywords and description');
        $this->siteTitle = $this->settings['siteTitle'];
        $this->image = $this->settings['mainSiteImage'];
        $this->keywords = $this->settings['keywords'];
        $this->description = $this->settings['description'];

        \Yii::trace('Init complete');
    }

    private function doIpsRequest($path)
    {
        $communityUrl = \Yii::$app->params['ipb_url'];
        $cookie_string = http_build_query($_COOKIE, null, ';');
//Open connection

        $curl = curl_init($communityUrl . $path);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true
        ]);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Cookie: " . $cookie_string]);

        $response = curl_exec($curl);

        return json_decode($response, true);
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

    public function getEncodedTitle()
    {
        return htmlspecialchars_decode($this->pageTitle);
    }
} 