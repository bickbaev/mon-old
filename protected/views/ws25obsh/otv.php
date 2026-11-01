<fieldset><legend><?php echo 'Чемпионат "Профессионалы" '.date('Y', strtotime($comp->rv));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('ws25obsh/index', array('id_comp'=>$comp->id))),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('ws25obsh/otv', array('id_comp'=>$comp->id)), 'active'=>true),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('ws25obsh/stats', array('id_comp'=>$comp->id))),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('ws25obsh/compet', array('id_comp'=>$comp->id))),
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
    'attribute'=>'pok1', // атрибут модели
    'source' =>Yii::app()->createUrl('ws25obsh/pok1_complete', array('id_comp'=>$comp->id)),
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
    'source' =>Yii::app()->createUrl('ws25obsh/est_complete'),
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
        <?php //echo $form->dropDownListRow($model, 'id_raion', CHtml::listData(Est::model()->findAll('type_adm = 2', array('order' => 'id_est ASC')), 'id_est', 'est_name'), array('empty'=>'Выберите муниципалитет','class'=>'span3')); ?>        
<!--        <div class="control-group ">
            <label class="control-label">Организация</label>
            <div class="controls">
            
            <?php /*$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model'=>$model,
                'attribute'=>'org_name', // поле модели для текста
                'sourceUrl'=>array('ws25obsh/org_complete'),
                'options'=>array(
                    'minLength'=>'2',
                    'select'=>"js:function(event, ui) {
                        $('#Ws25_obsh_id_est').val(ui.item.id); // предполагая, что у вас есть поле id
                    }",
                ),
                'htmlOptions'=>array(
                    'class'=>'span8',
                    'placeholder'=>'Начните вводить...',
                ),                
            ));

            echo $form->hiddenField($model, 'id_est');*/ ?>
                
            </div>
        </div>  -->
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
                    'value'=>'"<b>".$data->pok1." ".$data->pok2." ".$data->pok3."</b>"."<br>+7(".$data->pok4.")".$data->pok5',
                ),
                array(
                    'header'=>'Организация',
                    'type'=>'html',
                    'value'=>'Est::model()->findByPk($data->report->est->id_est)->est_name."<br>".Est::model()->findByPk($data->report->est->id_okr)->est_name',
                ),                
                array(
                    'header'=>'Заявка',
                    'type'=>'html',
                    'value'=>'CHtml::link("Скачать", array("ws25obsh/scandown2", "id_rep"=>$data->id_report, "id" => 6))."<br><i>".$data->pok6_vr."</i>"',
                ),
                array(
                    'header'=>'ПОС',
                    'type'=>'html',
                    'value'=>'CHtml::link("Скачать", array("ws25obsh/scandown2", "id_rep"=>$data->id_report, "id" => 7))."<br><i>".$data->pok7_vr."</i>"',
                ),
                array(
                    'header'=>'ПП',
                    'type'=>'html',
                    'value'=>'CHtml::link("Скачать", array("ws25obsh/scandown2", "id_rep"=>$data->id_report, "id" => 8))."<br><i>".$data->pok8_vr."</i>"',
                ),
                array(
                    'header' => 'Участ.',
                    'value'=>'$data->get_part()',
                    'type'=>'html',
                ),
                array(
                    'header' => 'Конк.',
                    'value'=>'$data->get_conc()',
                    'type'=>'html',
                ),
                array(
                    'header'=>'Отчет',
                    'type'=>'html',
                    'value'=>'CHtml::link("Ссылка", array("complex/ws25/edit", "id_rep"=>$data->id_report))',
                ),
                array(
                    'header'=>'Кабинет',
                    'type'=>'html',
                    'value'=>'CHtml::link("Ссылка", array("site/cabinet", "id"=>$data->report->est->id_est))',
                ),                             
            ),            
    )); 
}?>
