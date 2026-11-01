<?php

/**
 * This is the model class for table "biblio16".
 *
 * The followings are the available columns in table 'biblio16':
 * @property string $id_report
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
 * @property string $remark
 */
class Biblio16 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'biblio16';
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
            array('pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok51', 'length', 'max'=>3),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51', 'numerical', 'integerOnly'=>true),
            array('pok1, pok2, pok3, pok4, pok5, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48', 'in','range'=>array(1,2)),
            array('remark', 'match', 'pattern'=>'/^[а-яА-Я0-9,\.\-\s]*$/u', 'message'=>'В замечаниях можно использовать только буквы кириллицы, цифры и тире'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, remark', 'safe', 'on'=>'search'),
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
            'pok1' => '1.1 Наличие зоны получения информационных ресурсов во временное пользование',
            'pok2' => '1.2 Наличие в библиотеке читального зала',
            'pok3' => '1.3 Наличие доступа к WiFi для учащихся в здании школы',
            'pok4' => '1.3.1 в том числе в библиотеке',
            'pok5' => '1.4 Наличие в библиотеке зоны получения информации на различных типах носителей (медиатеки или читального зала, совмещенного с медиатекой)',
            'pok6' => '1.5.1 стационарных компьютеров или ноутбуков с подключением к сети Интернет (шт.)',
            'pok7' => '1.5.2 из них: находятся в доступе для учащихся (шт.)',
            'pok8' => '1.5.3 принтеров (шт.)',
            'pok9' => '1.5.4 из них: находятся в доступе для учащихся (шт.)',
            'pok10' => '1.5.5 сканеров (шт.)',
            'pok11' => '1.5.6 из них: находятся в доступе для учащихся (шт.)',
            'pok12' => '1.5.7 копиров (шт.)',
            'pok13' => '1.5.8 из них: находятся в доступе для учащихся (шт.)',
            'pok14' => '1.5.9 МФУ (шт.)',
            'pok15' => '1.5.10 из них: находятся в доступе для учащихся (шт.)',
            'pok16' => '1.6.1 стационарных компьютеров или ноутбуков с подключением к сети Интернет (шт.)',
            'pok17' => '1.6.2 принтеров (шт.)',
            'pok18' => '1.6.3 сканеров (шт.)',
            'pok19' => '1.6.4 копиров (шт.)',
            'pok20' => '1.6.5 МФУ (шт.)',
            'pok21' => '1.7 Наличие в библиотеке зоны проектно-исследовательской и коллективной метапредметной деятельности со свободной гибкой организацией пространства и средствами поддержки коллективной работы, в том числе:',
            'pok22' => '1.7.1 проекционной системой',
            'pok23' => '1.7.2 маркерной магнитной доской',
            'pok24' => '1.7.3 флипчартом',
            'pok25' => '1.8 Наличие в здании школы (вне библиотеки) зоны проектно-исследовательской и коллективной метапредметной деятельности со свободной гибкой организацией пространства и средствами поддержки коллективной работы, в том числе:',
            'pok26' => '1.8.1 проекционной системой',
            'pok27' => '1.8.2 маркерной магнитной доской',
            'pok28' => '1.8.3 флипчартом',
            'pok29' => '1.8.4 Осуществляется ли взаимодействие библиотеки с зоной проектно-исследовательской и коллективной метапредметной деятельности?',
            'pok30' => '1.8.5 Наличие локального  акта о взаимодействии библиотеки с зоной проектно-исследовательской и коллективной метапредметной деятельности',
            'pok31' => '1.9 Наличие в библиотеке зоны для проведения мероприятий гражданско-патриотической направленности',
            'pok32' => '1.10 Наличие в здании школы  школьного музея',
            'pok33' => '1.10.1 Осуществляется ли взаимодействие библиотеки со школьным музеем?',
            'pok34' => '1.10.2 Наличие локального акта о взаимодействии библиотеки со школьным музеем',
            'pok35' => '1.11 Наличие в здании школы  (вне библиотеки) помещения для проведения мероприятий гражданско-патриотической направленности (кроме школьного музея)',
            'pok36' => '1.11.1 Осуществляется ли взаимодействие библиотеки с помещением для проведения мероприятий гражданско-патриотической направленности (кроме школьного музея)?',
            'pok37' => '1.11.2 Наличие локального нормативного акта о взаимодействии библиотеки с помещением для проведения мероприятий гражданско-патриотической направленности (кроме школьного музея)',
            'pok38' => '1.12 Наличие в библиотеке зоны для организации выставок, витрин и тематических экспозиций',
            'pok39' => '2.1 Наличие каталога, картотеки в электронной форме',
            'pok40' => '2.2 Осуществление справочно-библиографического обслуживания в электронной форме',
            'pok41' => '2.3 Использование специального программного обеспечения для библиотек',
            'pok42' => '2.4 Наличие страницы школьной библиотеки в сети Интернет',
            'pok43' => '2.5 Наличие возможности у обучающихся пользоваться государственными информационно-библиотечными ресурсами (в том числе Национальной электронной библиотекой)',
            'pok44' => '2.5.1 Наличие заключенных соглашений или договоров с государственными информационно-библиотечными ресурсами (в том числе, Национальной электронной библиотекой)',
            'pok45' => '2.6 Наличие возможности у обучающихся пользоваться негосударственными информационно-библиотечными ресурсами',
            'pok46' => '2.6.1 Наличие заключенных соглашений или договоров с негосударственными информационно-библиотечными ресурсами',
            'pok47' => '2.7 Наличие возможности у обучающихся пользоваться электронными образовательными ресурсами',
            'pok48' => '2.7.1 в том числе в помещении библиотеки',
            'pok49' => '3.1 Зав.библиотекой (чел.)',
            'pok50' => '3.2 Библиотекарь (чел.)',
            'pok51' => '3.3 Педагог-библиотекарь (чел.)',
            'remark' => 'Замечания',
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
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Biblio16 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}