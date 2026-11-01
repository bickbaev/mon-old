<fieldset><legend>Выберите услугу (работу) и нажмите "добавить".</legend></fieldset>
<?php
echo '<b>Наименование услуги (работы)</b>: '.$uslugi[0]['pok1'].'<br>';
echo '<b>Условия оказания услуги (работы)</b>: '.$uslugi[0]['pok10'].'<br>'
?>
<table border="1" cellpadding="3" cellspacing="0" style="margin-top: 20px;">
  <col width="194">
  <col width="53">
  <col width="58">
  <col width="52">
  <col width="172">
  <col width="151">
  <col width="213">
  <col width="115">
  <col width="56">
  <tr>    
    <td colspan="7" width="680" style="text-align: center;"><small>Общая информация</small></td>
    <td rowspan="2" width="213" style="text-align: center;"><small>Содержание услуги (работы)</small></td>
    <td rowspan="2" width="115"><small>Объем услуги</small></td>
  </tr>
  <tr>
    <td width="194"><small>Уникальный реестровый номер услуги</small></td>
    <td width="53"><small>Код работы, сформированный по новому алгоритму</small></td>
    <td width="53"><small>Код услуги</small></td>
    <td width="58"><small>Тип</small></td>
    <td width="52"><small>Платность</small></td>
    <td width="172"><small>Виды учреждений</small></td>
    <td width="151"><small>Категории потребителей</small></td>
  </tr>
<?php foreach($uslugi as $usluga) {
   echo '<tr>';   
   echo '<td><small>'.$usluga['pok2'].'</small></td>';
   echo '<td><small>'.$usluga['pok3'].'</small></td>';
   echo '<td><small>'.$usluga['pok4'].'</small></td>';
   echo '<td><small>'.$usluga['pok5'].'</small></td>';
   echo '<td><small>'.$usluga['pok6'].'</small></td>';
   echo '<td><small>'.$usluga['pok7'].'</small></td>';
   echo '<td><small>'.$usluga['pok8'].'</small></td>';
   echo '<td><small>'.$usluga['pok9'].'</small></td>';
   echo '<td><small>'.$usluga['pok11'].'</small></td>';
   echo '<td><small>'.CHtml::link('добавить',array('uslugi21/add',
                                         'id_rep'=>$id_rep,
                                         'id_pok'=>$usluga['id_pok'],                                         
        )).'</small></td>';
   echo '</tr>';
    
}  
?>    
</table>  
