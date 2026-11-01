<?php
$this->pageTitle=Yii::app()->name . ' - Оснащенность';
?>
<div class = "otchet_edit">Листы оценивания - <?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></div>
<table  width="750" border="1" cellspacing="0" cellpadding="3" class ="otchet_edit_table" >
    <tr class="head">
        <th width="200">Управление</th>
        <th>Количество директорв набравших от 35 до 44,5 баллов</th>
        <th>Количество директорв набравших более 45 баллов</th>
    </tr>
    <?php
    for($i = 0; $i < sizeof($okrug); $i++) {
        echo '<tr>';
        if($okrug[$i]['kol']) {
            $per_1 = ' ('.number_format($okrug[$i]['per_1']*100/$okrug[$i]['kol'], 2).'%)';
            $per_2 = ' ('.number_format($okrug[$i]['per_1']*100/$okrug[$i]['kol'], 2).'%)';
        }
        else {
            $per_1 = '';
            $per_2 = '';
        }
        echo '<th style = "text-align: left; text-indent: 7px;">'.CHtml::link($okrug[$i]['est_name'], 'index.php?r=statistica/raiting_list_ou/raiting_list_upr&id_okr='.$okrug[$i]['id_est'].'&id_rep_type='.$id_rep_type).'</th><th style="text-align: center;">'.$okrug[$i]['per_1'].$per_1.'</th><th style="text-align: center;">'.$okrug[$i]['per_2'].$per_2.'</th>';
        echo '</tr>';
    }
    if($oblast['kol']) {
    $per_1 = ' ('.number_format($oblast['per_1']*100/$oblast['kol'], 2).'%)';
    $per_2 = ' ('.number_format($oblast['per_2']*100/$oblast['kol'], 2).'%)';
    }
    echo '<tr class="head"><th style = "text-align: left; text-indent: 7px;">Область</th><th style="text-align: center;">'.$oblast['per_1'].$per_1.'</th><th style="text-align: center;">'.$oblast['per_2'].$per_2.'</th>';
    ?>
</table>