<?php $this->pageTitle=Yii::app()->name.' - Статистика по заполнению отчета'; ?>
<legend>Статистика по заполнению отчета "<?php echo $report_name['rep_name'].'" период с '.$report_name['s_date'].' по '.$report_name['f_date'] ;?></legend>
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
            <th>Действие</th>
        </tr>
    </thead>        
<?php
    //print_r($report_name);
    for($i = 0; $i < sizeof($report);$i++) {        
        $rep_col = array_sum(array_slice($report[$i], 1, 6));
        echo '<tr><td>'.$report[$i][0].'</td>';
        for($k = 1; $k < 7; $k++) {
            if($k == 5) continue;
            echo '<td>'.$report[$i][$k].'</td>';
            $sum[$k] = $sum[$k] + $report[$i][$k];
        }
        echo '<td>'.$rep_col.'</td>';
        if($rep_col) echo '<td style="width:120px;">'.CHtml::image('/images/view.png').CHtml::link('Просмотр','index.php?r=report/stat_podr&id_rep_type='.$id_rep_type.'&id_est='.$report[$i][8]).'</td></tr>';
        else echo '<td>&nbsp;</td>';
    }
    echo '<tr class="info"><td>Область</td>';
    for($i = 1; $i < 7;$i++) {
        if($i == 5) continue;
        echo '<td>'.$sum[$i].'</td>';
    }
    echo '<td>'.array_sum($sum).'<td>&nbsp;</td></td></tr>';
?>
</table>
