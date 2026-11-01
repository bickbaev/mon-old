<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'isb',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <h4 style="color:red">Все данные предоставляются по состоянию на 1 января 2017 года по юридическому лицу</h4>
    
    <p><a href="/images/ege.xlsx">Справочник кодов образовательных организаций по ЕГЭ</a></p>

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
                    <?php echo $form->label($model,'pok11'); ?><?php echo $form->error($model,'pok11'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok11',array('class'=>'span2','maxlength'=>6)); ?>
                </td>                
            </tr>            
            <tr>
                <td colspan="2"><b>1. Сведения об учащихся (указываются данные только по обучающимся по программам общего образования)</b></td>
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1'); ?><?php echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2'); ?><?php echo $form->error($model,'pok2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok3'); ?><?php echo $form->error($model,'pok3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4'); ?><?php echo $form->error($model,'pok4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5'); ?><?php echo $form->error($model,'pok5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6'); ?><?php echo $form->error($model,'pok6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7'); ?><?php echo $form->error($model,'pok7'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok7',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok8'); ?><?php echo $form->error($model,'pok8'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok8',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>2. Сведения об учителях</b></td>
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok9'); ?><?php echo $form->error($model,'pok9'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok9',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
                    <tr>
                <td>
                    <?php echo $form->label($model,'pok10'); ?><?php echo $form->error($model,'pok10'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok10',array('class'=>'input-mini','maxlength'=>4)); ?>
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