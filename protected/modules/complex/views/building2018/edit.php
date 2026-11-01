<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> Заполните информацию о зданиях. Для добавления информации о здании нажмите кнопку "Добавить здание". Информацию нужно внести по ВСЕМ зданиям принадлежащим юридическому лицу. Количество зданий в отчете неограничено.
   Информацию по добавленным зданиям можно редактировать и удалять с помощью пиктограмм "карандаш" и "корзина" соответственно.
</p>
<?php
if($buildings->itemCount) {
    echo '<fieldset><legend>Информация о зданиях</legend></fieldset>';
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'buildings-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$buildings,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),                
                array(
                    'name'=>'id_mun',
                    'value'=>'Mun::model()->findByPk($data->id_mun)->naim_mun',
                    ),
                array(
                    'header' => 'Адрес',
                    'value' => array($this, 'address'),
                    'type'=>'html',
                ),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/building2018/update", array("id_building"=>$data->id_building))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/building2018/delete", array("id_building"=>$data->id_building))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить здание?',
                    ),
            ),            
    )); 
}?> 
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить здание', 'url'=>Yii::app()->createUrl("complex/building2018/create", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><button style="margin:10px 10px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>
