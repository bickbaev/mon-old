<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'mkf22',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <!--<h5 style="color:red">Данные о конфликтных ситуациях, имевших место и рассмотренных (урегулированных) в вашей образовательной организации в текущем 2021/22 учебном году (за период с 01.09.2021 по 31.01.2022)</h5>-->
    <h5 style="color:red">Данные о конфликтных ситуациях, имевших место и рассмотренных (урегулированных) в вашей образовательной организации за период с 01.01.2022 по 01.03.2023</h5>
   
    
    <table class="table table-bordered table-hover table-striped" style="width: 900px;">
        <tbody> 
            <tr>
                <td colspan="2"><b>Количество ситуаций "Ученик-Ученик" </b></td>
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok1'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok2'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok3'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok3'); ?>
                </td>                
            </tr>

            <tr>
                <td>
                    <?php echo $form->label($model,'pok4'); ?><?php echo $form->error($model,'pok4'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok4'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok5'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok6'); ?>
                </td>                
            </tr>

            <tr>
                <td>
                    <?php echo $form->label($model,'pok7'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok7'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok8'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok8'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok9'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok9'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok10'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok10'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>Количество ситуаций "Ученик-Учитель":</b></td>
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok11'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok11'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok12'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok12'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok13'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok13'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok14'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok14'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>Количество ситуаций "Взрослый-Взрослый"</b></td>
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok15'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok15'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok16'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok16'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok17'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok17'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok18'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok18'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok19'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok19'); ?>
                </td>                
            </tr>             
        </tbody>
    </table>
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>    
</div>

<?php $this->endWidget(); ?>       
