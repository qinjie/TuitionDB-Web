<?php
class MatchingTest extends CTestCase {
    
    public function testMatchingLogic() {
        $tutor = Tutor::model()->findByPk(21);
        $assignment = Assignment::model()->findByPk(4);
        $this->assertTrue(in_array($tutor, $assignment->findMatched()));
    }
    
}
