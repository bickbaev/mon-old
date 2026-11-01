<fieldset><legend><?php echo 'Фестиваль возможностей '.date('Y', strtotime($comp->rep_name->s_date)).'|'.CHtml::link("общая страница", array("abi/index"));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('fv25/index', array('id_comp'=>$comp->id))),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('fv25/otv', array('id_comp'=>$comp->id))),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('fv25/stats', array('id_comp'=>$comp->id))),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('fv25/compet', array('id_comp'=>$comp->id)), 'active'=>true),
    ),
)); 
?>

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
                    'header'=>'Школьники',
                    'type'=>'html',
                    'value'=>'($data->jun)?"Да":"Нет"',
                ),                            
                array(
                    'header'=>'Студенты',
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
                    'updateButtonUrl'=>'Yii::app()->createUrl("fv25/update_compet", array("id"=>$data->id))',                    
                ),                            
            ),            
    )); 
}?>