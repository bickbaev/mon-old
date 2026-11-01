<?php
$this->pageTitle=Yii::app()->name.' - Данные по учреждению '.$school_name;
?>
<?php
$street_type = array(1 => 'улица', 2 => 'проспект', 3 => 'переулок', 4 => 'проезд', 5 => 'шоссе', 6 => 'магистраль', 7 => 'просека', 8 => 'линия', 9 => 'бульвар', 10 => 'аллея', 11 => 'автомагистраль', 12 => 'тракт', 13 => 'тупик', 14 => 'набережная', 15 => 'разъезд', 16 => 'магистральная улица', 17 => 'квартал');
$nas_punkt_type = array(1 => 'город', 2 => 'посёлок городского типа', 3 => 'рабочий посёлок', 4 => 'посёлок', 5 => 'посёлок при станции', 6 => 'железнодорожная станция', 7 => 'село', 8 => 'деревня', 9 => 'район');
?>
<fieldset><legend><?php echo $school_name; ?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$report,
    'attributes'=>array(
        array(               
            'label'=>'Населенный пункт',
            'value'=>$nas_punkt_type[$report['nas_punkt_type']].' '.$report['nas_punkt'],
        ),
        array(               
            'label'=>'Адрес',
            'value'=>$street_type[$report['street_type']].' '.$report['street'].', '.$report['dom'].' '.$korpus,
        ),        
        array(               
            'label'=>'Директор',
            'value'=>$report['dir_sur'].' '.$report['dir_name'].' '.$report['dir_par'],
        ),
        array(               
            'label'=>'Контактный телефон',
            'value'=>'('.$report['cod_phone'].')'.$report['phone'],
        ),
        array(               
            'label'=>'Факс',
            'value'=>'('.$report['cod_fax'].')'.$report['fax'],
        ),
        array(               
            'label'=>'E-mail',
            'type'=>'html',
            'value'=>CHtml::mailto($report['mail'], $report['mail']),
        ),        
        array(               
            'label'=>'Сайт',
            'type'=>'html',
            'value'=>CHtml::link($report['site'], $report['site']),
        ),        
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'arrow-left', 'label'=>'Назад', 'htmlOptions'=>array('style'=>'margin-top:20px;'), 'url'=>$this->createUrl('site/upo_type', array('id_raion'=>$raion['id_est'])))); ?>

