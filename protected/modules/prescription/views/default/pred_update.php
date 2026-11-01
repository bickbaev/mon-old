<?php $this->pageTitle=Yii::app()->name;?>
<fieldset><legend>Информация о предписании</legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> Для ввода информация о мероприятих по данному предписанию нажмите на кнопку "Добавить мероприятие предписания".
</p>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,  
    'id'=>'pred-table',
    'type'=>'condenced striped bordered',
    'attributes'=>array(
        array(
            'label'=>'Реквизиты документа',
            'type'=>'html',
            'value'=>$this->pred_doc($model),
        ),        
        array(
            'name' => 'id_type',
            'value'=> Pr_type::model()->findByPk($model->id_type)->naim,
        ),
        'organ',                  
        array(
            'label'=>'Файл предписания',
            'value'=>CHtml::link($model->pred_r, array('preddown', 'id_pr'=>$model->id_pr)),
            'type'=>'html',
        ),         
    ),
));
?>
<div class="row" style="margin-bottom: 20px;"><div class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные предписания',  'url'=>Yii::app()->createUrl("prescription/default/pred_edit", array('id_pr'=>$model->id_pr)))); ?></div></div>
<?php echo '<h4>Мероприятия предписания</h4>';
if($mer->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'mer-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$mer,
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
                    'header' => 'Наименование мероприятия',
                    'type' => 'html',
                    'value' => array($this, 'naim_mer'),
                ), 
                array(
                    'header' => 'Нормативный акт',
                    'type' => 'html',
                    'value' => '$data->norm."<br>".$data->stat',
                ),
                'srok',
                array(
                    'header'=>'Необходимая сумма, руб.',
                    'value' => '$data->summa',
                ),
                array(
                    'header'=>'Сведения о финансировании',
                    'type'=>'html',
                    'value'=>array($this, 'mer_fin'),
                ),                            
                array(
                    'header'=>'Выполнено',
                    'type'=>'html',
                    'value' => '$data->fsrok?CHtml::link("Да", array("poddown", "id_mer"=>$data["id_mer"]))."<br>".$data->fsrok:"Нет"',
                ),                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("prescription/default/mer_update", array("id_mer"=>$data->id_mer))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("prescription/default/mer_delete", array("id_mer"=>$data->id_mer))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить мероприятие?',                    
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить мероприятие предписание', 'url'=>Yii::app()->createUrl("prescription/default/mer_add", array('id_pr'=>$model->id_pr)))); ?></p></div>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-arrow-left', 'label'=>'Назад', 'url'=>Yii::app()->createUrl("prescription/default/object_update", array('id_build'=>$model->id_build)))); ?></p></div>
