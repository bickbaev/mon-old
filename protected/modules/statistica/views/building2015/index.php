<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend>Отчет "<?php echo $otchet['rep_name'].'" период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php if(Yii::app()->session['type_adm'] > 2) echo '<p><i class="cus-page-excel"></i>'.CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/building2015/excel&id_rep_type='.$id_rep).'</p>'; ?>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id'=>'users-grid',
    'type'=>'striped bordered condensed',
    'enableSorting'=>false,
    'dataProvider'=>$provider,
    'summaryText'=>'',
    //'htmlOptions'=> array('style'=>'width:600px;'),
    'columns'=>array(
        array(
            'header'=>'Управление',
            'type'=>'html',
            'value' => '$data["okr"]',            
        ),        
        array(
            'header'=>'Муниципалитет',
            'type'=>'html',
            'value' => '$data["mun"]',
            'footer' => '<b>'.$itog[0].'</b>'
        ),        
        array(
            'header'=>'Число зданий',
            'value' => '$data["build"]',
            'footer' => '<b>'.$itog[1].'</b>'
        ),
        array(
            'header'=>'Дошк.',
            'value' => '$data["build1"]',
            'footer' => '<b>'.$itog[5].'</b>'
        ),
        array(
            'header'=>'Общ.',
            'value' => '$data["build2"]',
            'footer' => '<b>'.$itog[6].'</b>'
        ),
        array(
            'header'=>'Доп.',
            'value' => '$data["build3"]',
            'footer' => '<b>'.$itog[7].'</b>'
        ),        
        array(
            'header'=>'Среднее доля выполненных условий, %',
            'value' => '$data["sr"]',
            'footer' => '<b>'.$itog[2].'</b>'
        ),        
        array(
            'header'=>'Число зданий, отвечающих 100% условий',
            'value' => '$data["sto"]',
            'footer' => '<b>'.$itog[3].'</b>'
        ),
        array(
            'header'=>'Число зданий, отвечающих 80-100% условий',
            'value' => '$data["sem"]',
            'footer' => '<b>'.$itog[4].'</b>'
        ),         
    ),
)); ?>

