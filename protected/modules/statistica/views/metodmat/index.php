<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend><?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php if(Yii::app()->session['type_adm'] > 2) echo '<p><i class="cus-page-excel"></i>'.CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/metodmat/excel&id_rep_type='.$id_rep_type).'</p>'; ?>