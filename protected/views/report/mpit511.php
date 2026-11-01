<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'mpit511',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <h5 style="color:red">Данные заполняются, исходя из наличия и содержания информации в тематическом разделе сайта ОУ</h5>
    
    <h4>Двухнедельное основное (организованное) меню приготавливаемых  блюд</h4>
    
    <table class="table table-bordered table-hover table-striped" style="width: 900px;">
        <tbody> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok1'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>Опубликованное  меню подписано и утверждено</b></td>
            </tr>
            <tr>
                <td colspan="2"><i>При аутсорсинге:</i></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok2'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok2'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok3'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok3'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><i>При самостоятельной организации питания:</i></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok4'); ?><?php echo $form->error($model,'pok4'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok4'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>Опубликованное меню имеет отметку "Согласовано" с:</b></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok5'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok5'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok6'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok6'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>В опубликованном меню имеются следующие сведения:</b></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok7'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok7'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok8'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok8'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok9'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok9'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok10'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok10'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok11'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok11'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok12'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok12'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok13'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok13'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok14'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok14'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok15'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok15'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok16'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok16'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>Соответствие суммарного объема блюд по приемам пищи нормам СанПиН 2.3/2.4.3590-20</b></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok17'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok17'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok18'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok18'); ?>
                </td>                
            </tr>            
        </tbody>
    </table>
    
    <h4>Ежедневное меню основного (организованного) питания</h4>
    
    <table class="table table-bordered table-hover table-striped" style="width: 900px;">
        <tbody> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok19'); ?><?php echo $form->error($model,'pok19'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok19'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>В опубликованном меню имеются следующие сведения сведения:</b></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok20'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok20'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok21'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok21'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok22'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok22'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok23'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok23'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><b>Опубликованное  меню подписано и утверждено</b></td>
            </tr>
            <tr>
                <td colspan="2"><i>При аутсорсинге:</i></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok24'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok24'); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok25'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok25'); ?>
                </td>                
            </tr>
            <tr>
                <td colspan="2"><i>При самостоятельной организации питания:</i></td>
            </tr>
            <tr>
                <td style="text-indent: 30px;">
                    <?php echo $form->label($model,'pok26'); ?><?php echo $form->error($model,'pok26'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok26'); ?>
                </td>                
            </tr>
        </tbody>
    </table>              
            
    <h4>Иные вопросы контроля</h4>
    
    <table class="table table-bordered table-hover table-striped" style="width: 900px;">
        <tbody>    
            <tr>
                <td>
                    <?php echo $form->label($model,'pok27'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok27'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok28'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok28'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok29'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok29'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok30'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok30'); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok31'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok31'); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok32'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok32'); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok33'); ?><?php //echo $form->error($model,'pok1'); ?>
                </td>
                <td style="width: 100px;">
                    <?php echo $form->checkBox($model,'pok33'); ?>
                </td>                
            </tr>             
        </tbody>
    </table>  

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>    
</div>

<?php $this->endWidget(); ?>   