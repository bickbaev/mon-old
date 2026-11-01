<?php

/**
 * This is the model class for table "dou_inet".
 *
 * The followings are the available columns in table 'dou_inet':
 * @property string $id_report
 * @property string $naim_ur
 * @property string $adrress_ur
 * @property integer $inet_ur
 * @property string $naim_fil
 * @property string $address_fil
 * @property integer $inet_fil
 * @property string $inet_fact
 * @property string $prov
 * @property string $tech
 * @property string $tariff
 * @property integer $speed
 * @property integer $cost_obor
 * @property integer $cost_rab
 * @property integer $cost_all
 * @property integer $cost_month
 * @property integer $itog_year
 */
class Dou_inet extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Dou_inet the static model class
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
        return 'dou_inet';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('naim_ur, adrress_ur', 'required'),
            array('inet_ur, inet_fil, speed, cost_obor, cost_rab, cost_all, cost_month, itog_year', 'numerical', 'integerOnly'=>true),
            array('naim_ur, adrress_ur, naim_fil, address_fil, inet_fact, prov, tech, tariff', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, naim_ur, adrress_ur, inet_ur, naim_fil, address_fil, inet_fil, inet_fact, prov, tech, tariff, speed, cost_obor, cost_rab, cost_all, cost_month, itog_year', 'safe', 'on'=>'search'),
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
            'naim_ur' => 'Полное наименование образовательного учреждения',
            'adrress_ur' => 'Юридический адрес образовательного учреждения',
            'inet_ur' => 'Наличие подключения к сети Интернет',
            'naim_fil' => 'Наименование филиала (детского сада)',
            'address_fil' => 'Почтовый адрес филиала образовательного учреждения (с указанием индекса)',
            'inet_fil' => 'Наличие подключения к сети Интернет',
            'inet_fact' => 'Фактический адрес предоставления услуги доступа к сети Интернет (почтовый адрес здания ОУ, с точкой доступа в Интернет)',
            'prov' => 'Интернет-провайдер',
            'tech' => 'Технология подключения (ADSL, оптический канал, 3G и т.д.)',
            'tariff' => 'Тарифный план (наименование)',
            'speed' => 'Скорость доступа (Кбит/с)',
            'cost_obor' => 'Стоимость оборудования необходимого для подключения к сети интернет, руб',
            'cost_rab' => 'Стоимость работ по подключению к сети интернет, руб',
            'cost_all' => 'Стоимость оборудования и работ всего, руб',
            'cost_month' => 'Стоимость доступа в интернет в месяц, руб',
            'itog_year' => 'Итого доступ в год, руб',
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

        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('naim_ur',$this->naim_ur,true);
        $criteria->compare('adrress_ur',$this->adrress_ur,true);
        $criteria->compare('inet_ur',$this->inet_ur);
        $criteria->compare('naim_fil',$this->naim_fil,true);
        $criteria->compare('address_fil',$this->address_fil,true);
        $criteria->compare('inet_fil',$this->inet_fil);
        $criteria->compare('inet_fact',$this->inet_fact,true);
        $criteria->compare('prov',$this->prov,true);
        $criteria->compare('tech',$this->tech,true);
        $criteria->compare('tariff',$this->tariff,true);
        $criteria->compare('speed',$this->speed);
        $criteria->compare('cost_obor',$this->cost_obor);
        $criteria->compare('cost_rab',$this->cost_rab);
        $criteria->compare('cost_all',$this->cost_all);
        $criteria->compare('cost_month',$this->cost_month);
        $criteria->compare('itog_year',$this->itog_year);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
}