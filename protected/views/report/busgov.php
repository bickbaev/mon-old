<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'biblio16',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <h4 style="color:red">Все данные предоставляются на момент заполнения отчета</h4>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>
    
    <p class="note"><b>Замечания по отчету:</b><br />
    <?php
        if(Yii::app()->session['est'] == $id_est) echo CHtml::value($model,'remark');
        else echo $form->textArea($model,'remark', array('cols' => 80));
    ?>
    </p>    
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1'); ?><?php echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok1',array('class'=>'span5')); ?>
                </td>                
            </tr>
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2'); ?><?php echo $form->error($model,'pok2'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok2',array('class'=>'span3')); ?>
                </td>                
            </tr> 
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok3'); ?><?php echo $form->error($model,'pok3'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok3',array('class'=>'input-mini','maxlength'=>2)); ?>
                </td>                
            </tr> 
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4'); ?><?php echo $form->error($model,'pok4'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok4',array('class'=>'span2','maxlength'=>10)); ?>
                </td>                
            </tr> 
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5'); ?><?php echo $form->error($model,'pok5'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok5',array('class'=>'span2','maxlength'=>9)); ?>
                </td>                
            </tr> 
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6'); ?><?php echo $form->error($model,'pok6'); ?>
                </td>
                <td style="width: 400px;">
                    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'options'=>array(
                                    'showAnim'=>'fold',
                                    'dateFormat'=>'dd.mm.yy',
                                    'changeYear'=>true,
                                    'yearRange'=>'1990:2020'
                                ),
                                'language' => 'ru',
                                'attribute'=>'pok6',
                                'model' => $model,
                                'htmlOptions'=>array(
                                    'size'=>8,
                                    'class'=>'input-small'
                                ),
                                ));
                    ?>                     
                </td>                
            </tr>             
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7'); ?><?php echo $form->error($model,'pok7'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok7',array('class'=>'span3','maxlength'=>11)); ?>
                </td>                
            </tr> 
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok8'); ?><?php echo $form->error($model,'pok8'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok8',array('class'=>'span3','maxlength'=>255)); ?>
                </td>                
            </tr> 
            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok9'); ?><?php echo $form->error($model,'pok9'); ?>
                </td>
                <td style="width: 400px;">
                    <?php echo $form->textField($model,'pok9',array('class'=>'span3','maxlength'=>255)); ?>
                </td>                
            </tr>             
            
        </tbody>
    </table>    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
    <!--<button class="btn" onclick="javascript:history.back()">Отмена</button>-->
    <?php //$this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>$model->id_report)))); ?>
</div>

<?php $this->endWidget(); ?>    
