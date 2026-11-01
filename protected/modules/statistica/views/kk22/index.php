<?php
$this->pageTitle=Yii::app()->name . ' - Мониторинг деятельности комиссий по урегулированию споров';
?>
<legend>Мониторинг деятельности комиссий по урегулированию споров - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/kk22/excel&id_rep_type='.$id_rep_type); ?></p>
