<?php
$this->pageTitle=Yii::app()->name . ' - Отчет "М2012-Программы развития-ооу(У)"';
?>
<legend>Отчет "М2012-Программы развития-ооу(У)" - <?php echo $okrug.' - период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th width="150">Учреждение</th>
            <th>Учреждение имеет действующую программу развития</th>
            <th>Год начала действия программы развития образовательного учреждения</th>
            <th>Год окончания действия программы развития образовательного учреждения</th>
            <th>Программа развития образовательного учреждения утверждена (согласована) органом государственно-общественного управления учреждением (общественного участия в управлении учреждением)</th>
            <th>Дата утверждения (согласования) программы развития образовательного учреждения</th>
            <th>Наименование органа государственно-общественного управления образовательным учреждением (общественного участия в управлении учреждением), утвердивший (согласовавший) программу развития</th>
            <th>Наличие заключения по результатам экспертизы программы развития образовательного учреждения</th>
            <th>Дата проведения экспертизы</th>
            <th>Данные эксперта</th>
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr><td colspan="11"><strong>'.$raion[$i]['est_name'].'</strong></td></tr>';
        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
            if(!$raion[$i]['reports'][$k]['report'][0]['program']) $raion[$i]['reports'][$k]['report'][0]['program'] = '<span style="color:red">нет</span>';
            else $raion[$i]['reports'][$k]['report'][0]['program'] = 'да';
            if(!$raion[$i]['reports'][$k]['report'][0]['s_year']) $raion[$i]['reports'][$k]['report'][0]['s_year'] = '<span style="color:red">не указан</span>';
            if(!$raion[$i]['reports'][$k]['report'][0]['f_year']) $raion[$i]['reports'][$k]['report'][0]['f_year'] = '<span style="color:red">не указан</span>';
            if(!$raion[$i]['reports'][$k]['report'][0]['sogl']) $raion[$i]['reports'][$k]['report'][0]['sogl'] = '<span style="color:red">нет</span>';
            else $raion[$i]['reports'][$k]['report'][0]['sogl'] = 'да';
            if(!$raion[$i]['reports'][$k]['report'][0]['expert']) $raion[$i]['reports'][$k]['report'][0]['expert'] = '<span style="color:red">нет</span>';
            else $raion[$i]['reports'][$k]['report'][0]['expert'] = 'да';
            if(!$raion[$i]['reports'][$k]['report'][0]['naim_sogl']) $raion[$i]['reports'][$k]['report'][0]['naim_sogl'] = '<span style="color:red">не указан</span>';
            if($raion[$i]['reports'][$k]['report'][0]['sogl_date'] == '' || $raion[$i]['reports'][$k]['report'][0]['sogl_date'] == '00.00.0000') $raion[$i]['reports'][$k]['report'][0]['sogl_date'] = '<span style="color:red">не указана</span>';
            if($raion[$i]['reports'][$k]['report'][0]['expert_date'] == '' || $raion[$i]['reports'][$k]['report'][0]['expert_date'] == '00.00.0000') $raion[$i]['reports'][$k]['report'][0]['expert_date'] = '<span style="color:red">не указана</span>';
            if(!$raion[$i]['reports'][$k]['report'][0]['expert_fio']) $raion[$i]['reports'][$k]['report'][0]['expert_fio'] = '<span style="color:red">ФИО эксперта не указаны</span>';
            if(!$raion[$i]['reports'][$k]['report'][0]['expert_dol']) $raion[$i]['reports'][$k]['report'][0]['expert_dol'] = '<span style="color:red">Должность эксперта не указана</span>';
            if(!$raion[$i]['reports'][$k]['report'][0]['expert_mesto']) $raion[$i]['reports'][$k]['report'][0]['expert_mesto'] = '<span style="color:red">Место работы эксперта не указано</span>';
            echo '<tr style="text-align:center;">';
            echo '<td style="text-align: left;">'.$raion[$i]['reports'][$k]['est_name'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['program'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['s_year'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['f_year'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['sogl'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['sogl_date'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['naim_sogl'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['expert'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['expert_date'].'</td>';
            echo '<td>'.$raion[$i]['reports'][$k]['report'][0]['expert_fio'].'<br />'.$raion[$i]['reports'][$k]['report'][0]['expert_dol'].'<br />'.$raion[$i]['reports'][$k]['report'][0]['expert_mesto'].'</td>';
            echo '</tr>';
        }
    }
    ?>
</table>