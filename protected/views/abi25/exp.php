<fieldset><legend><?php echo 'Абилимпикс '.date('Y', strtotime($comp->rep_name_link->s_date)).'|'.CHtml::link("общая страница", array("abi/index"));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('abi25/index', array('id_comp'=>$comp->id))),
        array('label'=>'Эксперты', 'url'=>Yii::app()->createUrl('abi25/exp', array('id_comp'=>$comp->id)), 'active'=>true),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('abi25/otv', array('id_comp'=>$comp->id))),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('abi25/stats', array('id_comp'=>$comp->id))),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('abi25/compet', array('id_comp'=>$comp->id))),
    ),
)); 
?>

<?php 
$surname = array(
    'model'=>$model, // модель
    'attribute'=>'surname', // атрибут модели
    'source' =>Yii::app()->createUrl('abi25/surname_complete2'),
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
        <?php echo $form->dropDownListRow($model, 'id_compet', CHtml::listData(Abi25_compet::model()->findAll(array('condition' => 'id_comp = :id_comp', 'params' => array(':id_comp' => $comp->id), 'order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите компетенцию','class'=>'span3')); ?>        
        <input name="id_comp" id="id_comp" type="hidden" value="<?php echo $comp->id; ?>" />
</fieldset>    
<div style="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Поиск', 'htmlOptions'=>array('class'=>'pull-right', 'style'=>'margin-left:10px;'))); ?>    
</div>
<?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>

<div class="row" style="margin-bottom: 20px;">
    <div class="pull-right">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Реестр экспертов',  'url'=>Yii::app()->createUrl('abi25/excel_exp', array('id_comp'=>$comp->id)))); ?>        
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
            'summaryText'=>'Эксперты {start}-{end} из {count}',
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
                    'header'=>'Эксперт',
                    'type'=>'html',
                    'value'=>'"<b>".$data->surname." ".$data->name." ".$data->patr."</b>"."<br>".$data->burthdate."<br>".CHtml::mailto($data->lic_mail, $data->lic_mail)."<br>+7(".$data->lic_code.")".$data->lic_tel."<br>".Abi25_compet::model()->findByPk($data->id_compet)->naim',
                ),
                array(
                    'header'=>'Место работы/должн.',
                    'type'=>'html',
                    'value'=>'$data->rabota."<br>".$data->dol',
                ), 
                array(
                    'name'=>'gl_exp',
                    'type'=>'html',
                    'value'=>'($data->gl_exp?"Да":"Нет")',
                ),
                array(
                    'name'=>'exp',
                    'type'=>'html',
                    'value'=>'($data->exp?"Да":"Нет")',
                ),
                array(
                    'header'=>'Стаж работы в заявленной компетенции/Опыт работы с людьми с инвалидностью.',
                    'type'=>'html',
                    'value'=>'$data->staz."/".$data->opit',
                ),                
                array(
                    'header'=>'Посл. ред.',
                    'type'=>'html',
                    'value'=>'$data->r_date',
                ),               
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>function($data, $row, $column) use ($comp) {
                        return Yii::app()->createUrl("abi25/update_exp", array("id" => $data->id, "id_comp" => $comp->id));
                    },                    
                    'deleteButtonUrl'=>function($data, $row, $column) use ($comp) {
                        return Yii::app()->createUrl("abi25/delete_exp", array("id"=>$data->id, "id_comp"=>$comp->id));
                    },                     
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить эксперта?',
                    ),
            ),            
    )); 
}
