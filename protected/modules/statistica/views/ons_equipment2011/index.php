<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];?>
<legend>Оснащенность ННШ <?php echo date('Y').'. Период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<p><a href="http://ons.cposo.ru/index.php?r=site/index#ons" target="_blank">Данные за 2010 - 2013 годы</a></p>
<p><i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные текущего отчета в формате Excel', 'index.php?r=statistica/ons_equipment2011/excel&id_rep_type='.$id_rep_type); ?></p>
<?php if(sizeof($o_col)) { 
echo '<fieldset><legend>Доля общеобразовательных учреждений, в которых созданы от 80 до 100% современных условий (%) за '.date('Y', strtotime($otchet['s_date'])).' год</legend></fieldset>';
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$osn,
    'summaryText'=>'',
    'columns'=>$o_col,
));
}?>
<?php if(sizeof($op_col)) { 
echo '<fieldset><legend>Доля учащихся, обучающихся в учреждениях, в которых созданы от 80 до 100% современных условий (%) за '.$god.' год</legend></fieldset>';
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$osnp,
    'summaryText'=>'',
    'columns'=>$op_col,
));
}?>
