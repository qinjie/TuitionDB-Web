<?php

class MiscellanousTest extends CTestCase {
    public function testTutorFilterBySubject() {
        $tutor = Tutor::model()->findByPk(21);
        $this->assertTrue($tutor->filterBySubject(array(166)));
    }
    
    public function testTutorFilterByLocation() {
        $tutor = Tutor::model()->findByPk(21);
        $this->assertTrue($tutor->filterByLocation(array(166)));
        $tutor = Tutor::model()->findByPk(22);
        $this->assertTrue($tutor->filterByLocation(array(166)));
        $tutor = Tutor::model()->findByPk(23);
        $this->assertTrue($tutor->filterByLocation(array(166)));
        $tutor = Tutor::model()->findByPk(24);
        $this->assertTrue($tutor->filterByLocation(array(166)));
        $tutor = Tutor::model()->findByPk(16);
        $this->assertTrue($tutor->filterByLocation(array(166)));
    }
}