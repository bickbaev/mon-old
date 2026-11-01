<?php
$this->pageTitle=Yii::app()->name . ' - Программы развития';
?>
<legend><?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th width="220">Муниципалитет</th>
            <th width="100">Количество школ</th>
            <th>Количество школ имеющих программу развития</th>
            <th>Программа утверждена органом государственно-общественного управления образовательным учреждением</th>
            <th>Программа развития прошла экспертизу </th>
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr>';
        if($raion[$i]['kol']) {
            $razv = ' ('.number_format($raion[$i]['razv']*100/$raion[$i]['kol'], 2).'%)';
            $sogl = ' ('.number_format($raion[$i]['sovet']*100/$raion[$i]['kol'], 2).'%)';
            $expert = ' ('.number_format($raion[$i]['expert']*100/$raion[$i]['kol'], 2).'%)';
            }
        else {
            $razv = '';
            $sogl = '';
            $expert = '';
        }
        echo '<td>'.$raion[$i]['est_name'].'</td><td style="text-align: center;">'.$raion[$i]['kol'].'</td><td style="text-align: center;">'.$raion[$i]['razv'].$razv.'</td><td style="text-align: center;">'.$raion[$i]['sovet'].$sogl.'</td><td style="text-align: center;">'.$raion[$i]['expert'].$expert.'</td>';
        echo '</tr>';
    }
    if($oblast['kol']) {
    $razv = ' ('.number_format($oblast['razv']*100/$oblast['kol'], 2).'%)';
    $sogl = ' ('.number_format($oblast['sovet']*100/$oblast['kol'], 2).'%)';
    $expert = ' ('.number_format($oblast['expert']*100/$oblast['kol'], 2).'%)';
    }
    echo '<tr style="font-weight:bold;"><td>Область</td><td style="text-align: center;">'.$oblast['kol'].'</td><td style="text-align: center;">'.$oblast['razv'].$razv.'</td><td style="text-align: center;">'.$oblast['sovet'].$sogl.'</td><td style="text-align: center;">'.$oblast['expert'].$expert.'</td></tr>';
    ?>
</table>