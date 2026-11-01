<?php $this->pageTitle=Yii::app()->name;?>
<div class="row" style="margin-top: 40px;"><div class="span12"><legend>Информация о предписаниях</legend></div></div>
<p class="lead">Расшифровка показателей</p>
<ul>
  <li>АТЗ - Антитеррористическая защита</li>
  <li>ПБ – Пожарная безопасность</li>
  <li>СЭБ – Санитарно-эпидемиологическое благополучие</li>
  <li>ШП – Школьные перевозки</li>
  <li>ИБ - Информационная безопасность</li>
  <li>ОТ – Охрана труда</li>
  <li>НСО – Надзор в сфере образования</li>
  <li>ПМ – Просроченные мероприятия</li>
</ul>
<?php 
//print_r($itog);
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'okrs-grid',
    'type'=>'striped bordered condensed',
    'enableSorting'=>false,
    'dataProvider'=>$pokrs,
    'summaryText'=>'',
    //'htmlOptions'=> array('style'=>'width:800px;'),
    'columns'=>array(       
        array(  
            'header' => 'Округ',
            'value'=>'CHtml::link($data["okr"], array("cabinet_upr", "id_okr"=>$data["id_okr"]))',
            'type'=>'html',
            'footer'=>'',
            'visible' => $vis_okr,
        ),
        array(  
            'header' => 'Муниципалитет',
            'value'=>'CHtml::link($data["name"], array("cabinet_mun", "id_mun"=>$data["id"]))',
            'type'=>'html',
            'footer'=>'<strong>Итого</strong>',            
        ),
        array(  
            'header' => 'ЮЛ',
            'value'=>'$data["ul"]',
            'footer'=>'<strong>'.$itog['ul'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
        ),
        array(  
            'header' => 'Объект.',
            'value'=>'$data["obj"]',
            'footer'=>'<strong>'.$itog['obj'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
        ),
        array(  
            'header' => 'Предп.',
            'value'=>'$data["pred"]',
            'footer'=>'<strong>'.$itog['pred'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
        ),
        array(  
            'header' => 'АТЗ',
            'value'=>'$data["t1"]',
            'footer'=>'<strong>'.$itog['t1'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'ПБ',
            'value'=>'$data["t2"]',
            'footer'=>'<strong>'.$itog['t2'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'СЭБ',
            'value'=>'$data["t3"]',
            'footer'=>'<strong>'.$itog['t3'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'ШП',
            'value'=>'$data["t4"]',
            'footer'=>'<strong>'.$itog['t4'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'ИБ',
            'value'=>'$data["t5"]',
            'footer'=>'<strong>'.$itog['t5'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'ОТ',
            'value'=>'$data["t6"]',
            'footer'=>'<strong>'.$itog['t6'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'НСО',
            'value'=>'$data["t7"]',
            'footer'=>'<strong>'.$itog['t7'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'Иное',
            'value'=>'$data["t8"]',
            'footer'=>'<strong>'.$itog['t8'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
        ),
        array(  
            'header' => 'ПМ',
            'value'=>'$data["pm"]',
            'footer'=>'<strong>'.$itog['pm'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
        ),        
    ),
));
?>
<p class="lead">Мониторинги</p>
<ul>
<?php foreach ($mons as $mon) {
    if($id_est) $dobavka = array('id_rep_type'=>$mon['id_rep_type'], 'id_okr'=>$id_est);
    else $dobavka = array('id_rep_type'=>$mon['id_rep_type']);    
    echo '<li>'.CHtml::link($mon['rep_name'].' ('.$mon['s_date'].'-'.$mon['f_date'].')', Yii::app()->createUrl("prescription/default/mon_stat", $dobavka)).'</li>';
} 
?>
</ul>    
<p class="lead">Отчеты</p>
<?php
if($id_est) $dobavka = array('id_okr'=>$id_est);
else $dobavka = array();
?>
<ul>
  <li><?php echo CHtml::link('Подробная информация о предписаниях', Yii::app()->createUrl("prescription/default/excel_mer", $dobavka)) ?></li>
  <li><?php echo CHtml::link('Отчет по потребности в финансировании действующих предписаний', Yii::app()->createUrl("prescription/default/excel_summa", $dobavka)) ?></li>
  <li><?php echo CHtml::link('Отчет по мероприятиям, по которым не введена необходимая сумма более 31 дня', Yii::app()->createUrl("prescription/default/excel_srok", $dobavka)) ?></li>
</ul>