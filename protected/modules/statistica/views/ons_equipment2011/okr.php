<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];?>
<legend>Оснащенность ННШ <?php echo date('Y').'. Период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php if(sizeof($o_col)) { 
if($type == 1) echo '<fieldset><legend>Доля общеобразовательных учреждений, в которых созданы от 80 до 100% современных условий (%) за '.date('Y', strtotime($otchet['s_date'])).' год</legend></fieldset>';
else echo '<fieldset><legend>Доля учащихся, обучающихся в учреждениях, в которых созданы от 80 до 100% современных условий (%) за '.date('Y', strtotime($otchet['s_date'])).' год</legend></fieldset>';
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$osn,
    'summaryText'=>'',
    'columns'=>$o_col,
));
}?>