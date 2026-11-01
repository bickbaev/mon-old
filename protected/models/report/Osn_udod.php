<?php

/**
 * This is the model class for table "osn_udod".
 *
 * The followings are the available columns in table 'osn_udod':
 * @property integer $id_report
 * @property integer $temp
 * @property integer $voda
 * @property integer $kanal
 * @property integer $vihod
 * @property integer $electro
 * @property integer $stol
 * @property integer $zal
 * @property integer $pozar
 * @property integer $ohrana
 * @property integer $comp
 * @property integer $prog
 * @property integer $blago
 * @property integer $med
 * @property integer $colcomp
 * @property integer $proector
 * @property integer $interact
 * @property integer $po
 * @property integer $obor
 * @property integer $inet
 * @property integer $pedagog
 * @property integer $avtor
 * @property integer $do
 * @property integer $media
 * @property integer $avtobus
 * @property integer $grup
 * @property integer $director
 * @property string $remark
 */
class Osn_udod extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return OsnUdod the static model class
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
        return 'osn_udod';
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
            array('id_report, temp, voda, kanal, vihod, electro, stol, zal, pozar, ohrana, comp, prog, blago, med, colcomp, proector, interact, po, obor, inet, pedagog, avtor, do, media, avtobus, grup, director', 'numerical', 'integerOnly'=>true),
            array('temp, voda, kanal, vihod, electro, stol, zal, pozar, ohrana, prog, blago, med, po, obor, inet, pedagog, avtor, do, media, avtobus, grup, director', 'in', 'range' => array(0, 1)),
            array('remark', 'length', 'max'=>65535),
            array('remark', 'match', 'pattern'=>'/^[а-яА-я0-9\-\s]*$/u', 'message'=>'В замечаниях можно использовать только буквы кириллицы, цифры и тире'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, temp, voda, kanal, vihod, electro, stol, zal, pozar, ohrana, comp, prog, blago, med, colcomp, proector, interact, po, obor, inet, pedagog, avtor, do, media, avtobus, grup, director', 'safe', 'on'=>'search'),
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
            'kanal' => 'Наличие работающей системы канализации, а также оборудованных в соответствии с СанПиН туалетов',
            'vihod' => 'Наличие оборудованных аварийных выходов, необходимого количества средств пожаротушения, подъездных путей к зданию, отвечающих всем требованиям пожарной безопасности',
            'electro' => 'Соответствие электропроводки здания современным требованиям безопасности',
            'stol' => 'Наличие в детском оздоровительно-образовательном центре (лагере) собственной столовой или зала для приёма пищи площадью, соответствующей требованиям',
            'zal' => 'Наличие у учреждения, реализующего дополнительные общеобразовательные программы физкультурно-спортивной направленности, собственного (или на условиях договора пользования) безопасного и пригодного для проведения занятий и  массовых мероприятий физкультурно-спортивной направленности спортивного зала (площадью не менее 9x18 м при высоте не менее 6 м с оборудованными раздевалками, действующими душевыми комнатами и туалетами (при наличии)',
            'pozar' => 'Наличие у учреждения действующей пожарной сигнализации и автоматической системы оповещения людей при пожаре',
            'ohrana' => 'Наличие в учреждении действующей охраны (кнопка экстренного вызова милиции, охранника или сторожа)',
            'comp' => 'Количество в учреждении собственных (или на условиях договора пользования) компьютерных классов (кабинетов), оборудованных металлической дверью, электропроводкой, кондиционером или проточно-вытяжной вентиляцией, не меловыми досками, и площадью, обеспечивающей установку компьютеров в количестве не менее m/2 + 2, включая компьютер педагога (где m - проектная наполняемость учебных групп в соответствии с предельной численностью контингента учреждения)',
            'prog' => 'Соответствие в учреждении дополнительного образования детей специализированных кабинетов, помещений (лабораторий, мастерских, хореографических залов и пр.) перечню реализуемых дополнительных образовательных программ',
            'blago' => 'Соответствие благоустроенных площадок для занятий на открытом воздухе (спортивная площадка, кордодром, бассейн для судомоделистов, автодром, картодром, учебно-опытная зона и пр.) перечню реализуемых дополнительных образовательных программ',
            'med' => 'Наличие в детском оздоровительно-образовательном центре (лагере) собственного (или на условиях договора  пользования) лицензированного медицинского кабинета',
            'colcomp' => 'Количество компьютеров, имеющих сертификат качества, используемых для осуществления образовательного процесса',
            'proector' => 'Количество мультимедийных проекторов',
            'interact' => 'Количество интерактивных досок',
            'po' => 'Наличие у учреждения комплекта лицензионного или свободно распространяемого общесистемного и прикладного программного обеспечения (операционная система, офисные программы (редакторы текстов, таблиц), СУБД, навигаторы) для каждого установленного компьютера',
            'obor' => 'Соответствие имеющегося материально-технического оборудования перечням необходимого материально-технического оборудования, обозначенным в разделах  образовательных программ дополнительного образования детей',
            'inet' => 'Наличие скоростного выхода в Интернет (скорость канала не ниже 128 кб/с)',
            'pedagog' => 'Полная обеспеченность образовательного процесса педагогами дополнительного образования (старшими педагогами дополнительного образования, тренерами- преподавателями, концертмейстерами и социальными педагогами) в соответствии с профессиональными квалификационными  группами  должностей педагогических работников в соответствии с Приказом здравоохранения и социального развития РФ «Единый квалификационный справочник должностей руководителей, специалистов и служащих», утвержденным 14 августа 2009 года № 593',
            'avtor' => 'Учреждение реализует авторские образовательные программы',
            'do' => 'В учреждении реализуются программы дистанционного обучения',
            'media' => 'Наличие современной медиатеки с мультимедийным оборудованием, имеющей специально подобранный фонд (развивающие и обучающие программы; программы, направленные на развитие творческих способностей; энциклопедии, методические и справочные издания; аудиокниги)',
            'avtobus' => 'Наличие собственного автобуса, оснащенного в соответствии с Государственным стандартом РФ',
            'grup' => 'В учреждении отсутствуют учебные группы, наполняемость которых свыше допустимого количества обучающихся (в соответствии с требованиями СанПиН)',
            'director' => 'Директор имеет управленческую (менеджерскую) подготовку, подтвержденную документами о профессиональном образовании (специальность менеджер) и/или профессиональной переподготовке',
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
        $criteria->compare('kanal',$this->kanal);
        $criteria->compare('vihod',$this->vihod);
        $criteria->compare('electro',$this->electro);
        $criteria->compare('stol',$this->stol);
        $criteria->compare('zal',$this->zal);
        $criteria->compare('pozar',$this->pozar);
        $criteria->compare('ohrana',$this->ohrana);
        $criteria->compare('comp',$this->comp);
        $criteria->compare('prog',$this->prog);
        $criteria->compare('blago',$this->blago);
        $criteria->compare('med',$this->med);
        $criteria->compare('colcomp',$this->colcomp);
        $criteria->compare('proector',$this->proector);
        $criteria->compare('interact',$this->interact);
        $criteria->compare('po',$this->po);
        $criteria->compare('obor',$this->obor);
        $criteria->compare('inet',$this->inet);
        $criteria->compare('pedagog',$this->pedagog);
        $criteria->compare('avtor',$this->avtor);
        $criteria->compare('do',$this->do);
        $criteria->compare('media',$this->media);
        $criteria->compare('avtobus',$this->avtobus);
        $criteria->compare('grup',$this->grup);
        $criteria->compare('director',$this->director);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
} 