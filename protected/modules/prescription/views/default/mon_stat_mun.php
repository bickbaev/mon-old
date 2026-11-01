<?php $this->pageTitle=Yii::app()->name;?>
<div class="row" style="margin-top: 40px;"><div class="span12"><legend><?php echo $mon['rep_name'].' ('.$mon['s_date'].'-'.$mon['f_date'].')'; ?></legend></div></div>
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
                    'header' => 'Не заполнено',
                    'value'=>'$data["nov"]',
                    'footer'=>'<strong>'.$itog[$m]['nov'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #7AC7D4;'),
                ),
                array(  
                    'header' => 'Не обновлено',
                    'value'=>'$data["nobn"]',
                    'footer'=>'<strong>'.$itog[$m]['nobn'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #E0FFFF;'),
                ),
                array(  
                    'header' => 'Заполнено',
                    'value'=>'$data["zap"]',
                    'footer'=>'<strong>'.$itog[$m]['zap'].'</strong>',
                    'htmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
                    'footerHtmlOptions'=>array('style'=>'background-color: #FFE4C4;'),
                ),         
            ),
        ));
    }
}
?>


