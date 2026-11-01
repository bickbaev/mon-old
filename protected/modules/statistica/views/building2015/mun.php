<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend><?php echo $mun['est_name'] ?>. Отчет "<?php echo $otchet['rep_name'].'" период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php if($dou->itemCount) { ?>
<h4>Дошкольные организации</h4>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'users-grid',
    'type'=>'striped bordered condensed',
    'enableSorting'=>false,
    'dataProvider'=>$dou,
    'summaryText'=>'',
    //'htmlOptions'=> array('style'=>'width:600px;'),
    'columns'=>array(
        array(
            'header'=>'№',
            'htmlOptions'=> array('style'=>'width:20px;'),
            'value' => '$row+1',
        ),        
        array(
            'header'=>'Организация',
            'type'=>'html',
            'value' => '$data["naim"]',
            'footer' => '<b>'.$itog[1][0].'</b>',
        ),        
        array(
            'header'=>'Число зданий',
            'value' => '$data["build"]',
            'htmlOptions'=> array('style'=>'width:100px;'),
            'footer' => '<b>'.$itog[1][1].'</b>',
        ), 
        array(
            'header'=>'Дошк.',
            'value' => '$data["build1"]',
            'footer' => '<b>'.$itog[1][2].'</b>'
        ),
        array(
            'header'=>'Общ.',
            'value' => '$data["build2"]',
            'footer' => '<b>'.$itog[1][3].'</b>'
        ),
        array(
            'header'=>'Доп.',
            'value' => '$data["build3"]',
            'footer' => '<b>'.$itog[1][4].'</b>'
        ),        
    ),
)); }?>
<h4>Общеобразовательные организации</h4>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'users-grid',
    'type'=>'striped bordered condensed',
    'enableSorting'=>false,
    'dataProvider'=>$sosh,
    'summaryText'=>'',
    //'htmlOptions'=> array('style'=>'width:600px;'),
    'columns'=>array(
        array(
            'header'=>'№',
            'value' => '$row+1',
            'htmlOptions'=> array('style'=>'width:20px;'),
        ),        
        array(
            'header'=>'Организация',
            'type'=>'html',
            'value' => '$data["naim"]',
            'footer' => '<b>'.$itog[2][0].'</b>',
        ),        
        array(
            'header'=>'Число зданий',
            'value' => '$data["build"]',
            'htmlOptions'=> array('style'=>'width:100px;'),
            'footer' => '<b>'.$itog[2][1].'</b>',
        ), 
        array(
            'header'=>'Дошк.',
            'value' => '$data["build1"]',
            'footer' => '<b>'.$itog[2][2].'</b>'
        ),
        array(
            'header'=>'Общ.',
            'value' => '$data["build2"]',
            'footer' => '<b>'.$itog[2][3].'</b>'
        ),
        array(
            'header'=>'Доп.',
            'value' => '$data["build3"]',
            'footer' => '<b>'.$itog[2][4].'</b>'
        ),        
    ),
)); ?>
<?php if($dod->itemCount) { ?>
<h4>Организации дополнительного образования детей</h4>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'users-grid',
    'type'=>'striped bordered condensed',
    'enableSorting'=>false,
    'dataProvider'=>$dod,
    'summaryText'=>'',
    //'htmlOptions'=> array('style'=>'width:600px;'),
    'columns'=>array(
        array(
            'header'=>'№',
            'value' => '$row+1',
            'htmlOptions'=> array('style'=>'width:20px;'),
        ),        
        array(
            'header'=>'Организация',
            'type'=>'html',
            'value' => '$data["naim"]',
            'footer' => '<b>'.$itog[3][0].'</b>',
        ),        
        array(
            'header'=>'Число зданий',
            'value' => '$data["build"]',
            'htmlOptions'=> array('style'=>'width:100px;'),            
            'footer' => '<b>'.$itog[3][1].'</b>',
        ),
        array(
            'header'=>'Дошк.',
            'value' => '$data["build1"]',
            'footer' => '<b>'.$itog[3][2].'</b>'
        ),
        array(
            'header'=>'Общ.',
            'value' => '$data["build2"]',
            'footer' => '<b>'.$itog[3][3].'</b>'
        ),
        array(
            'header'=>'Доп.',
            'value' => '$data["build3"]',
            'footer' => '<b>'.$itog[3][4].'</b>'
        ),        
    ),
)); }?>
