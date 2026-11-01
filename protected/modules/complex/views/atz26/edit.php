<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по организации - <?php echo $est->est_name; ?></legend></fieldset>
<p><b>Инструкция по заполнению отчета "Мониторинг АТЗ"</b></p>
<p>Заполните информацию по всем объектам образовательной организации для мониторинга АТЗ. Для добавления объекта нажмите кнопку "Добавить объект".</p>
<fieldset><legend>Объекты</legend></fieldset>
<?php
if($atz_obj->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'part-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$atz_obj,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header'=>'Адрес(а)',
                    'type'=>'html',
                    'value'=>'$data->get_addr()',
                ),
                array(
                    'name'=>'pok1',
                    'type'=>'html',
                    'value'=>'$data->sob_link->naim',
                ),
                array(
                    'name'=>'pok4',
                    'type'=>'html',
                    'value'=>'$data->cat_link->naim',
                ),
                array(
                    'header'=>'Полностью соотв. треб.',
                    'type'=>'html',
                    'value'=>'$data->sootv()',
                ),                
                array(
                    //'header'=>"Сумма потраченная в тек. году, тыс. руб" ,
                    'header'=>"Сумма потраченная в тек. году, руб." ,
                    'type'=>'html',
                    'value'=>'$data->sum_god1()',
                ),
                array(
                    //'header'=>'Общая потребность, тыс. руб',
                    'header'=>'Общая потребность, руб.',
                    'type'=>'html',
                    'value'=>'$data->sum_god2()',
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/atz26/update_obj", array("id"=>$data->id))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/atz26/delete_obj", array("id"=>$data->id))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить объект?',
                    ),
            ),            
    )); 
}?>                
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить объект', 'url'=>Yii::app()->createUrl("complex/atz26/create_obj", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Назад', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$est->id_est)))); ?></p></div>