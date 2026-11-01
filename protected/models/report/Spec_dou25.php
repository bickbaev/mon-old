<?php

/**
 * This is the model class for table "spec_dou25".
 *
 * The followings are the available columns in table 'spec_dou25':
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
 */
class Spec_dou25 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'spec_dou25';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1', 'required'),
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26', 'length', 'max'=>10),
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26' , 'numerical', 'integerOnly'=>true),
            array('pok2', 'pok2_val'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26', 'safe', 'on'=>'search'),
        );
    }
    
    public function pok2_val ($attribute,$params)
    {
        for($i = 10; $i <= 19; $i++) {
            $pok = 'pok'.$i;
            if($this->$pok > $this->pok2) $this->addError($pok, 'Число детей превышает число заключений ПМПК');
        }
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
            'pok1'=>'Общее количество обучающихся в ДОУ',
            'pok2'=>'Количество заключений ПМПК',
            'pok3'=>'обучающиеся только с ОВЗ',
            'pok4'=>'обучающиеся только с инвалидностью (справка МСЭ)',
            'pok5'=>'обучающиеся с ОВЗ и инвалидностью ',
            'pok6'=>'Общее количество обучающихся на дому',
            'pok7'=>'Из них обучающихся со статусом "паллиативный ребенок"',
            'pok8'=>'Количество детей, обучающихся по АОП ДОУ',
            'pok9'=>'Количество детей, обучающихся по АОП ДОУ (СИПР)',
            'pok10'=>'Количество детей, которым рекомендовано сопровождение педагогом-психологом в соответствии с заключением ПМПК',
            'pok11'=>'Количество детей, которым организовано сопровождение педагогом-психологом в соответствии с заключением ПМПК',
            'pok12'=>'Количество детей, которым рекомендовано сопровождение учителем-дефектологом в соответствии с заключением ПМПК',
            'pok13'=>'Количество детей, которым организовано сопровождение учителем-дефектологом в соответствии с заключением ПМПК',
            'pok14'=>'Количество детей, которым рекомендовано сопровождение учителем-логопедом в соответствии с заключением ПМПК',
            'pok15'=>'Количество детей, которым организовано сопровождение учителем-логопедом в соответствии с заключением ПМПК',
            'pok16'=>'Количество детей, которым рекомендовано тьюторское сопровождение в соответствии с заключением ПМПК',
            'pok17'=>'Количество детей, которым организовано тьюторское сопровождение в соответствии с заключением ПМПК',
            'pok18'=>'Количество детей, которым рекомендовано сопровождение ассистентом-помощником в соответствии с заключением ПМПК',
            'pok19'=>'Количество детей, которым организовано сопровождение ассистентом-помощником в соответствии с заключением ПМПК',
            'pok20'=>'Количество педагогических работников, работающих с детьми с ОВЗ (всего чел.)',
            'pok21'=>'Количество педагогов-психологов (чел.)',
            'pok22'=>'Количество учителей-дефектологов (чел.)',
            'pok23'=>'Количество учителей-логопедов (чел.)',
            'pok24'=>'Количество тьюторов (чел.)',
            'pok25'=>'Количество социальных педагогов (чел.)',
            'pok26'=>'Количество асистентов-помощников (чел.)',
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

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Spec_dou25 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}