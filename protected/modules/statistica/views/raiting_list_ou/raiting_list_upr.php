<?php
$this->pageTitle=Yii::app()->name . ' - Листы оценивания.'.$okrug['est_name'];
?>
<div class = "otchet_edit">Листы оценивания - <?php echo $okrug['est_name']; ?></div>
<table  width="750" border="1" cellspacing="0" cellpadding="3" class ="otchet_edit_table" >
    <tr class="head">
        <th width="200">Управление</th>
        <th>Количество директорв набравших от 35 до 44,5 баллов</th>
        <th>Количество директорв набравших более 45 баллов</th>
    </tr>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr>';
        if($raion[$i]['kol']) {
            $per_1 = ' ('.number_format($raion[$i]['per_1']*100/$raion[$i]['kol'], 2).'%)';
            $per_2 = ' ('.number_format($raion[$i]['per_1']*100/$raion[$i]['kol'], 2).'%)';
        }
        else {
            $per_1 = '';
            $per_2 = '';
        }
        echo '<th style = "text-align: left; text-indent: 7px;">'.$raion[$i]['est_name'].'</th><th style="text-align: center;">'.$raion[$i]['per_1'].$per_1.'</th><th style="text-align: center;">'.$raion[$i]['per_2'].$per_2.'</th>';
        echo '</tr>';
    }
    if($okrug['kol']) {
    $per_1 = ' ('.number_format($okrug['per_1']*100/$okrug['kol'], 2).'%)';
    $per_2 = ' ('.number_format($okrug['per_2']*100/$okrug['kol'], 2).'%)';
    }
    echo '<tr class="head"><th style = "text-align: left; text-indent: 7px;">'.$okrug['est_name'].'</th><th style="text-align: center;">'.$okrug['per_1'].$per_1.'</th><th style="text-align: center;">'.$okrug['per_2'].$per_2.'</th>';
    ?>
</table>
<div style="color:white; margin-bottom: 10px;">.</div>