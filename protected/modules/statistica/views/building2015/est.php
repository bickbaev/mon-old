<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend>Здания <?php echo $est['est_name'] ?>. Отчет "<?php echo $otchet['rep_name'].'" период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php
if($buildings->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'buildings-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$buildings,
            'enableSorting'=>false,
            'summaryText'=>'',
            'htmlOptions'=> array('style'=>'width:900px;'),
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),                
                array(
                    'header' => 'Адрес',
                    'value' => array($this, 'address'),
                    'type'=>'html',
                ),
                array(
                    'header' => 'Преимущественно реализуемая программа',
                    'value' => array($this, 'ur'),
                    'type'=>'html',
                ),                
            ),            
    )); 
}?>
