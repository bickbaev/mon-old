<?php

/**
 * This is the model class for table "ov_kurs".
 *
 * The followings are the available columns in table 'ov_kurs':
 * @property string $id_mer
 * @property string $id_report
 * @property integer $id_okpdtr
 * @property string $naim_kurs
 * @property integer $hours_kurs
 * @property integer $forma_kurs1
 * @property integer $forma_kurs2
 * @property integer $forma_kurs3
 * @property integer $forma_kurs4
 * @property string $razr
 * @property integer $id_doc
 * @property string $oplata
 * @property string $dop
 */
class Ov_kurs extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Ov_kurs the static model class
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
        return 'ov_kurs';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_okpdtr, naim_kurs, hours_kurs', 'required'),
            array('id_report, id_okpdtr, hours_kurs, forma_kurs1, forma_kurs2, forma_kurs3, forma_kurs4, id_doc', 'numerical', 'integerOnly'=>true),
            array('oplata', 'numerical', 'integerOnly'=>false),
            array('id_okpdtr', 'check_okp'),            
            array('id_report', 'length', 'max'=>12),
            array('naim_kurs, razr', 'length', 'max'=>255),
            array('oplata', 'length', 'max'=>10),
            array('dop', 'safe'),
            array('dop, naim_kurs, razr','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_mer, id_report, id_okpdtr, naim_kurs, hours_kurs, forma_kurs1, forma_kurs2, forma_kurs3, forma_kurs4, razr, id_doc, oplata, dop', 'safe', 'on'=>'search'),
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
            'id_mer' => 'Id Mer',
            'id_report' => 'Id Report',
            'id_okpdtr' => 'Код по ОКПДТР',
            'naim_kurs' => 'Наименование программы',
            'hours_kurs' => 'Количество часов, ч.',
            'forma_kurs1' => 'Очная',
            'forma_kurs2' => 'Очно-заочная',
            'forma_kurs3' => 'Заочная',
            'forma_kurs4' => 'Экстернат',
            'razr' => 'присваимая квалификация или разряд',
            'id_doc' => 'Выдаваемый документ',
            'oplata' => 'Стоимость, руб.',
            'dop' => 'Дополнительная информация (любые дополнительные данные по курсу - входные требования, режим занятий и т.п.)',
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

        $criteria->compare('id_mer',$this->id_mer,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_okpdtr',$this->id_okpdtr);
        $criteria->compare('naim_kurs',$this->naim_kurs,true);
        $criteria->compare('hours_kurs',$this->hours_kurs);
        $criteria->compare('forma_kurs1',$this->forma_kurs1);
        $criteria->compare('forma_kurs2',$this->forma_kurs2);
        $criteria->compare('forma_kurs3',$this->forma_kurs3);
        $criteria->compare('forma_kurs4',$this->forma_kurs4);
        $criteria->compare('razr',$this->razr,true);
        $criteria->compare('id_doc',$this->id_doc);
        $criteria->compare('oplata',$this->oplata,true);
        $criteria->compare('dop',$this->dop,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    public function check_okp($attribute) {
        
        if(!Okpdtr::model()->exists('id_okpdtr=:id_okpdtr',array(':id_okpdtr'=>$this->id_okpdtr))) $this->addError($attribute, 'Неверный код ОКПДТР');
    }    
} 