<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'doo_0_3',
    //'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <blockquote><em>Поля помеченные<span class="required"> * </span>обязательны для заполнения.</em></blockquote>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <table class="table table-bordered table-hover table-striped" style="width: 1000px;">
        <tbody>
            <tr>
                <td rowspan="2"><strong>Показатели</strong></td>
                <td rowspan="2"><strong>Единицы измерения</strong></td>
                <td><strong>Значения показателей</strong></td>
            </tr>
            <tr>
                <td><strong>Детей в возрасте от рождения до трёх лет на 01.<?php echo date('m.Y', strtotime($f_date)); ?></strong></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->labelex($model,'pok1'); ?><?php echo $form->error($model,'pok1'); ?>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok1',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            
            <tr>
                <td colspan="3">2. Из них:</td>
            </tr>            

            <tr>
                <td>
                    <?php echo $form->labelex($model,'pok2'); ?><?php echo $form->error($model,'pok2'); ?>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok2',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            
            <tr>
                <td colspan="3">В том числе:</td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 30px;"><?php echo $form->labelex($model,'pok3'); ?><?php echo $form->error($model,'pok3'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok3',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 30px;"><?php echo $form->labelex($model,'pok4'); ?><?php echo $form->error($model,'pok4'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok4',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 30px;"><?php echo $form->labelex($model,'pok5'); ?><?php echo $form->error($model,'pok5'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok5',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="3"><p style="margin-left: 30px;">В том числе:</p></td>
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok6'); ?><?php echo $form->error($model,'pok6'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok6',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok7'); ?><?php echo $form->error($model,'pok7'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok7',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 30px;"><?php echo $form->labelex($model,'pok8'); ?><?php echo $form->error($model,'pok8'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok8',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>

            <tr>
                <td>
                    <?php echo $form->labelex($model,'pok9'); ?><?php echo $form->error($model,'pok9'); ?>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok9',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 30px;"><?php echo $form->labelex($model,'pok10'); ?><?php echo $form->error($model,'pok10'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok10',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="3"><p style="margin-left: 30px;">Из них, в том числе получат место в образовательном учреждении, реализующем основную общеобразовательную программу дошкольного образования (в группе, функционирующей в режиме полного дня):</p></td>
            </tr>

            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok11'); ?><?php echo $form->error($model,'pok11'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok11',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok12'); ?><?php echo $form->error($model,'pok12'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok12',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok13'); ?><?php echo $form->error($model,'pok13'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok13',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok14'); ?><?php echo $form->error($model,'pok14'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok14',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok15'); ?><?php echo $form->error($model,'pok15'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok15',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok16'); ?><?php echo $form->error($model,'pok16'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok16',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <p style="margin-left: 50px;"><?php echo $form->labelex($model,'pok17'); ?><?php echo $form->error($model,'pok17'); ?></p>
                </td>
                <td>человек</td>
                <td style="width: 100px;">
                    <?php echo $form->textField($model,'pok17',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>            
        </tbody>
    </table>
    
    <?php echo $form->textAreaRow($model,'remark',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=> Report::model()->findByPk($model->id_report)->id_est)))); ?>
</div>

<?php $this->endWidget(); ?>       

