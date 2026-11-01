<?php
$this->pageTitle=Yii::app()->name.' - Сбор данных по распоряжению 188-р';
?>
<h3><?php echo $otchet['rep_name'].' - период c '.$otchet['s_date'].' по '.$otchet['f_date']; ?></h3>
<fieldset><legend>Отчет о проведенных мероприятиях по профилактике правонарушений среди лиц, проповедующих идеи экстремизма, способствующих деятельности правоохранительных органов по пресечению терроризма</legend></fieldset>
<?php for($i = 1; $i < 20; $i++) {
    if($i == 2 || $i == 5 || $i == 8 || $i == 12 || $i == 13 || $i == 14 || $i == 17 || $i == 19) {
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