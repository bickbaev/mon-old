<?php
$this->pageTitle=Yii::app()->name.' - '.$otchet['rep_name'];
?>
<legend><?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php 
/*if(sizeof($okr)) {
    echo '<p>Выберите управление</p><ul>';
    for($i = 0; $i < sizeof($okr); $i++) {
        echo '<li><i class="cus-page-excel"></i>'.CHtml::link($okr[$i]['est_name'], 'index.php?r=statistica/doo_3_7/excel&id_rep_type='.$id_rep_type.'&id_okr='.$okr[$i]['id_est']).'</li>';
    }
    echo '</ul>';    
}
else {
    echo '<p><i class="cus-page-excel"></i>'.CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/doo_3_7/excel&id_rep_type='.$id_rep_type.'&id_okr='.Yii::app()->session['est']).'</p>';
}*/
?>
<?php 
if(Yii::app()->session['type_adm'] > 2) {    
    echo '<p><i class="cus-page-excel"></i>'.CHtml::link('Сводные данные по муниципалитетам в формате Excel', 'index.php?r=statistica/doo_3_7/excel_mun&id_rep_type='.$id_rep_type).'</p>';    
}
if(Yii::app()->session['type_adm'] > 3) {
    //echo '<p><i class="cus-page-excel"></i>'.CHtml::link('Сводные данные по области в формате Excel', 'index.php?r=statistica/doo_3_7/excel&id_rep_type='.$id_rep_type.'&id_okr=0').'</p>';    
}
?>