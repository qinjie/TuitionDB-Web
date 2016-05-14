<?php

class ActiveRecord extends CActiveRecord
{

    public function beforeSave()
    {
        if ($this->hasAttribute('modified')) {
            if ($this->isNewRecord)
                $this->modified = NULL;
            else
                $this->modified =  new CDbExpression('NOW()');
        }

        if ($this->isNewRecord && $this->hasAttribute('created'))
            $this->created =  new CDbExpression('NOW()');
        return parent::beforeSave();
    }

    public function getUrl()
    {
        $controller = get_class($this);
//        $controller[0] = strtolower($controller[0]);

        $params = array("id" => $this->id);
        // add the title parameter to the URL
        if ($this->hasAttribute('title'))
            $params['title'] = $this->title;
        if ($this->hasAttribute('name'))
            $params['name'] = $this->name;
        return Yii::app()->urlManager->createUrl($controller . '/view', $params);
    }

    public function listUrl()
    {
        $controller = get_class($this);
//        $controller[0] = strtolower($controller[0]);

        return Yii::app()->urlManager->createUrl($controller . '/list');
    }

}
