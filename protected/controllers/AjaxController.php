<?php
/**
 * Get dictionary data for javascript to use
 * @author Ndnam
 */
class AjaxController extends CController {
    
    protected function beforeAction($action) {
        header('Content-type: application/json');
        return parent::beforeAction($action);
    }
    
    public function actionSubjectTree() {
//        $data = Yii::app()->cache->get('subjectTree');
//        if ($data === false) {
//            $data = CJSON::encode(DictSubject::getSubjectTree());
//            Yii::app()->cache->set('subjectTree',$data);
//        }
//        echo $data;
        echo CJSON::encode(DictSubject::getSubjectTree());
    }
    
    public function actionStationTree() {
        echo CJSON::encode(DictMrtStation::getStationTree());
    }
    
    public function actionScheduleTree() {
        echo CJSON::encode(DictSchedule::getScheduleTree());
    }
    
    public function actionScheduleTreeNew() {
        echo CJSON::encode(DictSchedule::getScheduleTreeNew());
    }
    
    public function actionSchoolList() {
        echo CJSON::encode(DictSchool::getSchools());
    }
}
