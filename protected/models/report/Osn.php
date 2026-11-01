<?php

/**
 * This is the model class for table "osn".
 *
 * The followings are the available columns in table 'osn':
 * @property string $id_report
 * @property integer $temp
 * @property integer $voda
 * @property integer $tualet
 * @property integer $vihod
 * @property integer $provoda
 * @property integer $stolovaya
 * @property integer $sportzal
 * @property integer $signal
 * @property integer $ohrana
 * @property integer $kompclass
 * @property integer $fizika
 * @property integer $himia
 * @property integer $territoria
 * @property integer $gorpitanie
 * @property integer $medkabinet
 * @property integer $kompsert
 * @property integer $proektor
 * @property integer $doska
 * @property integer $lpo
 * @property integer $atletica
 * @property integer $fizika_lab
 * @property integer $himia_lab
 * @property integer $bio_lab
 * @property integer $geokarta
 * @property integer $hiskarta
 * @property integer $internet
 * @property integer $teacher
 * @property integer $profil
 * @property integer $klass
 * @property integer $director
 *
 * The followings are the available model relations:
 */
class Osn extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Osn the static model class
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
        return 'osn';
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
            array('temp, voda, tualet, vihod, provoda, stolovaya, sportzal, signal, ohrana, kompclass, fizika, himia, territoria, gorpitanie, medkabinet, kompsert, proektor, doska, lpo, atletica, fizika_lab, himia_lab, bio_lab, geokarta, hiskarta, internet, teacher, profil, klass, director', 'numerical', 'integerOnly'=>true),
            array('temp, voda, tualet, vihod, provoda, stolovaya, sportzal, signal, ohrana, fizika, himia, territoria, gorpitanie, medkabinet, lpo, atletica, fizika_lab, himia_lab, bio_lab, geokarta, hiskarta, internet, teacher, profil, klass, director', 'in', 'range' => array(0, 1)),
            array('id_report', 'length', 'max'=>10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, temp, voda, tualet, vihod, provoda, stolovaya, sportzal, signal, ohrana, kompclass, fizika, himia, territoria, gorpitanie, medkabinet, kompsert, proektor, doska, lpo, atletica, fizika_lab, himia_lab, bio_lab, geokarta, hiskarta, internet, teacher, profil, klass, director', 'safe', 'on'=>'search'),
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
            'temp' => 'Обеспечение температурного режима в соответствии с СанПиН',
            'voda' => 'Наличие работающей системы холодного и горячего водоснабжения (включая локальные системы), обеспечивающей необходимый санитарный и питьевой режим в соответствии с СанПиН',
            'tualet' => 'Наличие работающей системы канализации, а также оборудованных в соответствии с СанПиН туалетов',
            'vihod' => 'Наличие оборудованных аварийных выходов, необходимого количества средств пожаротушения, подъездных путей к зданию, отвечающих всем требованиям пожарной безопасности',
            'provoda' => 'Соответствие электропроводки здания современным требованиям безопасности ',
            'stolovaya' => 'Наличие у учреждения собственной (или на условиях договора пользования) столовой или зала для приёма пищи площадью,  соответствующей требованиям СанПиН',
            'sportzal' => 'Наличие у учреждения собственного (или на условиях договора пользования) безопасного и пригодного для проведения уроков физической культуры спортивного зала площадью не менее 9х18 м при высоте не менее 6 м с оборудованными раздевалками, действующими душевыми комнатами и туалетами',
            'signal' => 'Наличие у учреждения действующей пожарной сигнализации и автоматической системы оповещения людей при пожаре',
            'ohrana' => 'Наличие в учреждении действующей охраны (кнопка экстренного вызова милиции, охранника или сторожа)',
            'kompclass' => 'Количество в учреждении собственных (или на условиях договора пользования) компьютерных классов, оборудованных металлической дверью, электропроводкой, кондиционером или проточно-вытяжной вентиляцией, не меловыми досками, и площадью, обеспечивающей установку компьютеров в количестве не менее m/2 + 2, включая компьютер учителя (где m – проектная наполняемость классов в соответствии с предельной численностью контингента школы)',
            'fizika' => 'Наличие в учреждении кабинета физики с подводкой низковольтного электропитания к партам учащихся (включая независимые источники) и лаборантской (для школ, имеющих классы старше 7-го)',
            'himia' => 'Наличие в учреждении кабинета химии с вытяжкой и подводкой воды к партам учащихся и лаборантской (для школ, имеющих классы старше 7-го)',
            'territoria' => 'Благоустроенность пришкольной территории (озеленение территории, наличие оборудованных мест для отдыха)',
            'gorpitanie' => 'Организация горячего питания',
            'medkabinet' => 'Наличие в здании, где расположено учреждение, собственного (или на условиях договора пользования) лицензированного медицинского кабинета',
            'kompsert' => 'Количество компьютеров, имеющих сертификат качества, используемых для осуществления образовательного процесса',
            'proektor' => 'Количество мультимедийных проекторов',
            'doska' => 'Количество интерактивных досок',
            'lpo' => 'Наличие у учреждения комплекта лицензионного или свободно распространяемого общесистемного и прикладного программного обеспечения (операционная система, офисные программы (редакторы текстов, таблиц), СУБД, навигаторы) для каждого установленного компьютера',
            'atletica' => 'Наличие у учреждения (или на условиях договора пользования) оборудованной территории для реализации раздела «Лёгкая атлетика» программы по физической культуре (размеченные дорожки для бега со специальным покрытием, оборудованный сектор для метания и прыжков в длину)',
            'fizika_lab' => 'Наличие по каждому из разделов физики (электродинамика, термодинамика, механика, оптика, ядерная физика) лабораторных комплектов (в соответствии с общим количеством лабораторных работ согласно программе по физике в 7-11 классах) в количестве не менее m/2 + 1 (где m – проектная наполняемость классов в соответствии с предельной численностью контингента школы)',
            'himia_lab' => 'Наличие по каждому из разделов химии (неорганическая химия, органическая химия) лабораторных комплектов оборудования и препаратов (в соответствии с общим количеством лабораторных работ согласно программе по химии в 7-11 классах) в количестве m/2 + 1 (где m – проектная наполняемость классов в соответствии с предельной численностью контингента школы)',
            'bio_lab' => 'Наличие по каждому из разделов биологии (природоведение (окружающий мир), ботаника, зоология, анатомия, общая биология)  лабораторных комплектов (в соответствии с общим количеством лабораторных работ согласно программе по биологии в 5-11 классах) в количестве m/2 + 1 (где m – проектная наполняемость классов в соответствии с предельной численностью контингента школы)',
            'geokarta' => 'Наличие всех карт в соответствии с реализуемыми программами по географии или наличие лицензионного демонстрационного компьютерного программного обеспечения по каждому из разделов географии',
            'hiskarta' => 'Наличие всех карт в соответствии с реализуемыми программами по истории или лицензионного демонстрационного компьютерного программного обеспечения по каждому из курсов истории',
            'internet' => 'Наличие скоростного выхода в Интернет (скорость канала не ниже 128 кб/с)',
            'teacher' => 'Полная обеспеченность образовательного процесса учителями в соответствии со специальностью',
            'profil' => 'Обеспеченность программ профильного обучения и предпрофильной подготовки учителями не ниже 2 квалификационной категории',
            'klass' => 'В школе отсутствуют классы наполняемостью более 25 человек',
            'director' => 'Имеет ли директор управленческую подготовку, подтвержденную документами о профессиональном образовании (специальность менеджер) и/или профессиональной переподготовке',
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
        $criteria->compare('temp',$this->temp);
        $criteria->compare('voda',$this->voda);
        $criteria->compare('tualet',$this->tualet);
        $criteria->compare('vihod',$this->vihod);
        $criteria->compare('provoda',$this->provoda);
        $criteria->compare('stolovaya',$this->stolovaya);
        $criteria->compare('sportzal',$this->sportzal);
        $criteria->compare('signal',$this->signal);
        $criteria->compare('ohrana',$this->ohrana);
        $criteria->compare('kompclass',$this->kompclass);
        $criteria->compare('fizika',$this->fizika);
        $criteria->compare('himia',$this->himia);
        $criteria->compare('territoria',$this->territoria);
        $criteria->compare('gorpitanie',$this->gorpitanie);
        $criteria->compare('medkabinet',$this->medkabinet);
        $criteria->compare('kompsert',$this->kompsert);
        $criteria->compare('proektor',$this->proektor);
        $criteria->compare('doska',$this->doska);
        $criteria->compare('lpo',$this->lpo);
        $criteria->compare('atletica',$this->atletica);
        $criteria->compare('fizika_lab',$this->fizika_lab);
        $criteria->compare('himia_lab',$this->himia_lab);
        $criteria->compare('bio_lab',$this->bio_lab);
        $criteria->compare('geokarta',$this->geokarta);
        $criteria->compare('hiskarta',$this->hiskarta);
        $criteria->compare('internet',$this->internet);
        $criteria->compare('teacher',$this->teacher);
        $criteria->compare('profil',$this->profil);
        $criteria->compare('klass',$this->klass);
        $criteria->compare('director',$this->director);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
} 