<?php
$this->pageTitle=Yii::app()->name . ' - Оснащенность';
?>
<legend>Оснащенность - <?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th style="width:240px;">Муниципалитет</th>
            <th style="width:100px;">Количество школ</th>
            <th>Количество современных школ (25 и более баллов)</th>
            <th>Кол-во школ, набравших 24 балла</th>
            <th>Кол-во школ, набравших 23 балла</th>
            <th>Кол-во школ, набравших 22 балла</th>
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr>';
        if($raion[$i]['kol']) {
            $sov_p = ' ('.number_format($raion[$i]['sovr']*100/$raion[$i]['kol'], 2).'%)';
            $sov1_p = ' ('.number_format($raion[$i]['sovr_1']*100/$raion[$i]['kol'], 2).'%)';
            $sov2_p = ' ('.number_format($raion[$i]['sovr_2']*100/$raion[$i]['kol'], 2).'%)';
            $sov3_p = ' ('.number_format($raion[$i]['sovr_3']*100/$raion[$i]['kol'], 2).'%)';
        }
        else {
            $sov_p = '';
            $sov1_p = '';
            $sov2_p = '';
            $sov3_p = '';
        }
        echo '<td>'.$raion[$i]['est_name'].'</td><td>'.$raion[$i]['kol'].'</td><td>'.$raion[$i]['sovr'].$sov_p.'</td><td>'.$raion[$i]['sovr_1'].$sov1_p.'</td><td>'.$raion[$i]['sovr_2'].$sov2_p.'</td><td>'.$raion[$i]['sovr_3'].$sov3_p.'</td>';
        echo '</tr>';
    }
    if($oblast['kol']) {
    $sov_p = ' ('.number_format($oblast['sovr']*100/$oblast['kol'], 2).'%)';
    $sov1_p = ' ('.number_format($oblast['sovr_1']*100/$oblast['kol'], 2).'%)';
    $sov2_p = ' ('.number_format($oblast['sovr_2']*100/$oblast['kol'], 2).'%)';
    $sov3_p = ' ('.number_format($oblast['sovr_3']*100/$oblast['kol'], 2).'%)';
    }
    echo '<tr class="info" style="font-weight:bold;"><td>Область</td><td>'.$oblast['kol'].'</td><td>'.$oblast['sovr'].$sov_p.'</td><td>'.$oblast['sovr_1'].$sov1_p.'</td><td>'.$oblast['sovr_2'].$sov2_p.'</td><td>'.$oblast['sovr_3'].$sov3_p.'</td></tr>';
    ?>
</table>
