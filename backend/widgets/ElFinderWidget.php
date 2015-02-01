<?php

namespace bioengine\backend\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\InputWidget;

/**
 * Class ElFinder
 * @package elfinder
 */
class ElFinderWidget extends InputWidget
{
    public $connectorUrl = 'files/list';
    public $lang = 'ru';
    public $width = 840;
    public $options = [
        'class' => 'form-control'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $view = $this->getView();
        $input = $this->getInput('textInput');
        $id = 'jQuery("#' . $this->options['id'] . '")';
        $browseId = $this->options['id'] . '-browse';
        $connectorUrl = Url::toRoute($this->connectorUrl);
        $csrfParam = \Yii::$app->request->csrfParam;
        $csrfToken = \Yii::$app->request->csrfToken;
        $html = <<<EOF
        <div class='row'>
        <div class='col-lg-11'>
        {$input}
        </div>
        <div class='col-lg-1'>
        <span style='font-size: 1.8em;cursor:pointer' id="{$browseId}"><i class="fa fa-folder-open"></i></span>
        </div>
        </div>
EOF;
        $scirpt = <<<EOF
        jQuery('#{$browseId}').click(function(){
        $('<div/>').dialogelfinder({
            url: '{$connectorUrl}',
            customData: {
            {$csrfParam}: '{$csrfToken}'
            },
            lang: '{$this->lang}',
            width: {$this->width},
            destroyOnClose: true,
            getFileCallback: function (files, fm) {
            console.log(files);
                {$id}.val(files.url);
            },
            commandsOptions: {
                getfile: {
                    oncomplete: 'close',
                    folders: true
                }
            }
        }).dialogelfinder('instance');
        });
EOF;
        $view->registerJs($scirpt);
        echo $html;
    }

    /**
     * @param      $type
     * @param bool $list
     * @return mixed
     */
    protected function getInput($type, $list = false)
    {
        if ($this->hasModel()) {
            $input = 'active' . ucfirst($type);

            return $list ?
                Html::$input($this->model, $this->attribute, $this->data, $this->options) :
                Html::$input($this->model, $this->attribute, $this->options);
        }
        $input = $type;
        $checked = false;
        if ($type === 'radio' || $type === 'checkbox') {
            $this->options['value'] = $this->value;
            $checked = ArrayHelper::remove($this->options, 'checked', '');
            if (empty($checked) && !empty($this->value)) {
                $checked = ($this->value === 0);
            } elseif (empty($checked)) {
                $checked = false;
            }
        }

        return $list ?
            Html::$input($this->name, $this->value, $this->data, $this->options) :
            (($type === 'checkbox' || $type === 'radio') ?
                Html::$input($this->name, $checked, $this->options) :
                Html::$input($this->name, $this->value, $this->options));
    }
}