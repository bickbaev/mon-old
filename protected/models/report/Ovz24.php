<?php

/**
 * This is the model class for table "ovz24".
 *
 * The followings are the available columns in table 'ovz24':
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
 * @property string $p_date
 */
class Ovz24 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ovz24';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pok1, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43', 'required'),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9', 'length', 'max'=>255),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9', 'url'),
            array('pok10, pok27, pok28, pok29', 'in','range'=>array(0,1)),
            array('id_report, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43' , 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40, pok41, pok42, pok43, p_date', 'safe', 'on'=>'search'),
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
            'pok1' => 'Сайт',
            'pok2' => 'Положение об организации обучения лиц с ОВЗ (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok3' => 'Положение о порядке разработки, утверждения и внесения изменений в АООП (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok4' => 'Положение о порядке разработки и реализации ИОП (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok5' => 'Положение о порядке разработки и реализации СИПР (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok6' => 'Положение о ППк (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok7' => 'Положение об оказании логопедической помощи (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok8' => 'Положение об индивидуальном учебном плане (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok9' => 'Положение об организации обучения на дому  (ссылка на документ, размещенный на официальном сайте ОО)',
            'pok10' => 'Наличие приказа об организации обучения на дому',
            'pok11' => 'Всего детей в ОО',
            'pok12' => 'Общее количество обучающихся на дому',
            'pok13' => 'Обучающиеся только с ОВЗ (из общего количества обучающихся на дому)',
            'pok14' => 'Обучающиеся только с инвалидностью (из общего количества обучающихся на дому)',
            'pok15' => 'Обучающиеся с ОВЗ и инвалидностью (из общего количества обучающихся на дому)',
            'pok16' => 'Из них обучающихся со статусом "паллиативный ребенок" (из общего количества обучающихся на дому)',
            'pok17' => 'Численность обучающихся, получающих образование только с применением дистанционных образовательных технологий',
            'pok18' => 'Численность обучающихся, к которым учителя приходят на дом (без выхода в школу)',
            'pok19' => 'Численность обучающихся, которые обучаются только непосредственно в ОО',
            'pok20' => 'Численность обучающихся, которые обучаются в комбинированной форме (выход учителя к ребенку и посещение занятий ребенком в ОО)',
            'pok21' => 'Количество справок ВК',
            'pok22' => 'Количество заключений ПМПК',
            'pok23' => 'Количество обучающихся, имеющих оба документа',
            'pok24' => 'Количество заявления родителей (законных представителей) об организации обучения на дому',
            'pok25' => 'Количество договоров о получении образования на дому',
            'pok26' => 'Количество индивидуальных учебных планов обучающихся на дому',
            'pok27' => 'Наличие отметки родителя (законного представителя) о согласовании ИУП обучающегося на дому (на каждого обучающегося)',
            'pok28' => 'Наличие календарного учебного графика (на каждого обучающегося)',
            'pok29' => 'Наличие индивидуального расписания занятий (на каждого обучающегося)',
            'pok30' => '1доп',
            'pok31' => '1 класс',
            'pok32' => '2 класс',
            'pok33' => '3 класс',
            'pok34' => '4 класс',
            'pok35' => '5 класс',
            'pok36' => '6 класс',
            'pok37' => '7 класс',
            'pok38' => '8 класс',
            'pok39' => '9 класс',
            'pok40' => '10 класс',
            'pok41' => '10 класс',
            'pok42' => '12 класс',
            'pok43' => '13 класс',
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
        $criteria->compare('p_date',$this->p_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ovz24 the static model class
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
    
    protected function afterFind()
    {
        if($this->p_date == '0000-00-00 00:00:00' || $this->p_date == '') $this->p_date='';
        else $this->p_date=date('d.m.Y H:i:s', strtotime($this->p_date));
    }    
}