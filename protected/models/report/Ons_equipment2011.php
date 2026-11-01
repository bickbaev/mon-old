<?php

/**
 * This is the model class for table "ons_equipment2011".
 *
 * The followings are the available columns in table 'ons_equipment2011':
 * @property string $id_report
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
 * @property string $pok110
 * @property string $pok111
 * @property string $pok112
 * @property integer $step1
 * @property integer $step2
 * @property integer $step3
 */
class Ons_equipment2011 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ons_equipment2011';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, step1, step2, step3', 'required'),
            array('id_report, pok0, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, pok83, pok84, pok85, pok86, pok87, pok88, pok89, pok90, pok91, pok92, pok93, pok94, pok95, pok96, pok97, pok98, pok99, pok100, pok101, pok102, pok103, pok104, pok105, pok106, pok107, pok108, pok109, pok110, pok111, pok112, step1, step2, step3', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>8),
            array('pok23, pok24, pok25, pok41, pok48, pok49, pok52, pok58, pok59, pok60, pok61, pok62, pok66, pok100, pok105, pok106, pok107, pok108, step1, step2, step3', 'length', 'max'=>4),
            array('pok0, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok42, pok43, pok44, pok45, pok46, pok47, pok50, pok51, pok53, pok54, pok55, pok56, pok57, pok63, pok64, pok65, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, pok83, pok84, pok85, pok86, pok87, pok88, pok89, pok90, pok91, pok92, pok93, pok94, pok95, pok96, pok97, pok98, pok99, pok101, pok102, pok103, pok104, pok109, pok110, pok111, pok112', 'in','range'=>array(0,1)),
            array('pok49', 'length', 'max'=>5),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok0, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, pok78, pok79, pok80, pok81, pok82, pok83, pok84, pok85, pok86, pok87, pok88, pok89, pok90, pok91, pok92, pok93, pok94, pok95, pok96, pok97, pok98, pok99, pok100, pok101, pok102, pok103, pok104, pok105, pok106, pok107, pok108, pok109, pok110, pok111, pok112, step1, step2, step3', 'safe', 'on'=>'search'),
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
            'pok0' => 'Обеспечивается ли в вашем учреждении температурный режим в соответствии с СанПин?',
            'pok1' => 'В учреждении имеется работающая система холодного водоснабжения',
            'pok2' => 'В учреждении имеется работающая система горячего водоснабжения',
            'pok3' => 'В учреждении имеется работающая система канализации',
            'pok4' => 'В учреждении имеются туалеты, оборудованных в соответствии с СанПин',
            'pok5' => 'В учреждении имеются оборудованные аварийные выходы',
            'pok6' => 'В учреждении имеется необходимое количество средств пожаротушения',
            'pok7' => 'В учреждении имеются подъездные пути к зданию',
            'pok8' => 'В учреждении имеется соответствующая требованиям безопасности электропроводка',
            'pok9' => 'В учреждении имеется действующая пожарная сигнализация',
            'pok10' => 'В учреждении имеется автоматическая система оповещения людей при пожаре',
            'pok11' => 'В учреждении имеется охранник',
            'pok12' => 'В учреждении имеется сторож',
            'pok13' => 'В учреждении имеется кнопка экстренного вызова милиции',
            'pok14' => 'В этом учебном году в эксплуатацию после ремонта был введен спортивный зал',
            'pok15' => 'В этом учебном году в эксплуатацию после капитального ремонта была введена школа',
            'pok16' => 'В учреждении имеется собственная столовая или зал для приема пищи с площадью в соответствии с СанПиН',
            'pok17' => 'В учреждении имеется зал для приема пищи на условиях договора пользования с площадью в соответствии с СанПиН',
            'pok18' => 'В учреждении имеется современное технологическоe оборудованиe',
            'pok19' => 'В учреждении имеются сотрудники, квалифицированные для работы на современном технологическом оборудовании',
            'pok20' => 'В учреждении помещение столовой не требует ремонта',
            'pok21' => 'В учреждении имеется современно оформленный зал для приема пищи',
            'pok22' => 'В учреждении реализуются образовательные программы по формированию культуры здорового питания',
            'pok23' => 'Количество учащихся, получающих только горячие завтраки',
            'pok24' => 'Количество учащихся, получающих только горячие обеды',
            'pok25' => 'Количество учащихся, питающихся в школе и завтраками, и обедами',
            'pok26' => 'В учреждении имеется собственный спортивный зал',
            'pok27' => 'В учреждении имеется спортивный зал на условиях договора пользования',
            'pok28' => 'В учреждении имеется спортивный зал площадью не менее 9х18 м',
            'pok29' => 'В учреждении имеется спортивный зал высотой не менее 6 м',
            'pok30' => 'В учреждении имеется спортивный зал с оборудованными раздевалками',
            'pok31' => 'В учреждении имеется спортивный зал с действующими душевыми комнатами',
            'pok32' => 'В учреждении имеется спортивный зал с действующими туалетами',
            'pok33' => 'В учреждении имеется собственная оборудованная территория для реализации раздела "Легкая атлетика"',
            'pok34' => 'В учреждении имеется оборудованная территория для реализации раздела "Легкая атлетика" на условиях договора пользования',
            'pok35' => 'В учреждении имеется территория для реализации раздела "Легкая атлетика" с размеченными дорожками для бега',
            'pok36' => 'В учреждении имеется территория для реализации раздела "Легкая атлетика" с дорожками для бега с твердым покрытием',
            'pok37' => 'В учреждении имеется территория для реализации раздела "Легкая атлетика", оборудованная сектором для метания',
            'pok38' => 'В учреждении имеется территория для реализации раздела "Легкая атлетика", оборудованная сектором для прыжков в длину',
            'pok39' => 'В учреждении имеется собственный бассейн',
            'pok40' => 'В учреждении имеется бассейн на условиях договора пользования',
            'pok41' => 'Количество учащихся, в учебном плане которых предусмотрено более 3 часов физкультуры в неделю',
            'pok42' => 'В учреждении имеется собственный актовый зал',
            'pok43' => 'В учреждении имеется актовый зал на условиях договора пользования',
            'pok44' => 'В учреждении имеется художественная студия',
            'pok45' => 'В учреждении имеется театральная студия',
            'pok46' => 'В учреждении имеется вокально-музыкальная студия',
            'pok47' => 'В учреждении имеется кино-, радио-студия',
            'pok48' => 'Количество детей, которым обеспечена возможность пользоваться современно оборудованными помещениями студий',
            'pok49' => 'Количество детей, которым обеспечена возможность пользоваться современно оборудованными актовыми залами',
            'pok50' => 'В учреждении имеется собственный компьютерный класс',
            'pok51' => 'В учреждении имеется компьютерный класс на условиях договора пользования',
            'pok52' => 'Количество компьютерных классов в вашем учреждении',
            'pok53' => 'В компьютерном классе имеется металлическая дверь',
            'pok54' => 'В компьютерном классе имеется электропроводка',
            'pok55' => 'В компьютерном классе имеется кондиционер или протяжно-вытяжная вентиляция',
            'pok56' => 'В компьютерном классе имеются немеловые доски',
            'pok57' => 'В компьютерном классе имеется площадь, обеспечивающая установку m/2 + 2 компьютера, включая учительский',
            'pok58' => 'Количество компьютерных классов, удовлетворяющих всем вышеуказанным условиям',
            'pok59' => 'Количество компьютеров, используемых для осуществления образовательного процесса',
            'pok60' => 'Количество компьютеров, имеющих сертификат качества, используемых для осуществления образовательного процесса',
            'pok61' => 'Количество мультимедийных проекторов',
            'pok62' => 'Количество интерактивных досок',
            'pok63' => 'Программное обеспечение. Есть ли у учреждения комплект лицензионного или свободно распространяемого программного обеспечения (и операционная система, и офисные программы) для каждого установленного компьютера',
            'pok64' => 'Выход в интернет от 129 Кб/c',
            'pok65' => 'Выход в интернет от 2 Мб/c',
            'pok66' => 'Широкополосный интернет. Укажите количество компьютеров, скорость выхода в интернет которых не менее 2 Мб/с',
            'pok67' => 'В учреждении имеется кабинет физики',
            'pok68' => 'В учреждении имеется кабинет физики с подводкой низковольтного электропитания к партам (включая независимые источники)',
            'pok69' => 'В учреждении имеется кабинет физики с лаборантской',
            'pok70' => 'Наличие лабораторных комплектов в кабинете физики по электродинамике',
            'pok71' => 'Наличие лабораторных комплектов в кабинете физики по молекулярной физике',
            'pok72' => 'Наличие лабораторных комплектов в кабинете физики по механике',
            'pok73' => 'Наличие лабораторных комплектов в кабинете физики по оптике',
            'pok74' => 'Наличие лабораторных комплектов в кабинете физики по квантовой физике и элементам астрофизики',
            'pok75' => 'В учреждении имеется кабинет химии',
            'pok76' => 'В учреждении имеется кабинет химии с вытяжкой',
            'pok77' => 'В учреждении имеется кабинет химии с подводкой воды к партам',
            'pok78' => 'В учреждении имеется кабинет химии с лаборантской',
            'pok79' => 'Наличие лабораторных комплектов в кабинете химии по неорганической химии',
            'pok80' => 'Наличие лабораторных комплектов в кабинете химии по органической химии',
            'pok81' => 'Наличие лабораторных комплектов по биологии по разделу "природоведение (окружающий мир)"',
            'pok82' => 'Наличие лабораторных комплектов по биологии по разделу "ботаника"',
            'pok83' => 'Наличие лабораторных комплектов по биологии по разделу "зоология"',
            'pok84' => 'Наличие лабораторных комплектов по биологии по разделу "анатомия"',
            'pok85' => 'Наличие лабораторных комплектов по биологии по разделу "общая биология"',
            'pok86' => 'Отметьте факт использования в соответствии с реализуемыми программами по географии бумажных карт',
            'pok87' => 'Отметьте факт использования в соответствии с реализуемыми программами по географии лицензионного демонстрационного программного обеспечения',
            'pok88' => 'Отметьте факт использования в соответствии с реализуемыми программами по истории бумажных карт',
            'pok89' => 'Отметьте факт использования в соответствии с реализуемыми программами по истории лицензионного демонстрационного программного обеспечения',
            'pok90' => 'Наличие в учреждении читального зала библиотеки',
            'pok91' => 'Наличие в учреждении читального зала библиотеки с числом рабочих мест не менее 25',
            'pok92' => 'Наличие в библиотеке учреждения медиатеки',
            'pok93' => 'Наличие в библиотеке учреждения работающих средств для сканирования и распознавания текстов (сканер, компьютерные программы)',
            'pok94' => 'Наличие в библиотеке учреждения возможности работать на стационарных или переносных компьютерах',
            'pok95' => 'Наличие в библиотеке учреждения выхода в Интернет с компьютеров, расположенных в библиотеке',
            'pok96' => 'Наличие в библиотеке учреждения обеспечена контролируемая распечатка бумажных материалов (есть доступ к принтеру)',
            'pok97' => 'Наличие в библиотеке учреждения обеспечена контролируемое копирование бумажных материалов (есть доступ к ксероксу)',
            'pok98' => 'Благоустроенность пришкольной территории. Отметьте факт озеленения территории',
            'pok99' => 'Благоустроенность пришкольной территории. Отметьте факт наличия оборудованных мест для отдыха',
            'pok100' => 'Безбарьерная среда. В скольких зданиях, принадлежащих учреждению и предусмотренных для доступа учащихся, обеспечена безбарьерная среда для детей с ограниченными возможностями здоровья',
            'pok101' => 'В учреждении имеется собственный лицензированный медкабинет',
            'pok102' => 'В учреждении имеется медкабинет на условиях договора пользования',
            'pok103' => 'В медкабинете учреждения имеется квалифицированный медработник',
            'pok104' => 'Реализуется ли в вашем учреждении программа энергосбережения?',
            'pok105' => 'Число автотранспортных средств, предназначенных для перевозки обучающихся',
            'pok106' => 'Число автотранспортных средств, предназначенных для хозяйственных нужд',
            'pok107' => 'Общая численность учащихся, нуждающихся в подвозе в базовую школу',
            'pok108' => 'Численность учащихся, которым обеспечен ежедневный подвоз в базовую школу',
            'pok109' => 'Учебно-производственные мастерские. Отметьте факт наличия',
            'pok110' => 'слесарные учебно-производственные мастерские',
            'pok111' => 'токарные учебно-производственные мастерские',
            'pok112' => 'швейные учебно-производственные мастерские',
            'step1' => 'Численность учащихся первой ступени (1-4 класс)',
            'step2' => 'Численность учащихся второй ступени (5-9 класс)',
            'step3' => 'Численность учащихся третьей ступени (10-11 класс)',
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
        $criteria->compare('pok110',$this->pok110,true);
        $criteria->compare('pok111',$this->pok111,true);
        $criteria->compare('pok112',$this->pok112,true);
        $criteria->compare('step1',$this->step1);
        $criteria->compare('step2',$this->step2);
        $criteria->compare('step3',$this->step3);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ons_equipment2011 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}