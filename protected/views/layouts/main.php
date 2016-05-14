<?php
/* @var $this Controller */
$webUser = Yii::app()->user;
Yii::app()->bootstrap->register();

if (!isset($pageTitle))
    $pageTitle = Yii::app()->params['siteTitle'];
if (!isset($pageDescription))
    $pageDescription = Yii::app()->params['siteDescription'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="language" content="en"/>
<meta name="description" content="<?php echo $pageDescription; ?>">

<?php
// If canonical URL is specified, include canonical link element
if (isset($pageCanonical)) {
    echo '<link rel="canonical" href="' . $pageCanonical . '">';
}
// If meta robots content is specified, include robots meta tag
if (isset($pageRobots)) {
    echo '<meta name="robots" content="' . $pageRobots . '">';
}
?>

<!--[if lt IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
      media="screen, projection"/>
<![endif]-->

<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900,100italic,300italic,400italic,500italic,700italic,900italic' type='text/css'>
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/main.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/form.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/style.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/select2.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.rating.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.fancybox.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/jquery.fancybox-thumbs.css');
?>
<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/TuitionDB.ico" type="image/x-icon" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<script>
    // for facebook
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '311527579048444',
            xfbml      : true,
            version    : 'v2.2'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div id="header">
    <div class="contact-stripe">
        <div class="inner-container">
            <ul class="static-menu">
                <li>Get in touch: <?=CHtml::link('31505186','tel:31505186')?></li>
                <li><?=CHtml::link('About us',array('site/aboutUs'))?></li>
                <li><?=CHtml::link('FAQ',array('question/index'))?></li>
                <li><?=CHtml::link('Contact', array('site/contact'))?></li>
            </ul>
        </div>
    </div>
    <div class="nav-top">
        <div id="logo-wrapper">
            <?= CHtml::link(CHtml::image(Yii::app()->createUrl('images/logo.png'),'Logo'),array('/site/index'))?>
        </div>
        <?php
        $this->widget('zii.widgets.CMenu', array(
            'items' => array(
                array('label' => 'Home', 'url' => array('/site/index')),
                array('label' => 'Tutors', 'url' => array('/tutor/list'),
                    'visible' => $webUser->isGuest),
                array('label' => 'Assignments', 'url' => array('/assignment/list'),
                    'visible' => $webUser->isGuest),
                array('label' => 'Tuition Centres', 'url' => array('/tuitionCenter/list'),
                    'visible' => $webUser->isGuest),
                array('label' => 'Register', 'url' => array('/user/register/'),
                    'active' => in_array(Yii::app()->controller->action->id, array('register', 'registerAsTutor', 'registerAsRequestor', 'registerAccount')),
                    'visible' => $webUser->isGuest),
                // for parents/students
                array('label' => 'Tutors', 'url' => array('/tutor/list'),
                    'visible' => ($webUser->isRequestor)),
//                array('label' => 'Create Assignment', 'url' => array('/assignment/create'),
//                    'visible' => $webUser->isRequestor),
                array('label' => 'My Assignments', 'url' => array('/requestor/myassignment'),
                    'visible' => $webUser->isRequestor, 'items' => array(
                        array('label' => 'My Assignments', 'url' => array('/requestor/myassignment')),
                        array('label' => 'Create Assignment', 'url' => array('/assignment/create'), 'visible' => $webUser->isVerified),
                    ), 'submenuOptions' => array('style'=>'width: 100%')),
                array('label' => 'My Tutors', 'url' => array('/requestor/favoriteTutors'),
                    'visible' => $webUser->isRequestor),
                array('label' => 'Profile', 'url' => array('/requestor/profile'),
                    'visible' => $webUser->isRequestor, 'items' => array(
                         array('label' => 'My Profile', 'url' => array('/requestor/profile')),
                         array('label' => 'Update Profile', 'url' => array('/requestor/updateProfile')),
                         array('label' => 'Change Password', 'url' => array('/user/passwordChange')),
                    )),
                // for tutors
                array('label' => 'Assignments', 'url' => array('/assignment/list'),
                    'visible' => $webUser->isTutor),
//                array('label' => 'Recommended Assignments', 'url' => array('/tutor/recommendedAssignment'),
//                    'visible' => $webUser->isTutor),
                array('label' => 'My Assignments', 'url' => array('/tutor/myassignment'),
                    'visible' => $webUser->isTutor, 'items' => array(
                        array('label' => 'My Assignments', 'url' => array('/tutor/myassignment')),
                        array('label' => 'Recommended Assignments', 'url' => array('/tutor/recommendedAssignment')),
                    ), 'submenuOptions' => array('style'=>'width: 240px')),
                array('label' => 'Profile', 'url' => array('/tutor/profile'),
                    'visible' => $webUser->isTutor, 'items' => array(
                        array('label' => 'My Profile', 'url' => array('/tutor/profile')),
                        array('label' => 'My Public Profile', 'url' => isset($webUser->user->tutor) ? $webUser->user->tutor->publicUrl : ''),
                        array('label' => 'Update Personal Infomation', 'url' => array('/tutor/updatePersonal')),
                        array('label' => 'Update Education Infomation', 'url' => array('/tutor/updateEducation')),
                        array('label' => 'Update Qualification/Experience', 'url' => array('/tutor/updateQualification')),
                        array('label' => 'Update Tutoring Infomation', 'url' => array('/tutor/updateTutoring')),
                        array('label' => 'Change Password', 'url' => array('/user/passwordChange')),
                    ), 'submenuOptions' => array('style'=>'width: 250px')),
                // for centers
                array('label' => 'My Centre', 'url' => array('/tuitionCenter/profile'),
                    'items' => array(
                        array('label' => 'Public Profile', 'url' => array('/tuitionCenter/profile')),
                        array('label' => 'View Centre Info', 'url' => array('/tuitionCenter/view')),
                        array('label' => 'Update Centre Info', 'url' => array('/tuitionCenter/update')),
                        array('label' => 'Manage Staffs', 'url' => array("/tuitionCenterStaff/myStaffs")),
                        array('label' => 'Invite Staff', 'url' => array("tuitionCenterStaff/invite")),
                        array('label' => 'Centre Logo', 'url' => array("tuitionCenter/uploadLogo")),
                        array('label' => 'Centre Photos', 'url' => array("tuitionCenter/managePhotos")),
                    ), 'visible' => ($webUser->isCenter && $webUser->isVerified)),
                array('label' => 'My Branches','url' => array('/tuitionBranch'),
                    'visible' => $webUser->isCenter  && $webUser->isVerified,
//                    'items' => array(
//                        array('label' => 'Create Branch', 'url' => array('tuitionCenter/create')),
//                    )
                    ),
                array('label' => 'My Profile', 'url' => array('/tuitionCenterStaff/view'),
                    'items' => array(
                        array('label' => 'View Personal Info', 'url' => array('/tuitionCenterStaff/view')),
                        array('label' => 'Update Personal Info', 'url' => array('/tuitionCenterStaff/update')),
                    ),
                    'active' => Yii::app()->controller->id == 'tuitionCenterStaff' && in_array(Yii::app()->controller->action->id, array('view', 'update')),
                    'visible' => $webUser->isCenter),
                // for administrator
                array('label' => 'Browse',
                    'items' => array(
                        array('label' => 'Browse Tutors', 'url' => array('/tutor/list')),
                        array('label' => 'Browse Assignments', 'url' => array('/assignment/list')),
                    ), 'visible' => ($webUser->isAdmin)),
                array('label' => 'Administration',
                    'items' => array(
//                                    array('label' => 'Manage Tutors', 'url' => array('/tutor/admin')),
//                                    array('label' => 'Create Tutor', 'url' => array('/tutor/create')),
//                                    TbHtml::menuDivider(),
//                                    array('label' => 'Manage Parents/Students', 'url' => array('/requestor/admin')),
//                                    array('label' => 'Create Parent/Student', 'url' => array('/requestor/create')),
                        array('label' => 'Manage Assignments', 'url' => array('/assignment/admin')),
//                                    array('label' => 'Create Assignment', 'url' => array('/assignment/create')),
                        array('label' => 'Manage FAQ', 'url' => array("/question/admin")),
                        array('label' => 'Create FAQ', 'url' => array("/question/create")),
                    ), 'visible' => ($webUser->isAdmin)),
//                            array('label' => 'Settings',
//                                'items' => array(
//                                    array('label' => 'Lookup', 'url' => array('/lookup/admin')),
//                                ), 'visible' => $webUser->isAdmin),
                array('label' => 'Logout', 'url' => array('/site/logout'),
                    'visible' => !$webUser->isGuest,),
                array('label' => 'LOGIN', 'url' => array('/site/login'),
                    'visible' => $webUser->isGuest,
                    'itemOptions' => array('id'=>'btn-login'),),
            ),
            'htmlOptions'=>array(
                'class' => 'main-nav',
            ),
        ));
        ?>
    </div>
</div>

<div id="page">
    <?php if (!empty($this->breadcrumbs)): ?>
        <div class="breadcrumb-wrapper">
        <?php
        $this->widget('bootstrap.widgets.TbBreadcrumb', array(
            'links' => $this->breadcrumbs,
            'homeLabel' => 'Home',
            'divider' => '',
        ));
        ?>
        </div>
    <?php endif ?>
    <?php
//    $this->widget('bootstrap.widgets.TbAlert', array(
//        'block' => true,
//        'fade' => true,
//        'closeText' => '&times;',
//    ));
    ?>

    <?php echo $content; ?>

    <div class="clear"></div>


</div>
<!-- page -->

<div id="footer">
    <div class="home-page-block" style="background: #3ab3be">
        <div class="inner-container">
            <div class="footer-column" style="width: 382px;">
                <div class="column-title">About Us</div>
                <div class="column-content">
                    TuitionDB provides quality matching services between students and suitable tutors. With extensive prior experiences,
                    our passionate staffs are always at your service to assist you in satisfying all your tuition needs as best as possible. <u><?=  CHtml::link('Read more...',array('site/aboutUs'),array('style'=>'font-style: italic;'))?></u>
                </div>
            </div>
            <div class="footer-column" style="width: 160px;">
                <div class="column-title">Quick Links</div>
                <div class="column-content">
                    <ul class="footer-list">
                        <li><?=CHtml::link('Home',array('/'))?></li>
                        <li><?=CHtml::link('Browse Tutors',array('tutor/list'))?></li>
                        <li><?=CHtml::link('Browse Assignments',array('assignment/list'))?></li>
                        <li><?=CHtml::link('Browse Tuition Centres',array('tuitionCenter/list'))?></li>
                        <li><?=CHtml::link('FAQ',array('question/index'))?></li>
                    </ul>
                </div>
            </div>
            <div class="footer-column" style="width: 200px;">
                <div class="column-title">Get In Touch</div>
                <div class="column-content">
                    <ul class="footer-list">
                        <li id="admin-mail"><div class="icon"></div><?=CHtml::link('admin@tuitiondb.com','mailto:admin@tuitiondb.com')?></li>
                        <li id="tutiondb-tel"><div class="icon"></div><?=CHtml::link('31505186','tel:31505186')?></li>
                    </ul>
                </div>
            </div>
            <div class="footer-column" style="width: 150px; margin: 0;">
                <div class="column-title">Connect Socially</div>
                <div class="column-content social">
                    <a class="social-item" id="social-twitter" href="https://twitter.com/tuitiondb"></a>
                    <a class="social-item" id="social-facebook" href="https://www.facebook.com/tuitiondb?ref=profile"></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="bottom-stripe" style="height: 18px; text-align: center; background: #00676c; color: #FFF; font-size: 16px; padding: 12px;">
        2014 © TuitionDB - tuitiondb.com
    </div>
</div>
<!-- footer -->

</body>
</html>
<?php
//Yii::app()->clientScript->registerScriptFile('http://code.jquery.com/jquery-latest.min.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/library.js',CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/easing.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/script.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/input.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/select2.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.MetaData.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.rating.pack.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.fancybox.pack.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/jquery.fancybox-thumbs.js',CClientScript::POS_END);
?>
