<legend>Данные по зданию</legend>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,  
    'id'=>'est-table',
    'type'=>'condenced striped bordered',  
    'nullDisplay'=>'',
    'attributes'=>array(
        array(
            'label' => 'Адрес',
            'value' => $model->address(),
        ),        
        'pl',
        'godp',
        'eta',
        'izn',
        array(
            'name' => 'sport',
            'value' => $model->danet('sport'),
        ),
        array(
            'name' => 'pish',
            'value' => $model->danet('pish'),
        ),
        array(
            'name' => 'vodo',
            'value' => $model->danet('vodo'),
        ),
        array(
            'name' => 'kanal',
            'value' => $model->danet('kanal'),
        ),
        'sanvn',
        'sannar',
        array(
            'name' => 'otopl',
            'value' => $model->danet('otopl'),
        ),
        array(
            'name' => 'ogr',
            'value' => $model->danet('ogr'),
        ),        
        array(
            'label' => 'Тип здания',
            'value' => $model->zam(array('otd', 'fil', 'hoz', 'bass', 'sportz')),
            'type' => 'html',
        ),        
        array(
            'label' => 'Реализуемые в здании образовательные программы',
            'value' => $model->zam(array('doo', 'noo', 'ooo', 'soo', 'dop', 'dpredo', 'spo', 'oppo', 'dpo', 'ovo')),
            'type' => 'html',
        ), 
        array(
            'label' => 'Пожарная охрана',
            'value' => $model->zam(array('aps', 'di', 'pokr', 'v01')),
            'type' => 'html',
        ),
        array(
            'label' => 'Тип охраны',
            'value' => $model->zam(array('chop', 'vohr', 'vahta')),
            'type' => 'html',
        ), 
        array(
            'label' => 'Охранные системы',
            'value' => $model->zam(array('kevp', 'video', 'skud')),
            'type' => 'html',
        ),
        array(
            'name'=> 'sszd',
            'value'=> CHtml::link('Скачать',array('building2018/bdown','id'=>1, 'id_report' => $model->id_report, 'id_building' => $model->id_building)),
            'type' => 'html',
            'visible'=> ($model->sszd != ''),
        ),
        array(
            'name'=> 'sszem',
            'value'=> CHtml::link('Скачать',array('building2018/bdown','id'=>2, 'id_report' => $model->id_report, 'id_building' => $model->id_building)),
            'type' => 'html',
            'visible'=> ($model->sszem != ''),
        ),
        array(
            'name'=> 'tp',
            'value'=> CHtml::link('Скачать',array('building2018/bdown','id'=>3, 'id_report' => $model->id_report, 'id_building' => $model->id_building)),
            'type' => 'html',
            'visible'=> ($model->tp != ''),
        ),
        array(
            'label' => 'Иные правоустанавливающие документы',
            'value'=> $model->inoe(),
            'type' => 'html',
        ),         
    ),
)); ?>
<div class="row" style="margin-bottom: 20px;">
    <div class="pull-right">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Редактировать данные',  'url'=>Yii::app()->createUrl("complex/building2018/bupdate", array('id_building'=>$model->id_building)))); ?>        
    </div>
</div>

<legend>Выполненные ремонтные работы</legend>
<p><b>Введите данные о проведенных ремонтных работах с 01.01.2012 года.</b></p>
<?php
if($rem->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'rem-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$rem,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),                
                array(
                    'header' => 'Вид работ',
                    'value' => array($this, 'rem_vid'),
                    'type'=>'html',
                ),
                'price',
                'god',
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/building2018/update_rem", array("id_rem"=>$data->id_rem))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/building2018/delete_rem", array("id_rem"=>$data->id_rem))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить ремонтные работы?',
                    ),
            ),            
    )); 
}?> 
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить ремонтные работы', 'url'=>Yii::app()->createUrl("complex/building2018/create_rem", array('id_building'=>$model->id_building)))); ?></p></div>

<legend>Потребность в проведении работ</legend>
<p><b>Введите данные о потребностях в ремонтных работах.</b></p>
<?php
if($potr->itemCount) {
    $this->widget('bootstrap.widgets.TbGridView', array(
            'id'=>'potr-grid',
            'type'=>'striped bordered condensed',
            'dataProvider'=>$potr,
            'enableSorting'=>false,
            'summaryText'=>'',
            'columns'=>array(
                array(
                    'header' => '№',
                    'value' => '$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),                
                array(
                    'header' => 'Реквизиты документа',
                    'value' => array($this, 'potr_rekv'),
                    'type'=>'html',
                ),
                array(
                    'header' => 'Инициатор',
                    'value' => array($this, 'potr_inic'),
                    'type'=>'html',
                ), 
                array(
                    'header' => 'Документация',
                    'value' => array($this, 'potr_doc'),
                    'type'=>'html',
                ),                
                'price',
                array(
                    'header' => 'Статус',
                    'value' => array($this, 'potr_status'),
                    'type'=>'html',
                ),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}{delete}',
                    'updateButtonUrl'=>'Yii::app()->createUrl("complex/building2018/update_potr", array("id_potr"=>$data->id_potr))',
                    'deleteButtonUrl'=>'Yii::app()->createUrl("complex/building2018/delete_potr", array("id_potr"=>$data->id_potr))',
                    'deleteConfirmation'=>'Вы уверены, что хотите удалить потребность?',
                    ),
            ),            
    )); 
}?> 
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить потребность', 'url'=>Yii::app()->createUrl("complex/building2018/create_potr", array('id_building'=>$model->id_building)))); ?></p></div>
<div class="row" style="margin-bottom: 20px;">
    <div class="pull-right">    
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'btn btn-primary', 'label'=>'Назад', 'url'=>$this->createUrl('building2018/edit',array('id_rep'=>$model->id_report)))); ?>
    </div>
</div>
