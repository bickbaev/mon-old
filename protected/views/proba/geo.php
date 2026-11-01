<?php
$this->widget('ext.yandexmap.YandexMap',array(
        'id'=>'map',
        'width'=>1170,
        'height'=>600,
        'zoom'=>15,
        'center'=>array(53.0781, 50.2277),
        'controls' => array(
            'zoomControl' => true,
            'typeSelector' => true,
            'mapTools' => true,
            'smallZoomControl' => false,
            'miniMap' => true,
            'scaleLine' => true,
            //'searchControl' => true,
            'trafficControl' => true
        ),
        'placemark' => array(
            array(
                'lat'=>53.0781,
                'lon'=>50.2277,
                'properties'=>array(
                    /*'balloonContentHeader'=>'Школа',
                    'balloonContent'=>'1',
                    'balloonContentFooter'=>'она',*/
                    'hintContent'=> 'Зимние происшествия',
                ),
                'options'=>array(
                    'draggable'=>true
                )
            )
        ),
    ));

?>
