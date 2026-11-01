<?php $this->pageTitle=Yii::app()->name.' - Статистика по заполнению отчета'; ?>
<legend>Статистика по заполнению отчета "<?php echo $report_name['rep_name'].'" период с '.$report_name['s_date'].' по '.$report_name['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Округ</th>
            <th>Новый</th>
            <th>Заполнен</th>
            <th>Доработать</th>
            <th>Заполнен, заблокирован</th>
            <th>Принят</th>
            <th>Всего отчетов</th>
        </tr>
    </thead>        
<?php
    //print_r($report_name);
    for($i = 0; $i < sizeof($report);$i++) {
        $rep_col = array_sum(array_slice($report[$i], 1, 6));
        echo '<tr><td>'.$report[$i][0].'</td>';
        for($k = 1; $k < 7; $k++) {
            if($k == 5) continue;
            if ($report[$i][$k]) echo '<td>'.CHtml::link($report[$i][$k],'index.php?r=report/rep_isp&id_rep_type='.$id_rep_type.'&id_est='.$report[$i][8].'&status='.$k).'</td>';
            else echo '<td>'.$report[$i][$k].'</td>';
            $sum[$k] = $sum[$k] + $report[$i][$k];
        }
        echo '<td>'.$rep_col.'</td>';
    }
    echo '<tr class="info"><td>Управление</td>';
    for($i = 1; $i < 7;$i++) {
        if($i == 5) continue;
        echo '<td>'.$sum[$i].'</td>';
    }
    echo '<td>'.array_sum($sum).'</td></tr>';
?>
</table>
