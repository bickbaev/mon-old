<?php $this->pageTitle=Yii::app()->name;?>
<fieldset><legend>Выполненные предписания по объекту "<?php echo $model->naim; ?>"</legend></fieldset>
<?php if($pred->itemCount) {
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
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("prescription/default/pred_update", array("id_pr"=>$data->id_pr))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("prescription/default/pred_delete", array("id_pr"=>$data->id_pr))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить предписание?',
                    ),
            ),            
    )); 
}?>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-arrow-left', 'label'=>'Назад', 'url'=>Yii::app()->createUrl("prescription/default/object_update", array('id_build'=>$model->id_build)))); ?></p></div>

