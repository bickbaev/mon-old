<?php
$this->pageTitle=Yii::app()->name . ' - Информация о затратах на информатизацию';
?>
<legend>Информация о затратах на информатизацию - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 3) echo CHtml::link('Все данные', 'index.php?r=statistica/inf23/excel&id_rep_type='.$id_rep_type); ?></p>
