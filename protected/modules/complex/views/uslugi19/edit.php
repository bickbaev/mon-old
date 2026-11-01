<?php $this->widget('bootstrap.widgets.TbAlert'); ?>
<fieldset><legend>Данные по учреждению - <?php echo $naim_est; ?></legend></fieldset>
<p>
   <strong>Инструкция по заполнению:</strong> заполните информацию об оказываемых учреждением государственных услугах.<br />
   Для добавления информации об услуге нажмите "Добавить услугу или работу".<br />
   Потом выберите наименование услуги и условия ее оказания.<br />
   Далее введите объем услуги. Обычно это или число человек, которым оказывается услуга, или число человеко-часов.<br />
   Объем услуги указывается по состоянию на <b>1 января 2019 года, 1 сентября 2019 года, 1 января 2020 года, 1 сентября 2020 года, 1 января 2021 года, 1 сентября 2021 года</b><br />
   Добавьте все оказываемые организацией услуги.<br />
   В случае если надо изменить данные, нажмите значок <i class="icon-pencil"></i> в строке услуги.<br>
   Если нужно удалить услугу, нажмите значок <i class="icon-trash"></i> в строке услуг.
</p>
<div class="row"><p class="pull-right"><?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'icon-plus', 'label'=>'Добавить услугу или работу', 'url'=>Yii::app()->createUrl("complex/uslugi19/step1", array('id_rep'=>$id_rep)))); ?></p></div>
<?php if(sizeof($uslugi)) { 
echo '<i class="cus-page-excel"></i>'.CHtml::link('Выгрузить данные в формате Excel', '/index.php?r=complex/uslugi19/excel&id_rep='.$id_rep);    
?>
<table border="1" cellpadding="3" cellspacing="0" style="margin-top: 20px;">
  <thead>
      <tr>
        <td rowspan="2"><small>Наименование</small></td>  
        <td colspan="7" style="text-align: center;"><small>Общая информация</small></td>
        <td rowspan="2" style="text-align: center;"><small>Содержание услуги (работы)</small></td>        
        <td rowspan="2"><small>Условия оказания услуги (работы)</small></td>
        <td rowspan="2"><small>Объем услуги на 01.01.19</small></td>
        <td rowspan="2"><small>Объем услуги на 01.09.19</small></td>
        <td rowspan="2"><small>Объем услуги на 01.01.20</small></td>
        <td rowspan="2"><small>Объем услуги на 01.09.20</small></td>
        <td rowspan="2"><small>Объем услуги на 01.01.21</small></td>
        <td rowspan="2"><small>Объем услуги на 01.09.21</small></td>        
        <td rowspan="2"><small>Действие</small></td>
      </tr>
      <tr>
        <td><small>Уникальный реестровый номер услуги</small></td>
        <td><small>Код по новому алгоритму</small></td>
        <td><small>Код услуги</small></td>
        <td><small>Тип</small></td>
        <td><small>Платность</small></td>
        <td><small>Виды учреждений</small></td>
        <td><small>Категории потребителей</small></td>
      </tr>
  </thead>
<?php
foreach($uslugi as $usl) {
   $usluga = $usl['ras'];
   echo '<tr>'; 
   echo '<td><small>'.$usluga['pok1'].'</small></td>';
   echo '<td><small>'.$usluga['pok2'].'</small></td>';
   echo '<td><small>'.$usluga['pok3'].'</small></td>';
   echo '<td><small>'.$usluga['pok4'].'</small></td>';
   echo '<td><small>'.$usluga['pok5'].'</small></td>';
   echo '<td><small>'.$usluga['pok6'].'</small></td>';
   echo '<td><small>'.$usluga['pok7'].'</small></td>';
   echo '<td><small>'.$usluga['pok8'].'</small></td>';
   echo '<td><small>'.$usluga['pok9'].'</small></td>';
   echo '<td><small>'.$usluga['pok10'].'</small></td>';
   if($usluga['pok11'] != 'Количество человеко-часов') {
       echo '<td style="text-align: center;"><small>'.round($usl['col1'],0).'</small></td>';
       echo '<td style="text-align: center;"><small>'.round($usl['col2'],0).'</small></td>';
       echo '<td style="text-align: center;"><small>'.round($usl['col3'],0).'</small></td>';
       echo '<td style="text-align: center;"><small>'.round($usl['col4'],0).'</small></td>';
       echo '<td style="text-align: center;"><small>'.round($usl['col5'],0).'</small></td>';
       echo '<td style="text-align: center;"><small>'.round($usl['col6'],0).'</small></td>';       
   }       
   else {
       echo '<td style="text-align: center;"><small>'.$usl['col1'].'</small></td>';
       echo '<td style="text-align: center;"><small>'.$usl['col2'].'</small></td>';
       echo '<td style="text-align: center;"><small>'.$usl['col3'].'</small></td>';
       echo '<td style="text-align: center;"><small>'.$usl['col4'].'</small></td>';
       echo '<td style="text-align: center;"><small>'.$usl['col5'].'</small></td>';
       echo '<td style="text-align: center;"><small>'.$usl['col6'].'</small></td>';       
   }    
   echo '<td><small>'.CHtml::link('<i class="icon-pencil"></i>', array('uslugi19/update', 'id_rep'=>$id_rep, 'id_usluga'=>$usl['id_usluga']), array('rel'=>'tooltip', 'data-original-title'=>'Редактировать')).' '.CHtml::link('<i class="icon-trash"></i>',array('uslugi19/del', 'id_rep'=>$id_rep, 'id_usluga'=>$usl['id_usluga']), array('rel'=>'tooltip', 'data-original-title'=>'Удалить')).'</small></td>';
   echo '</tr>';   
}
    
?>    
</table>  
<?php } ?>

