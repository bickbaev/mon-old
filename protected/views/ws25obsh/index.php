<fieldset><legend><?php echo 'Чемпионат "Профессионалы" '.date('Y', strtotime($comp->rv));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('ws25obsh/index', array('id_comp'=>$comp->id)), 'active'=>true),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('ws25obsh/otv', array('id_comp'=>$comp->id))),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('ws25obsh/stats', array('id_comp'=>$comp->id))),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('ws25obsh/compet', array('id_comp'=>$comp->id))),
    ),
)); ?>

<?php 
$surname = array(
    'model'=>$model, // модель
    'attribute'=>'surname', // атрибут модели
    'source' =>Yii::app()->createUrl('ws25obsh/surname_complete', array('id_comp'=>$comp->id)),
    'options'=>array(
        'minLength'=>'2',
        'showAnim'=>'fold',
        'select' =>'js: function(event, ui) {
            this.value = ui.item.value;
            return false;
        }',
    ),
    'htmlOptions' => array(
        'class'=>'span3',
        'placeholder'=>'Начните вводить...'
    ),
);
?>

<?php
$this->beginWidget('bootstrap.widgets.TbHeroUnit');
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'decl',
    'type'=>'horizontal',
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',    
)); ?>
<fieldset>
        <div class="control-group ">
            <label class="control-label">Фамилия</label>
            <div class="controls">
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $surname); ?>
            </div>
        </div> 
        <?php echo $form->dropDownListRow($model, 'id_stat', CHtml::listData(Ws25_stat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите статус','class'=>'span3')); ?>               
        <?php echo $form->dropDownListRow($model, 'id_cat', CHtml::listData(Ws25_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите категорию','class'=>'span3')); ?>
        <?php //echo $form->dropDownListRow($model, 'id_compet', CHtml::listData(Ws25_compet::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите компетенцию','class'=>'span3')); ?>        
        <?php echo $form->dropDownListRow($model, 'id_compet', CHtml::listData(Ws25_compet::model()->findAll('id_comp = :id_comp', array(':id_comp'=>$comp->id)), 'id', 'naim'), array('empty'=>'Выберите компетенцию','class'=>'span3')); ?>
        <?php echo $form->checkBoxRow($model, 'housing'); ?>
        <input name="id_comp" id="id_comp" type="hidden" value="<?php echo $comp->id; ?>" />
</fieldset>    
<div style="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Поиск', 'htmlOptions'=>array('class'=>'pull-right', 'style'=>'margin-left:10px;'))); ?>    
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>

<div class="row" style="margin-bottom: 20px;">
    <div class="pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Заполнение отчетов', 'url'=>$this->createUrl('report/stat_podr', array('id_rep_type'=>$comp->id_rep_type, 'id_est'=>1)), 'htmlOptions' => array('style'=>''))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Доб. отчета для организации', 'url'=>$this->createUrl('ws25obsh/add_report', array('id_comp'=>$comp->id)), 'htmlOptions' => array('style'=>''))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Реестр основная категория',  'url'=>Yii::app()->createUrl('ws25obsh/excel', array('id_comp'=>$comp->id, 'id_cat'=>1)))); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Реестр юниоры',  'url'=>Yii::app()->createUrl('ws25obsh/excel', array('id_comp'=>$comp->id, 'id_cat'=>2)))); ?>
    </div>
</div>
   
<?php
$dataProvider = $model->search($comp->id);
$dataProvider->pagination = array('pageSize' => 20);
if($dataProvider->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'part1-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$dataProvider,
            'enableSorting'=>false,
            'summaryText'=>'Участники {start}-{end} из {count}',
            'columns'=>array(
                /*array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),*/
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
                    'header'=>'Участник',
                    'type'=>'html',
                    'value'=>'"<b>".$data->surname." ".$data->name." ".$data->patr."</b>"."<br>".$data->burthdate."<br>".CHtml::mailto($data->pers_mail, $data->pers_mail)."<br>".$data->nas_punkt',
                ),
                array(
                    'header'=>'Заявитель',
                    'type'=>'html',
                    'value'=>'Est::model()->findByPk($data->report->est->id_est)->est_name."<br>".Est::model()->findByPk($data->report->est->id_okr)->est_name',
                ),                
                array(
                    'header'=>'Статус',
                    'type'=>'html',
                    'value'=>'"<b>".Ws25_stat::model()->findByPk($data->id_stat)->naim."</b>"."<br>".Ws25_cat::model()->findByPk($data->id_cat)->naim."<br>".Ws25_compet::model()->findByPk($data->id_compet)->naim',
                ),                
                array(
                    'header'=>'Условия',
                    'type'=>'html',
                    //'value'=>'($data->housing?"Требуется проживание":"Не требуется проживание")."<br>Разм. одеж. ".Ws25_size::model()->findByPk($data->id_size)->naim."<br>".CHtml::link(Согласие, array("ws25obsh/scandown", "id"=>$data->id, "type" => 1)).($data->id_stat == 2)?"<br>".CHtml::link("Подтв. док.", array("ws25obsh/scandown", "id"=>$data->id, "type" => 2)):""',
                    'value'=>array($this, 'usl_data'),
                ),                
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'($data->id_stat < 4) ? 
                        Yii::app()->createUrl("ws25obsh/update", array("id"=>$data->id)) : 
                        Yii::app()->createUrl("ws25obsh/update2", array("id"=>$data->id))',                    
                    'viewButtonUrl'=>'Yii::app()->createUrl("ws25obsh/view", array("id"=>$data->id))',
                    //'deleteButtonUrl'=>'Yii::app()->createUrl("ws25obsh/delete", array("id"=>$data->id))',
                    'deleteButtonUrl'=>'($data->id_stat < 4) ? 
                        Yii::app()->createUrl("ws25obsh/delete", array("id"=>$data->id)) : 
                        Yii::app()->createUrl("ws25obsh/delete2", array("id"=>$data->id))',                       
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить участника?',
                    ),
            ),            
    )); 
}?>
