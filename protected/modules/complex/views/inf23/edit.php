<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<h4>Инструкция по заполнению отчета "Затраты на информатизацию"</h4>
<p>В целях оценки расходов необходимых на приобретение/разработку программного обеспечения (за исключением средств защиты информации), необходимо ввести информацию о расходах на приобретение/разработку программного обеспечения.<br> Для добавления информации по конкретному наименованию программного обеспечения нажмите кнопку "Добавить". Для добавления другого наименования нажмите кнопку "Добавить" еще раз.<br> Информацию о конкретном программном обеспечении можно отредактировать, нажав на соответствующие кнопки (в виде карандаша и корзины).</p>
<?php echo '<h4 style="margin-top: 40px;">Перечень затрат на информатизацию</h4>';
if($infs->itemCount) {  
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'inf23-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$infs,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                'pok1',
                'pok2',
                array(
                    'name'=>'pok4',
                    'type'=>'html',
                    'value'=>'Inf23_type::model()->findByPk($data->pok4)->naim',
                ),                                                             
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/inf23/update", array("id_inf"=>$data->id_inf))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/inf23/delete", array("id_inf"=>$data->id_inf))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить запись?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить', 'url'=>Yii::app()->createUrl("complex/inf23/create", array('id_rep'=>$id_rep)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary','label'=>'Назад', 'url'=>Yii::app()->createUrl("site/cabinet", array('id'=>$id_est)))); ?></p></div>

