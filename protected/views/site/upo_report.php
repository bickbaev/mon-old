<?php
$this->pageTitle=Yii::app()->name.' - Данные по учреждению '.$school_name;
$this->breadcrumbs=array(
	$id_raion => array('site/upo_type', 'id_raion' => $school_name_a['id_raion']),
        $school_name,
);
?>
<?php
print_r($school_name_a['id_raion']);
$id = array(nas_punkt, street, dom, korpus, dir_name, dir_par, dir_sur, cod_phone, phone, cod_fax, fax, mail, site, publ, akkr, lic, ustav);
$street_type = array(1 => 'улица', 2 => 'проспект', 3 => 'переулок', 4 => 'проезд', 5 => 'шоссе', 6 => 'магистраль', 7 => 'просека', 8 => 'линия', 9 => 'бульвар', 10 => 'аллея', 11 => 'автомагистраль', 12 => 'тракт', 13 => 'тупик', 14 => 'набережная', 15 => 'разъезд', 16 => 'магистральная улица', 17 => 'квартал');
$nas_punkt_type = array(1 => 'город', 2 => 'посёлок городского типа', 3 => 'рабочий посёлок', 4 => 'посёлок', 5 => 'посёлок при станции', 6 => 'железнодорожная станция', 7 => 'село', 8 => 'деревня', 9 => 'район');
?>
<fieldset><legend><?php echo $school_name;?></legend></fieldset>
<table width="650" border="0" cellspacing="0" cellpadding="3" style="padding-left: 20px;">
  <tr bgcolor="lightgrey">
    <td>Населенный пункт</td>
    <td><?php
    if($report['nas_punkt_type']) echo $nas_punkt_type[$report['nas_punkt_type']].' ';
    echo $report['nas_punkt'];
    ?></td>
  </tr>
  <tr bgcolor="white">
    <td>Адрес</td>
    <td><?php
    if($report['korpus']) $korpus = 'корпус '.$report['korpus'];
    else $korpus = '';
    if($report['street_type']) echo $street_type[$report['street_type']].' ';
    echo $report['street'].', '.$report['dom'].' '.$korpus; ?></td>
  </tr>
  <tr bgcolor="lightgrey">
    <td>Директор</td>
    <td><?php echo $report['dir_sur'].' '.$report['dir_name'].' '.$report['dir_par']; ?></td>
  </tr>
  <tr bgcolor="white">
    <td>Телефон</td>
    <td><?php
    if($report['cod_phone']) echo '('.$report['cod_phone'].')';
    if($report['phone']) echo $report['phone'];
    ?></td>
  </tr>
  <tr bgcolor="lightgrey">
    <td>Факс</td>
    <td><?php
    if($report['cod_fax']) echo '('.$report['cod_fax'].')';
    if($report['fax']) echo $report['fax'];
    ?></td>
  </tr>
  <tr bgcolor="white">
    <td>E-mail</td>
    <td><?php echo CHtml::mailto($report['mail'], $report['mail']); ?></td>
  </tr>
  <tr bgcolor="lightgrey">
    <td>Сайт</td>
    <td><?php echo CHtml::link($report['site'], $report['site'], array('target' => '_blank')); ?></td>
  </tr>
  <tr bgcolor="white">
    <td>Публичный отчет </td>
    <td><?php echo CHtml::link($report['publ'], $report['publ'], array('target' => '_blank')); ?></td>
  </tr>
  <tr bgcolor="lightgrey">
    <td>Свидетельство об аккредитации </td>
    <td><?php echo CHtml::link($report['akkr'], $report['akkr'], array('target' => '_blank')); ?></td>
  </tr>
  <tr bgcolor="white">
    <td>Лицензия</td>
    <td><?php echo CHtml::link($report['lic'], $report['lic'], array('target' => '_blank')); ?></td>
  </tr>
  <tr bgcolor="lightgrey">
    <td>Устав</td>
    <td><?php echo CHtml::link($report['ustav'], $report['ustav'], array('target' => '_blank')); ?></td>
  </tr>
</table>

<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'arrow-left', 'label'=>'Назад', 'htmlOptions'=>array('style'=>'margin-top:20px;'), 'url'=>$this->createUrl('site/upo_type', array('id_raion'=>$school_name_a['id_raion'])))); ?>