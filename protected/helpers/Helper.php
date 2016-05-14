<?php
/**
 * Created by PhpStorm.
 * User: qj
 * Date: 8/10/14
 * Time: 9:45 AM
 */

class Helper {

    public static function getCurrentCenterId()
    {
        if (Yii::app()->user->isCenter && Yii::app()->user->profile && Yii::app()->user->profile->tuitionCenter) {
            $id = Yii::app()->user->profile->tuitionCenter->id;
        } else {
            $id = null;
        }

        return $id;
    }

    public static function getCurrentCenterStaffId()
    {
        if (Yii::app()->user->isCenter && Yii::app()->user->profile) {
            $id = Yii::app()->user->profile->id;
        } else {
            $id = null;
        }

        return $id;
    }
    
    public static function cleanTempFolder() {
        foreach (glob(Yii::getPathOfAlias('webroot') . '/upload/temp/*') as $file) {
            if (!is_dir($file))
                unlink($file);
        }
    }
    
    public static function convertDateForSave($date) {
        $myDateTime = DateTime::createFromFormat('d-m-Y', $date);
        if ($myDateTime) {
            return $myDateTime->format('Y-m-d');
        } 
        return null;
    }
    
    public static function convertDateForDisplay($date) {
        if (strtotime($date)) {
            $myDateTime = DateTime::createFromFormat('Y-m-d', $date);
            if ($myDateTime) {
                return $myDateTime->format('d-m-Y');
            } 
        }
        return null;
    }
    
    private static $weekdays = array(
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday', 
        4 => 'Thursday', 
        5 => 'Friday', 
        6 => 'Saturday', 
        7 => 'Sunday'
    );
    
    public static function getWeekdayArray() {
        return self::$weekdays;
    }
    
    public static function getWeekdayName($id) {
        return self::$weekdays[$id];
    }
    
    /**
     * Render star rating based on the input
     * @param int $rating
     */
    public static function renderRating($rating = 0, $disabled = false, $name = '') {
        $str = '';
        $rating = round($rating);
        for ($i = 0; $i < 10; $i ++) {
            $str .= '<input name="star' . $name . '" type="radio" class="star {split:2}" ' . ($disabled ? 'disabled="disabled" ' : ' ') . ($i+1 == $rating ? 'checked="checked"' : ''). '/>';
        }
        return $str;
    }
} 