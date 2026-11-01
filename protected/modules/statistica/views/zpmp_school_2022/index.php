<?php
$this->pageTitle=Yii::app()->name . $rep_name->rep_name;
?>
<legend><?php echo $rep_name->rep_name.' период c '.$rep_name->s_date.' по '.$rep_name->f_date; ?></legend>

<?php 
    $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'grid',
    'dataProvider'=>$itogProvider,
    'type'=>'striped bordered condensed',
    'summaryText'=>'', 
    'emptyText'=>'данных нет',
    'enableSorting'=>false,
    'htmlOptions'=>array('style'=>'width: 500px;'),    
    'columns' => array(  
        array(  
            'name' => 'Управление',  
            'value' => 'CHtml::link($data["naim"], array("zpmp_school_2022/okr", "id_okr"=>$data["id"], "id_rep_type"=>398))',
            'type' => 'html',
            'footer' => '<strong>'.$itog_data["naim"].'</strong>',
            'htmlOptions'=>array('style'=>'width: 300px;')
        ),
        array(  
            'name' => 'всего подано',  
            'value' => '$data["items"]',
            'footer' => '<strong>'.$itog_data["items"].'</strong>',
            'htmlOptions'=>array('style'=>'width: 200px;')
        ),                
    )  
)); 
?>