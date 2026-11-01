<?php
$this->pageTitle=Yii::app()->name.' - Контактные данные операторов';
?>
<legend>Контактные данные операторов</legend>
<table class="table table-striped table-bordered table-condensed">
    <thead>
    <th width="200" scope="col">Наименование управления </th>
    <th scope="col">ФИО </th>
    <th scope="col">Контакты</th>
    <th scope="col">Кабинет</th>
  </thead>
<?php
for ($i = 0; $i < sizeof($ests); $i++) {
    echo '<tr>';
    echo '<td rowspan="'.sizeof($ests[$i]['oper']).'">'.CHtml::link($ests[$i]['est_name'], 'index.php?r=report/sprav&id_est='.$ests[$i]['id_est']).'</td>';
    for ($k = 0; $k < sizeof($ests[$i]['oper']); $k++) {
       if ($k == 0) echo '<td>'.$ests[$i]['oper'][$k]['surname'].' '.$ests[$i]['oper'][$k]['name'].' '.$ests[$i]['oper'][$k]['patronymic'].'</td><td>'.CHtml::mailto($ests[$i]['oper'][$k]['mail'], $ests[$i]['oper'][$k]['mail']).'<br />раб. '.'('.$ests[$i]['oper'][$k]['reg_cod_phone'].')'.$ests[$i]['oper'][$k]['phone'].'<br />сот. '.'('.$ests[$i]['oper'][$k]['reg_cod_mobile'].')'.$ests[$i]['oper'][$k]['mobile_phone'].'</td><td rowspan="'.sizeof($ests[$i]['oper']).'">'.CHtml::link('Кабинет', 'index.php?r=site/cabinet&id='.$ests[$i]['id_est']).'</td></tr>';
       else echo '<tr><td>'.$ests[$i]['oper'][$k]['surname'].' '.$ests[$i]['oper'][$k]['name'].' '.$ests[$i]['oper'][$k]['patronymic'].'</td><td>'.CHtml::mailto($ests[$i]['oper'][$k]['mail'], $ests[$i]['oper'][$k]['mail']).'<br />раб. '.'('.$ests[$i]['oper'][$k]['reg_cod_phone'].')'.$ests[$i]['oper'][$k]['phone'].'<br />сот. '.'('.$ests[$i]['oper'][$k]['reg_cod_mobile'].')'.$ests[$i]['oper'][$k]['mobile_phone'].'</td></tr>';
    }
    echo '</tr>';
}
?>
</table>
<div style="color: white; margin-bottom: 10px;">.</div>
