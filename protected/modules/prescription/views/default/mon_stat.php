<?php $this->pageTitle=Yii::app()->name;?>
<div class="row" style="margin-top: 40px;"><div class="span12"><legend><?php echo $mon['rep_name'].' ('.$mon['s_date'].'-'.$mon['f_date'].')'; ?></legend></div></div>
<?php
if(!$vis_okr) $dobavka = array('excel_'.$mon['svod'], 'id_okr'=>$id_okr);
else $dobavka = array('excel_'.$mon['svod']);
echo CHtml::link('Сводная информация в формате Excel', $dobavka);
$rep_type = $mon["id_rep_type"];
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
            'value'=>'$data["okr"]',
            'type'=>'html',
            'footer'=>'',
            'visible' => $vis_okr,
        ),
        array(  
            'header' => 'Муниципалитет',
            'value'=>'CHtml::link($data["name"], array("mon_stat_mun", "id_mun"=>$data["id"], "id_rep_type"=>1))',
            'type'=>'html',
            'footer'=>'<strong>Итого</strong>',            
        ),
        array(  
            'header' => 'Не заполнено',
            'value'=>'$data["nov"]',
            'footer'=>'<strong>'.$itog['nov'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
        ),
        array(  
            'header' => 'Не обновлено',
            'value'=>'$data["nobn"]',
            'footer'=>'<strong>'.$itog['nobn'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
        ),
        array(  
            'header' => 'Заполнено',
            'value'=>'$data["zap"]',
            'footer'=>'<strong>'.$itog['zap'].'</strong>',
            'htmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
            'footerHtmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
        ),        
    ),
));
?>
