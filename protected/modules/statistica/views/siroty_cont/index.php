<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend><?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php if(Yii::app()->session['type_adm'] > 2) echo '<p><i class="cus-page-excel"></i>'.CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/siroty_cont/excel&id_rep_type='.$id_rep_type).'</p>'; ?>
<?php if(Yii::app()->session['type_adm'] > 3) echo '<p><i class="cus-page-excel"></i>'.CHtml::link('Сводные данные по округам в формате Excel', 'index.php?r=statistica/siroty_cont/excel_okr&id_rep_type='.$id_rep_type).'</p>'; ?>