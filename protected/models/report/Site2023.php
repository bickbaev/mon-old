<?php

/**
 * This is the model class for table "site2023".
 *
 * The followings are the available columns in table 'site2023':
 * @property string $id_report
 * @property string $site2
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
 * @property string $pok76
 * @property string $pok77
 * @property string $pok78
 * @property string $pok79
 * @property string $pok80
 * @property string $pok81
 * @property string $pok82
 * @property string $pok83
 * @property string $pok84
 * @property string $pok85
 * @property string $pok86
 * @property string $pok87
 * @property string $pok88
 * @property string $pok89
 * @property string $pok90
 * @property string $pok91
 * @property string $pok92
 * @property string $pok93
 * @property string $pok94
 * @property string $pok95
 * @property string $pok96
 * @property string $pok97
 * @property string $pok98
 * @property string $pok99
 * @property string $pok100
 * @property string $pok101
 * @property string $pok102
 * @property string $pok103
 * @property string $pok104
 * @property string $pok105
 * @property string $pok106
 * @property string $pok107
 * @property string $pok108
 * @property string $pok109
 * @property string $p_date
 * @property string $red
 * @property string $remark
 */
class Site2023 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'site2023';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site2, red', 'length', 'max'=>255),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, pok83, pok84, pok85, pok86, pok87, pok88, pok89, pok90, pok91, pok92, pok93, pok94, pok95, pok96, pok97, pok98, pok99, pok100, pok101, pok102, pok103, pok104, pok105, pok106, pok107, pok108, pok109', 'in','range'=>array(0,1)),
            array('p_date, remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, pok83, pok84, pok85, pok86, pok87, pok88, pok89, pok90, pok91, pok92, pok93, pok94, pok95, pok96, pok97, pok98, pok99, pok100, pok101, pok102, pok103, pok104, pok105, pok106, pok107, pok108, pok109, p_date, red, remark', 'safe', 'on'=>'search'),
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
            'report'=>array(self::BELONGS_TO, 'Report', 'id_report'),
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
            'pok1' => 'Сайт работает',
            'pok2' => 'Версия для слабовидящих',
            'pok3' => 'Наличие специального раздела "Сведения об образовательной организации"',
            'pok4' => 'Механизм навигации представлен на каждой странице специального раздела',
            'pok5' => 'Доступ к специальному разделу осуществляется с главной (основной) страницы Сайта, а также из основного навигационного меню Сайта',
            'pok6' => 'Страницы специального раздела доступны в информационно-телекоммуникационной сети "Интернет" без дополнительной регистрации',
            'pok7' => 'Ссылки на официальные сайты Министерства науки и высшего образования Российской Федерации и Министерства просвещения Российской Федерации в сети "Интернет"',
            'pok8' => 'Ссылка на раздел «Противодействие коррупции» на сайте МОиН Самарской области https://educat.samregion.ru/category/anti-corruption/',
            'pok9' => 'О полном и сокращенном (при наличии) наименовании образовательной организации',
            'pok10' => 'О дате создания образовательной организации',
            'pok11' => 'Об учредителе (учредителях) образовательной организации',
            'pok12' => 'Отсутствуют филиалы и представительства',
            'pok13' => 'О наименовании представительств и филиалов образовательной организации (при наличии) (в том числе, находящихся за пределами Российской Федерации)',
            'pok14' => 'О месте нахождения образовательной организации, ее представительств и филиалов (при наличии)',
            'pok15' => 'О режиме и графике работы образовательной организации, ее представительств и филиалов (при наличии)',
            'pok16' => 'О контактных телефонах образовательной организации, ее представительств и филиалов (при наличии)',
            'pok17' => 'Об адресах электронной почты образовательной организации, ее представительств и филиалов (при наличии)',
            'pok18' => 'Об адресах официальных сайтов представительств и филиалов образовательной организации (при наличии) или страницах в информационно-телекоммуникационной сети "Интернет"',
            'pok19' => 'О местах осуществления образовательной деятельности',
            'pok20' => 'О структуре и об органах управления образовательной организации с указанием наименований структурных подразделений (органов управления)',
            'pok21' => 'Отсутствуют структурные подразделения',
            'pok22' => 'О фамилиях, именах, отчествах (при наличии) и должностях руководителей структурных подразделений',
            'pok23' => 'О местах нахождения структурных подразделений (органов управления) образовательной организации (при наличии структурных подразделений (органов управления)',
            'pok24' => 'Об адресах официальных сайтов в информационно-телекоммуникационной сети "Интернет" структурных подразделений (органов управления) образовательной организации (при наличии официальных сайтов)',
            'pok25' => 'Об адресах электронной почты структурных подразделений (органов управления) образовательной организации (при наличии электронной почты)',
            'pok26' => 'О положениях о структурных подразделениях (об органах управления) образовательной организации с приложением указанных положений в виде электронных документов, подписанных электронной подписью в соответствии с Федеральным законом от 6 апреля 2011 г. № 63-ФЗ "Об электронной подписи" (далее - электронный документ) (при наличии структурных подразделений (органов управления)',
            'pok27' => 'Устав образовательной организации',
            'pok28' => 'Свидетельство о государственной аккредитации (с приложениями) (при наличии)',
            'pok29' => 'Правила внутреннего распорядка обучающихся',
            'pok30' => 'Правила внутреннего трудового распорядка',
            'pok31' => 'Коллективный договор (при наличии)',
            'pok32' => 'Отчет о результатах самообследования',
            'pok33' => 'Предписания органов, осуществляющих государственный контроль (надзор) в сфере образования, отчеты об исполнении таких предписаний (до подтверждения органом, осуществляющим государственный контроль (надзор) в сфере образования, исполнения предписания или признания его недействительным в установленном законом порядке) (при наличии)',
            'pok34' => 'Правила приема обучающихся',
            'pok35' => 'Режим занятий обучающихся',
            'pok36' => 'Формы, периодичность и порядок текущего контроля успеваемости и промежуточной аттестации обучающихся',
            'pok37' => 'Порядок и основания перевода, отчисления и восстановления обучающихся',
            'pok38' => 'Порядок оформления возникновения, приостановления и прекращения отношений между образовательной организацией и обучающимися и (или) родителями (законными представителями) несовершеннолетних обучающихся',
            'pok39' => 'наименование образовательной программы',
            'pok40' => 'форм обучения',
            'pok41' => 'нормативного срока обучения',
            'pok42' => 'срока действия государственной аккредитации образовательной программы (при наличии государственной аккредитации), общественной, профессионально-общественной аккредитации образовательной программы (при наличии общественной, профессионально-общественной аккредитации)',
            'pok43' => 'языка(х), на котором(ых) осуществляется образование (обучение)',
            'pok44' => 'учебных предметов, курсов, дисциплин (модулей), предусмотренных соответствующей образовательной программой',
            'pok45' => 'практики, предусмотренной соответствующей образовательной программой',
            'pok46' => 'об использовании при реализации образовательной программы электронного обучения и дистанционных образовательных технологий',
            'pok47' => 'об учебном плане с приложением его в виде электронного документа',
            'pok48' => 'об аннотации к рабочим программам дисциплин (по каждому учебному предмету, курсу, дисциплине (модулю), практики, в составе образовательной программы) с приложением рабочих программ в виде электронного документа',
            'pok49' => 'о календарном учебном графике с приложением его в виде электронного документа',
            'pok50' => 'о методических и иных документах, разработанных образовательной организацией для обеспечения образовательного процесса, а также рабочей программы воспитания и календарного плана воспитательной работы, включаемых в основные образовательные программы в соответствии с частью 1 статьи 12.1 Федерального закона от 29 декабря 2012 г. N 273-ФЗ "Об образовании в Российской Федерации", в виде электронного документа',
            'pok51' => 'об общей численности обучающихся',
            'pok52' => 'о численности обучающихся за счет бюджетных ассигнований федерального бюджета (в том числе с выделением численности обучающихся, являющихся иностранными гражданами)',
            'pok53' => 'о численности обучающихся за счет бюджетных ассигнований бюджетов субъектов Российской Федерации (в том числе с выделением численности обучающихся, являющихся иностранными гражданами)',
            'pok54' => 'о численности обучающихся за счет бюджетных ассигнований местных бюджетов (в том числе с выделением численности обучающихся, являющихся иностранными гражданами)',
            'pok55' => 'о численности обучающихся по договорам об образовании, заключаемых при приеме на обучение за счет средств физического и (или) юридического лица (далее - договор об оказании платных образовательных услуг) (в том числе с выделением численности обучающихся, являющихся иностранными гражданами)',
            'pok56' => 'О лицензии на осуществление образовательной деятельности (выписке из реестра лицензий на осуществление образовательной деятельности)',
            'pok57' => 'О применяемых федеральных государственных образовательных стандартах, федеральных государственных требованиях с приложением их копий или размещением гиперссылки на действующие редакции соответствующих документов',
            'pok58' => 'Об утвержденных образовательных стандартах, самостоятельно устанавливаемых требованиях с приложением образовательных стандартов, самостоятельно устанавливаемых требований в форме электронного документа или в виде активных ссылок, непосредственный переход по которым позволяет получить доступ к образовательному стандарту, самостоятельно устанавливаемым требованиям в форме электронного документа',
            'pok59' => 'О наличии и условиях предоставления обучающимся стипендий',
            'pok60' => 'О мерах социальной поддержки',
            'pok61' => 'О наличии общежития, интерната',
            'pok62' => 'О количестве жилых помещений в общежитии, интернате для иногородних обучающихся',
            'pok63' => 'О формировании платы за проживание в общежитии',
            'pok64' => 'О трудоустройстве выпускников, с указанием численности трудоустроенных выпускников от общей численности выпускников в прошедшем учебном году, для каждой реализуемой образовательной программы, по которой состоялся выпуск',
            'pok65' => 'О руководителе образовательной организации, в том числе: ФИО, должность, телефон, эл.почта',
            'pok66' => 'О заместителях руководителя образовательной организации, в том числе: ФИО, должность, телефон, эл.почта',
            'pok67' => 'О руководителях филиалов, представительств образовательной организации, в том числе: ФИО, должность, телефон, эл.почта',
            'pok68' => 'О персональном составе педагогических работников каждой реализуемой образовательной программы в форме электронного документа',
            'pok69' => 'Об оборудованных учебных кабинетах',
            'pok70' => 'Об объектах для проведения практических занятий',
            'pok71' => 'О библиотеке(ах)',
            'pok72' => 'Об объектах спорта',
            'pok73' => 'О средствах обучения и воспитания',
            'pok74' => 'Об условиях питания обучающихся',
            'pok75' => 'Об условиях охраны здоровья обучающихся',
            'pok76' => 'О доступе к информационным системам и информационно-телекоммуникационным сетям',
            'pok77' => 'О собственных электронных образовательных и информационных ресурсах (при наличии)',
            'pok78' => 'О сторонних электронных образовательных и информационных ресурсах (при наличии)',
            'pok79' => 'О порядке оказания платных образовательных услуг, в том числе образец договора об оказании платных образовательных услуг',
            'pok80' => 'Об утверждении стоимости обучения по каждой образовательной программе',
            'pok81' => 'Об установлении размера платы, взимаемой с родителей (законных представителей) за присмотр и уход за детьми, осваивающими образовательные программы дошкольного образования в организациях, осуществляющих образовательную деятельность, за содержание детей в образовательной организации, реализующей образовательные программы начального общего, основного общего или среднего общего образования, если в такой образовательной организации созданы условия для проживания обучающихся в интернате, либо за осуществление присмотра и ухода за детьми в группах продленного дня в образовательной организации, реализующей образовательные программы начального общего, основного общего или среднего общего образования.',
            'pok82' => 'Информация об объеме образовательной деятельности, финансовое обеспечение которой осуществляется: за счет бюджетных ассигнований федерального бюджета; за счет бюджетов субъектов Российской Федерации; за счет местных бюджетов; по договорам об оказании платных образовательных услуг;',
            'pok83' => 'Информация о поступлении финансовых и материальных средств по итогам финансового года',
            'pok84' => 'Информация о расходовании финансовых и материальных средств по итогам финансового года',
            'pok85' => 'Копия плана финансово-хозяйственной деятельности образовательной организации, утвержденного в установленном законодательством Российской Федерации порядке, или бюджетной сметы образовательной организации',
            'pok86' => 'Количество вакантных мест для приема (перевода) за счет бюджетных ассигнований федерального бюджета',
            'pok87' => 'Количество вакантных мест для приема (перевода) за счет бюджетных ассигнований бюджетов субъекта Российской Федерации',
            'pok88' => 'Количество вакантных мест для приема (перевода) за счет бюджетных ассигнований местных бюджетов',
            'pok89' => 'Количество вакантных мест для приема (перевода) за счет средств физических и (или) юридических лиц',
            'pok90' => 'О специально оборудованных учебных кабинетах',
            'pok91' => 'Об объектах для проведения практических занятий, приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok92' => 'О библиотеке(ах), приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok93' => 'Об объектах спорта, приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok94' => 'О средствах обучения и воспитания, приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok95' => 'Об обеспечении беспрепятственного доступа в здания образовательной организации',
            'pok96' => 'О специальных условиях питания',
            'pok97' => 'О специальных условиях охраны здоровья',
            'pok98' => 'О доступе к информационным системам и информационно-телекоммуникационным сетям, приспособленным для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok99' => 'Об электронных образовательных ресурсах, к которым обеспечивается доступ инвалидов и лиц с ограниченными возможностями здоровья',
            'pok100' => 'О наличии специальных технических средств обучения коллективного и индивидуального пользования',
            'pok101' => 'О наличии условий для беспрепятственного доступа в общежитие, интернат',
            'pok102' => 'О количестве жилых помещений в общежитии, интернате, приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok103' => 'О заключенных и планируемых к заключению договорах с иностранными и (или) международными организациями по вопросам образования и науки (при наличии)',
            'pok104' => 'О международной аккредитации образовательных программ (при наличии).',
            'pok105' => 'Меню ежедневного горячего питания',
            'pok106' => 'Информацию о наличии диетического меню в образовательной организации',
            'pok107' => 'Перечни юридических лиц и индивидуальных предпринимателей, оказывающих услуги по организации питания в общеобразовательной организации',
            'pok108' => 'Перечни юридических лиц и индивидуальных предпринимателей, поставляющих (реализующих) пищевые продукты и продовольственное сырье в общеобразовательную организацию',
            'pok109' => 'Форма обратной связи для родителей обучающихся и ответы на вопросы родителей по питанию',
            'p_date' => 'Дата проверки',
            'red' => 'Проверяющий',
            'remark' => 'Примечание',
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
        $criteria->compare('pok74',$this->pok74,true);
        $criteria->compare('pok75',$this->pok75,true);
        $criteria->compare('pok76',$this->pok76,true);
        $criteria->compare('pok77',$this->pok77,true);
        $criteria->compare('pok78',$this->pok78,true);
        $criteria->compare('pok79',$this->pok79,true);
        $criteria->compare('pok80',$this->pok80,true);
        $criteria->compare('pok81',$this->pok81,true);
        $criteria->compare('pok82',$this->pok82,true);
        $criteria->compare('pok83',$this->pok83,true);
        $criteria->compare('pok84',$this->pok84,true);
        $criteria->compare('pok85',$this->pok85,true);
        $criteria->compare('pok86',$this->pok86,true);
        $criteria->compare('pok87',$this->pok87,true);
        $criteria->compare('pok88',$this->pok88,true);
        $criteria->compare('pok89',$this->pok89,true);
        $criteria->compare('pok90',$this->pok90,true);
        $criteria->compare('pok91',$this->pok91,true);
        $criteria->compare('pok92',$this->pok92,true);
        $criteria->compare('pok93',$this->pok93,true);
        $criteria->compare('pok94',$this->pok94,true);
        $criteria->compare('pok95',$this->pok95,true);
        $criteria->compare('pok96',$this->pok96,true);
        $criteria->compare('pok97',$this->pok97,true);
        $criteria->compare('pok98',$this->pok98,true);
        $criteria->compare('pok99',$this->pok99,true);
        $criteria->compare('pok100',$this->pok100,true);
        $criteria->compare('pok101',$this->pok101,true);
        $criteria->compare('pok102',$this->pok102,true);
        $criteria->compare('pok103',$this->pok103,true);
        $criteria->compare('pok104',$this->pok104,true);
        $criteria->compare('pok105',$this->pok105,true);
        $criteria->compare('pok106',$this->pok106,true);
        $criteria->compare('pok107',$this->pok107,true);
        $criteria->compare('pok108',$this->pok108,true);
        $criteria->compare('pok109',$this->pok109,true);
        $criteria->compare('p_date',$this->p_date,true);
        $criteria->compare('red',$this->red,true);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Site2023 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    {
        if(!$this->pok1) {
            for($i = 1; $i < 109; $i++) {
                $pok = 'pok'.$i;
                $this->$pok = '';
            }
        }
        $this->p_date=date('Y-m-d H:i:s', time());
        $this->red = Yii::app()->session['id'];
        return TRUE;
    }    
    
    protected function afterFind()
    {
        if($this->p_date == '0000-00-00 00:00:00' || $this->p_date == '') $this->p_date='';
        else $this->p_date=date('d.m.Y H:i:s', strtotime($this->p_date));
    }       
}
