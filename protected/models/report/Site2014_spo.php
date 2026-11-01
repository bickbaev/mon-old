<?php

/**
 * This is the model class for table "site2014_spo".
 *
 * The followings are the available columns in table 'site2014_spo':
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
 * @property string $p_date
 * @property string $remark
 */
class Site2014_spo extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'site2014_spo';
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
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31', 'length', 'max'=>1),
            array('p_date, remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, p_date, remark', 'safe', 'on'=>'search'),
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
            'pok1' => 'о дате создания образовательной организации, об учредителе, учредителях образовательной организации, о месте нахождения образовательной организации и ее филиалов (при наличии), режиме, графике работы, контактных телефонах и об адресах электронной почты',
            'pok2' => 'наименование структурных подразделений (органов управления)',
            'pok3' => 'об описании образовательной программы с приложением ее копии; об учебном плане с приложением его копии',
            'pok4' => 'об аннотации к рабочим программам дисциплин (по каждой дисциплине в составе образовательной программы) с приложением их копий (при наличии)',
            'pok5' => 'о календарном учебном графике с приложением его копии',
            'pok6' => 'о методических и об иных документах, разработанных образовательной организацией для обеспечения образовательного процесса',
            'pok7' => 'о реализуемых образовательных программах с указанием учебных предметов, курсов, дисциплин (модулей), практики, предусмотренных соответствующей образовательной программой',
            'pok8' => 'о численности обучающихся по реализуемым образовательным программам за счет бюджетных ассигнований федерального бюджета',
            'pok9' => 'о языках, на которых осуществляется образование (обучение)',
            'pok10' => 'о ФГОС',
            'pok11' => 'о руководителе образовательной организации, его заместителях, руководителях филиалов образовательной организации',
            'pok12' => 'о персональном составе педагогических работников',
            'pok13' => 'о материально-техническом обеспечении образовательной деятельности, в том числе сведения о наличии оборудованных учебных кабинетов, объектов для проведения практических занятий, библиотек, объектов спорта, средств обучения и воспитания',
            'pok14' => 'об условиях питания и охраны здоровья обучающихся',
            'pok15' => 'о доступе к информационным системам и информационно-телекоммуникационным сетям',
            'pok16' => 'об электронных образовательных ресурсах, к которым обеспечивается доступ обучающихся',
            'pok17' => 'о количестве вакантных мест для приема (перевода) по каждой образовательной программе, профессии, специальности, направлению подготовки',
            'pok18' => 'о наличии и условиях предоставления обучающимся стипендий, мер социальной поддержки',
            'pok19' => 'о наличии общежития, интерната, количестве жилых помещений в общежитии, интернате для иногородних обучающихся, формировании платы за проживание в общежитии',
            'pok20' => 'об объеме образовательной деятельности, финансовое обеспечение которой осуществляется за счет бюджетных ассигнований федерального бюджета, бюджетов субъектов Российской Федерации, местных бюджетов, по договорам об образовании за счет средств физических и (или) юридических лиц',
            'pok21' => 'о поступлении финансовых и материальных средств и об их расходовании по итогам финансового года; о трудоустройстве выпускников',
            'pok22' => 'устав образовательной организации',
            'pok23' => 'лицензии на осуществление образовательной деятельности (с приложениями)',
            'pok24' => 'свидетельства о государственной аккредитации (с приложениями)',
            'pok25' => 'о плане финансово-хозяйственной деятельности образовательной организации, утвержденного в установленном законодательством Российской Федерации порядке, или бюджетной сметы образовательной организации',
            'pok26' => 'о локальных нормативных актов, предусмотренных частью 2 статьи 30 Федерального закона "Об образовании в Российской Федерации", правил внутреннего распорядка обучающихся, правил внутреннего трудового распорядка и коллективного договора',
            'pok27' => 'отчет о результатах самообследования',
            'pok28' => 'документ о порядке оказания платных образовательных услуг, в том числе образец договора об оказании платных образовательных услуг, документ об утверждении стоимости обучения по каждой образовательной программе',
            'pok29' => 'о направлениях и результатах научной (научно-исследовательской) деятельности и научно-исследовательской базе для ее осуществления (для образовательных организаций высшего образования и организаций дополнительного профессионального образования)',
            'pok30' => 'о результатах приема по каждой профессии, специальности среднего профессионального образования (при наличии вступительных испытаний)',
            'pok31' => 'ссылка на официальный сайт Министерства образования и науки Российской Федерации в сети "Интернет"',
            'p_date' => 'P Date',
            'remark' => 'Примечания по сайту',
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
     * @return Site2014_spo the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
