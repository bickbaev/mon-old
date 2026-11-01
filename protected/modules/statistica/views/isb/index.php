<?php
$this->pageTitle=Yii::app()->name . ' - Индекс социального благополучия';
?>
<legend>Индекс социального благополучия - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/isb/excel&id_rep_type='.$id_rep_type); ?></p>
