<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'bbb',
    'type'=>'horizontal',
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model,'name', array('class'=>'span6')); ?>
<?php echo $form->textFieldRow($model,'moderator', array('class'=>'span4')); ?>
<?php echo $form->textFieldRow($model,'attendee', array('class'=>'span4')); ?>
<?php echo $form->checkboxRow($model, 'terupr'); ?>
<?php echo $form->textFieldRow($model,'attendeePW'); ?>
<?php echo $form->textFieldRow($model,'moderatorPW'); ?>
<?php echo $form->textAreaRow($model,'welcome', array('value'=>'Здравствуйте, коллеги.
В данном окне Вы можете писать вопросы, комментарии и т.п.')); ?>
<?php echo $form->textFieldRow($model,'max_participants', array('value' => 25)); ?>
<?php echo $form->textFieldRow($model,'duration'); ?>
<?php echo $form->checkboxRow($model, 'record'); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'Сохранить')); ?>
    <button class="btn" type="button" onclick="javascript:history.back()">Отменить</button>
</div>
<?php $this->endWidget();
?>