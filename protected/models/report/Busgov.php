<?php

/**
 * This is the model class for table "busgov".
 *
 * The followings are the available columns in table 'busgov':
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
 * @property string $remark
 */
class Busgov extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'busgov';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9', 'required'),
            array('id_report', 'length', 'max'=>10),
            array('pok4', 'length', 'is'=>10),
            array('pok2, pok6, pok8, pok9', 'length', 'max'=>255),
            array('id_report, pok3, pok4, pok5, pok7', 'numerical', 'integerOnly'=>true),
            array('pok3', 'length', 'is'=>2),
            array('pok5', 'length', 'is'=>9),
            array('pok7', 'length', 'max'=>11),
            array('pok7', 'length', 'min'=>8),
            array('pok1, pok2, remark', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            array('pok9', 'email'),
            array('pok6', 'date', 'format' => 'dd.MM.yyyy'),
            array('pok8', 'match', 'pattern'=>'/^[0-9\(\)\+\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры, тире, скобки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, remark', 'safe', 'on'=>'search'),
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
            'pok1' => 'Полное наименование организации (по уставу)',
            'pok2' => 'Сокращенное наименование организации',
            'pok3' => 'Код по ОКФС',
            'pok4' => 'ИНН',
            'pok5' => 'КПП',
            'pok6' => 'Дата постановки на учет в налоговом органе',
            'pok7' => 'Код территории населенного пункта (по ОКТМО)',
            'pok8' => 'Номер телефона',
            'pok9' => 'Адрес электронной почты',
            'remark' => 'Remark',
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
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Busgov the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}