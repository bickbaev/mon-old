<?php

/**
 * This is the model class for table "profor_anketa".
 *
 * The followings are the available columns in table 'profor_anketa':
 * @property string $id_report
 * @property string $pok1_1
 * @property string $pok1_2
 * @property string $pok1_3
 * @property string $pok1_4
 * @property string $pok1_5
 * @property string $pok1_6
 * @property string $pok1_7
 * @property string $pok1_8
 * @property string $pok1_9
 * @property string $pok1_10
 * @property string $pok1_11
 * @property string $pok2_1
 * @property string $pok2_2
 * @property string $pok2_3
 * @property string $pok2_4
 * @property string $pok2_5
 * @property string $pok2_6
 * @property string $pok2_7
 * @property string $pok2_8
 * @property string $pok2_9
 * @property string $pok2_10
 * @property string $pok2_11
 * @property string $pok2_12
 * @property string $pok2_13
 * @property string $pok2_14
 * @property string $pok2_15
 * @property string $pok2_16
 * @property string $pok2_17
 * @property string $pok2_18
 * @property string $pok2_19
 * @property string $pok2_20
 * @property string $pok2_21
 * @property string $pok2_22
 * @property string $pok2_23
 * @property string $pok2_24
 * @property string $pok2_25
 * @property string $pok2_26
 * @property string $pok2_27
 * @property string $pok2_28
 * @property string $pok2_29
 * @property string $pok2_30
 * @property string $pok2_31
 * @property string $pok2_32
 * @property string $pok2_33
 * @property string $pok2_34
 * @property string $pok2_35
 * @property string $pok2_36
 * @property string $pok2_37
 * @property string $pok2_38
 * @property string $pok3_1
 * @property string $pok3_2
 * @property string $pok3_3
 * @property string $pok3_4
 * @property string $pok3_5
 * @property string $pok3_6
 * @property string $pok3_7
 * @property string $pok3_8
 * @property string $pok3_9
 * @property string $pok4_1
 * @property string $pok4_2
 * @property string $pok4_3
 * @property string $pok4_4
 * @property string $pok4_5
 * @property string $pok4_6
 * @property string $pok4_7
 * @property string $pok4_8
 * @property string $pok4_9
 * @property string $pok5_1
 * @property string $pok6_1
 * @property string $pok7_1
 * @property string $pok7_2
 * @property string $pok7_3
 * @property string $pok7_4
 * @property string $pok7_5
 * @property string $pok7_6
 * @property string $pok7_7
 * @property string $pok7_8
 * @property string $pok7_9
 * @property string $pok7_10
 * @property string $pok7_11
 * @property string $pok7_12
 * @property string $pok7_13
 * @property string $pok7_14
 * @property string $pok7_15
 * @property string $pok8_1
 * @property string $pok8_2
 * @property string $pok8_3
 * @property string $pok8_4
 * @property string $pok8_5
 * @property string $pok8_6
 * @property string $pok8_7
 * @property string $pok9_1
 * @property string $pok10_1
 * @property string $pok10_2
 * @property string $pok10_3
 * @property string $pok10_4
 * @property string $pok10_5
 * @property string $pok10_6
 * @property string $pok10_7
 * @property string $pok11_1
 * @property string $pok12_1
 */
