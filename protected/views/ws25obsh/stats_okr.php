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
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'arrow-left', 'label'=>'Назад', 'htmlOptions'=>array('style'=>'margin-top:20px;'), 'url'=>$this->createUrl('ws25obsh/stats', array('id_comp'=>$comp->id)))); ?>
<h4 style="margin-top:30px;"><?php echo $est->est_name; ?></h4>
<?php
 foreach ($data as $item) {
    if($item['provider']->itemCount) { 
        echo '<h5 style="margin-top:30px;">'.$item['name'].'</h5>';
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'est-stats-grid',
            'dataProvider' => $item['provider'],
            'type'=>'striped bordered condensed',
            'summaryText'=>'', 
            'emptyText'=>'данных нет', 
            'columns'=>array(
                array(
                    'header'=>'№',
                    'value'=>'$row+1',
                    'htmlOptions' => array('style' => 'width:25px;'),
                ),
                array(
                    'header'=>'Организация',
                    'type'=>'html',
                    'value'=>'$data["est_name"]',
                ),
                array(
                    'header'=>'Число участников',
                    'type'=>'html',
                    'value'=>'$data["cnt"]',
                    'htmlOptions' => array('style' => 'width:100px;'),
                ),                 
            )    
        ));
    }
} 
?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'arrow-left', 'label'=>'Назад', 'htmlOptions'=>array('style'=>'margin-top:20px;'), 'url'=>$this->createUrl('ws25obsh/stats', array('id_comp'=>$comp->id)))); ?>
