<?php

/**
 * This is the model class for table "isb".
 *
 * The followings are the available columns in table 'isb':
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
 * @property string $remark
 */
class Isb extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'isb';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11', 'required'),
            array('id_report', 'length', 'max'=>10),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10', 'length', 'max'=>4),
            array('pok11', 'length', 'is'=>6),
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11', 'numerical', 'integerOnly'=>true),
            array('pok2, pok3, pok4, pok5, pok6, pok7, pok8', 'chisp'),
            array('pok10', 'chist'),
            array('remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, remark', 'safe', 'on'=>'search'),
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
            'pok1' => 'Общее число учащихся, чел.',
            'pok2' => 'Число обучающихся, у которых хотя бы один родитель не имеет высшего образования, чел.',
            'pok3' => 'Число обучающихся, у которых хотя бы один родитель безработный, чел.',
            'pok4' => 'Число обучающихся из неполных семей, чел.',
            'pok5' => 'Число обучающихся из многодетных семей (семья с тремя и более несовершеннолетними детьми (в том числе усыновлёнными, а также пасынками и падчерицами) в возрасте до 16 лет, а также в возрасте до 18 лет, если они обучаются в образовательных учреждениях, реализующих общеобразовательные программы), чел.',
            'pok6' => 'Число обучающихся находящихся под опекой, чел.',
            'pok7' => 'Число обучающихся состоящих на внутришкольном и других видах учета, чел.',
            'pok8' => 'Численность обучающихся для которых русский язык не является родным, чел.',
            'pok9' => 'Общая численность учителей, чел.',
            'pok10' => 'Численность учителей преподающих непрофильный предмет, чел.',
            'pok11' => 'Код образовательной организации по ЕГЭ (если код неизвестен, его можно узнать в справочнике выше)',
            'rg1' => 'Русский ГИА 2014',
            'rg2' => 'Русский ГИА 2015',
            'rg3' => 'Русский ГИА 2016',
            'mg1' => 'Математика ГИА 2014',
            'mg2' => 'Математика ГИА 2015',
            'mg3' => 'Математика ГИА 2016', 
            're1' => 'Русский ЕГЭ 2014',
            're2' => 'Русский ЕГЭ 2015',
            're3' => 'Русский ЕГЭ 2016',
            'me1' => 'Математика ЕГЭ 2014',
            'me2' => 'Математика ЕГЭ 2015',
            'me3' => 'Математика ЕГЭ 2016', 
            'remark' => 'Замечания',            
        );
    }
    
    public function chisp($attribute,$params) {
        if($this->$attribute > $this->pok1)  $this->addError($attribute, "Значение показателя превышает общее число обучащихся");
    }    

    public function chist($attribute,$params) {
        if($this->pok10 > $this->pok9)  $this->addError('pok10', 'Численность учителей преподающих непрофильный предмет превышает общее число учителей');
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
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Isb the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}