class Profor_anketa extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Profor_anketa the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'profor_anketa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report', 'required'),
            array('id_report', 'length', 'max'=>10),
            array('pok1_1, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_11, pok2_1, pok3_1, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok4_6, pok4_7, pok4_8, pok7_1, pok7_2, pok7_3, pok7_4, pok7_5, pok7_6, pok7_7, pok7_8, pok7_9, pok7_10, pok7_11, pok7_12, pok7_13, pok7_15, pok8_1, pok8_2, pok8_3, pok8_4, pok8_5, pok8_7, pok9_1, pok10_1, pok10_2, pok10_3, pok10_4, pok10_5, pok10_7, pok12_1', 'length', 'max'=>1),
            
            array('pok1_2, pok1_3, pok1_10, pok2_34, pok3_9, pok4_9, pok8_6, pok10_6', 'length', 'max'=>255),
            array('pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok2_7, pok2_8, pok2_9, pok2_10, pok2_11, pok2_12, pok2_13, pok2_14, pok2_15, pok2_16, pok2_17, pok2_18, pok2_19, pok2_20, pok2_21, pok2_22, pok2_23, pok2_24, pok2_25, pok2_26, pok2_27, pok2_28, pok2_29, pok2_30, pok2_31, pok2_32, pok2_33, pok2_35, pok2_36, pok2_37, pok2_38, pok3_2, pok3_3, pok3_4, pok3_5, pok3_6, pok3_7, pok3_8, pok5_1', 'length', 'max'=>2),
            array('pok6_1, pok7_14, pok11_1', 'safe'),
            
            array('pok6_1, pok7_14, pok11_1, pok1_2, pok1_10, pok2_34, pok3_9, pok4_9, pok8_6, pok10_6','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            array('pok1_1, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_11, pok2_1, pok3_1, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok4_6, pok4_7, pok4_8, pok7_1, pok7_2, pok7_3, pok7_4, pok7_5, pok7_6, pok7_7, pok7_8, pok7_9, pok7_10, pok7_11, pok7_12, pok7_13, pok7_15, pok8_1, pok8_2, pok8_3, pok8_4, pok8_5, pok8_7, pok9_1, pok10_1, pok10_2, pok10_3, pok10_4, pok10_5, pok10_7, pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok2_7, pok2_8, pok2_9, pok2_10, pok2_11, pok2_12, pok2_13, pok2_14, pok2_15, pok2_16, pok2_17, pok2_18, pok2_19, pok2_20, pok2_21, pok2_22, pok2_23, pok2_24, pok2_25, pok2_26, pok2_27, pok2_28, pok2_29, pok2_30, pok2_31, pok2_32, pok2_33, pok2_35, pok2_36, pok2_37, pok2_38, pok3_2, pok3_3, pok3_4, pok3_5, pok3_6, pok3_7, pok3_8, pok5_1, pok12_1', 'numerical', 'integerOnly'=>true),
            array('pok1_2', 'match', 'pattern'=>'/^[а-яА-Я\-\s]*$/u', 'message'=>'В имени, фамилии и отчестве можно использовать только буквы кириллицы, цифры и тире'),
            array('pok1_3', 'email'),
            array('pok1_10, pok2_34, pok3_8, pok4_9, pok7_14, pok8_6', 'match', 'pattern'=>'/^[а-яА-Я0-9,\.\-\s]*$/u', 'message'=>'В показателе можно использовать только буквы кириллицы, цифры, тире, точку и запятую'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, pok1_1, pok1_2, pok1_3, pok1_4, pok1_5, pok1_6, pok1_7, pok1_8, pok1_9, pok1_10, pok1_11, pok2_1, pok2_2, pok2_3, pok2_4, pok2_5, pok2_6, pok2_7, pok2_8, pok2_9, pok2_10, pok2_11, pok2_12, pok2_13, pok2_14, pok2_15, pok2_16, pok2_17, pok2_18, pok2_19, pok2_20, pok2_21, pok2_22, pok2_23, pok2_24, pok2_25, pok2_26, pok2_27, pok2_28, pok2_29, pok2_30, pok2_31, pok2_32, pok2_33, pok2_34, pok2_35, pok2_36, pok2_37, pok2_38, pok3_1, pok3_2, pok3_3, pok3_4, pok3_5, pok3_6, pok3_7, pok3_8, pok3_9, pok4_1, pok4_2, pok4_3, pok4_4, pok4_5, pok4_6, pok4_7, pok4_8, pok4_9, pok5_1, pok6_1, pok7_1, pok7_2, pok7_3, pok7_4, pok7_5, pok7_6, pok7_7, pok7_8, pok7_9, pok7_10, pok7_11, pok7_12, pok7_13, pok7_14, pok7_15, pok8_1, pok8_2, pok8_3, pok8_4, pok8_5, pok8_6, pok8_7, pok9_1, pok10_1, pok10_2, pok10_3, pok10_4, pok10_5, pok10_6, pok10_7, pok11_1', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_report' => 'Id Report',
            'pok1_1' => 'В ОУ нет специалиста, ответственного за проведение профориентационной работы',
            'pok1_2' => 'ФИО специалиста',
            'pok1_3' => 'e-mail специалиста',
            'pok1_4' => 'директор',
            'pok1_5' => 'заместитель директора',
            'pok1_6' => 'социальный педагог',
            'pok1_7' => 'психолог, педагог-психолог',
            'pok1_8' => 'библиотекарь',
            'pok1_9' => 'учитель-предметник',
            'pok1_10' => 'другой специалист (впишите, кто именно)',
            'pok1_11' => 'другой специалист (впишите, кто именно)',
            'pok2_1' => 'профориентационная работа с учащимися ОУ в 2012-2013 учебном году не проводилась',
            'pok2_2' => 'Учащиеся 1-4 классов',
            'pok2_3' => 'Учащиеся 5-7 классов',
            'pok2_4' => 'Учащиеся 8-9 классов',
            'pok2_5' => 'Учащиеся 10-11 классов',
            'pok2_6' => 'Учащиеся 1-4 классов',
            'pok2_7' => 'Учащиеся 5-7 классов',
            'pok2_8' => 'Учащиеся 8-9 классов',
            'pok2_9' => 'Учащиеся 10-11 классов',
            'pok2_10' => 'Учащиеся 1-4 классов',
            'pok2_11' => 'Учащиеся 5-7 классов',
            'pok2_12' => 'Учащиеся 8-9 классов',
            'pok2_13' => 'Учащиеся 10-11 классов',
            'pok2_14' => 'Учащиеся 1-4 классов',
            'pok2_15' => 'Учащиеся 5-7 классов',
            'pok2_16' => 'Учащиеся 8-9 классов',
            'pok2_17' => 'Учащиеся 10-11 классов',
            'pok2_18' => 'Учащиеся 1-4 классов',
            'pok2_19' => 'Учащиеся 5-7 классов',
            'pok2_20' => 'Учащиеся 8-9 классов',
            'pok2_21' => 'Учащиеся 10-11 классов',
            'pok2_22' => 'Учащиеся 1-4 классов',
            'pok2_23' => 'Учащиеся 5-7 классов',
            'pok2_24' => 'Учащиеся 8-9 классов',
            'pok2_25' => 'Учащиеся 10-11 классов',
            'pok2_26' => 'Учащиеся 1-4 классов',
            'pok2_27' => 'Учащиеся 5-7 классов',
            'pok2_28' => 'Учащиеся 8-9 классов',
            'pok2_29' => 'Учащиеся 10-11 классов',
            'pok2_30' => 'Учащиеся 1-4 классов',
            'pok2_31' => 'Учащиеся 5-7 классов',
            'pok2_32' => 'Учащиеся 8-9 классов',
            'pok2_33' => 'Учащиеся 10-11 классов',            
            'pok2_34' => 'Другое (впишите, что именно)',
            'pok2_35' => 'Учащиеся 1-4 классов',
            'pok2_36' => 'Учащиеся 5-7 классов',
            'pok2_37' => 'Учащиеся 8-9 классов',
            'pok2_38' => 'Учащиеся 10-11 классов',
            'pok3_1' => 'работа с педагогическим коллективом ОУ по вопросам профориентации учащихся и их родителей в 2012-2013 учебном году не проводилась',
            'pok3_2' => 'Тематический педагогический совет ОУ по профориентации',
            'pok3_3' => 'Совещание при директоре, заместителе директора по вопросам профориентационной тематики',
            'pok3_4' => 'Семинар любого уровня (районный, окружной, областной, всероссийский и др.) профориентационной тематики',
            'pok3_5' => 'Тематический конкурс любого уровня по профориентации для педагогов',
            'pok3_6' => 'Тематическая конференция по профориентации, в том числе интернет-конференция, любого уровня для педагогов ',
            'pok3_7' => 'Профориентационная экскурсия с учащимися ',
            'pok3_8' => 'Другое (впишите, что именно)',
            'pok3_9' => 'Другое (впишите, что именно)',
            'pok4_1' => 'работа с родителями учащихся ОУ по вопросам профориентации детей в 2012-2013 учебном году не проводилась',
            'pok4_2' => 'родительское собрание для класса профориентационной тематики',
            'pok4_3' => 'родительское собрание для параллели профориентационной тематики',
            'pok4_4' => 'общешкольное родительское собрание профориентационной тематики',
            'pok4_5' => 'анкетирование родителей по вопросам профориентации детей',
            'pok4_6' => 'индивидуальные и/или групповые консультации по вопросам профориентации детей',
            'pok4_7' => 'привлечение родителей к участию в экскурсиях профориентационной тематики',
            'pok4_8' => 'привлечение родителей к участию в массовых мероприятиях профориентационной тематики (ярмарки, выставки и т.п.)',
            'pok4_9' => 'другое (впишите, что именно) ',
            'pok5_1' => 'Выберите один вариант ответа',
            'pok6_1' => 'Перечислите в свободной форме',
            'pok7_1' => 'Положение о профориентационной работе в образовательном учреждении',
            'pok7_2' => 'Положение о совете по профессиональной ориентации',
            'pok7_3' => 'Положение о кабинете профессиональной ориентации',
            'pok7_4' => 'Приказ о назначении ответственного за профориентационную работу с утверждением его функциональных обязанностей',
            'pok7_5' => 'Приказ о внесении изменений в должностные обязанности педагогических работников в части организации деятельности по профессиональной ориентации учащихся',
            'pok7_6' => 'Программа профориентационной работы ОУ',
            'pok7_7' => 'План профориентационной работы на 2012-2013 учебный год',
            'pok7_8' => 'План совместной деятельности ОУ со сторонними организациями/учреждениями по проведению профориентационной работы',
            'pok7_9' => 'Договора о сотрудничестве и совместной деятельности ОУ со сторонними организациями/ учреждениями по проведению профориентационной работы',
            'pok7_10' => 'Приказ об организации предпрофильной подготовки учащихся основной школы',
            'pok7_11' => 'Положение о курсах по выбору в рамках предпрофильной подготовки учащихся основной школы',
            'pok7_12' => 'Положение о психолого-педагогическом сопровождении предпрофильной подготовки',
            'pok7_13' => 'Положение о профильном обучении учащихся на старшей ступени среднего (полного) общего образования (об индивидуальной образовательной траектории учащегося)',
            'pok7_14' => 'Другие документы (впишите, какие именно)',
            'pok7_15' => 'Документы, регламентирующие профориентационную работу в ОУ, отсутствуют',
            'pok8_1' => 'Нормативно-правовые документы, регламентирующие профориентационную деятельность в ОУ',
            'pok8_2' => 'Издания справочного характера (профессиограммы, справочники по учреждениям профессионального образования, рынку труда, предприятиям и организациям и др.)',
            'pok8_3' => 'Методические материалы (методические пособия, рекомендации, бюллетени и др. по организации и содержанию профориентационной работы в ОУ)',
            'pok8_4' => 'Периодические издания (газеты, журналы, содержащие публикации профориентационной тематики)',
            'pok8_5' => 'Диагностический инструментарий (профориентационные диагностические методики) ',
            'pok8_6' => 'Другое (впишите, что именно)',
            'pok8_7' => 'Другое (впишите, что именно)',
            'pok9_1' => '',
            'pok10_1' => 'кадровые',
            'pok10_2' => 'управленческие',
            'pok10_3' => 'финансовые',
            'pok10_4' => 'информационные',
            'pok10_5' => 'организационно-координационные',
            'pok10_6' => 'другие (впишите, какие именно)',
            'pok10_7' => 'проблемы отсутствуют',
            'pok11_1' => 'Напишите в свободной форме',
            'pok12_1' => '',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('pok1_1',$this->pok1_1,true);
        $criteria->compare('pok1_2',$this->pok1_2,true);
        $criteria->compare('pok1_3',$this->pok1_3,true);
        $criteria->compare('pok1_4',$this->pok1_4,true);
        $criteria->compare('pok1_5',$this->pok1_5,true);
        $criteria->compare('pok1_6',$this->pok1_6,true);
        $criteria->compare('pok1_7',$this->pok1_7,true);
        $criteria->compare('pok1_8',$this->pok1_8,true);
        $criteria->compare('pok1_9',$this->pok1_9,true);
        $criteria->compare('pok1_10',$this->pok1_10,true);
        $criteria->compare('pok1_11',$this->pok1_11,true);
        $criteria->compare('pok2_1',$this->pok2_1,true);
        $criteria->compare('pok2_2',$this->pok2_2,true);
        $criteria->compare('pok2_3',$this->pok2_3,true);
        $criteria->compare('pok2_4',$this->pok2_4,true);
        $criteria->compare('pok2_5',$this->pok2_5,true);
        $criteria->compare('pok2_6',$this->pok2_6,true);
        $criteria->compare('pok2_7',$this->pok2_7,true);
        $criteria->compare('pok2_8',$this->pok2_8,true);
        $criteria->compare('pok2_9',$this->pok2_9,true);
        $criteria->compare('pok2_10',$this->pok2_10,true);
        $criteria->compare('pok2_11',$this->pok2_11,true);
        $criteria->compare('pok2_12',$this->pok2_12,true);
        $criteria->compare('pok2_13',$this->pok2_13,true);
        $criteria->compare('pok2_14',$this->pok2_14,true);
        $criteria->compare('pok2_15',$this->pok2_15,true);
        $criteria->compare('pok2_16',$this->pok2_16,true);
        $criteria->compare('pok2_17',$this->pok2_17,true);
        $criteria->compare('pok2_18',$this->pok2_18,true);
        $criteria->compare('pok2_19',$this->pok2_19,true);
        $criteria->compare('pok2_20',$this->pok2_20,true);
        $criteria->compare('pok2_21',$this->pok2_21,true);
        $criteria->compare('pok2_22',$this->pok2_22,true);
        $criteria->compare('pok2_23',$this->pok2_23,true);
        $criteria->compare('pok2_24',$this->pok2_24,true);
        $criteria->compare('pok2_25',$this->pok2_25,true);
        $criteria->compare('pok2_26',$this->pok2_26,true);
        $criteria->compare('pok2_27',$this->pok2_27,true);
        $criteria->compare('pok2_28',$this->pok2_28,true);
        $criteria->compare('pok2_29',$this->pok2_29,true);
        $criteria->compare('pok2_30',$this->pok2_30,true);
        $criteria->compare('pok2_31',$this->pok2_31,true);
        $criteria->compare('pok2_32',$this->pok2_32,true);
        $criteria->compare('pok2_33',$this->pok2_33,true);
        $criteria->compare('pok2_34',$this->pok2_34,true);
        $criteria->compare('pok2_35',$this->pok2_35,true);
        $criteria->compare('pok2_36',$this->pok2_36,true);
        $criteria->compare('pok2_37',$this->pok2_37,true);
        $criteria->compare('pok2_38',$this->pok2_38,true);
        $criteria->compare('pok3_1',$this->pok3_1,true);
        $criteria->compare('pok3_2',$this->pok3_2,true);
        $criteria->compare('pok3_3',$this->pok3_3,true);
        $criteria->compare('pok3_4',$this->pok3_4,true);
        $criteria->compare('pok3_5',$this->pok3_5,true);
        $criteria->compare('pok3_6',$this->pok3_6,true);
        $criteria->compare('pok3_7',$this->pok3_7,true);
        $criteria->compare('pok3_8',$this->pok3_8,true);
        $criteria->compare('pok3_9',$this->pok3_9,true);
        $criteria->compare('pok4_1',$this->pok4_1,true);
        $criteria->compare('pok4_2',$this->pok4_2,true);
        $criteria->compare('pok4_3',$this->pok4_3,true);
        $criteria->compare('pok4_4',$this->pok4_4,true);
        $criteria->compare('pok4_5',$this->pok4_5,true);
        $criteria->compare('pok4_6',$this->pok4_6,true);
        $criteria->compare('pok4_7',$this->pok4_7,true);
        $criteria->compare('pok4_8',$this->pok4_8,true);
        $criteria->compare('pok4_9',$this->pok4_9,true);
        $criteria->compare('pok5_1',$this->pok5_1,true);
        $criteria->compare('pok6_1',$this->pok6_1,true);
        $criteria->compare('pok7_1',$this->pok7_1,true);
        $criteria->compare('pok7_2',$this->pok7_2,true);
        $criteria->compare('pok7_3',$this->pok7_3,true);
        $criteria->compare('pok7_4',$this->pok7_4,true);
        $criteria->compare('pok7_5',$this->pok7_5,true);
        $criteria->compare('pok7_6',$this->pok7_6,true);
        $criteria->compare('pok7_7',$this->pok7_7,true);
        $criteria->compare('pok7_8',$this->pok7_8,true);
        $criteria->compare('pok7_9',$this->pok7_9,true);
        $criteria->compare('pok7_10',$this->pok7_10,true);
        $criteria->compare('pok7_11',$this->pok7_11,true);
        $criteria->compare('pok7_12',$this->pok7_12,true);
        $criteria->compare('pok7_13',$this->pok7_13,true);
        $criteria->compare('pok7_14',$this->pok7_14,true);
        $criteria->compare('pok7_15',$this->pok7_15,true);
        $criteria->compare('pok8_1',$this->pok8_1,true);
        $criteria->compare('pok8_2',$this->pok8_2,true);
        $criteria->compare('pok8_3',$this->pok8_3,true);
        $criteria->compare('pok8_4',$this->pok8_4,true);
        $criteria->compare('pok8_5',$this->pok8_5,true);
        $criteria->compare('pok8_6',$this->pok8_6,true);
        $criteria->compare('pok8_7',$this->pok8_7,true);
        $criteria->compare('pok9_1',$this->pok9_1,true);
        $criteria->compare('pok10_1',$this->pok10_1,true);
        $criteria->compare('pok10_2',$this->pok10_2,true);
        $criteria->compare('pok10_3',$this->pok10_3,true);
        $criteria->compare('pok10_4',$this->pok10_4,true);
        $criteria->compare('pok10_5',$this->pok10_5,true);
        $criteria->compare('pok10_6',$this->pok10_6,true);
        $criteria->compare('pok10_7',$this->pok10_7,true);
        $criteria->compare('pok11_1',$this->pok11_1,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 