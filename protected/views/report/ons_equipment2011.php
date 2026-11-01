<fieldset><legend><?php echo '<div class = "otchet_edit">Отчет "'.$rep_name.'" - '.$est_name.'</div>' ?></legend></fieldset>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'ons2014',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

    <h4 style="color:red">Все данные предоставляются на дату заполнения отчета</h4>
    <p>
        <b><a href="/res/ons_equipment2011.doc">Методические рекомендации по заполнению показателей</a></b>
    </p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->hiddenField($model,'id_report') ?>

    <table class="table table-bordered table-hover" style="width: 900px;">
            <tbody><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok0"); ?><?php echo $form->error($model,"pok0"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok0"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Водоснабжение. Отметьте наличие в здании работающей системы водоснабжения (водопровода), включая локальные системы, обеспечивающей необходимый санитарный и питьевой режим в соответствии с СанПиН</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok1"); ?><?php echo $form->error($model,"pok1"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok1"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok2"); ?><?php echo $form->error($model,"pok2"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok2"); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Канализация. Отметьте наличие:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok3"); ?><?php echo $form->error($model,"pok3"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok3"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok4"); ?><?php echo $form->error($model,"pok4"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok4"); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Соответствие требованиям пожаробезопасности. Отметьте факт наличия:</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok5"); ?><?php echo $form->error($model,"pok5"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok5"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok6"); ?><?php echo $form->error($model,"pok6"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok6"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok7"); ?><?php echo $form->error($model,"pok7"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok7"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok8"); ?><?php echo $form->error($model,"pok8"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok8"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok9"); ?><?php echo $form->error($model,"pok9"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok9"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok10"); ?><?php echo $form->error($model,"pok10"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok10"); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Охрана. Отметьте факт наличия в учреждении действующей охраны:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok11"); ?><?php echo $form->error($model,"pok11"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok11"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok12"); ?><?php echo $form->error($model,"pok12"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok12"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok13"); ?><?php echo $form->error($model,"pok13"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok13"); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Ремонт. В этом учебном году в эксплуатацию после ремонта были введены:</b></td>
                </tr>                  
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok14"); ?><?php echo $form->error($model,"pok14"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok14"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok15"); ?><?php echo $form->error($model,"pok15"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok15"); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Столовая. Отметьте факт наличия:</b></td>
                </tr>                  
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok16"); ?><?php echo $form->error($model,"pok16"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok16"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok17"); ?><?php echo $form->error($model,"pok17"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok17"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok18"); ?><?php echo $form->error($model,"pok18"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok18"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok19"); ?><?php echo $form->error($model,"pok19"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok19"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok20"); ?><?php echo $form->error($model,"pok20"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok20"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok21"); ?><?php echo $form->error($model,"pok21"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok21"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok22"); ?><?php echo $form->error($model,"pok22"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok22"); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok23"); ?><?php echo $form->error($model,"pok23"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok23",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok24"); ?><?php echo $form->error($model,"pok24"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok24",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok25"); ?><?php echo $form->error($model,"pok25"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok25",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Спортивный зал. Отметьте наличие безопасного и пригодного для проведения уроков физической культуры спортивного зала и его характеристики:</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok26"); ?><?php echo $form->error($model,"pok26"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok26"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok27"); ?><?php echo $form->error($model,"pok27"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok27"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok28"); ?><?php echo $form->error($model,"pok28"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok28"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok29"); ?><?php echo $form->error($model,"pok29"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok29"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok30"); ?><?php echo $form->error($model,"pok30"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok30"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok31"); ?><?php echo $form->error($model,"pok31"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok31"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok32"); ?><?php echo $form->error($model,"pok32"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok32"); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Территория, оборудованная для реализации раздела 'Легкая атлетика'. Отметьте факт наличия у учреждения:</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok33"); ?><?php echo $form->error($model,"pok33"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok33"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok34"); ?><?php echo $form->error($model,"pok34"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok34"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok35"); ?><?php echo $form->error($model,"pok35"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok35"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok36"); ?><?php echo $form->error($model,"pok36"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok36"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok37"); ?><?php echo $form->error($model,"pok37"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok37"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok38"); ?><?php echo $form->error($model,"pok38"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok38"); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Бассейн. Отметьте факт наличия</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok39"); ?><?php echo $form->error($model,"pok39"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok39"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok40"); ?><?php echo $form->error($model,"pok40"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok40"); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok41"); ?><?php echo $form->error($model,"pok41"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok41",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr>
               <tr>
                     <td colspan="2"><b>Актовые залы и студии. Отметьте факт наличия у учреждения:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok42"); ?><?php echo $form->error($model,"pok42"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok42"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok43"); ?><?php echo $form->error($model,"pok43"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok43"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok44"); ?><?php echo $form->error($model,"pok44"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok44"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok45"); ?><?php echo $form->error($model,"pok45"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok45"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok46"); ?><?php echo $form->error($model,"pok46"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok46"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok47"); ?><?php echo $form->error($model,"pok47"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok47"); ?>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok48"); ?><?php echo $form->error($model,"pok48"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok48",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok49"); ?><?php echo $form->error($model,"pok49"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok49",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                 
                </tr>
               <tr>
                     <td colspan="2"><b>Компьютерные классы. Отметьте факт наличия компьютерных классов:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok50"); ?><?php echo $form->error($model,"pok50"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok50"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok51"); ?><?php echo $form->error($model,"pok51"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok51"); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok52"); ?><?php echo $form->error($model,"pok52"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok52",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Оснащенность компьютерных классов. Отметьте факт наличия (m - проектная наполняемость кабинета):</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok53"); ?><?php echo $form->error($model,"pok53"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok53"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok54"); ?><?php echo $form->error($model,"pok54"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok54"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok55"); ?><?php echo $form->error($model,"pok55"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok55"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok56"); ?><?php echo $form->error($model,"pok56"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok56"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok57"); ?><?php echo $form->error($model,"pok57"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok57"); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok58"); ?><?php echo $form->error($model,"pok58"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok58",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok59"); ?><?php echo $form->error($model,"pok59"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok59",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok60"); ?><?php echo $form->error($model,"pok60"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok60",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok61"); ?><?php echo $form->error($model,"pok61"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok61",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok62"); ?><?php echo $form->error($model,"pok62"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok62",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok63"); ?><?php echo $form->error($model,"pok63"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok63"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Выход в интернет.</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok64"); ?><?php echo $form->error($model,"pok64"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok64"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok65"); ?><?php echo $form->error($model,"pok65"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok65"); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok66"); ?><?php echo $form->error($model,"pok66"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok66",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Кабинет физики (заполняется школами, имеющими классы старше 7-го). Отметьте наличие:</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok67"); ?><?php echo $form->error($model,"pok67"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok67"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok68"); ?><?php echo $form->error($model,"pok68"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok68"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok69"); ?><?php echo $form->error($model,"pok69"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok69"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Лабораторные комплекты по физике. Отметьте факт наличия лабораторных комплектов (в соответствии с общим количеством лабораторных работ согласно программе по физике в 7-11 классах) в количестве не менее m/2 + 1 (где m - проектная наполняемость кабинета) по разделам:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok70"); ?><?php echo $form->error($model,"pok70"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok70"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok71"); ?><?php echo $form->error($model,"pok71"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok71"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok72"); ?><?php echo $form->error($model,"pok72"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok72"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok73"); ?><?php echo $form->error($model,"pok73"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok73"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok74"); ?><?php echo $form->error($model,"pok74"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok74"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Кабинет химии (заполняется школами, имеющими классы старше 7-го). Отметьте наличие:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok75"); ?><?php echo $form->error($model,"pok75"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok75"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok76"); ?><?php echo $form->error($model,"pok76"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok76"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok77"); ?><?php echo $form->error($model,"pok77"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok77"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok78"); ?><?php echo $form->error($model,"pok78"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok78"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Лабораторные комплекты по химии. Отметьте факт наличия лабораторных комплектов оборудования и препаратов (в соответствии с общим количеством лабораторных работ согласно программе по химии в 7-11 классах) в количестве m/2 + 1 (где m - проектная наполняемость кабинета) по разделам:</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok79"); ?><?php echo $form->error($model,"pok79"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok79"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok80"); ?><?php echo $form->error($model,"pok80"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok80"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Лабораторные комплекты по биологии. Отметьте факт наличия лабораторных комплектов (в соответствии с общим количеством лабораторных работ согласно программе по биологии в 5-11 классах) в количестве m/2 + 1 (где m - проектная наполняемость кабинета) по разделам:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok81"); ?><?php echo $form->error($model,"pok81"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok81"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok82"); ?><?php echo $form->error($model,"pok82"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok82"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok83"); ?><?php echo $form->error($model,"pok83"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok83"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok84"); ?><?php echo $form->error($model,"pok84"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok84"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok85"); ?><?php echo $form->error($model,"pok85"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok85"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Географические карты. </b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok86"); ?><?php echo $form->error($model,"pok86"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok86"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok87"); ?><?php echo $form->error($model,"pok87"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok87"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Карты по истории.</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok88"); ?><?php echo $form->error($model,"pok88"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok88"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok89"); ?><?php echo $form->error($model,"pok89"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok89"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Современная библиотека. Отметьте факт наличия:</b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok90"); ?><?php echo $form->error($model,"pok90"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok90"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok91"); ?><?php echo $form->error($model,"pok91"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok91"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok92"); ?><?php echo $form->error($model,"pok92"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok92"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok93"); ?><?php echo $form->error($model,"pok93"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok93"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok94"); ?><?php echo $form->error($model,"pok94"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok94"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok95"); ?><?php echo $form->error($model,"pok95"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok95"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok96"); ?><?php echo $form->error($model,"pok96"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok96"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok97"); ?><?php echo $form->error($model,"pok97"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok97"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Благоустроенность пришкольной территории. </b></td>
                </tr>                 
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok98"); ?><?php echo $form->error($model,"pok98"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok98"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok99"); ?><?php echo $form->error($model,"pok99"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok99"); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok100"); ?><?php echo $form->error($model,"pok100"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok100",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Медицинский кабинет. Отметьте факт наличия лицензированного медицинского кабинета:</b></td>
                </tr>                
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok101"); ?><?php echo $form->error($model,"pok101"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok101"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok102"); ?><?php echo $form->error($model,"pok102"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok102"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok103"); ?><?php echo $form->error($model,"pok103"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok103"); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok104"); ?><?php echo $form->error($model,"pok104"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok104"); ?>
                    </td>                
                </tr>
                <tr>
                     <td colspan="2"><b>Автотранспорт. Отметьте факт наличия</b></td>
                </tr>                   
                <tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok105"); ?><?php echo $form->error($model,"pok105"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok105",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok106"); ?><?php echo $form->error($model,"pok106"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok106",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok107"); ?><?php echo $form->error($model,"pok107"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok107",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok108"); ?><?php echo $form->error($model,"pok108"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"pok108",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr>
                <tr>
                    <td>
                        <?php echo $form->labelEx($model,"pok109"); ?><?php echo $form->error($model,"pok109"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok109"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok110"); ?><?php echo $form->error($model,"pok110"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok110"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok111"); ?><?php echo $form->error($model,"pok111"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok111"); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"pok112"); ?><?php echo $form->error($model,"pok112"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->checkBox($model,"pok112"); ?>
                    </td>                
                </tr> 
                <tr>
                     <td colspan="2"><b>Численность учащихся. </b></td>
                </tr>
<tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"step1"); ?><?php echo $form->error($model,"step1"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"step1",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"step2"); ?><?php echo $form->error($model,"step2"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"step2",array('class'=>'input-mini','maxlength'=>4)); ?>
                    </td>                
                </tr><tr>
                    <td style="text-align: right;">
                        <?php echo $form->labelEx($model,"step3"); ?><?php echo $form->error($model,"step3"); ?>
                    </td>
                    <td style="width: 60px;">
                        <?php echo $form->textField($model,"step3",array('class'=>'input-mini','maxlength'=>4)); ?>
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
