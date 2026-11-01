<fieldset><legend>Добавление отчета для организации</legend></fieldset>
<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'est-form',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype'=>'multipart/form-data'),    
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?> 
    
    <?php echo $form->dropDownListRow($model, 
            'id_okr', 
            CHtml::listData(Est::model()->findAll('type_adm = 3', array('order' => 'id_est ASC')), 'id_est', 'est_name'), 
            array('empty'=>'Выберите ТУ/ДО',
                'class'=>'span4',        
                'ajax' => array(
                    'type'=>'POST', 
                    'url'=>Yii::app()->createUrl('abi25/loadraion'),         
                    'success'=> 'function(data) {$("#Report_id_raion").empty(); $("#Report_id_raion").append(data);}',            
                    'data'=>array('id_okr'=>'js:this.value'),
                )
            )); ?>
    
    <?php echo $form->dropDownListRow($model,'id_raion',
            //CHtml::listData(Est::model()->findAll('type_adm = 2', array('order' => 'id_est ASC')), 'id_est', 'est_name'),
            array(),
            array('empty'=>'Сначала выберите ТУ/ДО',
                'class'=>'span4',        
                'ajax' => array(
                    'type'=>'POST', 
                    'url'=>Yii::app()->createUrl('abi25/loadtype'),         
                    'success'=> 'function(data) {$("#Report_id_type").empty(); $("#Report_id_type").append(data);}',            
                    'data'=>array('id_raion'=>'js:this.value'),
                )
            ));?>
    <?php echo $form->dropDownListRow($model,'id_type',
            //CHtml::listData(Est_type::model()->findAll(), 'id', 'naim'),
            array(),
            array('empty'=>'Сначала выберите муниципалитет',
                'class'=>'span4',        
                'ajax' => array(
                    'type'=>'POST', 
                    'url'=>Yii::app()->createUrl('abi25/loadest'),         
                    'success'=> 'function(data) {$("#Report_id_est").empty(); $("#Report_id_est").append(data);}',            
                    'data'=>array('id_est'=>'js:this.value', 'id_rep_type'=>$comp->id_rep_type),
                )
            ));?> 
    <?php echo $form->dropDownListRow($model,'id_est',
            //CHtml::listData(Est::model()->findAll(array('order' => 'id_est ASC')), 'id_est', 'est_name'),
            array(),
            array('empty'=>'Сначала выберите тип',
                'class'=>'span8',        
            ));?>    

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('zp25/index',array('id_comp'=>$comp->id)))); ?>
</div>

<?php $this->endWidget(); ?>      
