<?php

/**
 * This is the model class for table "site2016_spo".
 *
 * The followings are the available columns in table 'site2016_spo':
 * @property string $id_report
 * @property string $site2
 * @property string $pok0
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property string $pok5
 * @property string $pok6
 * @property string $pok7
 * @property string $pok8
 * @property string $pok9
 * @property string $pok10
 * @property string $pok11
 * @property string $pok12
 * @property string $pok13
 * @property string $pok14
 * @property string $pok15
 * @property string $pok16
 * @property string $pok17
 * @property string $pok18
 * @property string $pok19
 * @property string $pok20
 * @property string $pok21
 * @property string $pok22
 * @property string $pok23
 * @property string $pok24
 * @property string $pok25
 * @property string $pok26
 * @property string $pok27
 * @property string $pok28
 * @property string $pok29
 * @property string $pok30
 * @property string $pok31
 * @property string $pok32
 * @property string $pok33
 * @property string $pok34
 * @property string $pok35
 * @property string $pok36
 * @property string $pok37
 * @property string $pok38
 * @property string $pok39
 * @property string $pok40
 * @property string $pok41
 * @property string $pok42
 * @property string $pok43
 * @property string $pok44
 * @property string $pok45
 * @property string $pok46
 * @property string $pok47
 * @property string $pok48
 * @property string $pok49
 * @property string $pok50
 * @property string $pok51
 * @property string $pok52
 * @property string $pok53
 * @property string $pok54
 * @property string $pok55
 * @property string $pok56
 * @property string $pok57
 * @property string $pok58
 * @property string $pok59
 * @property string $pok60
 * @property string $pok61
 * @property string $pok62
 * @property string $pok63
 * @property string $pok64
 * @property string $pok65
 * @property string $pok66
 * @property string $pok67
 * @property string $pok68
 * @property string $pok69
 * @property string $pok70
 * @property string $pok71
 * @property string $pok72
 * @property string $pok73
 * @property string $pok74
 * @property string $pok75
 * @property string $p_date
 * @property string $remark
 */
