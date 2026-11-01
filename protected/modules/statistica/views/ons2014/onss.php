<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend><?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<div class="row">
    <div class="span12">    
        <ul>
            <li><?php echo CHtml::link('1. Общие показатели',array('/statistica/ons2014/index', 'id'=>'1', 'id_rep_type'=>$id_rep_type)); ?></li>
            <li><?php echo CHtml::link('2. Переход на новые образовательные стандарты',array('/statistica/ons2014/index', 'id'=>'2', 'id_rep_type'=>$id_rep_type)); ?></li>
            <li><?php echo CHtml::link('3. Развитие системы поддержки талантливых детей',array('/statistica/ons2014/index', 'id'=>'3', 'id_rep_type'=>$id_rep_type)); ?></li>
            <li><?php echo CHtml::link('4. Совершенствование учительского корпуса',array('/statistica/ons2014/index', 'id'=>'4', 'id_rep_type'=>$id_rep_type)); ?></li>
            <li><?php echo CHtml::link('5. Изменение школьной инфраструктуры',array('/statistica/ons2014/index', 'id'=>'5', 'id_rep_type'=>$id_rep_type)); ?></li>
            <li><?php echo CHtml::link('6. Сохранение и укрепление здоровья школьников',array('/statistica/ons2014/index', 'id'=>'6', 'id_rep_type'=>$id_rep_type)); ?></li>
            <li><?php echo CHtml::link('7. Развитие самостоятельности школ',array('/statistica/ons2014/index', 'id'=>'7', 'id_rep_type'=>$id_rep_type)); ?></li>  
        </ul>
    </div>
</div>
<p><i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/ons2014/excel&id_rep_type='.$id_rep_type); ?></p>
<?php
if($naz) echo '<div class ="row"><button class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>';
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$gridDataProvider,
    'summaryText'=>'',
    'columns'=>$col,    
));
if($naz) echo '<div class ="row"><button class="btn btn-primary pull-right" onclick="javascript:history.back()">Назад</button></div>';
?>    
