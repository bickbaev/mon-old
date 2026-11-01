<?php
$this->pageTitle=Yii::app()->name . ' - Оснащенность учреждений дополнительного образования детей';
?>
<legend>Оснащенность учреждений дополнительного образования детей - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th style="width: 240px;">Управление</th>
            <th>Кол-во современных учреждений (21 и более баллов)</th>
            <th>Кол-во учреждений, набравших 20 баллов</th>
            <th>Кол-во учреждений, набравших 19 баллов</th>
            <th>Кол-во учреждений, набравших 18 баллов</th>
        </tr>
    </thead>
    <?php
    for($i = 0; $i < sizeof($okrug); $i++) {
        echo '<tr>';
        if($okrug[$i]['kol']) {
            $sov_p = ' ('.number_format($okrug[$i]['sovr']*100/$okrug[$i]['kol'], 2).'%)';
            $sov1_p = ' ('.number_format($okrug[$i]['sovr_1']*100/$okrug[$i]['kol'], 2).'%)';
            $sov2_p = ' ('.number_format($okrug[$i]['sovr_2']*100/$okrug[$i]['kol'], 2).'%)';
            $sov3_p = ' ('.number_format($okrug[$i]['sovr_3']*100/$okrug[$i]['kol'], 2).'%)';
        }
        else {
            $sov_p = '';
            $sov1_p = '';
            $sov2_p = '';
            $sov3_p = '';
        }
        echo '<td>'.CHtml::link($okrug[$i]['est_name'], 'index.php?r=statistica/osn_udod/osn_upr&id_okr='.$okrug[$i]['id_est'].'&id_rep_type='.$id_rep_type).'</td><td style="text-align: center;">'.$okrug[$i]['sovr'].$sov_p.'</td><td style="text-align: center;">'.$okrug[$i]['sovr_1'].$sov1_p.'</td><td style="text-align: center;">'.$okrug[$i]['sovr_2'].$sov2_p.'</td><td style="text-align: center;">'.$okrug[$i]['sovr_3'].$sov3_p.'</td>';
        echo '</tr>';
    }
    if($oblast['kol']) {
    $sov_p = ' ('.number_format($oblast['sovr']*100/$oblast['kol'], 2).'%)';
    $sov1_p = ' ('.number_format($oblast['sovr_1']*100/$oblast['kol'], 2).'%)';
    $sov2_p = ' ('.number_format($oblast['sovr_2']*100/$oblast['kol'], 2).'%)';
    $sov3_p = ' ('.number_format($oblast['sovr_3']*100/$oblast['kol'], 2).'%)';
    }
    echo '<tr class="info" style="font-weight:bold;"><td>Область</td><td style="text-align: center;">'.$oblast['sovr'].$sov_p.'</td><td style="text-align: center;">'.$oblast['sovr_1'].$sov1_p.'</td><td style="text-align: center;">'.$oblast['sovr_2'].$sov2_p.'</td><td style="text-align: center;">'.$oblast['sovr_3'].$sov3_p.'</td></tr>';
    ?>
</table>
<p><i class="icon-list-alt"></i><?php echo CHtml::link('Сводный отчет по муниципалитетам', 'index.php?r=statistica/osn_udod/podr_mun&id_rep_type='.$id_rep_type); ?><br />
<i class="icon-list-alt"></i><?php echo CHtml::link('Отчет по управлениям по всем показателям', 'index.php?r=statistica/osn_udod/det_upr&id_rep_type='.$id_rep_type); ?><br />
<i class="icon-list-alt"></i><?php echo CHtml::link('Отчет по районам по всем показателям', 'index.php?r=statistica/osn_udod/det_raion&id_rep_type='.$id_rep_type); ?><br />
<i class="cus-page-excel"></i><?php if(Yii::app()->session['type_adm'] > 2) echo CHtml::link('Все данные в формате Excel', 'index.php?r=statistica/osn_udod/osn_excel&id_rep_type='.$id_rep_type); ?></p>