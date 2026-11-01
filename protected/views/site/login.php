<?php
$this->pageTitle=Yii::app()->name . ' - Вход';
$this->breadcrumbs=array(
	'Вход',
);
?>
	<div class="row">
            <div class="span4 offset4">
                <h2>Вход</h2>
            </div>    
	</div>                
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>true,
)); ?>

    
        <div class="row">
            <div class="span4 offset4">
		<?php echo $form->textField($model,'username', array('placeholder'=>'Логин')); ?>
		<?php echo $form->error($model,'username'); ?>
            </div>    
	</div>

	<div class="row">
            <div class="span4 offset4">            
		<?php echo $form->passwordField($model,'password', array('placeholder'=>'Пароль')); ?>
		<?php echo $form->error($model,'password'); ?>
            </div>                  
	</div>

	<div class="row">
            <div class="span4 offset4">            
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
            </div>                  
	</div>

	<div class="row buttons">
            <div class="span4 offset4">            
		<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Вход')); ?>
            </div>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->