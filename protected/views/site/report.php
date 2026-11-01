<?php
$this->pageTitle=Yii::app()->name.' - Данные по учреждению';
$this->breadcrumbs=array(
	$id_raion => array('site/type', 'id_raion' => $school_name_a['id_raion']),
        $type => array('site/schools', 'id_type' => $school_name_a['pid_est']),
        $school_name,
);
?>
<?php $this->pageTitle='Данные по учреждению '.$school_name;
$id = array(nas_punkt, street, dom, korpus, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, mail, site, publ, akkr, lic, ustav);
$street_type = array(1 => 'улица', 2 => 'проспект', 3 => 'переулок', 4 => 'проезд', 5 => 'шоссе', 6 => 'магистраль', 7 => 'просека', 8 => 'линия', 9 => 'бульвар', 10 => 'аллея', 11 => 'автомагистраль', 12 => 'тракт', 13 => 'тупик', 14 => 'набережная', 15 => 'разъезд', 16 => 'магистральная улица', 17 => 'квартал');
$nas_punkt_type = array(1 => 'город', 2 => 'посёлок городского типа', 3 => 'рабочий посёлок', 4 => 'посёлок', 5 => 'посёлок при станции', 6 => 'железнодорожная станция', 7 => 'село', 8 => 'деревня', 9 => 'район');
?>
<fieldset><legend>Данные по учреждению "<?php echo $school_name;?>"</legend></fieldset>
<table class="table table-striped table-hover">
  <tr>
    <td>Населенный пункт</td>
    <td><?php
    if($report['nas_punkt_type']) echo $nas_punkt_type[$report['nas_punkt_type']].' ';
    echo $report['nas_punkt'];
    ?></td>
  </tr>
  <tr>
    <td>Адрес</td>
    <td><?php
    if($report['korpus']) $korpus = 'корпус '.$report['korpus'];
    else $korpus = '';
    if($report['street_type']) echo $street_type[$report['street_type']].' ';
    echo $report['street'].', '.$report['dom'].' '.$korpus; ?></td>
  </tr>
<!--  <tr>
    <td>Директор</td>
    <td><?php //echo $report['dir_sur'].' '.$report['dir_name'].' '.$report['dir_par']; ?></td>
  </tr>-->
  <tr>
    <td>Телефон</td>
    <td><?php
    if($report['cod_phone']) echo '('.$report['cod_phone'].')';
    if($report['phone']) echo $report['phone'];
    ?></td>
  </tr>
  <tr>
    <td>Факс</td>
    <td><?php
    if($report['cod_fax']) echo '('.$report['cod_fax'].')';
    if($report['fax']) echo $report['fax'];
    ?></td>
  </tr>
  <!--<tr>
    <td>E-mail</td>
    <td><?php //echo CHtml::mailto($report['mail'], $report['mail']); ?></td>
  </tr>
  <tr>
    <td>Сайт</td>
    <td><?php //echo CHtml::link($report['site'], $report['site'], array('target' => '_blank')); ?></td>
  </tr>
<<tr>
    <td>Публичный отчет </td>
    <td><?php //echo CHtml::link($report['publ'], $report['publ'], array('target' => '_blank')); ?></td>
  </tr>
  <tr>
    <td>Отчет о результатах самообследования </td>
    <td><?php //echo CHtml::link($report['samo'], $report['samo'], array('target' => '_blank')); ?></td>
  </tr>  
  <tr>
    <td>Свидетельство об аккредитации </td>
    <td><?php //echo CHtml::link($report['akkr'], $report['akkr'], array('target' => '_blank')); ?></td>
  </tr>
  <tr>
    <td>Лицензия</td>
    <td><?php //echo CHtml::link($report['lic'], $report['lic'], array('target' => '_blank')); ?></td>
  </tr>
  <tr>
    <td>Устав</td>
    <td><?php //echo CHtml::link($report['ustav'], $report['ustav'], array('target' => '_blank')); ?></td>
  </tr>-->
</table>

<!--<fieldset><legend>Расположение на карте</legend></fieldset>-->
<?php
/*if($report['korpus']) $korp = 'корпус '.$report['korpus'];
else $korp='';
$geo = $this->geocoder('Самарская область, '.$report['nas_punkt'].', '.$report['street'].', '.$report['dom'].$korp);
$this->widget('ext.yandexmap.YandexMap',array(
        'id'=>'map',
        'width'=>1170,
        'height'=>600,
        'zoom'=>15,
        'center'=>array($geo[1], $geo[0]),
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
                'lat'=>$geo[1],
                'lon'=>$geo[0],
                'properties'=>array(
                    //'balloonContentHeader'=>'Школа',
                    //'balloonContent'=>'1',
                    //'balloonContentFooter'=>'она',
                    'hintContent'=> $school_name,
                ),
                'options'=>array(
                    'draggable'=>false,
                )
            )
        ),
    ));*/
?>

<div class="row" style="margin-top: 10px;">        
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Вернуться к выбору образовательного учреждения',
    'type'=>'', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'url'=>'index.php?r=site/schools&id_type='.$school_name_a['pid_est'],
    'icon'=>'icon-arrow-left',
    'htmlOptions'=>array('class'=>'pull-right'),
)); ?>
</div>
