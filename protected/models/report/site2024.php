<?php

/**
 * This is the model class for table "site2024".
 *
 * The followings are the available columns in table 'site2024':
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
 * @property string $p_date
 * @property string $red
 * @property string $remark
 */
class Site2024 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'site2024';
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
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82', 'in','range'=>array(0,1)),
            array('site2, red', 'length', 'max'=>255),
            array('p_date, remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, p_date, red, remark', 'safe', 'on'=>'search'),
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
            'pok1' => 'Сайт работает',
            'pok2' => 'Версия для слабовидящих',
            'pok3' => 'Наличие специального раздела "Сведения об образовательной организации"',
            'pok4' => 'Механизм навигации представлен на каждой странице специального раздела',
            'pok5' => 'Доступ к специальному разделу осуществляется с главной (основной) страницы Сайта, а также из основного навигационного меню Сайта',
            'pok6' => 'Страницы специального раздела доступны в информационно-телекоммуникационной сети "Интернет" без дополнительной регистрации',
            'pok7' => 'Ссылки на официальные сайты Министерства науки и высшего образования Российской Федерации и Министерства просвещения Российской Федерации в сети "Интернет"',
            'pok8' => 'Ссылка на раздел «Противодействие коррупции» на сайте МОиН Самарской области https://educat.samregion.ru/category/anti-corruption/',
            'pok9' => 'о полном и сокращенном (при наличии) наименовании образовательной организации',
            'pok10' => 'о дате создания образовательной организации',
            'pok11' => 'об учредителе (учредителях) образовательной организации',
            'pok12' => 'о месте нахождения образовательной организации',
            'pok13' => 'о режиме и графике работы образовательной организации',
            'pok14' => 'о контактных телефонах образовательной организации',
            'pok15' => 'об адресах электронной почты образовательной организации (адрес электронной почты в домене @63edu.ru или @edu.tgl.ru)',
            'pok16' => 'о местах осуществления образовательной деятельности',
            'pok17' => 'о лицензии на осуществление образовательной деятельности (выписке из реестра лицензий на осуществление образовательной деятельности)',
            'pok18' => 'о наличии или об отсутствии государственной аккредитации образовательной деятельности по реализуемым образовательным программам, за исключением образовательных программ дошкольного образования, программ подготовки научных и научно-педагогических кадров в аспирантуре (адъюнктуре), образовательных программ, реализуемых в соответствии с федеральным государственным образовательным стандартом образования обучающихся с нарушением интеллекта, основных программ профессионального обучения, дополнительных образовательных программ (выписке из государственной информационной системы "Реестр организаций, осуществляющих образовательную деятельность по имеющим государственную аккредитацию образовательным программам" 4)',
            'pok19' => 'Отсутствуют структурные подразделения, в т.ч. филиалы и представительства',
            'pok20' => 'о наименовании структурного подразделения (органа управления)',
            'pok21' => 'о фамилиях, именах, отчествах (при наличии) и должностях руководителей структурных подразделений',
            'pok22' => 'о месте нахождения структурных подразделений',
            'pok23' => 'об адресах официальных сайтов в сети "Интернет" структурных подразделений (при наличии)',
            'pok24' => 'об адресах электронной почты структурных подразделений (при наличии)',
            'pok25' => 'о положениях о структурных подразделениях (об органах управления) образовательной организации с приложением указанных положений в виде электронных документов, подписанных электронной подписью в соответствии с Федеральным законом от 6 апреля 2011 г. № 63-ФЗ "Об электронной подписи" (далее - электронный документ) (при наличии структурных подразделений (органов управления)',
            'pok26' => 'устав образовательной организации',
            'pok27' => 'правила внутреннего распорядка обучающихся',
            'pok28' => 'правила внутреннего трудового распорядка',
            'pok29' => 'коллективный договор (при наличии)',
            'pok30' => 'правила приема обучающихся',
            'pok31' => 'режим занятий обучающихся',
            'pok32' => 'формы, периодичность и порядок текущего контроля успеваемости и промежуточной аттестации обучающихся',
            'pok33' => 'порядок и основания перевода, отчисления и восстановления обучающихся',
            'pok34' => 'порядок оформления возникновения, приостановления и прекращения отношений между образовательной организацией и обучающимися и (или) родителями (законными представителями) несовершеннолетних обучающихся',
            'pok35' => 'отчет о результатах самообследования',
            'pok36' => 'предписания органов, осуществляющих государственный контроль (надзор) в сфере образования, отчеты об исполнении таких предписаний (до подтверждения органом, осуществляющим государственный контроль (надзор) в сфере образования, исполнения предписания или признания его недействительным в установленном законом порядке) (при наличии)',
            'pok37' => 'о реализуемых образовательных программах с указанием учебных предметов, курсов, дисциплин (модулей), практики, предусмотренных соответствующей образовательной программой (за исключением образовательных программ дошкольного образования), представляемую в виде образовательной программы в форме электронного документа или в виде активных ссылок, непосредственный переход по которым позволяет получить доступ к страницам Сайта, содержащим отдельные компоненты образовательной программы',
            'pok38' => 'о численности обучающихся по реализуемым образовательным программам, в том числе о численности обучающихся за счет бюджетных ассигнований федерального бюджета, о численности обучающихся за счет бюджетных ассигнований бюджетов субъектов Российской Федерации, о численности обучающихся за счет бюджетных ассигнований местных бюджетов, о численности обучающихся за счет средств физических и (или) юридических лиц.',
            'pok39' => 'о численности обучающихся, являющихся иностранными гражданами, по каждой общеобразовательной программе и каждой профессии, специальности, в том числе научной, направлению подготовки или укрупненной группе профессий, специальностей и направлений подготовки (для профессиональных образовательных программ)',
            'pok40' => 'о языках образования (в форме электронного документа)',
            'pok41' => 'О руководителе образовательной организации, в том числе: ФИО, должность, телефон, эл.почта',
            'pok42' => 'О заместителях руководителя образовательной организации, в том числе: ФИО, должность, телефон, эл.почта',
            'pok43' => 'О руководителях филиалов, представительств образовательной организации, в том числе: ФИО, должность, телефон, эл.почта',
            'pok44' => 'Информация о персональном составе педагогических работников',
            'pok45' => 'о наличии оборудованных учебных кабинетов',
            'pok46' => 'о наличии оборудованных объектов для проведения практических занятий',
            'pok47' => 'о наличии оборудованных библиотек',
            'pok48' => 'о наличии оборудованных объектов спорта',
            'pok49' => 'о наличии оборудованных средствах обучения и воспитания',
            'pok50' => 'о доступе к информационным системам и информационно-телекоммуникационным сетям',
            'pok51' => 'об электронных образовательных ресурсах, к которым обеспечивается доступ обучающихся',
            'pok52' => 'о количестве жилых помещений в общежитии, интернате, формировании платы за проживание в общежитии',
            'pok53' => 'об обеспечении доступа в здания образовательной организации, в том числе в общежитие, интернат, приспособленных для использования инвалидами и лицами с ограниченными возможностями здоровья',
            'pok54' => 'о наличии специальных технических средств обучения коллективного и индивидуального пользования инвалидов и лиц с ограниченными возможностями здоровья',
            'pok55' => 'о порядке оказания платных образовательных услуг, в том числе образец договора об оказании платных образовательных услуг',
            'pok56' => 'об утверждении стоимости обучения по каждой образовательной программе',
            'pok57' => 'об установлении размера платы, взимаемой с родителей (законных представителей) за присмотр и уход за детьми, осваивающими образовательные программы дошкольного образования в организациях, осуществляющих образовательную деятельность, за содержание детей в образовательной организации, реализующей образовательные программы начального общего, основного общего или среднего общего образования, если в такой образовательной организации созданы условия для проживания обучающихся в интернате, либо за осуществление присмотра и ухода за детьми в группах продленного дня в образовательной организации, реализующей образовательные программы начального общего, основного общего или среднего общего образования',
            'pok58' => 'о порядке оказания платных образовательных услуг, в том числе образец договора об оказании платных образовательных услуг',
            'pok59' => 'об утверждении стоимости обучения по каждой образовательной программе',
            'pok60' => 'об установлении размера платы, взимаемой с родителей (законных представителей) за присмотр и уход за детьми, осваивающими образовательные программы дошкольного образования в организациях, осуществляющих образовательную деятельность, за содержание детей в образовательной организации, реализующей образовательные программы начального общего, основного общего или среднего общего образования, если в такой образовательной организации созданы условия для проживания обучающихся в интернате, либо за осуществление присмотра и ухода за детьми в группах продленного дня в образовательной организации, реализующей образовательные программы начального общего, основного общего или среднего общего образования',
            'pok61' => 'информацию об объеме образовательной деятельности, финансовое обеспечение которой осуществляется: за счет бюджетных ассигнований федерального бюджета; за счет бюджетов субъектов Российской Федерации; за счет местных бюджетов; по договорам об оказании платных образовательных услуг',
            'pok62' => 'информацию о поступлении финансовых и материальных средств по итогам финансового года',
            'pok63' => 'информацию о расходовании финансовых и материальных средств по итогам финансового года',
            'pok64' => 'копия плана финансово-хозяйственной деятельности образовательной организации, утвержденного в установленном законодательством Российской Федерации порядке, или бюджетную смету образовательной организации в форме электронного документа',
            'pok65' => 'количество вакантных мест для приема (перевода) за счет бюджетных ассигнований федерального бюджета',
            'pok66' => 'количество вакантных мест для приема (перевода) за счет бюджетных ассигнований бюджетов субъекта Российской Федерации',
            'pok67' => 'количество вакантных мест для приема (перевода) за счет бюджетных ассигнований местных бюджетов',
            'pok68' => 'количество вакантных мест для приема (перевода) за счет средств физических и (или) юридических лиц',
            'pok69' => 'о наличии и условиях предоставления обучающимся стипендий',
            'pok70' => 'о наличии и условиях предоставления обучающимся мер социальной поддержки',
            'pok71' => 'о наличии общежития, интерната',
            'pok72' => 'о количестве жилых помещений в общежитии, интернате для иногородних обучающихся',
            'pok73' => 'о формировании платы за проживание в общежитии',
            'pok74' => 'о заключенных и планируемых к заключению договорах с иностранными и (или) международными организациями по вопросам образования и науки (при наличии)',
            'pok75' => 'об условиях питания и охраны здоровья обучающихся',
            'pok76' => 'меню ежедневного горячего питания',
            'pok77' => 'информацию о наличии диетического меню в общеобразовательной организации',
            'pok78' => 'перечни юридических лиц и индивидуальных предпринимателей, оказывающих услуги по организации питания в общеобразовательной организации',
            'pok79' => 'перечни юридических лиц и индивидуальных предпринимателей, поставляющих (реализующих) пищевые продукты и продовольственное сырье в общеобразовательную организацию',
            'pok80' => 'форма обратной связи для родителей обучающихся и ответы на вопросы родителей по питанию.',
            'pok81' => 'о применяемых федеральных государственных образовательных стандартах, федеральных государственных требованиях. Информация размещается в виде активных ссылок, непосредственный переход по которым позволяет получить доступ к официально опубликованным нормативным правовым актам',
            'pok82' => 'об утвержденных образовательных стандартах, самостоятельно устанавливаемых требованиях с приложением образовательных стандартов, самостоятельно устанавливаемых требований в форме электронного документа или копии',
            'p_date' => 'Дата проверки',
            'red' => 'Проверяющий',
            'remark' => 'Remark',
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
     * @return Site2024 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}