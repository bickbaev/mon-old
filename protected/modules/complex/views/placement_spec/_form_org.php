<?php
$rab = array(
    '1' => 'АО "РКЦ "Прогресс"', 
    '2' => 'ОАО "Кузнецов"', 
    '3' => 'ОАО "Салют"',
    '4' => 'ОАО "Авиакор – авиационный завод"',
    '5' => 'ОАО "Агрегат"',
    '6' => 'ОАО "АвтоВАЗ"',
    '7' => 'другой работодатель (поле ниже)',
);
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'org-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>    


    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model,'id_est', $rab, array('empty' => 'Выберите работодателя', 'class'=>'span3')); ?>

    <?php echo $form->textFieldRow($model,'est',array('class'=>'span5','maxlength'=>255, 'disabled'=>true)); ?>

    <?php echo $form->textFieldRow($model,'p_out',array('class'=>'span1','maxlength'=>4)); ?>

    <?php echo $form->textAreaRow($model,'prik',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('placement_spec/edit_po',array('id_spec'=>$model->id_spec)))); ?>
</div>

<?php $this->endWidget(); ?> 

<script type="text/javascript">   
$('#Placement_org_id_est').change(function () {
    if($(this).val() != 7) {
        $('#Placement_org_est').val("");
        $('#Placement_org_est').attr('class', 'disabled');
        $('#Placement_org_est').attr('class', 'span5');
        $('#Placement_org_est').attr('disabled', '');
    }
    else {
        $('#Placement_org_est').removeClass('disabled');
        $('#Placement_org_est').removeAttr('disabled');       
    }
});
</script> 

