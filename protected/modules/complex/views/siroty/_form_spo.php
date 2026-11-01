<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'siroty-spo-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->textFieldRow($model,'sir_num',array('class'=>'span2','maxlength'=>10)); ?>

    <div class="control-group">
            <?php echo $form->labelEx($model,'id_spo',array('class'=>'control-label')); ?>
            <div class="controls">
            <?php echo $form->textField($model,'id_spo',array('class'=>'span2','maxlength'=>9)); ?>
            <span class="help-inline" id="spo"></span>
            </div>
    </div> 
    
    <?php echo $form->dropDownListRow($model, 'id_zan', CHtml::listData(Siroty_zan::model()->findAll(array('order' => 'id_zan ASC')), 'id_zan', 'naim_zan'), array('empty'=>'Выберите вид занятости', 'class'=>'span3')); ?>    

    <?php echo $form->textFieldRow($model,'mesto',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->dropDownListRow($model, 'id_nez', CHtml::listData(Siroty_nez::model()->findAll(array('order' => 'id_nez ASC')), 'id_nez', 'naim_nez'), array('empty'=>'Выберите причину незанятости', 'class'=>'span3')); ?>        

    <?php echo $form->textFieldRow($model,'nez',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->checkboxRow($model, 'cnz'); ?>     

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('siroty/edit',array('id_rep'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript"> 

$("#Siroty_spo_id_spo").change(function(){
    var cat = $('#Siroty_spo_id_spo').val();
    $.post('/index.php?r=/complex/siroty/p_spo',{data:cat},
    function(data){
      $('#spo').html(data);
    });        
}); 

</script>    
