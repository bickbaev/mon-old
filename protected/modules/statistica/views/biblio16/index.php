<?php
$this->pageTitle=Yii::app()->name . ' - Мониторинг состояния библиотек';
?>
<legend>Мониторинг состояния библиотек - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/biblio16/excel&id_rep_type='.$id_rep_type); ?></p>
