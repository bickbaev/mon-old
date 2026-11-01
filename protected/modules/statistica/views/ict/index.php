<?php
$this->pageTitle=Yii::app()->name . ' - ИКТ';
?>
<legend>ИКТ - <?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<p><i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/ict/ict_excel&id_rep_type='.$id_rep_type); ?></p>