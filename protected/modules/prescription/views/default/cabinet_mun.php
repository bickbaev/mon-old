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
for($m = 1; $m < 10; $m++) {
    if($pokrs[$m]->itemCount) {
        echo '<h4 style="margin-top:20px;">'.$this->get_type($m).'</h4>';
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'okrs-grid',
            'type'=>'striped bordered condensed',
            'enableSorting'=>false,
            'dataProvider'=>$pokrs[$m],
            'summaryText'=>'',
            //'htmlOptions'=> array('style'=>'width:800px;'),
            'columns'=>array(
                array(  
                    'header' => 'Организация',
                    'value'=>'CHtml::link($data["name"], array("default/cabinet", "id_est"=>$data["id"]))',
                    'type'=>'html',
                    'footer'=>'<strong>Итого</strong>',            
                ),
                array(  
                    'header' => 'Объект.',
                    'value'=>'$data["obj"]',
                    'footer'=>'<strong>'.$itog[$m]['obj'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
                ),
                array(  
                    'header' => 'Предп.',
                    'value'=>'$data["pred"]',
                    'footer'=>'<strong>'.$itog[$m]['pred'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
                ),
                array(  
                    'header' => 'АТЗ',
                    'value'=>'$data["t1"]',
                    'footer'=>'<strong>'.$itog[$m]['t1'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'ПБ',
                    'value'=>'$data["t2"]',
                    'footer'=>'<strong>'.$itog[$m]['t2'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'СЭБ',
                    'value'=>'$data["t3"]',
                    'footer'=>'<strong>'.$itog[$m]['t3'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'ШП',
                    'value'=>'$data["t4"]',
                    'footer'=>'<strong>'.$itog[$m]['t4'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'ИБ',
                    'value'=>'$data["t5"]',
                    'footer'=>'<strong>'.$itog[$m]['t5'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'ОТ',
                    'value'=>'$data["t6"]',
                    'footer'=>'<strong>'.$itog[$m]['t6'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'НСО',
                    'value'=>'$data["t7"]',
                    'footer'=>'<strong>'.$itog[$m]['t7'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'Иное',
                    'value'=>'$data["t8"]',
                    'footer'=>'<strong>'.$itog[$m]['t8'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #F5F5DC;'),
                ),
                array(  
                    'header' => 'ПМ',
                    'value'=>'$data["pm"]',
                    'footer'=>'<strong>'.$itog[$m]['pm'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
                ),        
            ),
        ));
    }
}
?>