class Site2016_spo extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'site2016_spo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site2', 'length', 'max'=>255),
            array('pok0, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79', 'in','range'=>array(0,1)),
            array('p_date, remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, site2, pok0, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, p_date, remark', 'safe', 'on'=>'search'),
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
            'site2' => 'Адрес сайта',
            'pok0' => 'Сайт не работает',
            'pok1' => 'Наличие структурных подразделений',
            'pok2' => 'Наличие филиалов',
            'pok3' => 'Наличие специального раздела "Сведения об образовательной организации"',
            'pok4' => 'Информация в специальном разделе представлена в виде набора страниц и (или) иерархического списка и (или) ссылок на другие разделы Сайта',
            'pok5' => 'Информация имеет общий механизм навигации по всем страницам специального раздела',
            'pok6' => 'Механизм навигации представлен на каждой странице специального раздела',
            'pok7' => 'Доступ к специальному разделу осуществляется с главной (основной) страницы Сайта, а также из основного навигационного меню Сайта',
            'pok8' => 'Страницы специального раздела доступны в информационно-телекоммуникационной сети "Интернет" без дополнительной регистрации',
            'pok9' => 'В специальном разделе имеются доступные для посетителей Сайта ссылки на файлы, снабженные информацией, поясняющей назначение данных файлов',
            'pok10' => 'Версия для слабовидящих',
            'pok11' => 'Дата создания образовательной организации',
            'pok12' => 'Информация об учредителе, учредителях образовательной организации',
            'pok13' => 'Информация о представительствах и филиалах образовательной организации, месте нахождения образовательной организации, ее представительств и филиалов (при наличии)',
            'pok14' => 'Режим и график работы',
            'pok15' => 'Контактный телефон',
            'pok16' => 'Адрес электронной почты',
            'pok17' => 'Информация о структуре и об органах управления образовательной организации',
            'pok18' => 'Наименование структурных подразделений (органов управления)',
            'pok19' => 'Руководители структурных подразделений',
            'pok20' => 'Места нахождения структурных подразделений',
            'pok21' => 'Адреса официальных сайтов в сети "Интернет" структурных подразделений (при наличии)',
            'pok22' => 'Адреса электронной почты структурных подразделений (при наличии)',
            'pok23' => 'Сведения о наличии положений о структурных подразделениях (об органах управления) с приложением копий указанных положений (при их наличии)',
            'pok24' => 'Устав образовательной организации',
            'pok25' => 'Лицензия на осуществление образовательной деятельности (с приложениями)',
            'pok26' => 'Свидетельство о государственной аккредитации (с приложениями)',
            'pok27' => 'План финансово-хозяйственной деятельности образовательной организации, утвержденный в установленном законодательством Российской Федерации порядке, или бюджетные сметы образовательной организации',
            'pok28' => 'Локальные нормативные акты, предусмотренные частью 2 статьи 30 Федерального закона "Об образовании в Российской Федерации", правила внутреннего распорядка обучающихся, правила внутреннего трудового распорядка и коллективного договора',
            'pok29' => 'Отчет о результатах самообследования',
            'pok30' => 'Документ о порядке оказания платных образовательных услуг, в том числе образец договора об оказании платных образовательных услуг, документ об утверждении стоимости обучения по каждой образовательной программе',
            'pok31' => 'Предписания органов, осуществляющих государственный контроль (надзор) в сфере образования, отчеты об исполнении таких предписаний',
            'pok32' => 'Реализуемые уровни образования',
            'pok33' => 'Формы обучения',
            'pok34' => 'Нормативные сроки обучения',
            'pok35' => 'Сроки действия государственной аккредитации образовательной программы (при наличии государственной аккредитации)',
            'pok36' => 'Описание образовательной программы с приложением ее копии',
            'pok37' => 'Учебный план с приложением его копии',
            'pok38' => 'Аннотация к рабочим программам дисциплин (по каждой дисциплине в составе образовательной программы) с приложением их копий (при наличии)',
            'pok39' => 'Календарный учебный график с приложением его копии',
            'pok40' => 'Методические и иные документы, разработанные образовательной организацией для обеспечения образовательного процесса',
            'pok41' => 'Реализуемые образовательные программы с указанием учебных предметов, курсов, дисциплин (модулей), практики, предусмотренных соответствующей образовательной программой, а также об использовании при реализации указанных образовательных программ электронного обучения и дистанционных образовательных технологий',
            'pok42' => 'Численность обучающихся по реализуемым образовательным программам за счет бюджетных ассигнований федерального бюджета, бюджетов субъектов Российской Федерации, местных бюджетов и по договорам об образовании за счет средств физических и (или) юридических лиц',
            'pok43' => 'Языки, на которых осуществляется образование (обучение)',
            'pok44' => 'Образовательные организации, реализующие профессиональные образовательные программы, дополнительно, для каждой образовательной программы указывают: а) уровень образования',
            'pok45' => 'б) код и наименование профессии, специальности, направления подготовки',
            'pok46' => 'в) о заключенных и планируемых к заключению договорах с иностранными и (или) международными организациями по вопросам образования и науки',
            'pok47' => 'Информация о результатах приема по каждой профессии, специальности среднего профессионального образования (при наличии вступительных испытаний), каждому направлению подготовки или специальности высшего образования с различными условиями приема (на места, финансируемые за счет бюджетных ассигнований федерального бюджета, бюджетов субъектов Российской Федерации, местных бюджетов, по договорам об образовании за счет средств физических и (или) юридических лиц) с указанием средней суммы набранных баллов по всем вступительным испытаниям, а также о результатах перевода, восстановления и отчисления',
            'pok48' => '48.	Копии документов или гиперссылки на соответствующие документы на сайте Минпросвещения РФ о федеральных государственных образовательных стандартах и об образовательных стандартах',
            'pok49' => 'Руководитель образовательной организации',
            'pok50' => 'Заместители руководителя',
            'pok51' => 'Руководители филиалов образовательной организации (при их наличии), в том числе фамилию, имя, отчество (при наличии) руководителя',
            'pok52' => 'Заместители руководителя филиалов образовательной организации (при их наличии), в том числе фамилию, имя, отчество (при наличии) должность заместителей руководителя',
            'pok53' => 'Контактные телефоны',
            'pok54' => 'Адреса электронной почты',
            'pok55' => 'Персональный состав педагогических работников с указанием уровня образования',
            'pok56' => 'Квалификация и опыт работы, в том числе фамилию, имя, отчество (при наличии) работника, занимаемую должность (должности), преподаваемые дисциплины, ученую степень (при наличии), ученое звание (при наличии), наименование направления подготовки и (или) специальности, данные о повышении квалификации и (или) профессиональной переподготовке (при наличии), общий стаж работы, стаж работы по специальности',
            'pok57' => 'Информация о местах осуществления образовательной деятельности,  включая места, не указываемые в соответствии с Федеральным законом «Об образовании в Российской Федерации» в приложении к лицензии на осуществление образовательной деятельности',
            'pok58' => 'Сведения о наличии оборудованных учебных кабинетов, в том числе приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok59' => 'Объекты для проведения практических занятий, в том числе приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok60' => 'Библиотеки',
            'pok61' => 'Объекты спорта',
            'pok62' => 'Средства обучения и воспитания',
            'pok63' => 'Условия питания и охраны здоровья обучающихся',
            'pok64' => 'Доступ к информационным системам и информационно-телекоммуникационным сетям, в том числе приспособленные для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok65' => 'Электронные образовательные ресурсы, к которым обеспечивается доступ обучающихся',
            'pok66' => 'Наличие и условия предоставления стипендий',
            'pok67' => 'Наличие общежития, интерната',
            'pok68' => 'Количество жилых помещений в общежитии, интернате для иногородних обучающихся',
            'pok69' => 'Формирование платы за проживание в общежитии и иных видов материальной поддержки обучающихся',
            'pok70' => 'Трудоустройство выпускников',
            'pok71' => 'Информация о порядке оказания платных образовательных услуг',
            'pok72' => 'Объем образовательной деятельности, финансовое обеспечение которой осуществляется за счет бюджетных ассигнований федерального бюджета, бюджетов субъектов Российской Федерации, местных бюджетов, по договорам об образовании за счет средств физических и (или) юридических лиц, о поступлении финансовых и материальных средств и об их расходовании по итогам финансового года',
            'pok73' => 'Количество вакантных мест для приема (перевода) по каждой образовательной программе, профессии, специальности, направлению подготовки (на места, финансируемые за счет бюджетных ассигнований федерального бюджета, бюджетов субъектов Российской Федерации, местных бюджетов, по договорам об образовании за счет средств физических и (или) юридических лиц)',
            'pok74' =>  'Обеспечение доступа в здания образовательной организации инвалидов и лиц с ограниченными возможностями здоровья.',
            'pok75' =>  'Наличие специальных технических средств обучения коллективного и индивидуального пользования для инвалидов и лиц с ограниченными возможностями здоровья.',
            'pok76' =>  'Наличие captcha для форм обратной связи.',
            'pok77' =>  'Численность обучающихся, являющихся иностранными гражданами',
            'pok78' =>  'Адрес электронной почты в домене @samara.edu.ru',
            'pok79' =>  'Все архивы в формате .zip',
            'p_date' => 'Дата проверки',
            'red' => 'Проверяющий',
            'remark' => 'Замечания по отчету',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('site2',$this->site2,true);
        $criteria->compare('pok0',$this->pok0,true);
        $criteria->compare('pok1',$this->pok1,true);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3,true);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5,true);
        $criteria->compare('pok6',$this->pok6,true);
        $criteria->compare('pok7',$this->pok7,true);
        $criteria->compare('pok8',$this->pok8,true);
        $criteria->compare('pok9',$this->pok9,true);
        $criteria->compare('pok10',$this->pok10,true);
        $criteria->compare('pok11',$this->pok11,true);
        $criteria->compare('pok12',$this->pok12,true);
        $criteria->compare('pok13',$this->pok13,true);
        $criteria->compare('pok14',$this->pok14,true);
        $criteria->compare('pok15',$this->pok15,true);
        $criteria->compare('pok16',$this->pok16,true);
        $criteria->compare('pok17',$this->pok17,true);
        $criteria->compare('pok18',$this->pok18,true);
        $criteria->compare('pok19',$this->pok19,true);
        $criteria->compare('pok20',$this->pok20,true);
        $criteria->compare('pok21',$this->pok21,true);
        $criteria->compare('pok22',$this->pok22,true);
        $criteria->compare('pok23',$this->pok23,true);
        $criteria->compare('pok24',$this->pok24,true);
        $criteria->compare('pok25',$this->pok25,true);
        $criteria->compare('pok26',$this->pok26,true);
        $criteria->compare('pok27',$this->pok27,true);
        $criteria->compare('pok28',$this->pok28,true);
        $criteria->compare('pok29',$this->pok29,true);
        $criteria->compare('pok30',$this->pok30,true);
        $criteria->compare('pok31',$this->pok31,true);
        $criteria->compare('pok32',$this->pok32,true);
        $criteria->compare('pok33',$this->pok33,true);
        $criteria->compare('pok34',$this->pok34,true);
        $criteria->compare('pok35',$this->pok35,true);
        $criteria->compare('pok36',$this->pok36,true);
        $criteria->compare('pok37',$this->pok37,true);
        $criteria->compare('pok38',$this->pok38,true);
        $criteria->compare('pok39',$this->pok39,true);
        $criteria->compare('pok40',$this->pok40,true);
        $criteria->compare('pok41',$this->pok41,true);
        $criteria->compare('pok42',$this->pok42,true);
        $criteria->compare('pok43',$this->pok43,true);
        $criteria->compare('pok44',$this->pok44,true);
        $criteria->compare('pok45',$this->pok45,true);
        $criteria->compare('pok46',$this->pok46,true);
        $criteria->compare('pok47',$this->pok47,true);
        $criteria->compare('pok48',$this->pok48,true);
        $criteria->compare('pok49',$this->pok49,true);
        $criteria->compare('pok50',$this->pok50,true);
        $criteria->compare('pok51',$this->pok51,true);
        $criteria->compare('pok52',$this->pok52,true);
        $criteria->compare('pok53',$this->pok53,true);
        $criteria->compare('pok54',$this->pok54,true);
        $criteria->compare('pok55',$this->pok55,true);
        $criteria->compare('pok56',$this->pok56,true);
        $criteria->compare('pok57',$this->pok57,true);
        $criteria->compare('pok58',$this->pok58,true);
        $criteria->compare('pok59',$this->pok59,true);
        $criteria->compare('pok60',$this->pok60,true);
        $criteria->compare('pok61',$this->pok61,true);
        $criteria->compare('pok62',$this->pok62,true);
        $criteria->compare('pok63',$this->pok63,true);
        $criteria->compare('pok64',$this->pok64,true);
        $criteria->compare('pok65',$this->pok65,true);
        $criteria->compare('pok66',$this->pok66,true);
        $criteria->compare('pok67',$this->pok67,true);
        $criteria->compare('pok68',$this->pok68,true);
        $criteria->compare('pok69',$this->pok69,true);
        $criteria->compare('pok70',$this->pok70,true);
        $criteria->compare('pok71',$this->pok71,true);
        $criteria->compare('pok72',$this->pok72,true);
        $criteria->compare('pok73',$this->pok73,true);
        $criteria->compare('p_date',$this->p_date,true);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Site2016_spo the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {
        if($this->pok0) {
            for($i = 1; $i < 80; $i++) {
                $pok = 'pok'.$i;
                $this->$pok = '';
            }
        }
        $this->p_date=date('Y-m-d', time());
        $this->red = Yii::app()->session['id'];
        return TRUE;
    }    
    
    protected function afterFind()
    {
    if($this->p_date == '0000-00-00' || $this->p_date == '') $this->p_date='';
    else $this->p_date=date('d.m.Y', strtotime($this->p_date));
    }    
}
