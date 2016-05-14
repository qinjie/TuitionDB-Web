<?php

/**
 * Description of MailTest
 *
 * @author Ndnam
 */
class MailTest extends CTestCase {
    
    public function testSendMail() {
        $message = new YiiMailMessage;
        //this points to the file test.php inside the view path
//        $message->view = "test";
        $message->subject = 'My Test Subject';
        $message->setBody('A test message', 'text/html');                
        $message->addTo('namndse02484@fpt.edu.vn');
        $message->from = 'admin@domain.com';   
        Yii::app()->mail->send($message);
    }
    
//    public function testSendVerifyMail() {
//        $user = User::model()->findByPk(16);
//        $user->sendVerificationMail();
//    }
    
}
