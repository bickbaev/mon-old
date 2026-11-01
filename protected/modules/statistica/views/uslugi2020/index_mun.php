<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend><?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php 
if(sizeof($mun)) {
echo '<p>Выберите муниципалитет</p><ul>';
for($i = 0; $i < sizeof($mun); $i++) {
    echo '<li><i class="cus-page-excel"></i>'.CHtml::link($mun[$i]['est_name'], 'index.php?r=statistica/uslugi2020/excel_mun&id_rep_type='.$id_rep_type.'&id_mun='.$mun[$i]['id_est']).'</li>';
}
echo '</ul>';    
}
?>
