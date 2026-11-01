<?php
$this->pageTitle=Yii::app()->name . ' - Мониторинг АТЗ';
?>
<legend>Мониторинг АТЗ - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php if(Yii::app()->session['type_adm'] > 2) { ?>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 1. Раздел 1', 'index.php?r=statistica/atz26/part&id_rep_type='.$id_rep_type.'&cat=1'); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 1. Раздел 2', 'index.php?r=statistica/atz26/part&id_rep_type='.$id_rep_type.'&cat=2'); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 1. Раздел 3', 'index.php?r=statistica/atz26/part&id_rep_type='.$id_rep_type.'&cat=3'); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 1. Раздел 4', 'index.php?r=statistica/atz26/part&id_rep_type='.$id_rep_type.'&cat=4'); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 1. Раздел 5', 'index.php?r=statistica/atz26/part5&id_rep_type='.$id_rep_type); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 1. Свод', 'index.php?r=statistica/atz26/svod&id_rep_type='.$id_rep_type); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 2. Раздел 1', 'index.php?r=statistica/atz26/f2_part1&id_rep_type='.$id_rep_type); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 2. Раздел 2', 'index.php?r=statistica/atz26/f2_part2&id_rep_type='.$id_rep_type); ?></p>
<i class="cus-page-excel"></i> <?php echo CHtml::link('Форма 2. Раздел 3', 'index.php?r=statistica/atz26/f2_part3&id_rep_type='.$id_rep_type); ?></p>
<?php } ?>

