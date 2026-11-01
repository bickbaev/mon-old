<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'ons2014',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <h4 style="color:red">Все данные предоставляются на 1 января 2016 года (или за период с 1 января 2015 года по 1 января 2016 года, если рассматривается период и не указано иное). По пункту 2.11.1 указывается численность за все годы.</h4>
    <p>
        <b><a href="/images/metodika_nnsh_2015.doc">Методические рекомендации по заполнению отдельных показателей в форме ННШ-2015</a></b>
    </p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <fieldset><legend>1. ОБЩИЕ ПОКАЗАТЕЛИ</legend></fieldset>
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>
            <tr>
                <td>
                    <?php echo $form->label($model,'mesto'); ?><?php echo $form->error($model,'mesto'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'mesto',array('1' => 'Город', '0' => 'Село'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_1'); ?><?php echo $form->error($model,'pok1_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_2'); ?><?php echo $form->error($model,'pok1_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_2_1'); ?><?php echo $form->error($model,'pok1_2_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_2_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_2_2'); ?><?php echo $form->error($model,'pok1_2_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_2_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_3'); ?><?php echo $form->error($model,'pok1_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_3_1'); ?><?php echo $form->error($model,'pok1_3_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_3_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_3_2'); ?><?php echo $form->error($model,'pok1_3_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_3_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность  выпускников 9-x классов, сдававших  ГИА по:</b></td>
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_4_1'); ?><?php echo $form->error($model,'pok1_4_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_4_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_4_2'); ?><?php echo $form->error($model,'pok1_4_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_4_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Средний тестовый балл ГИА выпускников 9-x классов по</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_5_1'); ?><?php echo $form->error($model,'pok1_5_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_5_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_5_2'); ?><?php echo $form->error($model,'pok1_5_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_5_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность выпускников 9-x классов, сдававших  ГИА и не преодолевших минимального порога по:</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_6_1'); ?><?php echo $form->error($model,'pok1_6_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_6_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_6_2'); ?><?php echo $form->error($model,'pok1_6_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_6_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность выпускников 9-х классов, поступивших в профессиональные образовательные организации или на профильное обучение по программам среднего общего образования:</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_7_1'); ?><?php echo $form->error($model,'pok1_7_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_7_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_7_2'); ?><?php echo $form->error($model,'pok1_7_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_7_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_8'); ?><?php echo $form->error($model,'pok1_8'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_8',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_8_1'); ?><?php echo $form->error($model,'pok1_8_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_8_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>  
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_8_2'); ?><?php echo $form->error($model,'pok1_8_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_8_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность выпускников, сдававших  ЕГЭ по: </b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_9_1'); ?><?php echo $form->error($model,'pok1_9_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_9_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_9_2'); ?><?php echo $form->error($model,'pok1_9_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_9_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Средний тестовый балл ЕГЭ выпускников по</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_10_1'); ?><?php echo $form->error($model,'pok1_10_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_10_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_10_2'); ?><?php echo $form->error($model,'pok1_10_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_10_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность выпускников, сдававших ЕГЭ и не преодолевших минимального порога</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_11_1'); ?><?php echo $form->error($model,'pok1_11_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_11_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok1_11_2'); ?><?php echo $form->error($model,'pok1_11_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_11_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_12'); ?><?php echo $form->error($model,'pok1_12'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_12',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok1_13'); ?><?php echo $form->error($model,'pok1_13'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok1_13',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>            
        </tbody>
    </table>
    
    <fieldset><legend>2. ПЕРЕХОД НА НОВЫЕ ОБРАЗОВАТЕЛЬНЫЕ СТАНДАРТЫ</legend></fieldset>
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_1'); ?><?php echo $form->error($model,'pok2_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2_1', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_1_1'); ?><?php echo $form->error($model,'pok2_1_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_1_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_1_2'); ?><?php echo $form->error($model,'pok2_1_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_1_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_1_3'); ?><?php echo $form->error($model,'pok2_1_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_1_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_1_4'); ?><?php echo $form->error($model,'pok2_1_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_1_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_1_5'); ?><?php echo $form->error($model,'pok2_1_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_1_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_1_6'); ?><?php echo $form->error($model,'pok2_1_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_1_6',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                 <td colspan="2"><b>Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС,  за счет: </b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_2_1'); ?><?php echo $form->error($model,'pok2_2_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_2_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_2_2'); ?><?php echo $form->error($model,'pok2_2_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_2_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_2_3'); ?><?php echo $form->error($model,'pok2_2_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_2_3',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Среднее количество часов в неделю внеурочной деятельности в классах основной школы,  обучающихся по ФГОС,  за счет: </b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_3_1'); ?><?php echo $form->error($model,'pok2_3_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_3_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_3_2'); ?><?php echo $form->error($model,'pok2_3_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_3_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_3_3'); ?><?php echo $form->error($model,'pok2_3_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_3_3',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr> 
            <tr>
                 <td colspan="2"><b>Среднее количество часов в неделю внеурочной деятельности в классах старшей школы,  обучающихся по ФГОС,  за счет: </b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_4_1'); ?><?php echo $form->error($model,'pok2_4_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_4_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_4_2'); ?><?php echo $form->error($model,'pok2_4_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_4_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_4_3'); ?><?php echo $form->error($model,'pok2_4_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_4_3',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Среднее количество часов в неделю внеурочной деятельности в классах начальной школы, обучающихся по ФГОС  в том числе, отведенных на направления:</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_5_1'); ?><?php echo $form->error($model,'pok2_5_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_5_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_5_2'); ?><?php echo $form->error($model,'pok2_5_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_5_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_5_3'); ?><?php echo $form->error($model,'pok2_5_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_5_3',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_5_4'); ?><?php echo $form->error($model,'pok2_5_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_5_4',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_5_5'); ?><?php echo $form->error($model,'pok2_5_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_5_5',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_5_6'); ?><?php echo $form->error($model,'pok2_5_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_5_6',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr> 
            <tr>
                 <td colspan="2"><b>Среднее количество часов в неделю внеурочной деятельности в классах основной школы, обучающихся по ФГОС, в том числе, отведенных на направления:</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_6_1'); ?><?php echo $form->error($model,'pok2_6_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_6_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_6_2'); ?><?php echo $form->error($model,'pok2_6_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_6_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_6_3'); ?><?php echo $form->error($model,'pok2_6_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_6_3',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_6_4'); ?><?php echo $form->error($model,'pok2_6_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_6_4',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_6_5'); ?><?php echo $form->error($model,'pok2_6_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_6_5',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_6_6'); ?><?php echo $form->error($model,'pok2_6_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_6_6',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>  
        <tr>
                 <td colspan="2"><b>Среднее количество часов в неделю внеурочной деятельности в классах старшей школы, обучающихся по ФГОС, в том числе, отведенных на направления:</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_7_1'); ?><?php echo $form->error($model,'pok2_7_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_7_1',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_7_2'); ?><?php echo $form->error($model,'pok2_7_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_7_2',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_7_3'); ?><?php echo $form->error($model,'pok2_7_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_7_3',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_7_4'); ?><?php echo $form->error($model,'pok2_7_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_7_4',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_7_5'); ?><?php echo $form->error($model,'pok2_7_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_7_5',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_7_6'); ?><?php echo $form->error($model,'pok2_7_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_7_6',array('class'=>'input-mini','maxlength'=>5)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Использование современных оценочных процедур для оценки достижений обучающихся по ФГОС в начальных классах: </b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_8_1'); ?><?php echo $form->error($model,'pok2_8_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2_8_1', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_8_2'); ?><?php echo $form->error($model,'pok2_8_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2_8_2', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_8_3'); ?><?php echo $form->error($model,'pok2_8_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2_8_3', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность обучающихся по ФГОС, которым обеспечена возможность пользоваться в соответствии с ФГОС:</b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_9_1'); ?><?php echo $form->error($model,'pok2_9_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_9_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_9_2'); ?><?php echo $form->error($model,'pok2_9_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_9_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>В образовательном учреждении организованы оборудованные постоянно действующие площадки: </b></td>
            </tr>            
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_10_1'); ?><?php echo $form->error($model,'pok2_10_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2_10_1', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_10_2'); ?><?php echo $form->error($model,'pok2_10_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2_10_2', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok2_10_3'); ?><?php echo $form->error($model,'pok2_10_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok2_10_3', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_11'); ?><?php echo $form->error($model,'pok2_11'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_11',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok2_11_1'); ?><?php echo $form->error($model,'pok2_11_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok2_11_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>            
        </tbody>
    </table>
           
    <fieldset><legend>3. РАЗВИТИЕ СИСТЕМЫ ПОДДЕРЖКИ ТАЛАНТЛИВЫХ ДЕТЕЙ</legend></fieldset>
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>
            <tr>
                 <td colspan="2"><b>Школьный этап Всероссийской олимпиады школьников</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_1_1'); ?><?php echo $form->error($model,'pok3_1_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_1_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_1_2'); ?><?php echo $form->error($model,'pok3_1_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_1_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Муниципальный этап Всероссийской олимпиады школьников</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_2_1'); ?><?php echo $form->error($model,'pok3_2_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_2_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_2_2'); ?><?php echo $form->error($model,'pok3_2_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_2_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_2_3'); ?><?php echo $form->error($model,'pok3_2_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_2_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_2_4'); ?><?php echo $form->error($model,'pok3_2_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_2_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                 <td colspan="2"><b>Региональный этап Всероссийской олимпиады школьников</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_3_1'); ?><?php echo $form->error($model,'pok3_3_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_3_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_3_2'); ?><?php echo $form->error($model,'pok3_3_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_3_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_3_4'); ?><?php echo $form->error($model,'pok3_3_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_3_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_3_5'); ?><?php echo $form->error($model,'pok3_3_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_3_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                 <td colspan="2"><b>Заключительный этап Всероссийской олимпиады школьников</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_4_1'); ?><?php echo $form->error($model,'pok3_4_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_4_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_4_2'); ?><?php echo $form->error($model,'pok3_4_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_4_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_4_3'); ?><?php echo $form->error($model,'pok3_4_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_4_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                 <td colspan="2"><b>Очные и дистанционные олимпиады, проводимые сторонними организациями</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_5_1'); ?><?php echo $form->error($model,'pok3_5_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_5_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_5_2'); ?><?php echo $form->error($model,'pok3_5_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_5_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_5_3'); ?><?php echo $form->error($model,'pok3_5_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_5_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_5_4'); ?><?php echo $form->error($model,'pok3_5_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_5_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_5_5'); ?><?php echo $form->error($model,'pok3_5_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_5_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_5_6'); ?><?php echo $form->error($model,'pok3_5_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_5_6',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность обучающихся, которым созданы условия для занятий творчеством в специально оборудованных:</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_6_1'); ?><?php echo $form->error($model,'pok3_6_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_6_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok3_6_2'); ?><?php echo $form->error($model,'pok3_6_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok3_6_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>            
        </tbody>
    </table>    
    
    <fieldset><legend>4. СОВЕРШЕНСТВОВАНИЕ УЧИТЕЛЬСКОГО КОРПУСА</legend></fieldset>
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>           
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_1'); ?><?php echo $form->error($model,'pok4_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_2'); ?><?php echo $form->error($model,'pok4_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_3'); ?><?php echo $form->error($model,'pok4_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_4'); ?><?php echo $form->error($model,'pok4_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_5'); ?><?php echo $form->error($model,'pok4_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_6'); ?><?php echo $form->error($model,'pok4_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_6',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_7'); ?><?php echo $form->error($model,'pok4_7'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_7',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_8'); ?><?php echo $form->error($model,'pok4_8'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_8',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_9'); ?><?php echo $form->error($model,'pok4_9'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_9',array('class'=>'input-medium','maxlength'=>11)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_9_1'); ?><?php echo $form->error($model,'pok4_9_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_9_1',array('class'=>'input-medium','maxlength'=>11)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_9_2'); ?><?php echo $form->error($model,'pok4_9_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_9_2',array('class'=>'input-medium','maxlength'=>11)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_9_3'); ?><?php echo $form->error($model,'pok4_9_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_9_3',array('class'=>'input-medium','maxlength'=>11)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_10'); ?><?php echo $form->error($model,'pok4_10'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_10',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_11'); ?><?php echo $form->error($model,'pok4_11'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_11',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_12'); ?><?php echo $form->error($model,'pok4_12'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_12',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_14'); ?><?php echo $form->error($model,'pok4_14'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_14',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_15'); ?><?php echo $form->error($model,'pok4_15'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_15',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_16'); ?><?php echo $form->error($model,'pok4_16'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_16',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_17'); ?><?php echo $form->error($model,'pok4_17'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_17',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_18'); ?><?php echo $form->error($model,'pok4_18'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_18',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_19'); ?><?php echo $form->error($model,'pok4_19'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_19',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_20'); ?><?php echo $form->error($model,'pok4_20'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_20',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok4_21'); ?><?php echo $form->error($model,'pok4_21'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok4_21',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>           
        </tbody>
    </table>              
    
    <fieldset><legend>5.  ИЗМЕНЕНИЕ ШКОЛЬНОЙ ИНФРАСТРУКТУРЫ</legend></fieldset>
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>           
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_1'); ?><?php echo $form->error($model,'pok5_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность обучающихся, которые имеют возможность пользоваться современной библиотекой:</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok5_2_1'); ?><?php echo $form->error($model,'pok5_2_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_2_1',array('class'=>'input-mini','maxlength'=>8)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok5_2_2'); ?><?php echo $form->error($model,'pok5_2_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_2_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok5_2_3'); ?><?php echo $form->error($model,'pok5_2_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_2_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok5_2_4'); ?><?php echo $form->error($model,'pok5_2_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_2_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok5_2_5'); ?><?php echo $form->error($model,'pok5_2_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_2_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok5_2_6'); ?><?php echo $form->error($model,'pok5_2_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_2_6',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr> 
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok5_2_7'); ?><?php echo $form->error($model,'pok5_2_7'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_2_7',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_3'); ?><?php echo $form->error($model,'pok5_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_4'); ?><?php echo $form->error($model,'pok5_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok5_4', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_5'); ?><?php echo $form->error($model,'pok5_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_7'); ?><?php echo $form->error($model,'pok5_7'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_7',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_8'); ?><?php echo $form->error($model,'pok5_8'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok5_8', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_9'); ?><?php echo $form->error($model,'pok5_9'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_9',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_10'); ?><?php echo $form->error($model,'pok5_10'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok5_10', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_11'); ?><?php echo $form->error($model,'pok5_11'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_11',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_12'); ?><?php echo $form->error($model,'pok5_12'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_12',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_13'); ?><?php echo $form->error($model,'pok5_13'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_13',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_14'); ?><?php echo $form->error($model,'pok5_14'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok5_14',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok5_15'); ?><?php echo $form->error($model,'pok5_15'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok5_15', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>            
        </tbody>
    </table>               
    
    <fieldset><legend>6. СОХРАНЕНИЕ И УКРЕПЛЕНИЕ ЗДОРОВЬЯ ШКОЛЬНИКОВ</legend></fieldset>
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>           
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6_1'); ?><?php echo $form->error($model,'pok6_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6_2'); ?><?php echo $form->error($model,'pok6_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Условия питания (оснащенность столовой):</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_3_1'); ?><?php echo $form->error($model,'pok6_3_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_3_1', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_3_2'); ?><?php echo $form->error($model,'pok6_3_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_3_2', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_3_3'); ?><?php echo $form->error($model,'pok6_3_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_3_3', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_3_4'); ?><?php echo $form->error($model,'pok6_3_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_3_4', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_3_5'); ?><?php echo $form->error($model,'pok6_3_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_3_5', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6_4'); ?><?php echo $form->error($model,'pok6_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_4', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность обучающихся, которые получают качественное горячее питание</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_5_1'); ?><?php echo $form->error($model,'pok6_5_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_5_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_5_2'); ?><?php echo $form->error($model,'pok6_5_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_5_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_5_3'); ?><?php echo $form->error($model,'pok6_5_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_5_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6_5_4'); ?><?php echo $form->error($model,'pok6_5_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_5_4', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>            
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6_5_5'); ?><?php echo $form->error($model,'pok6_5_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_5_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>            
            <tr>
                 <td colspan="2"><b>Численность обучающихся, которым обеспечена возможность пользоваться универсальными спортивными залами со следующими характеристиками: </b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_6_1'); ?><?php echo $form->error($model,'pok6_6_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_6_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_6_2'); ?><?php echo $form->error($model,'pok6_6_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_6_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_6_3'); ?><?php echo $form->error($model,'pok6_6_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_6_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_6_4'); ?><?php echo $form->error($model,'pok6_6_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_6_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_6_5'); ?><?php echo $form->error($model,'pok6_6_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_6_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_6_6'); ?><?php echo $form->error($model,'pok6_6_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_6_6',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>            
            <tr>
                 <td colspan="2"><b>Численность обучающихся, которым обеспечена возможность пользоваться оборудованными спортивными площадками для реализации программы «Легкая атлетика» (с учетом климатических условий) со следующими характеристиками:</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_7_1'); ?><?php echo $form->error($model,'pok6_7_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_7_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_7_2'); ?><?php echo $form->error($model,'pok6_7_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_7_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_7_3'); ?><?php echo $form->error($model,'pok6_7_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_7_3',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_7_4'); ?><?php echo $form->error($model,'pok6_7_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_7_4',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_7_5'); ?><?php echo $form->error($model,'pok6_7_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_7_5',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6_8'); ?><?php echo $form->error($model,'pok6_8'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok6_8', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok6_9'); ?><?php echo $form->error($model,'pok6_9'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_9',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Численность обучающихся, которым обеспечено медицинское обслуживание, включая наличие лицензионных медицинских кабинетов и не менее 1 квалифицированного медицинского работника, в том числе:</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_10_1'); ?><?php echo $form->error($model,'pok6_10_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_10_1',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok6_10_2'); ?><?php echo $form->error($model,'pok6_10_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->textField($model,'pok6_10_2',array('class'=>'input-mini','maxlength'=>4)); ?>
                </td>                
            </tr>            
        </tbody>
    </table>             
    
    <fieldset><legend>7. РАЗВИТИЕ САМОСТОЯТЕЛЬНОСТИ ШКОЛ</legend></fieldset>
    
    <table class="table table-bordered table-hover" style="width: 900px;">
        <tbody>           
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_1'); ?><?php echo $form->error($model,'pok7_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_1', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_2'); ?><?php echo $form->error($model,'pok7_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_2', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_3'); ?><?php echo $form->error($model,'pok7_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_3', array('1' => 'Автономная', '2' => 'Бюджетное', '3' => 'Казенное'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_4'); ?><?php echo $form->error($model,'pok7_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_4', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_5'); ?><?php echo $form->error($model,'pok7_5'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_5', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_6'); ?><?php echo $form->error($model,'pok7_6'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_6', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_7'); ?><?php echo $form->error($model,'pok7_7'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_7', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr> 
            <tr>
                 <td colspan="2"><b>Органы государственно-общественного управления в общеобразовательной организации участвуют в разработке и утверждении:</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7_8_1'); ?><?php echo $form->error($model,'pok7_8_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_8_1', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7_8_2'); ?><?php echo $form->error($model,'pok7_8_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_8_2', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7_8_3'); ?><?php echo $form->error($model,'pok7_8_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_8_3', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7_8_4'); ?><?php echo $form->error($model,'pok7_8_4'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_8_4', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                 <td colspan="2"><b>Использование электронного документооборота (электронные системы управления):</b></td>
            </tr>             
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7_9_1'); ?><?php echo $form->error($model,'pok7_9_1'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_9_1', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7_9_2'); ?><?php echo $form->error($model,'pok7_9_2'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_9_2', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td style="text-align: right;">
                    <?php echo $form->label($model,'pok7_9_3'); ?><?php echo $form->error($model,'pok7_9_3'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_9_3', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
                </td>                
            </tr>
            <tr>
                <td>
                    <?php echo $form->label($model,'pok7_10'); ?><?php echo $form->error($model,'pok7_10'); ?>
                </td>
                <td style="width: 200px;">
                    <?php echo $form->dropDownList($model,'pok7_10', array('1' => 'Да', '0' => 'Нет'), array('empty' => 'Выберите значение', 'class'=>'span2')); ?>
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