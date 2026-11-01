<fieldset><legend>Введите объем услуги</legend></fieldset>
<?php
echo '<b>Наименование услуги (работы)</b>: '.$usluga[0]['pok1'].'<br>';
echo '<b>Условия оказания услуги (работы)</b>: '.$usluga[0]['pok9'].'<br>';
echo '<b>Содержание услуги (работы)</b>: '.$usluga[0]['pok8'].'<br>'
?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'uslugi_res',
    'enableAjaxValidation'=>false,
    'type'=>'horizontal',
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>
<?php echo $form->errorSummary($model); ?>
<div class="control-group" style="margin-top: 20px;">
            <label class="control-label"><?php echo $usluga[0]['pok10']; ?> на 01.01.18<span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col',array('class'=>'span1','maxlength'=>12)); ?>
            </div>
</div>            
<div class="control-group" style="margin-top: 20px;">            
            <label class="control-label"><?php echo $usluga[0]['pok10']; ?> на 01.09.18<span class="required">*</span></label>
            <div class="controls">
            <?php echo $form->textField($model,'col2',array('class'=>'span1','maxlength'=>12)); ?>
            </div>            
</div> 

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('uslugi2017/edit',array('id_rep'=>$id_rep)))); ?>
</div>

<?php $this->endWidget(); ?>
