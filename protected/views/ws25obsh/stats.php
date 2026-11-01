<fieldset><legend><?php echo 'Чемпионат "Профессионалы" '.date('Y', strtotime($comp->rv));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('ws25obsh/index', array('id_comp'=>$comp->id))),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('ws25obsh/otv', array('id_comp'=>$comp->id))),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('ws25obsh/stats', array('id_comp'=>$comp->id)), 'active'=>true),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('ws25obsh/compet', array('id_comp'=>$comp->id))),
    ),
)); ?>
<h4>Число конкурсантов</h4>
<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'est-stats-grid',
    'dataProvider' => $dataProvider,
    'type'=>'striped bordered condensed',
    'summaryText'=>'', 
    'emptyText'=>'данных нет',    
    'columns' => $columns,
));
