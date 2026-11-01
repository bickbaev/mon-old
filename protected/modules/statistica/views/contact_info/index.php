<?php
$this->pageTitle=Yii::app()->name . ' - Контактные данные учреждений. Выберите управление';
?>
<legend>Контактные данные учреждений - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<p>Выберите управление</p>
<ul>
<?php
for($i = 0; $i < sizeof($okrug); $i++) {
    echo '<li>'.CHtml::link($okrug[$i]['est_name'], 'index.php?r=statistica/contact_info/contact_upr&id_okr='.$okrug[$i]['id_est'].'&id_rep_type='.$id_rep_type).'</li>';
}
?>
</ul>
<p><i class="icon-list-alt"></i><?php echo CHtml::link('Сводный отчет по управлениям', 'index.php?r=statistica/contact_info/podr&id_rep_type='.$id_rep_type); ?><br />
<i class="icon-list-alt"></i><?php echo CHtml::link('Сводный отчет по муниципалитетам', 'index.php?r=statistica/contact_info/podr_mun&id_rep_type='.$id_rep_type); ?><br />
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/contact_info/con_excel&id_rep_type='.$id_rep_type); ?></p>