<?php

/**
 * This is the model class for table "ovz22".
 *
 * The followings are the available columns in table 'ovz22':
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
 * @property double $pok26
 * @property double $pok27
 * @property double $pok28
 * @property double $pok29
 * @property double $pok30
 * @property double $pok31
 * @property double $pok32
 * @property double $pok33
 * @property double $pok34
 * @property double $pok35
 * @property double $pok36
 * @property double $pok37
 * @property double $pok38
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
 * @property double $pok52
 * @property double $pok53
 * @property double $pok54
 * @property double $pok55
 * @property double $pok56
 * @property double $pok57
 * @property double $pok58
 * @property double $pok59
 * @property double $pok60
 * @property double $pok61
 * @property double $pok62
 * @property double $pok63
 * @property double $pok64
 * @property double $pok65
 * @property double $pok66
 * @property double $pok67
 * @property double $pok68
 * @property double $pok69
 * @property double $pok70
 * @property double $pok71
 * @property double $pok72
 * @property double $pok73
 * @property double $pok74
 * @property double $pok75
 * @property double $pok76
 * @property double $pok77
 * @property string $p_date
 */
class Ovz22 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ovz22';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7', 'url'),
            array('pok8, pok23, pok24, pok25', 'in','range'=>array(0,1)),
            array('id_report, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51' , 'numerical', 'integerOnly'=>true),
            array('pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77', 'numerical'),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7', 'length', 'max'=>255),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, pok44, pok45, pok46, pok47, pok48, pok49, pok50, pok51, pok52, pok53, pok54, pok55, pok56, pok57, pok58, pok59, pok60, pok61, pok62, pok63, pok64, pok65, pok66, pok67, pok68, pok69, pok70, pok71, pok72, pok73, pok74, pok75, pok76, pok77, p_date', 'safe', 'on'=>'search'),
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
            'pok1' => 'Положение об организации обучения лиц с ОВЗ (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok2' => 'Положение о порядке разработки и реализации ИОП  (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok3' => 'Положение о порядке разработки и реализации СИПР (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok4' => 'Положение о ППк (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok5' => 'Положение об оказании логопедической помощи (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok6' => 'Положение об организации обучения на дому (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok7' => 'Положение об индивидуальном учебном плане (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok8' => 'Наличие приказа об организации обучения на дому',
            'pok9' => 'Общее количество обучающихся на дому',
            'pok10' => 'обучающиеся только с ОВЗ',
            'pok11' => 'обучающиеся только с инвалидностью',
            'pok12' => 'обучающиеся с ОВЗ и инвалидностью ',
            'pok13' => 'Численность обучающихся, получающих образование только с применением дистанционных образовательных технологий ',
            'pok14' => 'Численность обучающихся, к которым учителя приходят на дом (без выхода в школу)',
            'pok15' => 'Численность обучающихся, которые обучаются только непосредственно в ОО',
            'pok16' => 'Численность обучающихся, которые обучаются в комбинированной форме (выход учителя к ребенку и посещение занятий ребенком в ОО)',
            'pok17' => 'Количество справок ВК',
            'pok18' => 'Количество заключений ПМПК',
            'pok19' => 'Количество обучающихся, имеющих оба документа',
            'pok20' => 'Количество заявления родителей (законных представителей) об организации обучения на дому',
            'pok21' => 'Количество договоров о получении образования на дому',
            'pok22' => 'Количество индивидуальных учебных планов обучающихся на дому',
            'pok23' => 'Наличие отметки родителя (законного представителя) о согласовании ИУП обучающегося на дому (на каждого обучающегося)',
            'pok24' => 'Наличие календарного учебного графика (на каждого обучающегося)',
            'pok25' => 'Наличие индивидуального расписания занятий (на каждого обучающегося)',
            'pok26' => '1доп',
            'pok27' => '1 класс',
            'pok28' => '2 класс',
            'pok29' => '3 класс',
            'pok30' => '4 класс',
            'pok31' => '5 класс',
            'pok32' => '6 класс',
            'pok33' => '7 класс',
            'pok34' => '8 класс',
            'pok35' => '9 класс',
            'pok36' => '10 класс',
            'pok37' => '11 класс',
            'pok38' => '12-13 класс',
            'pok39' => '1доп',
            'pok40' => '1 класс',
            'pok41' => '2 класс',
            'pok42' => '3 класс',
            'pok43' => '4 класс',
            'pok44' => '5 класс',
            'pok45' => '6 класс',
            'pok46' => '7 класс',
            'pok47' => '8 класс',
            'pok48' => '9 класс',
            'pok49' => '10 класс',
            'pok50' => '11 класс',
            'pok51' => '12-13 класс',
            'pok52' => '1доп',
            'pok53' => '1 класс',
            'pok54' => '2 класс',
            'pok55' => '3 класс',
            'pok56' => '4 класс',
            'pok57' => '5 класс',
            'pok58' => '6 класс',
            'pok59' => '7 класс',
            'pok60' => '8 класс',
            'pok61' => '9 класс',
            'pok62' => '10 класс',
            'pok63' => '11 класс',
            'pok64' => '12-13 класс',
            'pok65' => '1доп',
            'pok66' => '1 класс',
            'pok67' => '2 класс',
            'pok68' => '3 класс',
            'pok69' => '4 класс',
            'pok70' => '5 класс',
            'pok71' => '6 класс',
            'pok72' => '7 класс',
            'pok73' => '8 класс',
            'pok74' => '9 класс',
            'pok75' => '10 класс',
            'pok76' => '11 класс',
            'pok77' => '12-13 класс',
            'p_date' => 'Дата заполнения',
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
        $criteria->compare('pok26',$this->pok26);
        $criteria->compare('pok27',$this->pok27);
        $criteria->compare('pok28',$this->pok28);
        $criteria->compare('pok29',$this->pok29);
        $criteria->compare('pok30',$this->pok30);
        $criteria->compare('pok31',$this->pok31);
        $criteria->compare('pok32',$this->pok32);
        $criteria->compare('pok33',$this->pok33);
        $criteria->compare('pok34',$this->pok34);
        $criteria->compare('pok35',$this->pok35);
        $criteria->compare('pok36',$this->pok36);
        $criteria->compare('pok37',$this->pok37);
        $criteria->compare('pok38',$this->pok38);
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
        $criteria->compare('pok52',$this->pok52);
        $criteria->compare('pok53',$this->pok53);
        $criteria->compare('pok54',$this->pok54);
        $criteria->compare('pok55',$this->pok55);
        $criteria->compare('pok56',$this->pok56);
        $criteria->compare('pok57',$this->pok57);
        $criteria->compare('pok58',$this->pok58);
        $criteria->compare('pok59',$this->pok59);
        $criteria->compare('pok60',$this->pok60);
        $criteria->compare('pok61',$this->pok61);
        $criteria->compare('pok62',$this->pok62);
        $criteria->compare('pok63',$this->pok63);
        $criteria->compare('pok64',$this->pok64);
        $criteria->compare('pok65',$this->pok65);
        $criteria->compare('pok66',$this->pok66);
        $criteria->compare('pok67',$this->pok67);
        $criteria->compare('pok68',$this->pok68);
        $criteria->compare('pok69',$this->pok69);
        $criteria->compare('pok70',$this->pok70);
        $criteria->compare('pok71',$this->pok71);
        $criteria->compare('pok72',$this->pok72);
        $criteria->compare('pok73',$this->pok73);
        $criteria->compare('pok74',$this->pok74);
        $criteria->compare('pok75',$this->pok75);
        $criteria->compare('pok76',$this->pok76);
        $criteria->compare('pok77',$this->pok77);
        $criteria->compare('p_date',$this->p_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ovz22 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }    
    
    protected function beforeSave()
    {
        $this->p_date=date('Y-m-d H:i:s', time());
        return TRUE;
    }      
}