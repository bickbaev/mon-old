<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'karta-out-spo-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="control-group">
            <?php echo $form->labelEx($model,'id_spo',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->textField($model,'id_spo',array('class'=>'span2','maxlength'=>9)); ?>
            <span class="help-inline" id="spo"></span>
            </div>
    </div> 
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year1',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1+1; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year2',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1+2; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year3',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>
    
    <div class="control-group">
            <label class="control-label">Выпуск в <?php echo $year1+3; ?> г. (чел.)</label>
            <div class="controls">    
            <?php echo $form->textField($model,'year4',array('class'=>'input-small','maxlength'=>6)); ?>   
            </div>
    </div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('karta_out/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript"> 
    
$("#Karta_out_spo_id_spo").change(function(){
    var cat = $('#Karta_out_spo_id_spo').val();
    $.post('/index.php?r=/complex/karta_out/p_spo',{data:cat},
    function(data){
      $('#spo').html(data);
    });        
}); 

</script>    
