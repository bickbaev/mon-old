<?php $this->pageTitle=Yii::app()->name; ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'contact_info',
    'enableAjaxValidation'=>false,
)); ?>

    <fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->hiddenField($model,'id_report') ?>
    </div>
    
    <p class="note"><b>Замечания по отчету:</b><br />
    <?php
        echo $form->textArea($model,'remark', array('cols' => 80));
    ?>
    </p> 
    
    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>

    <table class ="otchet_edit_table" width="750" border="1" cellspacing="0" cellpadding="3" bordercolor="#999999">
      <tr bgcolor="#FFFFCC" class ="head">
        <th scope="col">Наименование показателя </th>
        <th width="80" scope="col">Значение </th>
      </tr> 
      <tr class ="head">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'p_date'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $model->p_date; ?></div>
        </td>
      </tr> 
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;">Сайт</div>
        </td>
        <td>
            <div align="center"><?php echo CHtml::link($model->site2, $model->site2, array('target'=>'_blank')); ?></div>
        </td>
      </tr> 
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok35'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok35'); ?></div>
        </td>
      </tr>        
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok34'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok34'); ?></div>
        </td>
      </tr>      
      <tr>
          <td><b>Выделить все</b></td>
        <td><div align="center"><input id="one" type="checkbox" name="one" value="all" onclick="checkAll(this)" /></div></td>
      </tr>      
      <tr class="head">
        <td colspan="2" align="left">сведения:</td>
      </tr>        
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok1'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok1'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok2'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok2'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok3'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok3'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok4'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok4'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok5'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok5'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok7'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok7'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok8'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok8'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok9'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok9'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok10'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok10'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok12'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok12'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok14'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok14'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok15'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok15'); ?></div>
        </td>
      </tr>
      <tr class="head">
        <td colspan="2" align="left">Копии документов</td>
      </tr>       
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok16'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok16'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok17'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok17'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok18'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok18'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok19'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok19'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok20'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok20'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok21'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok21'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok22'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok22'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok23'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok23'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok25'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok25'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok26'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok26'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok27'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok27'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok28'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok28'); ?></div>
        </td>
      </tr>
      <tr class="head">
        <td colspan="2" align="left">Ссылки</td>
      </tr>      
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok29'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok29'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok30'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok30'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok31'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok31'); ?></div>
        </td>
      </tr>
      <tr bgcolor="#FFFFCC">
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok32'); ?></div>
        </td>
        <td>
        <div align="center"><?php echo $form->checkBox($model,'pok32'); ?></div>
        </td>
      </tr>
      <tr>
        <td>
            <div style="padding-left: 5px;"><?php echo $form->labelEx($model,'pok33'); ?></div>
        </td>
        <td>
            <div align="center"><?php echo $form->checkBox($model, 'pok33'); ?></div>
        </td>
      </tr>      
    </table>

    <div class="otchet_button">
        <input type="button" onclick="javascript:history.back()" name="Отменить" value="Отменить">
        <?php echo CHtml::submitButton('Сохранить'); ?>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text/javascript">
function checkAll(obj) {
  'use strict';
  // Получаем NodeList дочерних элементов input формы:
  var items = obj.form.getElementsByTagName("input"),
      len, i;
  // Здесь, увы цикл по элементам формы:
  for (i = 0, len = items.length; i < len; i += 1) {
    // Если текущий элемент является чекбоксом...
    if (items.item(i).type && items.item(i).type === "checkbox") {
      // Дальше логика простая: если checkbox "Выбрать всё" - отмечен           
      if (obj.checked) {
        // Отмечаем все чекбоксы...
        if(items.item(i).name === "Site[pok34]") continue;
        if(items.item(i).name === "Site[pok35]") continue;
        items.item(i).checked = true;
      } else {
        // Иначе снимаем отметки со всех чекбоксов:
        items.item(i).checked = false;
      }      
    }
  }
}
</script>