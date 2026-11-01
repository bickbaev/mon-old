<h3>Информация о деятельности общеобразовательного учреждения в сфере профессиональной ориентации за период с 01.09.2012 по 31.08.2013 (2012-2013 учебный год)</h3>
<p><b>Уважаемые коллеги!<br />
С целью сбора статистических данных и оптимизации региональной системы профориентации обучающихся министерство образования и науки Самарской области проводит исследование профориентационной работы общеобразовательных учреждений Самарской области в 2012-2013 учебном году. Просим Вас ответить на все вопросы анкеты.
</b></p>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'profor_anketa',
    'type'=>'horizontal',    
    'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model,'id_report') ?>
<fieldset><legend>1. Специалист, ответственный за проведение профориентационной работы</legend></fieldset>
<?php echo $form->checkBoxRow($model,'pok1_1'); ?>
<p><i>В случае, если специалист есть:</i></p>
<?php echo $form->textFieldRow($model,'pok1_2',array('class'=>'span3','maxlength'=>255)); ?>
<?php echo $form->textFieldRow($model,'pok1_3',array('class'=>'span3','maxlength'=>255)); ?>
<p><i>В случае, если специалист  проходил специальное обучение профориентационной тематики, напротив его должности выберите вариант обучения. Если специалистов, ответственных за проведение профориентационной работы несколько, укажите  сведения об обучении каждого специалиста</i></p>
<?php echo $form->dropDownListRow($model, 'pok1_4', CHtml::listData(Profor_pok1::model()->findAll(array('order' => 'id_profor_pok1 ASC')), 'id_profor_pok1', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok1_5', CHtml::listData(Profor_pok1::model()->findAll(array('order' => 'id_profor_pok1 ASC')), 'id_profor_pok1', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok1_6', CHtml::listData(Profor_pok1::model()->findAll(array('order' => 'id_profor_pok1 ASC')), 'id_profor_pok1', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok1_7', CHtml::listData(Profor_pok1::model()->findAll(array('order' => 'id_profor_pok1 ASC')), 'id_profor_pok1', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok1_8', CHtml::listData(Profor_pok1::model()->findAll(array('order' => 'id_profor_pok1 ASC')), 'id_profor_pok1', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok1_9', CHtml::listData(Profor_pok1::model()->findAll(array('order' => 'id_profor_pok1 ASC')), 'id_profor_pok1', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<div class="control-group">
        <?php echo $form->labelEx($model,'pok1_10',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($model,'pok1_10',array('class'=>'span3','maxlength'=>255)); ?>
        <?php echo $form->dropDownList($model, 'pok1_11', CHtml::listData(Profor_pok1::model()->findAll(array('order' => 'id_profor_pok1 ASC')), 'id_profor_pok1', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span6')); ?>    
        </div>
</div>  

<fieldset><legend>2. Работа профориентационного характера с учащимися ОУ в 2012-2013 учебном году (в том числе сотрудниками сторонних организаций/учреждений) </legend></fieldset>
<?php echo $form->checkBoxRow($model,'pok2_1'); ?>
<p><i>В случае, если проводилась, выберите вариант, соответствующий <b>доле (%) охвата</b> учащихся ОУ профориентационной работой в обозначенной возрастной группе по указанным формам работы (числовой диапазон означает, сколько учащихся 1-4 классов прошли профдиагностику, в процентах от общего количества учащихся 1-4 классов; сколько учащихся 5-7 классов прошли профдиагностику, в процентах от общего количества учащихся 5-7 классов и т.д.) </i></p>
<p><i>Профдиагностика (диагностика профессиональных интересов, склонностей, намерений и т.п. посредством тестирования, анкетирования) и консультирование по результатам диагностики</i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_2', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_3', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_4', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_5', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
<p><i>Профконсультирование (индивидуальные и групповые консультации, беседы с учащимися по вопросам профессионального самоопределения) </i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_6', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_7', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_8', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_9', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
<p><i>Экскурсии в учреждения среднего/высшего профессионального образования (в том числе, дни открытых дверей) </i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_10', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_11', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_12', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_13', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
<p><i>Экскурсии на предприятия и в организации</i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_14', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_15', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_16', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_17', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
<p><i>Ярмарки учебных мест и учреждений среднего/высшего профессионального образования, выставки «Образование и карьера», «Образование. Карьера. Бизнес» и т.п. </i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_18', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_19', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_20', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_21', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
<p><i>Тематические конкурсы по профориентации, конференции, в том числе видеоконференции </i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_22', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_23', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_24', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_25', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>     
<p><i>Интеллектуальные игры (викторины, КВН и т.п.) профориентационной тематики, профориентационные тренинги</i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_26', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_27', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_28', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_29', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
<p><i>Профильные смены</i><p>
    <?php echo $form->dropDownListRow($model, 'pok2_30', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_31', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_32', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_33', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
<?php echo $form->textFieldRow($model,'pok2_34',array('class'=>'span3','maxlength'=>255)); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_35', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
    <?php echo $form->dropDownListRow($model, 'pok2_36', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_37', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>
    <?php echo $form->dropDownListRow($model, 'pok2_38', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span2')); ?>    
<fieldset><legend>3. Работа с педагогическим коллективом ОУ в 2012-2013 учебном году по вопросам профориентации учащихся и их родителей</legend></fieldset>
<?php echo $form->checkBoxRow($model,'pok3_1'); ?>    
<p><i>В случае, если проводилась, укажите долю педагогов ОУ, принявших участие в указанных мероприятиях (в процентах от общего количества педагогов ОУ)</i></p>  
<?php echo $form->dropDownListRow($model, 'pok3_2', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok3_3', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok3_4', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok3_5', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok3_6', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<?php echo $form->dropDownListRow($model, 'pok3_7', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span7')); ?>
<div class="control-group">
        <?php echo $form->labelEx($model,'pok3_8',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($model,'pok3_9',array('class'=>'span3','maxlength'=>255)); ?>
        <?php echo $form->dropDownList($model, 'pok3_8', CHtml::listData(Profor_proc::model()->findAll(array('order' => 'id_profor_proc ASC')), 'id_profor_proc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span6')); ?>    
        </div>
</div> 
<fieldset><legend>4. Работа с родителями учащихся ОУ в 2012-2013 учебном году по вопросам профориентации детей (в том числе сотрудниками сторонних организаций/учреждений)</legend></fieldset>
<?php echo $form->checkBoxRow($model,'pok4_1'); ?>  
<p><i>В случае если проводилась, выберите вид работы (можно несколько)</i></p>
<?php echo $form->checkBoxRow($model,'pok4_2'); ?>
<?php echo $form->checkBoxRow($model,'pok4_3'); ?>
<?php echo $form->checkBoxRow($model,'pok4_4'); ?>
<?php echo $form->checkBoxRow($model,'pok4_5'); ?>
<?php echo $form->checkBoxRow($model,'pok4_6'); ?>
<?php echo $form->checkBoxRow($model,'pok4_7'); ?>
<?php echo $form->checkBoxRow($model,'pok4_8'); ?>
<?php echo $form->textFieldRow($model,'pok4_9',array('class'=>'span4','maxlength'=>255)); ?>
<fieldset><legend>5. Каким образом проводилась профориентационная работа в ОУ в 2012-2013 учебном году?</legend></fieldset>
<?php echo $form->radioButtonListRow($model, 'pok5_1', array(
    'Все профориентационные мероприятия проводились только на базе ОУ только сотрудниками ОУ',
    'Все профориентационные мероприятия проводились только на базе ОУ только приглашенными специалистами сторонних учреждений/организаций',
    'Все профориентационные мероприятия проводились только на базе ОУ сотрудниками ОУ и приглашенными специалистами сторонних учреждений/организаций',
    'Все профориентационные мероприятия проводились только на базе сторонних учреждений/организаций только сотрудниками ОУ',
    'Все профориентационные мероприятия проводились только на базе сторонних учреждений/организаций только специалистами сторонних учреждений/организаций',
    'Все профориентационные мероприятия проводились только на базе сторонних учреждений/организаций сотрудниками ОУ и специалистами сторонних учреждений/организаций',
    'Все профориентационные мероприятия проводились на базе ОУ и сторонних учреждений/организаций и сотрудниками ОУ, и приглашенными специалистами сторонних учреждений/организаций',
)); ?>
<fieldset><legend>6. Перечислите все сторонние учреждения/организации, специалистами которых проводились профориентационные мероприятия в 2012-2013 учебном году, в том числе на базе ОУ:</legend></fieldset>
<?php echo $form->textAreaRow($model, 'pok6_1', array('class'=>'span8', 'rows'=>5)); ?>
<fieldset><legend>7. Какие документы, регламентирующие профориентационную работу, имеются в ОУ (отметьте все имеющиеся)?</legend></fieldset>
<?php echo $form->checkBoxRow($model,'pok7_1'); ?>
<?php echo $form->checkBoxRow($model,'pok7_2'); ?>
<?php echo $form->checkBoxRow($model,'pok7_3'); ?>
<?php echo $form->checkBoxRow($model,'pok7_4'); ?>
<?php echo $form->checkBoxRow($model,'pok7_5'); ?>
<?php echo $form->checkBoxRow($model,'pok7_6'); ?>
<?php echo $form->checkBoxRow($model,'pok7_7'); ?>
<?php echo $form->checkBoxRow($model,'pok7_8'); ?>
<?php echo $form->checkBoxRow($model,'pok7_9'); ?>
<?php echo $form->checkBoxRow($model,'pok7_10'); ?>
<?php echo $form->checkBoxRow($model,'pok7_11'); ?>
<?php echo $form->checkBoxRow($model,'pok7_12'); ?>
<?php echo $form->checkBoxRow($model,'pok7_13'); ?>
<?php echo $form->textFieldRow($model,'pok7_14',array('class'=>'span4','maxlength'=>255)); ?>
<?php echo $form->checkBoxRow($model,'pok7_15'); ?>
<fieldset><legend>8. Оцените оснащенность профориентационной деятельности ОУ учебно-методическими материалами:</legend></fieldset>
<?php echo $form->dropDownListRow($model, 'pok8_1', CHtml::listData(Profor_oc::model()->findAll(array('order' => 'id_profor_oc ASC')), 'id_profor_oc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>
<?php echo $form->dropDownListRow($model, 'pok8_2', CHtml::listData(Profor_oc::model()->findAll(array('order' => 'id_profor_oc ASC')), 'id_profor_oc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>
<?php echo $form->dropDownListRow($model, 'pok8_3', CHtml::listData(Profor_oc::model()->findAll(array('order' => 'id_profor_oc ASC')), 'id_profor_oc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>
<?php echo $form->dropDownListRow($model, 'pok8_4', CHtml::listData(Profor_oc::model()->findAll(array('order' => 'id_profor_oc ASC')), 'id_profor_oc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>
<?php echo $form->dropDownListRow($model, 'pok8_5', CHtml::listData(Profor_oc::model()->findAll(array('order' => 'id_profor_oc ASC')), 'id_profor_oc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>
<div class="control-group">
        <?php echo $form->labelEx($model,'pok8_6',array('class'=>'control-label')); ?>
        <div class="controls">
        <?php echo $form->textField($model,'pok8_6',array('class'=>'span3','maxlength'=>255)); ?>
        <?php echo $form->dropDownList($model, 'pok8_7', CHtml::listData(Profor_oc::model()->findAll(array('order' => 'id_profor_oc ASC')), 'id_profor_oc', 'naim'), array('empty'=>'Выберите вариант', 'class'=>'span4')); ?>    
        </div>
</div> 
<fieldset><legend>9. Отметьте, посещают ли сотрудники ОУ, занимающиеся профориентационной работой, сайт ЦПО Самарской области</legend></fieldset>
<?php echo $form->radioButtonListRow($model, 'pok9_1', array(
    'Да',
    'Нет',
)); ?>
<fieldset><legend>10. Укажите основные проблемы, возникающие при организации и проведении профориентационной работы в ОУ: </legend></fieldset>
<?php echo $form->checkBoxRow($model,'pok10_1'); ?>
<?php echo $form->checkBoxRow($model,'pok10_2'); ?>
<?php echo $form->checkBoxRow($model,'pok10_3'); ?>
<?php echo $form->checkBoxRow($model,'pok10_4'); ?>
<?php echo $form->checkBoxRow($model,'pok10_5'); ?>
<?php echo $form->textFieldRow($model,'pok10_6',array('class'=>'span4','maxlength'=>255)); ?>
<?php echo $form->checkBoxRow($model,'pok10_7'); ?>
<fieldset><legend>11. Есть ли в ОУ кабинет (уголок) профориентации?</legend></fieldset>
<?php echo $form->radioButtonListRow($model, 'pok12_1', array(
    'Да',
    'Нет',
)); ?>
<fieldset><legend>12. Ваши предложения по повышению эффективности профориентационной работы в ОУ</legend></fieldset>
<?php echo $form->textAreaRow($model, 'pok11_1', array('class'=>'span8', 'rows'=>5)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Сохранить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'action', 'icon'=>'remove', 'label'=>'Отмена', 'url'=>$this->createUrl('site/cabinet',array('id'=>Yii::app()->session['est'])))); ?>
</div>

<?php $this->endWidget(); ?> 