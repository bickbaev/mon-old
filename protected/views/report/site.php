<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-info-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <?php echo $form->textAreaRow($model,'remark',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'site2',array('maxlength'=>255, 'class'=>'span8')); ?>

    <?php echo $form->checkBoxRow($model,'pok34'); ?>

    <?php echo $form->checkBoxRow($model,'pok35'); ?>

    <div class="control-group ">
        <div class="controls">
            <label class="checkbox">
            <input id="one" type="checkbox" name="one" value="all" onclick="checkAll(this)" />
            Отметить все
            </label>
        </div>
    </div>

    <div class="row"><div class="span10 offset2"><fieldset><legend>Сведения:</legend></fieldset></div></div>

    <?php echo $form->checkBoxRow($model,'pok1'); ?>

    <?php echo $form->checkBoxRow($model,'pok2'); ?>

    <?php echo $form->checkBoxRow($model,'pok3'); ?>

    <?php echo $form->checkBoxRow($model,'pok4'); ?>

    <?php echo $form->checkBoxRow($model,'pok5'); ?>

    <?php echo $form->checkBoxRow($model,'pok7'); ?>

    <?php echo $form->checkBoxRow($model,'pok8'); ?>

    <?php echo $form->checkBoxRow($model,'pok9'); ?>

    <?php echo $form->checkBoxRow($model,'pok10'); ?>

    <?php echo $form->checkBoxRow($model,'pok12'); ?>

    <?php echo $form->checkBoxRow($model,'pok14'); ?>

    <?php echo $form->checkBoxRow($model,'pok15'); ?>

    <div class="row"><div class="span10 offset2"><fieldset><legend>Копии документов:</legend></fieldset></div></div>

    <?php echo $form->checkBoxRow($model,'pok16'); ?>

    <?php echo $form->checkBoxRow($model,'pok17'); ?>

    <?php echo $form->checkBoxRow($model,'pok18'); ?>

    <?php echo $form->checkBoxRow($model,'pok19'); ?>

    <?php echo $form->checkBoxRow($model,'pok20'); ?>

    <?php echo $form->checkBoxRow($model,'pok21'); ?>

    <?php echo $form->checkBoxRow($model,'pok22'); ?>

    <?php echo $form->checkBoxRow($model,'pok23'); ?>

    <?php echo $form->checkBoxRow($model,'pok25'); ?>

    <?php echo $form->checkBoxRow($model,'pok26'); ?>

    <?php echo $form->checkBoxRow($model,'pok27'); ?>

    <?php echo $form->checkBoxRow($model,'pok28'); ?>
    
    <div class="row"><div class="span10 offset2"><fieldset><legend>Ссылки:</legend></fieldset></div></div>

    <?php echo $form->checkBoxRow($model,'pok29'); ?>

    <?php echo $form->checkBoxRow($model,'pok30'); ?>

    <?php echo $form->checkBoxRow($model,'pok31'); ?>

    <?php echo $form->checkBoxRow($model,'pok32'); ?>

    <?php echo $form->checkBoxRow($model,'pok33'); ?>




<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <button class="btn" onclick="javascript:history.back()">Отмена</button>
    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>

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
