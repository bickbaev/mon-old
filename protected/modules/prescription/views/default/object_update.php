<?php $this->pageTitle=Yii::app()->name;?>
<fieldset><legend>Информация об объекте</legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> Для ввода информация о предписаниях по данному объекту нажмите на кнопку "Добавить предписание". После внесения общей информации о предписании вносится информация по каждому мероприятию предписания.
</p>
<p><strong>Для удаления предписания удалите все мероприятия по данному предписанию.</strong></p>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,  
    'id'=>'build-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        'naim',
        array(
            'label'=>'Адрес объекта',
            'value'=>$this->addr($model),
            'type'=>'html',
        ),
        array(
            'label'=>'На объекте располагается',
            'value'=>$model->type_o_print(),
            'type'=>'html',
        ),        
        array(
            'label'=>'Реализуемые образовательные программы',
            'value'=>$model->ur_print(),
            'type'=>'html',
        ),         
    ),
));
?>
<div class="row" style="margin-bottom: 20px;"><div class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные объекта',  'url'=>Yii::app()->createUrl("prescription/default/object_edit", array('id_build'=>$model->id_build)))); ?></div></div>
<?php  if($monitor->itemCount) {
echo '<h4>Мониторинги</h4>';
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'pred-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$monitor,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                'nn'=> array(
                    'name' => '№',
                    'value' => function($data, $row, $column) {
                        
                        $grid = $column->grid;
                        
                        $pages = $grid->dataProvider->getPagination();

                        $start = ($grid->enablePagination === false)
                                ? 0
                                : $pages->getCurrentPage(false) * $pages->getPageSize();

                        return $start + $row + 1;
                    },
                ),
                array(
                    'header'=>'Наименование отчета',
                    'value'=>'$data["rep_name"]',
                ),
                array(
                    'header'=>'Срок заполнения',
                    'value'=>'$data["f_date"]',
                ),
                array(
                    'header'=>'Статус',
                    'value'=>'$data["status"]',
                ),                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("prescription/default/mon_edit", array("id_rep_type"=>$data["id_rep_type"], "id_report"=>$data["id_report"]))',                    
                    ),
            ),            
    ));
}
?>
<?php echo '<h4>Действующие предписания</h4>';
if($pred->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'pred-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$pred,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                'nn'=> array(
                    'name' => '№',
                    'value' => function($data, $row, $column) {
                        /** @var $grid CGridView */
                        $grid = $column->grid;
                        /** @var $pages CPagination */
                        $pages = $grid->dataProvider->getPagination();

                        $start = ($grid->enablePagination === false)
                                ? 0
                                : $pages->getCurrentPage(false) * $pages->getPageSize();

                        return $start + $row + 1;
                    },
                ),
                array(
                    'header'=>'Реквизиты документа',
                    'type'=>'html',
                    'value'=>array($this, 'pred_doc'),
                ),                              
                array(
                    'header'=>'Тип предписания',
                    'value'=>'Pr_type::model()->findByPk($data->id_type)->naim',
                ),                            
                'organ',
                array(
                    'header'=>'Мероприятия',
                    'type'=>'html',
                    'value'=>array($this, 'pred_mer'),
                ),                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("prescription/default/pred_update", array("id_pr"=>$data->id_pr))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("prescription/default/pred_delete", array("id_pr"=>$data->id_pr))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить предписание?',
                    'buttons' => array(
                        'delete' => array(
                            'visible' => '!$data->mer_count()',
                        )
                    ),                    
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить предписание', 'url'=>Yii::app()->createUrl("prescription/default/pred_add", array('id_build'=>$model->id_build)))); ?></p></div>
<?php if($vpr) { ?>
    <div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Выполненные предписания', 'url'=>Yii::app()->createUrl("prescription/default/object_vpr", array('id_build'=>$model->id_build)))); ?></p></div>
<?php }; ?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-arrow-left', 'label'=>'Назад', 'url'=>Yii::app()->createUrl("prescription/default/cabinet", array('id_est'=>$model->id_est)))); ?></p></div>    
    
