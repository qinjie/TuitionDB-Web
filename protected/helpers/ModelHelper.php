<?php

/**
 * Description of ModelHelper
 *
 * @author Ndnam
 */
class ModelHelper {

    /**
     * Run matching logic to determine if the given tutor and assignment match
     * @param Tutor $tutor
     * @param Assignment $assignment
     * return boolean
     */
    public static function match($tutor, $assignment) {
        if (!$assignment->isOpen) 
            return false;
        
        if (!$tutor->isProfileComplete()) 
            return false;
        
        if ($tutor->appliedTo($assignment->id))
            return false;
        
        if (!is_null($assignment->tutorGenderCode) && $tutor->genderCode != $assignment->tutorGenderCode) 
            return false;
        
        if (!is_null($assignment->tutorRaceCode) && $tutor->raceCode != $assignment->tutorRaceCode)
            return false;
        
        $tutorQualification = $tutor->tutorQualification;
        if (!is_null($tutorQualification->dictTutorCredentialId) && $assignment->teachingCredential > 0 && $tutorQualification->dictTutorCredentialId == 0) 
            return false;
        
        if (!is_null($tutorQualification->dictTutorQualificationId) && $assignment->minQualificationId > $tutorQualification->dictTutorQualificationId)
            return false;
        
        if (count(array_diff($assignment->subjects, $tutor->subjects)) > 0)
            return false;
        
        if (count(array_diff($assignment->schedules,$tutor->schedules)) > 0) 
            return false;
        
        if (!in_array($assignment->requestor->dictMrtStation, $tutor->locations))
            return false;
        
        return true;
    }
    
    public static function getRandomPassword() {
        $length = 5;
        $chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));
        return $password;
    }
    
    /* Trim a string if it is too long and add ... at the end */
    public static function trimStr($str, $maxLength) {
        if (is_string($str) && strlen($str) > $maxLength) {
            $str = substr($str, 0, $maxLength) . '...';
        }
        return $str;
    }

}
