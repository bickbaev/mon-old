<?php

/**
 * This is the model class for table "osn_dou".
 *
 * The followings are the available columns in table 'osn_dou':
 * @property integer $id_report
 * @property integer $grup
 * @property integer $fiz
 * @property integer $zem
 * @property integer $ozel
 * @property integer $ten
 * @property integer $med
 * @property integer $pandus
 * @property integer $zal
 * @property integer $pol
 * @property integer $obor
 * @property integer $didact
 * @property integer $muz
 * @property integer $igr
 * @property integer $po
 * @property integer $kanal
 * @property integer $krov
 * @property integer $osv
 * @property integer $lumen
 * @property integer $temp
 * @property integer $gor
 * @property integer $dezinf
 * @property integer $post
 * @property integer $pit
 * @property integer $mineral
 * @property integer $iod
 * @property integer $posuda
 * @property integer $pomesh
 * @property integer $pit1
 * @property integer $pozar
 * @property integer $electro
 * @property integer $signal
 * @property integer $ochrana
 * @property integer $inet
 * @property integer $vospit
 * @property string $remark
 */
class Osn_dou extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return OsnDou the static model class
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
        return 'osn_dou';
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
            array('id_report, grup, fiz, zem, ozel, ten, med, pandus, zal, pol, obor, didact, muz, igr, po, kanal, krov, osv, lumen, temp, gor, dezinf, post, pit, mineral, iod, posuda, pomesh, pit1, pozar, electro, signal, ochrana, inet, vospit', 'numerical', 'integerOnly'=>true),
            array('grup, fiz, zem, ozel, ten, med, pandus, zal, pol, obor, igr, po, kanal, krov, osv, lumen, temp, gor, dezinf, post, pit, mineral, iod, posuda, pomesh, pit1, pozar, electro, signal, ochrana, inet, vospit', 'in', 'range' => array(0, 1)),
            array('remark', 'length', 'max'=>65535),
            array('remark', 'match', 'pattern'=>'/^[а-яА-я0-9\-\s]*$/u', 'message'=>'В замечаниях можно использовать только буквы кириллицы, цифры и тире'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, grup, fiz, zem, ozel, ten, med, pandus, zal, pol, obor, didact, muz, igr, po, kanal, krov, osv, lumen, temp, gor, dezinf, post, pit, mineral, iod, posuda, pomesh, pit1, pozar, electro, signal, ochrana, inet, vospit', 'safe', 'on'=>'search'),
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
            'grup' => 'Отсутствие в ДОУ групп с наполняемостью превышающей требования СанПиН',
            'fiz' => 'Наличие физкультурной площадки с зонами, оснащёнными гимнастическим оборудованием, спортивными снарядами, беговой дорожкой и ямой для прыжков',
            'zem' => 'Наличие земельного участка, соответствующего требованию: не менее 25 кв.м. на 1 воспитанника',
            'ozel' => 'Озеленение не менее 50 % территории, свободной от застройки',
            'ten' => 'Наличие на территории каждой групповой площадки теневого навеса площадью из расчета не менее 2 кв.м на одного ребенка, но не менее 30 кв.м',
            'med' => 'Наличие лицензированного медицинского кабинета',
            'pandus' => 'Наличие пандуса для детских и инвалидных колясок при входе в учреждение и в групповую ячейку ясельной группы',
            'zal' => 'Наличие физкультурного и музыкального залов',
            'pol' => 'Групповые помещения, расположенные на первом этаже, имеют утепленные или отапливаемые полы',
            'obor' => 'Наличие в групповых помещениях комплекса оборудования для детей раннего ясельного возраста (групповой манеж;  место для ползания детей на полу, ограниченное барьером; горки с лесенкой, мостики с перилами; пеленальные столы и специальные столики с выдвижными креслами для кормления)',
            'didact' => 'Наличие дидактических пособий и оборудования, предназначенных для работы с детьми, имеющими ограниченные возможности здоровья в количестве, соответствующем численности детей с ОВЗ',
            'muz' => 'Имеется  подборка методической литературы (не менее пяти изданий по каждому из основных реализуемых направлений воспитания и обучения детей) и подписка на периодические издания по проблемам дошкольного образования (не менее трех наименований)',
            'igr' => 'В групповых помещениях имеется игровой материал соответствующий возрастным особенностям',
            'po' => 'Наличие у учреждения комплекта лицензионного или свободно распространяемого общесистемного и прикладного программного обеспечения (операционная система, офисные программы (редакторы текстов, таблиц), СУБД, навигаторы) для каждого установленного компьютера',
            'kanal' => 'Наличие работающей системы канализации, а также оборудованных в соответствии с СанПиН туалетов',
            'krov' => 'Спальни оборудованы кроватями, соответствующими списочному числу воспитанников и требованиям СанПиН',
            'osv' => 'Соответствие естественного и искусственного освещения требованиям СанПиН',
            'lumen' => 'Обеспечено люминесцентное освещение всех групповых, игровых и спальных помещений по спектру цветоизлучения (белый, тёплобелый, естественно-белый)',
            'temp' => 'Соответствие ДОУ требованиям к отоплению, вентиляции, температурному режиму',
            'gor' => 'Система хозяйственно-питьевого и горячего водоснабжения соответствует нормам СанПиН',
            'dezinf' => 'Выполняются требования к санитарному содержанию помещений и проведению дезинфекционных мероприятий',
            'post' => 'Имеется три смены постельного белья и полотенец на каждого воспитанника',
            'pit' => 'Выполняются требования СанПиН к организации питания',
            'mineral' => 'В меню используются блюда и напитки, обогащенные витаминами и минеральными веществами',
            'iod' => 'Использование в питании детей йодированной поваренной соли',
            'posuda' => 'Посуда, используемая в ДОУ изготовлена из фаянса или фарфора, столовые приборы – из нержавеющей стали',
            'pomesh' => 'Наличие оборудованного помещения для проведения физического воспитания детей первого года жизни (проведения массажа, гимнастики)',
            'pit1' => 'В ДОУ имеется возможность для организации в соответствии с СанПиН питания детей первого года жизни',
            'pozar' => 'Наличие оборудованных аварийных выходов, необходимого количества средств пожаротушения, подъездных путей к зданию, отвечающих всем требованиям пожарной безопасности',
            'electro' => 'Соответствие электропроводки здания современным требованиям безопасности',
            'signal' => 'Наличие у учреждения действующей пожарной сигнализации и автоматической системы оповещения людей при пожаре',
            'ochrana' => 'Наличие в учреждении круглосуточно действующей охраны (кнопка экстренного вызова милиции или охранники и сторожа)',
            'inet' => 'Наличие скоростного выхода в Интернет (скорость канала не ниже 128 кб/с)',
            'vospit' => 'Полная обеспеченность образовательного процесса воспитателями со средним специальным и высшим педагогическим образованием',
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
        $criteria->compare('grup',$this->grup);
        $criteria->compare('fiz',$this->fiz);
        $criteria->compare('zem',$this->zem);
        $criteria->compare('ozel',$this->ozel);
        $criteria->compare('ten',$this->ten);
        $criteria->compare('med',$this->med);
        $criteria->compare('pandus',$this->pandus);
        $criteria->compare('zal',$this->zal);
        $criteria->compare('pol',$this->pol);
        $criteria->compare('obor',$this->obor);
        $criteria->compare('didact',$this->didact);
        $criteria->compare('muz',$this->muz);
        $criteria->compare('igr',$this->igr);
        $criteria->compare('po',$this->po);
        $criteria->compare('kanal',$this->kanal);
        $criteria->compare('krov',$this->krov);
        $criteria->compare('osv',$this->osv);
        $criteria->compare('lumen',$this->lumen);
        $criteria->compare('temp',$this->temp);
        $criteria->compare('gor',$this->gor);
        $criteria->compare('dezinf',$this->dezinf);
        $criteria->compare('post',$this->post);
        $criteria->compare('pit',$this->pit);
        $criteria->compare('mineral',$this->mineral);
        $criteria->compare('iod',$this->iod);
        $criteria->compare('posuda',$this->posuda);
        $criteria->compare('pomesh',$this->pomesh);
        $criteria->compare('pit1',$this->pit1);
        $criteria->compare('pozar',$this->pozar);
        $criteria->compare('electro',$this->electro);
        $criteria->compare('signal',$this->signal);
        $criteria->compare('ochrana',$this->ochrana);
        $criteria->compare('inet',$this->inet);
        $criteria->compare('vospit',$this->vospit);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
} 
