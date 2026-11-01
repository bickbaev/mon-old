<?php

/**
 * This is the model class for table "kk22".
 *
 * The followings are the available columns in table 'kk22':
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
 * @property string $p_date
 */
class Kk22 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'kk22';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok8' , 'numerical', 'integerOnly'=>true),
            array('pok1, pok2, pok3, pok8', 'in','range'=>array(0,1)),
            array('pok4, pok5, pok6, pok7, pok9, pok10', 'match', 'pattern'=>'/^[a-zA-Zа-яА-ЯёЁ0-9№,\.\(\)\-\«\»\:\;\s\"\_\?\!\=\%\&\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, точку, двоеточие, знак номера, скобки и кавычки, дробь'),
            array('pok4, pok5, pok6, pok7, pok9, pok10', 'length', 'max'=>1500),
            //array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, p_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, p_date', 'safe', 'on'=>'search'),
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
            'pok1' => 'В образовательнной организации приняты локальные акты, регламентирующие вопросы создания и функционирования Комиссии',
            'pok2' => 'Комиссия является постоянно действующей',
            'pok3' => 'Комиссия создается на определенный период времени для разрешения конкретной ситуации',
            'pok4' => 'Какие вопросы наиболее часто выносятся на заседание Комиссии (пример)?',
            'pok5' => 'Наличие проблематики, связанной с функционированием Комиссии. Если да, то какие пути их решения Вы видите?',
            'pok6' => 'Количество конфликтов между участниками образовательных отношений, разрешенных  с помощью Комиссии',
            'pok7' => 'Имелись ли случаи обжалования решения Комиссии. В какой орган они направлялись?',
            'pok8' => 'Имелись ли случаи судебных разбирательств, связанных с функционированием Комиссии и принимаемыми ею решениями?',
            'pok9' => 'Имеются ли случаи взаимодействия Комиссии с органами внутренних дел, комиссиями по делам несовершеннолетних, органами опеки, органами прокуратуры? Если да, то как методологически это происходит и каковы результаты такого взаимодействия',
            'pok10' => 'Ваши предложения по совершенствованию положений законодательства, регулирующих работу Комиссии (при наличии)',
            'p_date' => 'Дата подачи',
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
        $criteria->compare('p_date',$this->p_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Kk22 the static model class
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
