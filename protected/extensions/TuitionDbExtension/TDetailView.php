<?php
Yii::import('zii.widgets.CDetailView');

class TDetailView extends CDetailView
{
    public $cssFile = false;
    public $itemTemplate="<tr class=\"{class}\"><td class=\"name\">{label}</td><td class=\"colon\">:</td><td class=\"value\">{value}</td></tr>\n";
    
    public function init() {
        parent::init();
        if (isset($this->htmlOptions['class'])) {
            $this->htmlOptions['class'] .= ' info-table';
        } else {
            $this->htmlOptions['class'] = ' info-table';
        }
    }
}