<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<h4>Инструкция</h4>
<p>Введите информацию о трудоустройстве выпускников, выпущенных Вашим учреждением за период с 1 января 2015 года по 1 апреля 2015 года (т.е за 1 квартал 2015 года).<br />
При вводе информации необходимо указывать новые коды профессий/специальностей, независимо от того по каким кодам был проведен первоначальнй набор.<br />
Добавьте все профессиии/специальности, по которым был проведен выпуск за отчетный период (за 1 квартал 2015 года).<br /> 
В каждой добавленной профессии/специальности укажите все места трудоустройства выпускников.
</p>
<fieldset><legend>Информация о выпуске по профессиям/специальностям (новые коды)</legend></fieldset>
<?php
if($po->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'spo-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$po,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header' => 'Специальность',
                    'value' => array($this, 'prof_po'),
                    'type'=>'html',
                ),
                array(
                    'header' => 'Первоначально принято, чел.',
                    'name' => 'p_in',
                ),
                array(
                    'header' => 'Выпущено, чел.',
                    'name' => 'p_out',
                ),                
                array(
                    'header' => 'Всего трудоустроено, чел.',
                    'value' => array($this, 'place_all'),
                    'type'=>'html',
                ),
                array(
                    'header' => 'Число предприятий',
                    'value' => array($this, 'place_pred'),
                    'type'=>'html',
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/placement_spec/edit_po", array("id_spec"=>$data->id_spec))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/placement_spec/delete_po", array("id_spec"=>$data->id_spec))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить профессию/специальность?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить профессию/специальность (новые коды)', 'url'=>Yii::app()->createUrl("complex/placement_spec/create_po", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><button style="margin:10px 10px;" class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>