<?php $this->pageTitle=Yii::app()->name.' - Администрирование';?>
<fieldset><legend>Видеоконференции</legend></fieldset>
<?php
 $this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'user',
    'type'=>'striped condensed',
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name'=>'meetingID',
            'header'=>'ID',
        ),
        'name',
        array(
            'header'=>'Идет в данный момент',
            'value'=>array($this, 'bbb_status'),
        ),
        array(
            'header'=>'',
            'type'=>'html',
            'value'=>'CHtml::link("Остановить", array("admin/bbb_end", "meetingid"=>$data->meetingID))',
        ),          
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',  
            'template'=>'{update}{play}{delete}',
            'htmlOptions'=>array('style'=>'width: 70px'),
            'deleteConfirmation'=>'Вы действительно хотите удалить конференцию?',            
            'updateButtonUrl'=>'Yii::app()->createUrl("admin/bbb_edit", array("meetingid"=>$data->meetingID))',
            'deleteButtonUrl'=>'Yii::app()->createUrl("admin/bbb_delete", array("meetingid"=>$data->meetingID))',
            'buttons'=>array(
                'play' => array(
                        'icon'=>'play',
                        'url'=>'Yii::app()->createUrl("admin/bbb_join", array("meetingid"=>$data->meetingID))',
                        'label'=>'Подключиться',
                        
                ),                
            ),            
        ),        
    ),    
     ));
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'plus', 'label'=>'Добавить конференцию', 'url'=>Yii::app()->createUrl("admin/bbb_create"))); ?>
