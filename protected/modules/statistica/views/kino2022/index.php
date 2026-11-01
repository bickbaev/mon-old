<?php
$this->pageTitle=Yii::app()->name . ' - Киноуроки в школе';
?>
<legend>Киноуроки в школе - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/kino2022/excel&id_rep_type='.$id_rep_type); ?></p>
