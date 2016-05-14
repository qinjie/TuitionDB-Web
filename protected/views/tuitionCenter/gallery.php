<?php 
$items = array();
foreach ($photos as $photo) {
    array_push($items, array(
        'url' => $photo->url,
        'src' => $photo->url,
        'options' => array('title' => $photo->caption, 'class'=>'thumbnail-frame'),
    ));
}
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/style.css');
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/library.js');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <title><?=$center->name?>'s Photo Gallery</title>
</head>
<body>
    <h2><?=$center->name?>'s Photo Gallery</h2>
    <?php
        $this->widget('yiiwheels.widgets.gallery.WhGallery', array(
            'items' => $items,
        ));
    ?>



    <style>
        body {
            background-color: #222;   
            color: #fff;    
            font-size: 1em;
            line-height: 1.4em;    
            margin: 0 auto;
            max-width: 750px;    
            padding: 1em;    
            font-family: "Lucida Grande","Lucida Sans Unicode",Arial,sans-serif;
        }

        h2{
            text-align: center;
        }
        
        a.thumbnail-frame {
            float: left;
            width: 75px;
            height: 75px;
        }
        
        img {
            border: 0 none;
            vertical-align: middle;
        }
    </style>
    
    <script>
        $(window).load(function(){
            // Adjust thumbnails
            $('.thumbnail-frame img').each(adjustThumb);
        });
    </script>
</body>
</html>