<?php
$this->pageTitle=Yii::app()->name.' - Сбор данных по распоряжению 188-р';
?>
<h3><?php echo $otchet['rep_name'].' - период c '.$otchet['s_date'].' по '.$otchet['f_date']; ?></h3>
<fieldset><legend>Форма 1. Отчет о проведенных мероприятиях по профилактике наркомании и связанных с ней правонарушений среди несовершеннолетних и молодежи в соответствии с показателями</legend></fieldset>
<?php for($i = 1; $i < 25; $i++) {
    if($i == 14 || $i == 15 || $i == 17 || $i == 18 || $i == 20 || $i == 21 || $i == 22) continue;
    elseif($i == 2 || $i == 8) {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'</p>';
        foreach($res[$i] as $rs) {
            echo '<p>';
            echo '<b><i>'.$rs['est_name'].'</i></b>:<br>';
            echo $rs['pok'.$i].'<br>';
            echo '</p>';
        }
    }
    else {
        echo '<p class="lead text-success">'.$labels['pok'.$i].'<br>';
        echo $res[$i].'</p>';
    }
}
?>
<fieldset><legend>Форма 2.</legend></fieldset>

<table class="table table-bordered">
  <tr>
    <td>Отчетный показатель</td>
    <td>Всего </td>
    <td>Из них несовершеннолетних</td>
  </tr>
  <tr>
    <td>Поставлено на учет</td>
    <td><?php echo $res['14']; ?></td>
    <td><?php echo $res['15']; ?></td>
  </tr>
  <tr>
    <td>В том числе за употребление наркотиков</td>
    <td><?php echo $res['17']; ?></td>
    <td><?php echo $res['18']; ?></td>
  </tr>
  <tr>
    <td>Выявлено употребляющих наркотики</td>
    <td><?php echo $res['20']; ?></td>
    <td><?php echo $res['21']; ?></td>
  </tr>
</table>