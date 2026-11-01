<?php

/**
 * This is the model class for table "inf23".
 *
 * The followings are the available columns in table 'inf23':
 * @property string $id_inf
 * @property string $id_report
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property string $pok5
 * @property string $pok6
 * @property string $pok7
 * @property string $pok8
 */
class Inf23 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'inf23';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4', 'required'),
            array('pok1, pok2', 'length', 'max'=>255),
            array('pok1, pok2, pok3', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            array('pok4', 'in','range'=>range(1,6)),
            array('pok5, pok6, pok7, pok8', 'numerical', 'integerOnly'=>true),
            array('pok5, pok6, pok7, pok8', 'length', 'max'=>10),  
            array('pok5', 'check_pok5'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_inf, id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8', 'safe', 'on'=>'search'),
        );
    }
    
    
    public function check_pok5($attribute,$params)
    {
        if(!$this->pok5 && !$this->pok6 && !$this->pok7 && !$this->pok8) $this->addError('pok5', 'Необходимо заполнить хотя бы одно значение по расходам.');
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
            'id_inf' => 'Id Inf',
            'id_report' => 'Id Report',
            'pok1' => 'Наименование программного обеспечения',
            'pok2' => 'Цель использования/создания',
            'pok3' => 'Функционал',
            'pok4' => 'Тип программного обеспечения',
            'pok5' => 'Расходы на 2022 год (целое значение), руб.',
            'pok6' => 'Плановые расходы на 2023 год (целое значение), руб.',
            'pok7' => 'Плановые расходы на 2024 год (целое значение), руб.',
            'pok8' => 'Плановые расходы на 2025 год (целое значение), руб.',
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

        $criteria->compare('id_inf',$this->id_inf,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('pok1',$this->pok1,true);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3,true);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5,true);
        $criteria->compare('pok6',$this->pok6,true);
        $criteria->compare('pok7',$this->pok7,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Inf23 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

