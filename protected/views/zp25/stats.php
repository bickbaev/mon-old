<fieldset><legend><?php echo 'Знакомство с профессией '.date('Y', strtotime($comp->rep_name->s_date)).'|'.CHtml::link("общая страница", array("abi/index"));?></legend></fieldset>
<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'tabs', // '', 'tabs', 'pills' (or 'list')
    'stacked'=>false, // whether this is a stacked menu
    'items'=>array(
        array('label'=>'Участники', 'url'=>Yii::app()->createUrl('zp25/index', array('id_comp'=>$comp->id))),
        array('label'=>'Ответственные', 'url'=>Yii::app()->createUrl('zp25/otv', array('id_comp'=>$comp->id))),
        array('label'=>'Статистика', 'url'=>Yii::app()->createUrl('zp25/stats', array('id_comp'=>$comp->id)), 'active'=>true),
        array('label'=>'Компетенции', 'url'=>Yii::app()->createUrl('zp25/compet', array('id_comp'=>$comp->id))),
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
));?>

<h4>Статистика участников по компетенциям</h4>

<?php 
$columns2 = [
    [
        'header' => 'Компетенция',
        'value' => '$data["compet"]',
    ],
];

// Добавляем динамические колонки по категориям
foreach ($cats as $cat) {
    $columns2[] = [
        'header' => CHtml::encode($cat['naim']),
        'value' => 'isset($data["cat_' . $cat['id'] . '"]) ? $data["cat_' . $cat['id'] . '"] : 0',
        //'htmlOptions' => ['style' => 'text-align:center'],
    ];
}

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => $dataProvider2,
    'type'=>'striped bordered condensed',
    'summaryText'=>'', 
    'emptyText'=>'данных нет',     
    'columns' => $columns2,
));


