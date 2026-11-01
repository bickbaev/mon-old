<?php
$this->pageTitle=Yii::app()->name.' - Сбор данных по распоряжению 188-р';
?>
<h3><?php echo $otchet['rep_name'].' - период c '.$otchet['s_date'].' по '.$otchet['f_date']; ?></h3>
<!--<fieldset><legend>Форма 1. Аналитическая справка о проведенных в образовательной организации мероприятиях по профилактике правонарушений среди молодежи</legend></fieldset>-->
<?php /*for($i = 1; $i < 9; $i++) {
    echo '<p class="lead text-success">'.$labels['pok'.$i].'</p>';
    foreach($res[$i] as $rs) {
        echo '<p>';
        echo '<b><i>'.$rs['est_name'].'</i></b>:<br>';
        echo $rs['pok'.$i].'<br>';
        echo '</p>';
    }
}*/
?>
<fieldset><legend>Форма 2. Отчет о проведенных мероприятиях</legend></fieldset>
<?php 
//echo '<p>';
for($i = 9; $i < 51; $i++) {
    if($i > 23 && $i < 48) continue;
    elseif($i == 12 || $i == 15 || $i == 49) {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'</p>';
        if(is_array($res[$i])) {
            foreach($res[$i] as $rs) {
                echo '<p>';
                echo '<b><i>'.$rs['est_name'].'</i></b>:<br>';
                echo $rs['pok'.$i].'<br>';
                echo '</p>';
            }
        }
    }
    else {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'<br>';
        echo $res[$i].'</p>';
    }
}
for($i = 63; $i < 65; $i++) {
    if($i == 64) {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'</p>';
        if(is_array($res[$i])) {
            foreach($res[$i] as $rs) {
                echo '<p>';
                echo '<b><i>'.$rs['est_name'].'</i></b>:<br>';
                echo $rs['pok'.$i].'<br>';
                echo '</p>';
            }
        }
    }
    else {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'<br>';
        echo $res[$i].'</p>';
    }
}
//echo '</p>';
?>
<fieldset><legend>Форма 3. Отчет о совершенных преступлениях и правонарушениях</legend></fieldset>

<table  class="table table-bordered">
  <tr>
    <td rowspan="2">№ п/п</td>
    <td rowspan="2">Отчетные показатели</td>
    <td rowspan="2">Всего</td>
    <td colspan="2">из них участие:</td>
  </tr>
  <tr>
    <td>несовершеннолетних</td>
    <td>состоящих на учете в ИДН</td>
  </tr>
  <tr>
    <td rowspan="3">1</td>
    <td><strong>Количество преступлений, совершенных обучаемыми</strong></td>
    <td><?php echo $res['24']; ?></td>
    <td><?php echo $res['25']; ?></td>
    <td><?php echo $res['26']; ?></td>
  </tr>
  <tr>
    <td>Количество участников</td>
    <td><?php echo $res['28']; ?></td>
    <td><?php echo $res['29']; ?></td>
    <td><?php echo $res['30']; ?></td>
  </tr>
  <tr>
    <td>Из них привлечены к уголовной  ответственности</td>
    <td><?php echo $res['32']; ?></td>
    <td><?php echo $res['33']; ?></td>
    <td><?php echo $res['34']; ?></td>
  </tr>
  <tr>
    <td rowspan="3">2</td>
    <td><strong>Количество правонарушений, совершенных обучаемыми</strong></td>
    <td><?php echo $res['36']; ?></td>
    <td><?php echo $res['37']; ?></td>
    <td><?php echo $res['38']; ?></td>
  </tr>
  <tr>
    <td>Количество участников</td>
    <td><?php echo $res['40']; ?></td>
    <td><?php echo $res['41']; ?></td>
    <td><?php echo $res['42']; ?></td>
  </tr>
  <tr>
    <td>Из них привлечены к  административной ответственности</td>
    <td><?php echo $res['44']; ?></td>
    <td><?php echo $res['45']; ?></td>
    <td><?php echo $res['46']; ?></td>
  </tr>     
</table>

<?php 
//echo '<p>';
for($i = 51; $i < 63; $i++) {
    if($i == 53 || $i == 55 || $i == 57 || $i == 59 || $i == 61) {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'</p>';
        if(is_array($res[$i])) {
            foreach($res[$i] as $rs) {
                echo '<p>';
                echo '<b><i>'.$rs['est_name'].'</i></b>:<br>';
                echo $rs['pok'.$i].'<br>';
                echo '</p>';
            }
        }
    }
    else {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'<br>';
        echo $res[$i].'</p>';
    }
}
//echo '</p>';
