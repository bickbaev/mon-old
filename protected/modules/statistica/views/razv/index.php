<?php
$this->pageTitle=Yii::app()->name . ' - Программы развития ООУ';
?>
<legend><?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
  <thead>
      <tr>
        <th rowspan="3" scope="col" width="200">Управление</th>
        <th rowspan="3" scope="col">Количество учреждений имеющих программу развития </th>
        <th colspan="7" scope="col">Из общего количества учреждений имеющих программу развития:</th>
      </tr>
      <tr>
        <th colspan="5" style="text-align: center;">Год окончания программы развития</th>
        <th rowspan="2" style="text-align: center;">Программа утверждена органом государственно-общественного управления образовательным учреждением</th>
        <th rowspan="2" style="text-align: center;">Программа развития прошла экспертизу</th>
      </tr>
      <tr>
        <th>2012</th>
        <th>2013</th>
        <th>2014</th>
        <th>2015</th>
        <th>2016 и позднее</th>
      </tr>
  </thead>
  <?php
    for($i = 0; $i < sizeof($okrug); $i++) {
        echo '<tr>';
        echo '<td>'.CHtml::link($okrug[$i]['est_name'], 'index.php?r=statistica/razv/razv_upr&id_okr='.$okrug[$i]['id_est'].'&id_rep_type='.$id_rep_type).'</td>';
        if($okrug[$i]['kol']) echo '<td style="text-align: center;">'.$okrug[$i]['razv'].' ('. sprintf("%.2f", $okrug[$i]['razv']*100/$okrug[$i]['kol']).'%)</td>';
        else echo '<td style="text-align: center;">0</td>';
        echo '<td style="text-align: center;">'.$okrug[$i]['razv_11'].'</td>';
        echo '<td style="text-align: center;">'.$okrug[$i]['razv_12'].'</td>';
        echo '<td style="text-align: center;">'.$okrug[$i]['razv_13'].'</td>';
        echo '<td style="text-align: center;">'.$okrug[$i]['razv_14'].'</td>';
        echo '<td style="text-align: center;">'.$okrug[$i]['razv_15'].'</td>';
        echo '<td style="text-align: center;">'.$okrug[$i]['sovet'].'</td>';
        echo '<td style="text-align: center;">'.$okrug[$i]['expert'].'</td>';
        echo '</tr>';
    }
    echo '<tr style="font-weight:bold;">';
    echo '<td>Область</td>';
    if($oblast['kol']) echo '<td style="text-align: center;">'.$oblast['razv'].' ('.sprintf("%.2f", $oblast['razv']*100/$oblast['kol']).'%)</td>';
    else echo '<td style="text-align: center;">&nbsp;</td>';
    echo '<td style="text-align: center;">'.$oblast['razv_11'].'</td>';
    echo '<td style="text-align: center;">'.$oblast['razv_12'].'</td>';
    echo '<td style="text-align: center;">'.$oblast['razv_13'].'</td>';
    echo '<td style="text-align: center;">'.$oblast['razv_14'].'</td>';
    echo '<td style="text-align: center;">'.$oblast['razv_15'].'</td>';
    echo '<td style="text-align: center;">'.$oblast['sovet'].'</td>';
    echo '<td style="text-align: center;">'.$oblast['expert'].'</td>';
    echo '</tr>';
  ?>
</table>
<p><i class="icon-list-alt"></i><?php echo CHtml::link('Сводный отчет по муниципалитетам', 'index.php?r=statistica/razv/podr_mun&id_rep_type='.$id_rep_type); ?></p>