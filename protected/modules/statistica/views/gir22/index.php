<?php
$this->pageTitle=Yii::app()->name . ' - Мониторинг ГИР';
?>
<legend>Мониторинг ГИР - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные по ответственным в формате Excel', 'index.php?r=statistica/gir22/excel_otv&id_rep_type='.$id_rep_type); ?><br>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные по обучающимся в формате Excel', 'index.php?r=statistica/gir22/excel&id_rep_type='.$id_rep_type); ?></p></p>
