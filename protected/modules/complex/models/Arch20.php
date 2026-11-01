<?php

/**
 * This is the model class for table "arch20".
 *
 * The followings are the available columns in table 'arch20':
 * @property string $id_zd
 * @property string $id_report
 * @property integer $pok1
 * @property string $pok2
 * @property integer $pok3
 * @property string $pok4
 * @property string $pok5
 * @property integer $pok6
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
 */
class Arch20 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'arch20';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok48, pok50', 'required'),
            array('pok2, pok4, pok5', 'match', 'pattern'=>'/^[а-яА-Я0-9\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры и тире'),
            array('pok64', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            array('pok1, pok3, pok6, pok40, pok42, pok44, pok48, pok50, pok43, pok45, pok46', 'numerical', 'integerOnly'=>true),
            array('pok35, pok36', 'numerical', 'integerOnly' => false),
            array('pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok37, pok38, pok39, pok41, pok47, pok49, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63', 'in','range'=>array(0,1)), 
            array('pok1', 'in','range'=>range(1,9)),
            array('pok3', 'in','range'=>range(1,22)),
            array('pok40, pok42, pok44', 'in','range'=>range(1,3)),
            array('pok48', 'in','range'=>range(1,6)),
            array('pok50', 'in','range'=>range(1,2)),
            array('id_report', 'length', 'max'=>10),
            array('pok2, pok4, pok5', 'length', 'max'=>255),
            array('pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok37, pok38, pok39, pok41, pok47, pok49, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63', 'length', 'max'=>1),
            array('pok6', 'length', 'max'=>4),
            array('pok43, pok45, pok46', 'length', 'max'=>3),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_zd, id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64', 'safe', 'on'=>'search'),
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
            'id_zd' => 'Id Zd',
            'id_report' => 'Id Report',
            'pok1' => 'Тип населенного пункта',
            'pok2' => 'Название населенного пункта, в котором находится здание',
            'pok3' => 'Тип улицы',
            'pok4' => 'Улица',
            'pok5' => 'Дом',
            'pok6' => 'Корпус',
            'pok7'=>'Главный вход в здание хорошо опознается слабовидящими (яркая вывеска, контрастные дверные полотна, поручни, звуковой, световой маяки и пр.)',
            'pok8'=>'Хорошо освещенная зона входа в темное время суток',
            'pok9'=>'Имеется переговорное устройство на входе (домофон), кнопка вызова персонала ',
            'pok10'=>'Входная дверь легко открывается, автоматическая раздвижная или распашная',
            'pok11'=>'Имеется контактное лицо в зоне входа (лица, помогающие, или организующие сопровождение инвалида)',
            'pok12'=>'Безбарьерные вход и пути движения для инвалидов на кресле-коляске к месту оказания услуг ',
            'pok13'=>'Контрастная маркировка на имеющихся стеклянных дверях',
            'pok14'=>'На лестницах крайние ступени имеют контрастную разметку',
            'pok15'=>'Имеются указатели и визуальные средства ориентирования и информации, план размещения учреждения, путеводитель',
            'pok16'=>'Имеются пиктограммы (для лиц с трудностями в обучении, не умеющих читать)',
            'pok17'=>'Информация на видеотабло, надписи светящиеся или с подсветкой и т. п.',
            'pok18'=>'Информация в виде телетекста (бегущая строка) ',
            'pok19'=>'Речевое оповещение, звуковые объявления',
            'pok20'=>'Информация на звуковых носителях (аудиогид)',
            'pok21'=>'Система тактильных направляющих для слепых',
            'pok22'=>'Тактильный номер этажа на поручне лестницы',
            'pok23'=>'Обозначения помещений и указателей направления движения в рельефном исполнении',
            'pok24'=>'Таблички обозначения помещений и указатели шрифтом Брайля',
            'pok25'=>'Индукционная петля, другие системы звукоусиления для лиц со слуховыми аппаратами ',
            'pok26'=>'Возможность привлечения лица, владеющего языком жестов (сурдопереводчика)',
            'pok27' => 'Отсутствует парковка в радиусе 100м',
            'pok28' => 'Возможность парковки вблизи объекта',
            'pok29' => 'Специальная парковка для инвалидов',
            'pok30' => 'Крытый паркинг, подземный паркинг',
            'pok31' => 'Лифт имеется',
            'pok32' => 'Лифт доступный для инвалидов на кресле-коляске',
            'pok33' => 'Пандус имеется',
            'pok34' => 'Поручень на пандусе',
            'pok35' => 'Длина одного марша пандуса (без площадок), м.',
            'pok36' => 'Высота подъема одного марша пандуса, м.',
            'pok37' => 'Мобильный подъемник',
            'pok38' => 'Подъемная платформа наклонная',
            'pok39' => 'Подъемная платформа вертикальная',
            'pok40' => '',
            'pok41' => 'Поручень с 2 сторон',
            'pok42' => '',
            'pok43' => 'Кол-во ступеней',
            'pok44' => '',
            'pok45' => 'Количество ступеней внутренней лестницы',
            'pok46' => 'ширина рабочей створки в см',
            'pok47' => 'Домофон, звонок имеется',
            'pok48' => '',
            'pok49' => 'Прозрачное полотно, смотровая панель',
            'pok50' => '',
            'pok51' => 'Задержка открывания',
            'pok52' => 'Имеется женский туалет для инвалидов',
            'pok53' => 'Женский туалет для инвалидов, есть на каждом этаже',
            'pok54' => 'Имеется мужской туалет для инвалидов',
            'pok55' => 'Мужской туалет для инвалидов, есть на каждом этаже',
            'pok56' => 'Имеется общий туалет для инвалидов',
            'pok57' => 'Общий туалет для инвалидов, есть на каждом этаже',
            'pok58' => 'Туалет для инвалидов открывается персоналом',
            'pok59' => 'Ремонт здания (помещений)',
            'pok60' => 'Озеленение территории',
            'pok61' => 'Обеспечение библиотеки литературой',
            'pok62' => 'Оснащение пищеблока',
            'pok63' => 'Оснащение кабинетов учебным оборудованием',
            'pok64' => 'Другое (указать)',
        );
    }
    
    public function attributeLabels_svod()
    {
        return array(
            'pok1' => 'Тип населенного пункта',
            'pok2' => 'Название населенного пункта, в котором находится здание',
            'pok3' => 'Тип улицы',
            'pok4' => 'Улица',
            'pok5' => 'Дом',
            'pok6' => 'Корпус',
            'pok7'=>'Главный вход в здание хорошо опознается слабовидящими (яркая вывеска, контрастные дверные полотна, поручни, звуковой, световой маяки и пр.)',
            'pok8'=>'Хорошо освещенная зона входа в темное время суток',
            'pok9'=>'Имеется переговорное устройство на входе (домофон), кнопка вызова персонала ',
            'pok10'=>'Входная дверь легко открывается, автоматическая раздвижная или распашная',
            'pok11'=>'Имеется контактное лицо в зоне входа (лица, помогающие, или организующие сопровождение инвалида)',
            'pok12'=>'Безбарьерные вход и пути движения для инвалидов на кресле-коляске к месту оказания услуг ',
            'pok13'=>'Контрастная маркировка на имеющихся стеклянных дверях',
            'pok14'=>'На лестницах крайние ступени имеют контрастную разметку',
            'pok15'=>'Имеются указатели и визуальные средства ориентирования и информации, план размещения учреждения, путеводитель',
            'pok16'=>'Имеются пиктограммы (для лиц с трудностями в обучении, не умеющих читать)',
            'pok17'=>'Информация на видеотабло, надписи светящиеся или с подсветкой и т. п.',
            'pok18'=>'Информация в виде телетекста (бегущая строка) ',
            'pok19'=>'Речевое оповещение, звуковые объявления',
            'pok20'=>'Информация на звуковых носителях (аудиогид)',
            'pok21'=>'Система тактильных направляющих для слепых',
            'pok22'=>'Тактильный номер этажа на поручне лестницы',
            'pok23'=>'Обозначения помещений и указателей направления движения в рельефном исполнении',
            'pok24'=>'Таблички обозначения помещений и указатели шрифтом Брайля',
            'pok25'=>'Индукционная петля, другие системы звукоусиления для лиц со слуховыми аппаратами ',
            'pok26'=>'Возможность привлечения лица, владеющего языком жестов (сурдопереводчика)',
            'pok27' => 'Отсутствует парковка в радиусе 100м',
            'pok28' => 'Возможность парковки вблизи объекта',
            'pok29' => 'Специальная парковка для инвалидов',
            'pok30' => 'Крытый паркинг, подземный паркинг',
            'pok31' => 'Лифт имеется',
            'pok32' => 'Лифт доступный для инвалидов на кресле-коляске',
            'pok33' => 'Пандус имеется',
            'pok34' => 'Поручень на пандусе',
            'pok35' => 'Длина одного марша пандуса (без площадок), м.',
            'pok36' => 'Высота подъема одного марша пандуса, м.',
            'pok37' => 'Мобильный подъемник',
            'pok38' => 'Подъемная платформа наклонная',
            'pok39' => 'Подъемная платформа вертикальная',
            'pok40' => 'Тип входной лестницы',
            'pok41' => 'Поручень с 2 сторон',
            'pok42' => 'Материал наружной лестницы',
            'pok43' => 'Кол-во ступеней',
            'pok44' => 'Материал внутренней лестницы',
            'pok45' => 'Количество ступеней внутренней лестницы',
            'pok46' => 'ширина рабочей створки в см',
            'pok47' => 'Домофон, звонок имеется',
            'pok48' => 'Тип входной двери в здание',
            'pok49' => 'Прозрачное полотно, смотровая панель',
            'pok50' => 'Наличие доводчика',
            'pok51' => 'Задержка открывания',
            'pok52' => 'Имеется женский туалет для инвалидов',
            'pok53' => 'Женский туалет для инвалидов, есть на каждом этаже',
            'pok54' => 'Имеется мужской туалет для инвалидов',
            'pok55' => 'Мужской туалет для инвалидов, есть на каждом этаже',
            'pok56' => 'Имеется общий туалет для инвалидов',
            'pok57' => 'Общий туалет для инвалидов, есть на каждом этаже',
            'pok58' => 'Туалет для инвалидов открывается персоналом',
            'pok59' => 'Ремонт здания (помещений)',
            'pok60' => 'Озеленение территории',
            'pok61' => 'Обеспечение библиотеки литературой',
            'pok62' => 'Оснащение пищеблока',
            'pok63' => 'Оснащение кабинетов учебным оборудованием',
            'pok64' => 'Другое (указать)',
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

        $criteria->compare('id_zd',$this->id_zd,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('pok1',$this->pok1);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5,true);
        $criteria->compare('pok6',$this->pok6);
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

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Arch20 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}