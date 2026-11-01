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
                <td colspan="2"><b>1. Материально-техническое оснащение образовательного учреждения, в том числе библиотеки</b></td>
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1'); ?><?php echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok1', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2'); ?><?php echo $form->error($model,'pok2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok3'); ?><?php echo $form->error($model,'pok3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok3', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok4'); ?><?php echo $form->error($model,'pok4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok4', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5'); ?><?php echo $form->error($model,'pok5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok5', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2">1.5 Наличие в библиотеке:</td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6'); ?><?php echo $form->error($model,'pok6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7'); ?><?php echo $form->error($model,'pok7'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok7',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok8'); ?><?php echo $form->error($model,'pok8'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok8',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok9'); ?><?php echo $form->error($model,'pok9'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok9',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok10'); ?><?php echo $form->error($model,'pok10'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok10',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok11'); ?><?php echo $form->error($model,'pok11'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok11',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok12'); ?><?php echo $form->error($model,'pok12'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok12',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok13'); ?><?php echo $form->error($model,'pok13'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok13',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok14'); ?><?php echo $form->error($model,'pok14'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok14',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok15'); ?><?php echo $form->error($model,'pok15'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok15',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2">1.6 Наличие в библиотеке потребности в установке дополнительной компьютеров и мультимедийной техники для организации доступа учащихся:</td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok16'); ?><?php echo $form->error($model,'pok16'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok16',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok17'); ?><?php echo $form->error($model,'pok17'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok17',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok18'); ?><?php echo $form->error($model,'pok18'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok18',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok19'); ?><?php echo $form->error($model,'pok19'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok19',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok20'); ?><?php echo $form->error($model,'pok20'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok20',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok21'); ?><?php echo $form->error($model,'pok21'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok21', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok22'); ?><?php echo $form->error($model,'pok22'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok22', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok23'); ?><?php echo $form->error($model,'pok23'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok23', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok24'); ?><?php echo $form->error($model,'pok24'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok24', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok25'); ?><?php echo $form->error($model,'pok25'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok25', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok26'); ?><?php echo $form->error($model,'pok26'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok26', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok27'); ?><?php echo $form->error($model,'pok27'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok27', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok28'); ?><?php echo $form->error($model,'pok28'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok28', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok29'); ?><?php echo $form->error($model,'pok29'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok29', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok30'); ?><?php echo $form->error($model,'pok30'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok30', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok31'); ?><?php echo $form->error($model,'pok31'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok31', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td>
                    <?php echo $form->label($model,'pok32'); ?><?php echo $form->error($model,'pok32'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok32', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok33'); ?><?php echo $form->error($model,'pok33'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok33', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok34'); ?><?php echo $form->error($model,'pok34'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok34', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td>
                    <?php echo $form->label($model,'pok35'); ?><?php echo $form->error($model,'pok35'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok35', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok36'); ?><?php echo $form->error($model,'pok36'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok36', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok37'); ?><?php echo $form->error($model,'pok37'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok37', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td>
                    <?php echo $form->label($model,'pok38'); ?><?php echo $form->error($model,'pok38'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok38', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>2. Информационное обеспечение библиотеки</b></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok39'); ?><?php echo $form->error($model,'pok39'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok39', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok40'); ?><?php echo $form->error($model,'pok40'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok40', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok41'); ?><?php echo $form->error($model,'pok41'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok41', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok42'); ?><?php echo $form->error($model,'pok42'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok42', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok43'); ?><?php echo $form->error($model,'pok43'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok43', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok44'); ?><?php echo $form->error($model,'pok44'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok44', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok45'); ?><?php echo $form->error($model,'pok45'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok45', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok46'); ?><?php echo $form->error($model,'pok46'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok46', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok47'); ?><?php echo $form->error($model,'pok47'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok47', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>  
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok48'); ?><?php echo $form->error($model,'pok48'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok48', array('2' => 'Да', '1' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>3. Кадровое обеспечение библиотеки</b></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok49'); ?><?php echo $form->error($model,'pok49'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok49',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok50'); ?><?php echo $form->error($model,'pok50'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok50',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok51'); ?><?php echo $form->error($model,'pok51'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok51',array('class'=>'input-mini','maxlength'=>4)); ?>
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
            

