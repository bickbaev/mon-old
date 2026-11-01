<?php
$this->pageTitle=Yii::app()->name . ' - Проверка ссылок контактных данных учреждений';
?>
<legend>Проверка ссылок контактных данных учреждений - <?php echo $okrug.' - период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>

<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Учреждение</th>
            <th style="width:200px;">Сайт</th>
            <th style="width:200px;">E-mail</th>
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr><td colspan="11"><strong>'.$raion[$i]['est_name'].'</strong></td></tr>';
        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
            if($raion[$i]['reports'][$k]['znach']['site']) $raion[$i]['reports'][$k]['znach']['site'] = CHtml::link($raion[$i]['reports'][$k]['znach']['site'], $raion[$i]['reports'][$k]['znach']['site']); else $raion[$i]['reports'][$k]['znach']['site'] = '<span style="color:red">Сайта нет</span>';
            if($raion[$i]['reports'][$k]['znach']['mail']) $raion[$i]['reports'][$k]['znach']['mail'] = CHtml::mailto($raion[$i]['reports'][$k]['znach']['mail']); else $raion[$i]['reports'][$k]['znach']['mail'] = '<span style="color:red">Электронной почты нет</span>';
            echo '<tr>';
            echo '<td>'.$raion[$i]['reports'][$k]['est_name'].'</td>';
            echo '<td style="width:200px;">'.$raion[$i]['reports'][$k]['znach']['site'].'</td>';
            echo '<td style="width:200px;">'.$raion[$i]['reports'][$k]['znach']['mail'].'</td>';
            echo '</tr>';
        }
    }
    ?>
</table>