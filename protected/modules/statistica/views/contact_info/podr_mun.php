<?php
$this->pageTitle=Yii::app()->name . ' - Сводный отчет по контактным данным';
?>
<legend>Контактные данные учреждений - <?php echo ' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<?php
$uroven = array('Дошкольные образовательные учреждения', 'Общеобразовательные учреждения', 'Учреждения дополнительного образования детей', 'Учреждения начального профессионального образования', 'Учреждения среднего профессионального образования', 'Специальные (коррекционные) образовательные учреждения');
$sum = array();
for($i = 1; $i < 7; $i++) {
    $sum[$i] = array(0,0,0,0,0,0,0,0,0);
    
    echo '<table class="table table-striped table-bordered table-condensed">';
    echo '<caption><strong>'.$uroven[$i - 1].'</strong></caption>';
    echo '<thead>  
              <tr>
                <th style="width:250px;">Наименование муниципалитета (всего отчетов) </th>
                <th style="width:90px;">Сайт</th>'.
                /*<th>Публичный отчет</th>
                <th>Свидетельство об аккредитации</th>
                <th style="width:90px;">Лицензия</th>
                <th style="width:90px;">Устав</th>
                <th>Положение об органе государственно-общественного управления</th>
                <th>Положение о распределении стимулирующей части ФОТ</th>*/
              '</tr>
          </thead>';    
          for($k = 0; $k < sizeof($report[$i]); $k++) {
              echo '<tr><td>'.$report[$i][$k][0].' ('.$report[$i][$k][8].')</td>';
              $sum[$i][8] = $sum[$i][8] + $report[$i][$k][8];
              for($m = 1; $m < 2; $m++) {
                  $sum[$i][$m] = $sum[$i][$m] + ($report[$i][$k][8] - $report[$i][$k][$m]);
                  if($report[$i][$k][8]) {
                      $plus_p = number_format(($report[$i][$k][8] - $report[$i][$k][$m])*100/$report[$i][$k][8], 2);
                      $plus_p = $plus_p.' %'.'('.($report[$i][$k][8] - $report[$i][$k][$m]).')';
                  }
                  else $plus_p = '-';
                  echo '<td>'.$plus_p.'</td>';
              }
              echo '</tr>';
          }
    echo '<tr class="info" style="font-weight:bold;"><td>Область ('.$sum[$i][8].')</td>';
    for($m = 1; $m < 2; $m++) {
        if($sum[$i][8]) echo '<td>'.number_format($sum[$i][$m]*100/$sum[$i][8], 2).'%'.'('.$sum[$i][$m].')'.'</td>';
        else echo '<td>-</td>';
    }
    echo '</tr>';
    echo '</table>';
}
?>
<div style="color:white; margin-bottom: 10px;">.</div>

