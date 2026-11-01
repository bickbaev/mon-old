<?php

/**
 * This is the model class for table "isb22".
 *
 * The followings are the available columns in table 'isb22':
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
 * @property string $p_date
 */
class Isb22 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'isb22';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13', 'required'),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13', 'numerical', 'integerOnly'=>true),
            array('pok1, pok2', 'in','range'=>range(1,2)),
            array('pok13', 'in','range'=>range(1,4)),
            array('pok7', 'in','range'=>range(0,100)),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, p_date', 'safe', 'on'=>'search'),
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
            'pok1' => 'Школа является малокомплектной',
            'pok2' => 'Местность, где находится школа',
            'pok3' => 'Общее число обучающихся, чел.',
            'pok4' => 'Число обучающихся, у которых хотя бы один родитель не имеет высшего образования, чел.',
            'pok5' => 'Число обучающихся, у которых хотя бы один родитель безработный, чел.',
            'pok6' => 'Число обучающихся из многодетных семей (семья с тремя и более несовершеннолетними детьми (в том числе усыновлёнными, а также пасынками и падчерицами) в возрасте до 16 лет, а также в возрасте до 18 лет, если они обучаются в образовательных учреждениях, реализующих общеобразовательные программы), чел.',
            'pok7' => 'Доля классов, в которых более 30% обучающихся из малообеспеченных семей, %',
            'pok8' => 'Число обучающихся находящихся под опекой, чел.',
            'pok9' => 'Численность обучающихся для которых русский язык не является родным, чел.',
            'pok10' => 'Численность обучающихся с ОВЗ, чел.',
            'pok11' => 'Численность учителей, преподающих непрофильный предмет, чел.',
            'pok12' => 'Численность учителей, испытвающих сложности при работе с учащимися с ОВЗ, чел.',            
            'pok13' => 'Затраты времени на посещение ближайшего крупого города',
            'p_date' => 'P Date',
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
        $criteria->compare('p_date',$this->p_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Isb22 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

