<?php

class TutorTest extends CDbTestCase {

    public $fixtures = array(
        'tutors' => 'Tutor',
        'users' => 'User',
    );

    public function testFixture() {

        $tutor = $this->tutors('tutor1');

        $this->assertEquals($tutor->fullName, 'Tutor Number 1');
    }

    public function testRegisterTutor() {

        $user = new User;

        $user->attributes = array(
            'username' => 'email@email.com',
            'password' => '12345',
            'repeat_password' => '12345',
            'verifiedCode' => 1,
        );

        $this->assertTrue($user->save());

        $tutor = new Tutor;

        $tutor->attributes = array(
            'userId' => $user->id,
            'fullName' => 'Tutor Number 2',
            'genderCode' => 1,
            'yearOfBirth' => 1990,
            'raceCode' => 5,
            'nationality' => 'Vietnamese',
            'passport' => 'B765432',
            'email' => 'email@email.com',
            'mobilePhone' => '0123456789',
            'homeTel' => '01234567890',
            'homeAddress' => 'Kismis Avenue',
            'homePostal' => 42309,
        );

        $subject = new TutorSubject;
        $subject->dictSubjectId = 20;

        $this->assertTrue($tutor->save());

        $tutor = Tutor::model()->findByAttributes(array('fullName' => 'Tutor Number 2'));

        $this->assertFalse(is_null($tutor->user));
    }

}
