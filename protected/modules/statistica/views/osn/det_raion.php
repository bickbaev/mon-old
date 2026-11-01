<?php
$this->pageTitle=Yii::app()->name . ' - Оснащенность всем показателям.'.$uch;
$pokazs = Osn::model()->attributeLabels();
array_shift($pokazs);?>
<legend>Отчет - <?php echo $otchet['rep_name'].' период '.$otchet['s_date'].'-'.$otchet['f_date']; ?></legend>
<table class="table table-striped table-bordered table-condensed">
<?php
echo '<thead><tr><th style="width:200px;">Показатель</th>';
for($i=0; $i <sizeof($raion); $i++) {
    echo '<th style="width:80px;">'.$raion[$i]['est_name'].'</th>';
}
echo '<th>Область</th>';
echo '</tr></thead>';
foreach ($pokazs as $key => $pokaz) {
    if($key == 'kompclass' || $key == 'kompsert' || $key == 'proektor' || $key == 'doska') {
        echo '<tr><td>'.$pokaz.' (среднее количество на одну школу по району)</td>';
    }
    else echo '<tr><td>'.$pokaz.'</td>';
    for($i=0; $i <sizeof($raion); $i++) {
        if($key == 'kompclass' || $key == 'kompsert' || $key == 'proektor' || $key == 'doska') {
            echo '<td style="text-align:center;">'.number_format($raion[$i][0][$key]/$raion[$i]['col'], 2).' шт.</td>';
        }
        else echo '<td style="text-align:center;">'.number_format($raion[$i][0][$key]*100/$raion[$i]['col'], 2).'%</td>';
    }
    if($key == 'kompclass' || $key == 'kompsert' || $key == 'proektor' || $key == 'doska') {
        echo '<td style="background-color:#D9EDF7; text-align:center;"><strong>'.number_format($oblast[0][$key]/$oblast['col'], 2).' шт</strong></td>';
    }
    else echo '<td style="background-color:#D9EDF7; text-align:center;"><strong>'.number_format($oblast[0][$key]*100/$oblast['col'], 2).'%</strong></td>';
    echo '</tr>';
}
?>
</table>