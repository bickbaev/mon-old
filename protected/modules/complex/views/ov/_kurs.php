<?php $this->pageTitle=Yii::app()->name.' - Добавление учреждения'; ?>
<p class="help-block">Поля отмеченные<span class="required">*</span> обязательны для заполнения. Справочник ОКПДТР <a href="/images/norm8.doc">можно скачать по ссылке</a></p>
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'kurs_add',
    'type'=>'horizontal',
)); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->hiddenField($model,'id_mer') ?>
    <?php echo $form->hiddenField($model,'id_report') ?> 
    <div class="control-group">
            <?php echo $form->labelEx($model,'id_okpdtr',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->textField($model,'id_okpdtr', array('class'=>'span2')); ?>
            <span class="help-inline" id="okp"></span>
            </div>
    </div>
    <?php echo $form->textFieldRow($model, 'naim_kurs', array('class'=>'span9')); ?>
    <?php echo $form->textFieldRow($model, 'hours_kurs', array('class'=>'span1')); ?>
    <label class="control-label">Формы обучения</label>
    <?php echo $form->checkboxRow($model, 'forma_kurs1'); ?>
    <?php echo $form->checkboxRow($model, 'forma_kurs2'); ?>
    <?php echo $form->checkboxRow($model, 'forma_kurs3'); ?>
    <?php echo $form->checkboxRow($model, 'forma_kurs4'); ?>
    <?php echo $form->dropDownListRow($model,'id_doc', CHtml::listData(Ov_doc::model()->findAll(), 'id_doc', 'doc_naim'), array('empty'=>'Выберите тип выдаваемого документа', 'class'=>'span4')); ?>   
    <?php echo $form->textFieldRow($model, 'oplata', array('class'=>'span2')); ?>
    <?php echo $form->textAreaRow($model, 'dop', array('class'=>'span8', 'rows'=>5)); ?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'label'=>'Отмена', 'url'=>Yii::app()->createUrl("complex/ov/edit", array("id_rep"=>$model->id_report)))); ?>
</div>
<?php $this->endWidget();?>
<script type="text/javascript">
$(document).ready(function() {
    $("#Ov_kurs_id_okpdtr").change(function(){
        var cat = $('#Ov_kurs_id_okpdtr').val();
        $.post('/index.php?r=complex/ov/p_okp',{data:cat},
        function(data){
          $('#okp').html(data);
        });        
    });
});

</script> 
