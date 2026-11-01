<?php $this->pageTitle=Yii::app()->name.' - Статистика по заполнению отчетов'; ?>
<?php $type = array('Месячный', 'Квартальный', 'Годовой', 'Полный'); ?>
<legend>Статистика по заполнению отчетов</legend>
    <?php if(sizeof($report)) { ?>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Таблица</th>
            <th colspan="2" scope="col" style="text-align: center;">Период</th>
            <th>Тип таблицы</th>
            <th>Просмотр</th>
        </tr>
    </thead>
<?php
    for($i = 0; $i < sizeof($report);$i++) {
        echo '<tr><td style="width: 600px;">'.$report[$i]['rep_name'].'</td><td>'.$report[$i]['s_date'].'</td><td>'.$report[$i]['f_date'].'</td><td>'.$type[$report[$i]['date_type']].'</td><td>'.CHtml::image('/images/view.png').CHtml::link('Просмотр','index.php?r=report/stat_podr&id_rep_type='.$report[$i]['id_rep_type'].'&id_est='.$id_est).'</td></tr>';
    }
}
?>
</table>
