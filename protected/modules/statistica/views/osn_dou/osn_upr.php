<?php
$this->pageTitle=Yii::app()->name . ' - Оснащенность ДОУ.'.$okrug;
?>
<legend>Оснащенность ДОУ - <?php echo $okrug; ?></legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Учреждение</th>
            <th>Количество баллов</th>
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($raion); $i++) {
        echo '<tr><td colspan="2"><strong>'.$raion[$i]['est_name'].'<strong></td></tr>';
        for($k = 0; $k < sizeof($raion[$i]['reports']); $k++) {
            if($raion[$i]['reports'][$k]['sum'] > 26) echo '<tr class="success">';
            else echo '<tr>';
            echo '<td>'.CHtml::link($raion[$i]['reports'][$k]['est_name'], 'index.php?r=statistica/osn_dou/osn_uch&id_est='.$raion[$i]['reports'][$k]['id_est'].'&id_report='.$raion[$i]['reports'][$k]['id_report']).'</td><td style="text-align: center;">'.$raion[$i]['reports'][$k]['sum'].'</td></tr>';
        }
    }
    ?>
</table>
<div style="color:white; margin-bottom: 10px;">.</div>