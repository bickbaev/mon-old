<?php
$this->pageTitle=Yii::app()->name . ' - Информация о проведении мероприятий в новогодние каникулы';
?>
<legend>Информация о проведении мероприятий в новогодние каникулы - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/mnk19/excel&id_rep_type='.$id_rep_type); ?></p>
