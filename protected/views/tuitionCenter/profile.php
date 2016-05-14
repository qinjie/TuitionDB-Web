<?php
/* @var $this TuitionCenterController */
/* @var $model TuitionCenter */
$this->breadcrumbs = array(
    'Tuition Centres' => array('list'),
    CHtml::encode($model->idStr),
);
?>
<style>
    .address-list {
        list-style: none;
        margin-left: 22px;
    }
    .contact-info #contact-address.contact-item .address-list .icon {
        background-position: -100px 1px;
        cursor: pointer;
    }
    #map-canvas img {
        max-width: none; 
    }
    p.info {
        font-size: 10px;
    }
</style>

<div class="center-caption">
    <?php if (isset($model->logo)):?>
        <div class="center-logo thumbnail-frame" style="position: absolute">
            <?=CHtml::image($model->logoUrl,$model->name)?>
        </div>
    <?php endif;?>
    <div class="center-name"><?=$model->name?></div>
    <div class="clear"></div>
</div>

<div class="center-profile-block" style="background-color: #fafafa;">
    <div class="title">
        Learn <span class="highlight">About Us</span>
    </div>
    <p><?=  nl2br($model->info)?></p>
</div>

<div class="center-profile-block" style="background-color: #dbf5f6;">
    <div class="title">
        Our <span class="highlight">Photos</span>
    </div>
    <div class="thumbnail-list">
        <?php 
        $photos = $model->photos;
        if (count($photos) > 0)
            for ($i = 0; $i < min(5, count($photos)); $i++) {
                $photo = each($photos)[1];
        ?>
        <div class="thumbnail-item thumbnail-frame">
            <a class="fancybox" title="<?=$photo->caption?>" rel="group" data-fancybox-group="gallery" href="<?=$photo->url?>">
                <img src="<?=$photo->url?>">
            </a>
        </div>
        <?php }?>
        <div class="clear"></div>
    </div>
    <a href="<?=Yii::app()->createUrl('tuitionCenter/gallery',array('id'=>$model->id))?>" class="btn-view-more">View More</a>
</div>

<div class="center-profile-block" style="background-color: #fafafa;">
    <div class="title">
        Our <span class="highlight">Classes</span>
    </div>
    <div class="gridview-wraper">
        <div class="gridview-title">
            <div class="icon"></div>
            Classes
        </div>
        <div class="clear"></div>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'tuition-class-grid',
            'dataProvider' => $classesProvider,
            'columns' => array(
                'name',
                array(
                    'name' => 'dictClassLevelId',
                    'value' => 'DictClassLevel::getLabel($data->dictClassLevelId)',
                    'htmlOptions' => array(
                    )
                ),
                array(
                    'name' => 'dictSubjectId',
                    'value' => 'DictSubject::getSubjectLabel($data->dictSubjectId)',
                    'htmlOptions' => array(
                    )
                ),
                array(
                    'name' => 'weekday',
                    'value' => 'Helper::getWeekdayName($data->weekday)',
                ),
//                 'weekday',
                array(
                    'header' => 'Time',
                    'value' => '$data->timeStr',
                ),
//                 'startTime',
//                 'endTime',
                'startDate',
//                 'endDate',

//                 'lessonCount',
                array(
                    'header' => 'Lessons',
                    'name' => 'lessonCount',
                ),
//                 'classSize',
                array(
                    'name' => 'status',
                    'value' => 'Lookup::item(Lookup::TYPE_CLASS_STATUS, $data->status)',
                ),
                array(
                    'class' => 'CLinkColumn',
                    'label' => 'View',
                    'urlExpression' => '$data->url',
                ),
            ),
            'summaryText' => false,
            'htmlOptions' => array(
                'style' => ''
            )
        ));
        ?>
    </div>
</div>

<div class="center-profile-block" style="background-color: #eeeeee;">
    <div class="column2" style="margin-right: 30px; width: 540px;">
        <div class="title">
            View our <span class="highlight">Locations</span>
        </div>
        <div id="map-canvas" style="width:540px; height: 270px;"></div>
        <a href="javascript:resetMap()" class="underline">Reset Map</a>
    </div>
    <div class="column2" style="width: 530px;">
        <div class="title">
            <span class="highlight">Contact</span> Us
        </div>
        <div class="contact-info">
            <div class="contact-column">
                <div class="contact-item" id="contact-phone"><span class="icon"></span><?=$model->phone?></div>
                <div class="contact-item" id="contact-fax"><span class="icon"></span><?=$model->fax?></div>
                <div class="contact-item" id="contact-email"><span class="icon"></span><?=$model->email?></div>
                <div class="contact-item" id="contact-website">
                    <span class="icon"></span>
                    <?php
                    $url = empty($model->website) ? $model->publicUrl : $model->website;
                    echo CHtml::link(ModelHelper::trimStr($url, 24), $url);
                    ?>
                </div>
            </div>
            <div class="contact-column">
                <div class="contact-item" id="contact-address">
                    <span class="icon"></span>
                    <span>Our address:</span>
                    <ul class="address-list">
                    <?php foreach ($model->branches as $branch) {
                            if (isset($branch->address) && (preg_replace('/\s+/', '', $branch->address) != '')) {
                                echo '<li><span class="icon" onclick="centerToBranch(' . $branch->id . ')" data-placement="left" data-original-title="View on map" data-toggle="tooltip"></span>' . $branch->address . '</li>';
                            }
                    }?>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="social-medias" style="display: none;">
            <div style="font-size: 20px; color: #474747; float: left; margin: 13px 0 0;">Follow us on</div>
            <a href="" class="social-item" id="social-facebook"></a>
            <a href="" class="social-item" id="social-gplus"></a>
            <a href="" class="social-item" id="social-twitter"></a>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js">
</script>
<script type="text/javascript">
    var map, geocoder, bounds, coords = [];
    function initialize() {
        var mapOptions = {
            center: { lat: 1.2932539, lng: 103.8510741},
            zoom: 12
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
        
        // Mark the branches on the map
        geocoder = new google.maps.Geocoder();
        var count = 0;
        bounds = new google.maps.LatLngBounds();
        <?php for ($i=0; $i < count($model->branches); $i++) {
            if (isset($model->branches[$i]->address) && (preg_replace('/\s+/', '', $model->branches[$i]->address) != '')) {?>
            geocoder.geocode( { 'address': '<?=$model->branches[$i]->address?>, Singapore'}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var location = results[0].geometry.location;
                var marker = new google.maps.Marker({
                    map: map,
                    position: location,
                    title: '<?=$model->branches[$i]->name.' - '.$model->branches[$i]->address?>',
                });
                var infowindow = new google.maps.InfoWindow({
                    content: '<p class="info"><?=$model->branches[$i]->name.' - '.$model->branches[$i]->address?></p>',
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                });

                coords[<?=$model->branches[$i]->id?>] = location;
                bounds.extend(location);
                count++;
                if (count >= <?=count($model->branches)?>) {
                    resetMap();
                }
            } else {
              console.log("Geocode was not successful for the following reason: " + status);
            }
          });
        <?php }
        }?>
    }
    
    function centerToBranch(branchId) {
        map.setCenter(coords[branchId]);
        if (map.getZoom() < 14)
            map.setZoom(14);
    }
    
    function resetMap() {
        map.fitBounds(bounds);
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
    
    $(function(){
        $('span.icon').tooltip();
    });
</script>

