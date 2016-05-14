<?php

?>
<style>
    #statistic-numbers {
        margin-left: 5%;
        width: 45%;
        float: left;
    }

    #statistic-numbers .statistic-row {
        margin-bottom: 20px;
    }

    #statistic-numbers .statistic-row p {
        display: block;
    }

    .statistic-number {
        display: block;
        width: 80px;
        font-size: 30px;
        font-weight: bold;
        text-align: right;
        float: left;
        margin-right: 10px;
    }
    
    .fb-like-box{
        
    }
</style>

<div class="inner-container row" id="about-us">
    <div class="title">About <span class="highlight">Us</span></div>
    <div class="pull-left" style="width: 770px; margin-right: 50px;">
        <p>TuitionDB provides quality matching services between students and suitable tutors. With extensive prior
            experiences,
            our passionate staffs are always at your service to assist you in satisfying all your tuition needs as best as
            possible.</p>

        <p>Our database features a wide range of teachers – including undergraduates, full time tutors, PhD level tutors and
            fully certified MOE teachers – all of whom have been selected for their high quality tutoring skills.</p>

        <p>Let us assist you in seeking for your ideal tutor. Feel free to contact us at <a
                href="mailto:admin@tuitiondb.com?Subject=Hello%20TuitionDB" target="_top"><u><b>admin@tuitiondb.com</b></u></a>
            or call us
            at <a href="tel:31505186" target="_top"><u><b>31505186</b></u></a>.</p>
    </div>
    <div class="fb-like-box" data-href="https://www.facebook.com/tuitiondb" data-width="290" data-height="260"
         data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false"
         data-show-border="true"></div>
    <div class="clear"></div>
    <br>
</div>

<div id="statistic-numbers">
    <!--    <br>-->
    <!--    <h3>Register Today!</h3>-->
    <!--    <div class="statistic-row">-->
    <!--        <div class="statistic-number">$20</div>-->
    <!--        <p>admin fee only per assignment for <b><u>tutors</u></b></p>-->
    <!--    </div>-->
    <!--    <div class="statistic-row">-->
    <!--        <div class="statistic-number">$10</div>-->
    <!--        <p>cash reward on every successful assignment for <b><u>parents</u></b></p>-->
    <!--    </div>-->
    <!---->
    <!--    <br>-->
    <!--    <p align="right">(Promotions till <u>31 Aug</u>. Terms and conditions applied.)</p>-->
    <!--        <h3>We currently have</h3>-->
    <!--    <div class="statistic-row">-->
    <!--        <div class="statistic-number">-->
    <?php
    //= Tutor::model()->count()
    ?>
    <!--</div>-->
    <!--        <p>Highly qualified teachers and home tutors</p>-->
    <!--    </div>-->
    <!--    <div class="statistic-row">-->
    <!--        <div class="statistic-number">-->
    <?php
    //= Assignment::model()->count('statusCode = '.Assignment::STATUS_CONFIRMED)
    ?>
    <!--</div>-->
    <!--        <p>Assignments have found suitable tutors</p>-->
    <!--    </div>-->
    <!--    <div class="statistic-row">-->
    <!--        <div class="statistic-number">0</div>-->
    <!--        <p>Tuition Centres offer classes</p>-->
    <!--    </div>-->

</div>