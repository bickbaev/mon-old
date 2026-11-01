<?php $this->pageTitle=Yii::app()->name.' - Статистика заполнения отчета'; ?>
<legend>Статистика по заполнению отчета "<?php echo $rep_name['rep_name'].'" период с '.$rep_name['s_date'].' по '.$rep_name['f_date'] ;?></legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Статус</th>
            <th>Учреждение</th>
            <th>Действия</th>
        </tr>
    </thead>        
<?php
$td_status = array('1'=>'<td style="background-color: red; width:140px;">Новый</td>',
                    '2'=>'<td style="background-color: #FF6A00; width:140px;">Заполнен</td>', 
                    '3'=>'<td style="background-color: #FF006E; width:140px;">Доработать</td>', 
                    '4'=>'<td style="background-color: #4CFF00; width:140px;">Заполнен, блокирован</td>', 
                    '5'=>'<td style="background-color: #CCFFF7; width:140px;">На согласовании</td>', 
                    '6'=>'<td style="width:140px;">Принят</td>');
$rep_deistv = array(
    array('Редактировать', 'index.php?r=report/edit&id_rep=', '/images/edit.png'),
    array('Заблокировать', 'index.php?r=report/block&id_rep=', '/images/prov.png'),
    array('Доработать', 'index.php?r=report/dorab&id_rep=', '/images/dorab.png'),
    array('Разблокировать', 'index.php?r=report/razb&id_rep=', '/images/sogl.png'),
    array('Принять', 'index.php?r=report/prin&id_rep=', '/images/prin.png'),
    array('Просмотр', 'index.php?r=report/view&id_rep=', '/images/view.png'),
);
for($n = 0; $n < sizeof($reports); $n++) {
    $deistv = '<a href="index.php?r=site/cabinet&id='.$reports[$n]['id_est'].'"><img src="./images/blog.png">Кабинет</a>';
    for ($k = 0; $k < 6; $k++) {
        if($reports[$n]['deistv'][$k]) $deistv = $deistv.' '.CHtml::image($rep_deistv[$k][2]).CHtml::link($rep_deistv[$k][0], $rep_deistv[$k][1].$reports[$n]['id_report']);
    }
    echo '<tr>'.$td_status[$reports[$n]['status']].'<td>'.$reports[$n]['est_name'].'</td><td>'.$deistv.'</td></tr>';
}
?>
</table>