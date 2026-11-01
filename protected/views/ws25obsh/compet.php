<fieldset><legend><?php echo 'Чемпионат "Профессионалы" '.date('Y', strtotime($comp->rv));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('ws25obsh/index', array('id_comp'=>$comp->id))),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('ws25obsh/otv', array('id_comp'=>$comp->id))),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('ws25obsh/stats', array('id_comp'=>$comp->id))),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('ws25obsh/compet', array('id_comp'=>$comp->id)), 'active'=>true),
    ),
)); ?>
<?php
$this->beginWidget('bootstrap.widgets.TbHeroUnit');
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'decl',
    'type'=>'horizontal',
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',    
)); ?>
<fieldset>
        <?php echo $form->dropDownListRow($model, 'id_cat', CHtml::listData(Ws25_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите категорию','class'=>'span3')); ?>
        <input name="id_comp" id="id_comp" type="hidden" value="<?php echo $comp->id; ?>" />
</fieldset>    
<div style="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Поиск', 'htmlOptions'=>array('class'=>'pull-right', 'style'=>'margin-left:10px;'))); ?>    
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
<?php
$dataProvider = $model->search($comp->id);
$dataProvider->pagination = array('pageSize' => 100);
if($dataProvider->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'compet-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$dataProvider,
            'enableSorting'=>false,
            'summaryText'=>'Компетенция {start}-{end} из {count}',
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
                'naim',
                array(
                    'header'=>'Юниоры',
                    'type'=>'html',
                    'value'=>'($data->jun)?"Да":"Нет"',
                ),                            
                array(
                    'header'=>'Основная',
                    'type'=>'html',
                    'value'=>'($data->osn)?"Да":"Нет"',
                ),
                array(
                    'header'=>'Создание новых',
                    'type'=>'html',
                    'value'=>'($data->nov)?"Да":"Нет"',
                ),
                array(
                    'header'=>'Редактирование',
                    'type'=>'html',
                    'value'=>'($data->red)?"Да":"Нет"',
                ),                            
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("ws25obsh/update_compet", array("id"=>$data->id))',                    
                ),                            
            ),            
    )); 
}?>