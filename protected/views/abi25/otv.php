<fieldset><legend><?php echo 'Абилимпикс '.date('Y', strtotime($comp->rep_name_link->s_date)).'|'.CHtml::link("общая страница", array("abi/index"));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('abi25/index', array('id_comp'=>$comp->id))),
        array('label'=>'Эксперты', 'url'=>Yii::app()->createUrl('abi25/exp', array('id_comp'=>$comp->id))),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('abi25/otv', array('id_comp'=>$comp->id)), 'active'=>true),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('abi25/stats', array('id_comp'=>$comp->id))),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('abi25/compet', array('id_comp'=>$comp->id))),
    ),
)); ?>
<?php 
$type = [
        1 => 'Дошкольные образовательные учреждения',
        2 => 'Общеобразовательные учреждения',
        3 => 'Учреждения дополнительного образования детей',
        5 => 'Учреждения среднего профессионального образования',
        6 => 'Специальные (коррекционные) образовательные учреждения',
        7 => 'Учреждения высшего професcионального образования',
        8 => 'Учреждения для детей, нуждающихся в психолого-педагогической и медико-социальной помощи',
        9 => 'Иные учреждения',
    ];
$surname = array(
    'model'=>$model, // модель
    'attribute'=>'surname', // атрибут модели
    'source' =>Yii::app()->createUrl('abi25/pok1_complete'),
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
        <?php echo $form->dropDownListRow($model, 'id_type', $type, array('empty'=>'Выберите тип','class'=>'span8')); ?>
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

<?php
$dataProvider = $model->search($comp->id);
$dataProvider->pagination = array('pageSize' => 20);
if($dataProvider->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'part1-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$dataProvider,
            'enableSorting'=>false,
            'summaryText'=>'Ответственные {start}-{end} из {count}',
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
                    'value'=>'"<b>".$data->surname." ".$data->name." ".$data->patr."</b>"."<br>+7(".$data->code.")".$data->tel',
                ),
                array(
                    'header'=>'Организация',
                    'type'=>'html',
                    'value'=>'Est::model()->findByPk($data->report->est->id_est)->est_name."<br>".Est::model()->findByPk($data->report->est->id_okr)->est_name',
                ),                
                array(
                    'header'=>'Заявка',
                    'type'=>'html',
                    'value'=>'CHtml::link("Скачать", array("abi25/scandown2", "id"=>$data->id_report))."<br><i>".$data->obsh_r."</i>"',
                ),
                array(
                    'header' => 'Участ.',
                    'value'=>'$data->get_part()',
                    'type'=>'html',
                ),
                array(
                    'header'=>'Отчет',
                    'type'=>'html',
                    'value'=>'CHtml::link("Ссылка", array("complex/abi25/edit", "id_rep"=>$data->id_report))',
                ),
                array(
                    'header'=>'Кабинет',
                    'type'=>'html',
                    'value'=>'CHtml::link("Ссылка", array("site/cabinet", "id"=>$data->report->est->id_est))',
                ),                             
            ),            
    )); 
}?>
