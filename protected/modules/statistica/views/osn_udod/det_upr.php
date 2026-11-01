<?php
$this->pageTitle=Yii::app()->name . ' - Оснащенность всем показателям.'.$uch;
$pokazs = Osn_udod::model()->attributeLabels();
array_shift($pokazs);?>
<legend>Отчет - <?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
<?php
echo '<thead><tr><th style="width:200px;">Показатель</th>';
for($i=0; $i <sizeof($okrug); $i++) {
    echo '<th style="width:80px;">'.$okrug[$i]['est_name'].'</th>';
}
echo '<th>Область</th>';
echo '</tr></thead>';
foreach ($pokazs as $key => $pokaz) {
    if($key == 'comp' || $key == 'colcomp' || $key == 'proector' || $key == 'interact') {
        echo '<tr><td>'.$pokaz.' (среднее количество на одну школу по округу)</td>';
    }
    else echo '<tr><td>'.$pokaz.'</td>';
    for($i=0; $i <sizeof($okrug); $i++) {
        if($key == 'comp' || $key == 'colcomp' || $key == 'proector' || $key == 'interact') {
            if($okrug[$i]['col']) echo '<td style="text-align:center;">'.number_format($okrug[$i][0][$key]/$okrug[$i]['col'], 2).' шт.</td>';
            else echo '<td style="text-align:center;">&nbsp;</td>';
        }
        else {
            if($okrug[$i]['col']) echo '<td style="text-align:center;">'.number_format($okrug[$i][0][$key]*100/$okrug[$i]['col'], 2).'%</td>';  
            else echo '<td style="text-align:center;">&nbsp;</td>';
        }
    }
    if($key == 'comp' || $key == 'colcomp' || $key == 'proector' || $key == 'interact') {
        echo '<td style="background-color:#D9EDF7; text-align:center;"><strong>'.number_format($oblast[0][$key]/$oblast['col'], 2).' шт</th>';
    }
    else echo '<td style="background-color:#D9EDF7; text-align:center;"><strong>'.number_format($oblast[0][$key]*100/$oblast['col'], 2).'%</th>';
    echo '</tr>';
}
?>
</table>
<div style="color:white; margin-bottom: 10px;">.</div>