<?php

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;

/**
 * Created by PhpStorm.
 * User: qj
 * Date: 26/12/14
 * Time: 12:46
 */
class FacebookHelper
{
    const LOG_TAG = "FacebookHelper";

    /* Reference:
     * http://www.yiiframework.com/extension/facebook-opengraph/
     * https://github.com/splashlab/yii-facebook-opengraph
     * http://stackoverflow.com/questions/3627684/facebook-graph-api-posting-to-fan-page-as-an-admin
     * https://developers.facebook.com/docs/graph-api/reference/v2.2/post
     * http://stackoverflow.com/questions/8231877/facebook-access-token-for-pages
     * https://www.webniraj.com/2014/05/01/facebook-api-php-sdk-updated-to-v4-0-0/
     * https://www.webniraj.com/2014/08/23/facebook-api-posting-as-a-page-using-graph-api-v2-x-and-php-sdk-4-0-x/
    */

    public static function postNewTutor($id)
    {
        $tutor = Tutor::model()->findByPk($id);
        $imageUrl = Yii::app()->getBaseUrl(true) . $tutor->getPhotoUrl();
        $name = $tutor->fullName;
        $caption = $tutor->getBriefInfo() . ', ' . $tutor->getBackgroundStr();
        $description = is_null($tutor->tutorQualification) ? '' : $tutor->tutorQualification->experienceStyle;
        $url = $tutor->getPublicUrl();
        $_solute = $tutor->genderCode == 1 ? 'Mr.' : 'Ms.';
        $_heshe = $tutor->genderCode == 1 ? 'his' : 'her';
        $message = "#Tutor $_solute $tutor->fullName has joint TuitionDB as a tutor. Check out $_heshe profile.";

        FacebookHelper::createPost($message, $url, $name, $caption, $description, $imageUrl);
    }

    public static function postNewAssignment($id){
        $model = Assignment::model()->findByPk($id);
        $name = $model->title;
        $imageUrl = Yii::app()->getBaseUrl(true) . '/images/new-assignment.png';
//        $imageUrl = Yii::app()->createUrl('/images/new-assignment.png');
        $caption = DictMrtStation::getStationLabel($model->requestor->dictMrtStationId) . ', ' . $model->lessionPerMonthStr . ', ' . $model->hourPerLessionStr;
        $tutorInfo = $model->getPreferredTutorInfo();
        $description = ($tutorInfo=='')?'All tutors are welcomed to apply.':('Preferred Tutor: ' . $tutorInfo);
        $url = Yii::app()->getBaseUrl(true) . $model->getUrl();
        $message = '#TuitionAssignment New assignment is available on TuitionDB. ';

        FacebookHelper::createPost($message, $url, $name, $caption, $description, $imageUrl);
    }

    public static function postNewCenter($id)
    {
        $model = TuitionCenter::model()->findByPk($id);
        $imageUrl = $model->getLogoUrl();
        $name = $model->name;
        $caption = $model->getLocationStr();
        $description = $model->info;
        $url = $model->getPublicUrl();
        $message = "#TuitionCenter New tuition center has joint TuitionDB. Check out what classes it offers.";

        FacebookHelper::createPost($message, $url, $name, $caption, $description, $imageUrl);
    }

    public static function createPost($message, $link, $name, $caption, $description, $imageUrl)
    {
        $params = Yii::app()->params;
        $appId = $params['facebook_app_id'];
        $secret = $params['facebook_secret'];
        $page_id = $params['facebook_page_id'];
//        $app_token = $params['facebook_app_token'];
//        $access_token = $params['facebook_access_token'];
        //-- Get access token from database
        $access_token = ConfigStore::model()->item('Facebook_Access_Token');

        // Initialize FacebookSession
        FacebookSession::setDefaultApplication($appId, $secret);

        // Create new session
        $session = new FacebookSession($access_token);
        // Get long term access token
        $response = (new FacebookRequest($session, 'POST', '/oauth/access_token', array(
            'grant_type' => 'fb_exchange_token',
            'client_id' => $appId,
            'client_secret' => $secret,
            'fb_exchange_token' => $access_token)))->execute()->getGraphObject()->asArray();
        $LongTermAccessToken=$response['access_token'];
        if($LongTermAccessToken != $access_token) {
            ConfigStore::model()->updateItem('Facebook_Access_Token', $LongTermAccessToken);
        }
        $session = new FacebookSession($LongTermAccessToken);

        // Get page access token
        $request = new FacebookRequest($session, 'GET', '/' . $page_id,
            array('fields' => 'access_token'));
        $access_token = $request->execute()->getGraphObject()->asArray();
        // save access token in variable for later use
        $access_token = $access_token['access_token'];

        if ($session && $access_token) {
            try {
                // post to page
                $page_post = (new FacebookRequest($session, 'POST', '/' . $page_id . '/feed', array(
                    'access_token' => $access_token,
                    'name' => $name,
                    'link' => $link,
                    'caption' => $caption,
                    'description' => $description,
                    'message' => $message,
                    'picture' => $imageUrl,
                )))->execute()->getGraphObject()->asArray();

                Yii::log("Posted with id: " . $page_post['id'], 'info', FacebookHelper::LOG_TAG);
            } catch (FacebookRequestException $e) {
                Yii::log("Exception occured, code: " . $e->getCode() . " with message: " . $e->getMessage(), 'error', FacebookHelper::LOG_TAG);
            }
        } else {
            echo "No Session available!";
            Yii::log("No Session available!", 'warning', FacebookHelper::LOG_TAG);
        }

    }
}