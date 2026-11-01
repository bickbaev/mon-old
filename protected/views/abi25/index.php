<fieldset><legend><?php echo 'Абилимпикс '.date('Y', strtotime($comp->rep_name_link->s_date)).'|'.CHtml::link("общая страница", array("abi/index"));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('abi25/index', array('id_comp'=>$comp->id)), 'active'=>true),
        array('label'=>'Эксперты', 'url'=>Yii::app()->createUrl('abi25/exp', array('id_comp'=>$comp->id))),
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
    'source' =>Yii::app()->createUrl('abi25/surname_complete'),
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
$est_name = array(
    'model'=>$model, // модель
    'attribute'=>'est_name', // атрибут модели
    'source' =>Yii::app()->createUrl('abi25/est_complete'),
    'options'=>array(
        'minLength'=>'2',
        'showAnim'=>'fold',
        'select' =>'js: function(event, ui) {
            this.value = ui.item.value;
            return false;
        }',
    ),
    'htmlOptions' => array(
        'class'=>'span6',
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
        <?php echo $form->dropDownListRow($model, 'id_cat', CHtml::listData(Abi25_cat::model()->findAll(array('order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите категорию','class'=>'span3')); ?>
        <?php echo $form->dropDownListRow($model, 'id_compet', CHtml::listData(Abi25_compet::model()->findAll(array('condition' => 'id_comp = :id_comp', 'params' => array(':id_comp' => $comp->id), 'order' => 'id ASC')), 'id', 'naim'), array('empty'=>'Выберите компетенцию','class'=>'span3')); ?>        
        <?php echo $form->dropDownListRow($model, 'id_okr', CHtml::listData(Est::model()->findAll('type_adm = 3', array('order' => 'id_est ASC')), 'id_est', 'est_name'), array('empty'=>'Выберите ТУ/ДО','class'=>'span4')); ?>
        <div class="control-group ">
            <label class="control-label">Название организации</label>
            <div class="controls">
                <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', $est_name); ?>
            </div>
        </div>    
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
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'type'=>'primary', 'label'=>'Доб. отчета для организации', 'url'=>$this->createUrl('abi25/add_report', array('id_comp'=>$comp->id)), 'htmlOptions' => array('style'=>''))); ?>        
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Реестр участников',  'url'=>Yii::app()->createUrl('abi25/excel', array('id_comp'=>$comp->id)))); ?>        
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
                    'value'=>'"<b>".$data->surname." ".$data->name." ".$data->patr."</b>"."<br>".$data->burthdate."<br>".CHtml::mailto($data->lic_mail, $data->lic_mail)."<br>+7(".$data->lic_code.")".$data->lic_tel."<br>Размер одежды ".Abi25_size::model()->findByPk($data->id_size)->naim',
                ),
                array(
                    'header'=>'ОО/кат./комп.',
                    'type'=>'html',
                    'value'=>'Est::model()->findByPk($data->report->est->id_est)->est_name."<br>".Est::model()->findByPk($data->report->est->id_okr)->est_name."<br>".Abi25_cat::model()->findByPk($data->id_cat)->naim."<br>".Abi25_compet::model()->findByPk($data->id_compet)->naim',
                ), 
                array(
                    'header'=>'Огр. по здоровью',
                    'type'=>'html',
                    'value'=>'Abi25_noz::model()->findByPk($data->id_noz)->naim.($data->id_gr?"<br>".Abi25_gr::model()->findByPk($data->id_gr)->naim."<br>".CHtml::link("Справка", array("abi25/scandown", "id"=>$data->id, "type" => 1))." до ".$data->spr_date:"").($data->ovz?"<br>ОВЗ"."<br>".CHtml::link("Справка", array("abi25/scandown", "id"=>$data->id, "type" => 4)):"")',
                ),
                array(
                    'header'=>'Сопровожд.',
                    'type'=>'html',
                    'value'=>'$data->per_surname." ".$data->per_name." ".$data->per_patr."<br>+7(".$data->per_code.")".$data->per_tel',
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
                        return Yii::app()->createUrl("abi25/update", array("id" => $data->id, "id_comp" => $comp->id));
                    },                    
                    'deleteButtonUrl'=>function($data, $row, $column) use ($comp) {
                        return Yii::app()->createUrl("abi25/delete", array("id"=>$data->id, "id_comp"=>$comp->id));
                    },                     
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить участника?',
                    ),
            ),            
    )); 
}
