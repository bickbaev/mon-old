<?php
$this->pageTitle=Yii::app()->name.' - Контактные данные операторов';
?>
<legend><?php echo $est_inf['est_name']; ?>. Контактные данные операторов</legend>
<?php
$names = array(1 => 'Дошкольные образовательные учреждения', 2 => 'Общеобразовательные учреждения', 3 => 'Учреждения дополнительного образования детей', 4 => 'Учреждения начального профессионального образования', 5 => 'Учреждения среднего профессионального образования', 6 => 'Специальные (коррекционные) образовательные учреждения');
for ($i = 1; $i < sizeof($uch); $i++) {
    if(sizeof($uch[$i])) {
        echo '<h5>'.$names[$i].'</h5>';
        echo '<table class="table table-striped table-bordered table-condensed">
            <thead>
            <th scope="col">Наименование учреждения </th>
            <th width="230" scope="col">ФИО оператора</th>
            <th width="200" scope="col">Контакты</th>
            <th width="60" scope="col">Кабинет</th>
            </thead>';
    }
    for ($k = 0; $k < sizeof($uch[$i]); $k++) {
        echo '<tr>';
        if(sizeof($uch[$i][$k]['oper'])) {
            echo '<td rowspan="'.sizeof($uch[$i][$k]['oper']).'">'.$uch[$i][$k]['est_name'].'</td>';
            for ($l = 0; $l < sizeof($uch[$i][$k]['oper']); $l++) {
               if ($l == 0) {
                   echo '<td>'.$uch[$i][$k]['oper'][$l]['surname'].' '.$uch[$i][$k]['oper'][$l]['name'].' '.$uch[$i][$k]['oper'][$l]['patronymic'].'</td>';
                   echo '<td>';
                   if($uch[$i][$k]['oper'][$l]['mail']) echo CHtml::mailto($uch[$i][$k]['oper'][$l]['mail'], $uch[$i][$k]['oper'][$l]['mail']).'<br />';
                   if($uch[$i][$k]['oper'][$l]['phone']) echo 'раб. '.'('.$uch[$i][$k]['oper'][$l]['reg_cod_phone'].')'.$uch[$i][$k]['oper'][$l]['phone'].'<br />';
                   if($uch[$i][$k]['oper'][$l]['mobile_phone']) echo 'сот. '.'('.$uch[$i][$k]['oper'][$l]['reg_cod_mobile'].')'.$uch[$i][$k]['oper'][$l]['mobile_phone'];
                   echo '</td>';
                   echo '<td rowspan="'.sizeof($uch[$i][$k]['oper']).'">'.CHtml::link('Кабинет', 'index.php?r=site/cabinet&id='.$uch[$i][$k]['id_est']).'</td></tr>';
               }
               else echo '<tr><td>'.$uch[$i][$k]['oper'][$l]['surname'].' '.$uch[$i][$k]['oper'][$l]['name'].' '.$uch[$i][$k]['oper'][$l]['patronymic'].'</td><td>'.CHtml::mailto($uch[$i][$k]['oper'][$l]['mail'], $uch[$i][$k]['oper'][$l]['mail']).'<br />раб. '.'('.$uch[$i][$k]['oper'][$l]['reg_cod_phone'].')'.$uch[$i][$k]['oper'][$l]['phone'].'<br />сот. '.'('.$uch[$i][$k]['oper'][$l]['reg_cod_mobile'].')'.$uch[$i][$k]['oper'][$l]['mobile_phone'].'</td></tr>';
            }
        }
        else echo '<th>'.$uch[$i][$k]['est_name'].'</th><th>&nbsp;</th><th>&nbsp;</th><th>'.CHtml::link('Кабинет', 'index.php?r=site/cabinet&id='.$uch[$i][$k]['id_est']).'</th>';
        //echo '</tr>';
    }
    if(sizeof($uch[$i])) echo '</table>';
}
?>