<?php

/**
 * BlockController is a customized base controller class.
 * All controller classes with unique url  should extend from this base class.
 */
class BlockController extends Controller
{
    public function beforeAction($action)
    {
        $normalizedUrl = CHtml::normalizeUrl(array_merge(array("/" . $this->route), $_GET));
        if (Yii::app()->request->url != $normalizedUrl
            && strpos($normalizedUrl, Yii::app()->errorHandler->errorAction) === false
        ) {
            $this->redirect($normalizedUrl, true, 301);
        }

        return parent::beforeAction($action);
    }
}