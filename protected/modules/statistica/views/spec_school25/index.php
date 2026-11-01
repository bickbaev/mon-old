<?php
$this->pageTitle=Yii::app()->name . ' - Создание специальных условий (ОО)';
?>
<legend>Создание специальных условий (ОО) - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/spec_school25/excel&id_rep_type='.$id_rep_type); ?></p>
