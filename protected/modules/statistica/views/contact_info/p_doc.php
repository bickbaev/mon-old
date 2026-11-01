<?php
$this->pageTitle=Yii::app()->name . ' - Контактные данные учреждений';
?>
<legend>Проверка ссылок документов - <?php echo $okrug.' - период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>

<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Учреждение</th>
            <th>Документы</th>
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr><td colspan="11"><strong>'.$raion[$i]['est_name'].'</strong></td></tr>';
        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
            if($raion[$i]['reports'][$k]['znach']['publ']) $raion[$i]['reports'][$k]['znach']['publ'] = CHtml::link($raion[$i]['reports'][$k]['znach']['publ'], $raion[$i]['reports'][$k]['znach']['publ']); else $raion[$i]['reports'][$k]['znach']['publ'] = '<span style="color:red">Отчета о самообследовании нет</span>';
            if($raion[$i]['reports'][$k]['znach']['akkr']) $raion[$i]['reports'][$k]['znach']['akkr'] = CHtml::link($raion[$i]['reports'][$k]['znach']['akkr'], $raion[$i]['reports'][$k]['znach']['akkr']); else $raion[$i]['reports'][$k]['znach']['akkr'] = '<span style="color:red">Свидетельства об аккредитации нет</span>';
            if($raion[$i]['reports'][$k]['znach']['lic']) $raion[$i]['reports'][$k]['znach']['lic'] = CHtml::link($raion[$i]['reports'][$k]['znach']['lic'], $raion[$i]['reports'][$k]['znach']['lic']); else $raion[$i]['reports'][$k]['znach']['lic'] = '<span style="color:red">Лицензии нет</span>';
            if($raion[$i]['reports'][$k]['znach']['ustav']) $raion[$i]['reports'][$k]['znach']['ustav'] = CHtml::link($raion[$i]['reports'][$k]['znach']['ustav'], $raion[$i]['reports'][$k]['znach']['ustav']); else $raion[$i]['reports'][$k]['znach']['ustav'] = '<span style="color:red">Устава нет</span>';
            //if($raion[$i]['reports'][$k]['znach']['gos']) $raion[$i]['reports'][$k]['znach']['gos'] = CHtml::link($raion[$i]['reports'][$k]['znach']['gos'], $raion[$i]['reports'][$k]['znach']['gos']); else $raion[$i]['reports'][$k]['znach']['gos'] = '<span style="color:red">Положения об органе государственно-общественного управления нет</span>';
            //if($raion[$i]['reports'][$k]['znach']['opl']) $raion[$i]['reports'][$k]['znach']['opl'] = CHtml::link($raion[$i]['reports'][$k]['znach']['opl'], $raion[$i]['reports'][$k]['znach']['opl']); else $raion[$i]['reports'][$k]['znach']['opl'] = '<span style="color:red">Положения о распределении стимулирующей части ФОТ нет</span>';
            echo '<tr>';
            echo '<td>'.$raion[$i]['reports'][$k]['est_name'].'</td>';
            //echo '<td>Отчет о самообследовании<br />'.$raion[$i]['reports'][$k]['znach']['publ'].'<br />Cвидетельство об аккредитации<br />'.$raion[$i]['reports'][$k]['znach']['akkr'].'<br />Лицензия<br />'.$raion[$i]['reports'][$k]['znach']['lic'].'<br />Устав<br />'.$raion[$i]['reports'][$k]['znach']['ustav'].'<br />Положение об органе ГОУ<br />'.$raion[$i]['reports'][$k]['znach']['gos'].'<br />Положение о стимулирующей части ФОТ<br />'.$raion[$i]['reports'][$k]['znach']['opl'].'</td>';
            echo '<td>Отчет о самообследовании<br />'.$raion[$i]['reports'][$k]['znach']['publ'].'<br />Cвидетельство об аккредитации<br />'.$raion[$i]['reports'][$k]['znach']['akkr'].'<br />Лицензия<br />'.$raion[$i]['reports'][$k]['znach']['lic'].'<br />Устав<br />'.$raion[$i]['reports'][$k]['znach']['ustav'].'</td>';
            echo '</tr>';
        }
    }
    ?>
</table>

