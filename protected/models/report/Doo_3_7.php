<?php

/**
 * This is the model class for table "doo_3_7".
 *
 * The followings are the available columns in table 'doo_3_7':
 * @property string $id_report
 * @property integer $pok1
 * @property integer $pok2
 * @property integer $pok3
 * @property integer $pok4
 * @property integer $pok5
 * @property integer $pok6
 * @property integer $pok7
 * @property integer $pok8
 * @property integer $pok9
 * @property integer $pok10
 * @property integer $pok11
 * @property integer $pok12
 * @property integer $pok13
 * @property integer $pok14
 * @property integer $pok15
 * @property integer $pok16
 * @property integer $pok17
 * @property integer $pok18
 * @property integer $pok19
 * @property string $remark
 */
class Doo_3_7 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'doo_3_7';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok3, pok4', 'required'),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19', 'numerical', 'integerOnly'=>true),
            //array('pok1', 'pok1_prov'),
            array('pok3', 'pok3_prov'),
            //array('pok8', 'pok8_prov'),
            array('pok9', 'pok9_prov'),            
            array('id_report', 'length', 'max'=>10),
            array('remark', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\!\(\)\-\—\–\r\n\s\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, дефис, точку, запятую, восклицательный знак, знак номера, кавычки вида " и скобки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, remark', 'safe', 'on'=>'search'),
        );
    }
    
    public function pok1_prov ($attribute,$params)
    {            
        if($this->pok1 < ($this->pok3 + $this->pok8)) $this->addError('pok1','Показатель 1 не может быть меньше суммы 2.2 и 3.');
    }
    
    public function pok3_prov ($attribute,$params)
    {            
        if($this->pok3 < ($this->pok4 + $this->pok5 + $this->pok6 + $this->pok7)) $this->addError('pok3','Показатель 2.2 не может быть меньше суммы 2.2.1, 2.2.2, 2.2.3, 2.2.4');
    }

    public function pok8_prov ($attribute,$params)
    {            
        if($this->pok8 < ($this->pok10 + $this->pok11 + $this->pok12 + $this->pok13 + $this->pok14 + $this->pok15 + $this->pok16)) $this->addError('pok8','Показатель 3 не может быть меньше суммы 4.1-4.7');
    }

    public function pok9_prov ($attribute,$params)
    {            
        if($this->pok9 != ($this->pok10 + $this->pok11 + $this->pok12 + $this->pok13 + $this->pok14 + $this->pok15 + $this->pok16)) $this->addError('pok9','Показатель 4 должен быть равен сумме 4.1-4.7');
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
            'pok1' => '1. Численность детей в возрасте от 3 до 7 лет, зарегистрированных на территории муниципалитета',
            'pok2' => '2.1. Численность детей в возрасте от 5 до 7 лет, обучающихся по основным общеобразовательным программам начального общего образования',
            'pok3' => '2.2. Численность детей, получающих образовательные услуги по дошкольному образованию и (или) содержанию (присмотру и уходу)',
            'pok4' => '2.2.1. Посещающих муниципальные и государственные дошкольные учреждения (детские сады разных видов, дошкольные группы в учреждениях для детей дошкольного н младшего школьного возраста, дошкольные группы при общеобразовательных школах и др.) в режиме полного дня, продлённого дня или круглосуточного пребывания',
            'pok5' => '2.2.2. Посещающих негосударственные дошкольные учреждения в режиме полного дня',
            'pok6' => '2.2.3. Получающих дошкольное образование в группах кратковременного пребывания (иных формах кратковременного пребывания)',
            'pok7' => '2.2.4. Получающих дошкольное образование в частных организациях и у индивидуальных предпринимателей, не имеющих лицензии на образовательную деятельность (семейных дошкольных группах, группах присмотра и ухода)',
            'pok8' => '3. Численность детей в возрасте от 3 до 7 лет, поставленных на учет для предоставления места в государственных или муниципальных дошкольных учреждениях, функционирующих в режиме полного дня (зарегистрированных в электронной очереди пли в едином реестре, созданном в муниципальном районе (городском округе) или в субъекте Российской Федерации) (актуальный спрос)',
            'pok9' => '4. Из них получат место в образовательном учреждении, реализующем основную общеобразовательную программу дошкольного образования (в группе, функционирующей в режиме полного дня):',
            'pok10' => '4.1. в течение ближайшего месяца',
            'pok11' => '4.2. в срок от 1 месяца до 3 месяцев',
            'pok12' => '4.3. в срок от 3 месяцев до 6 месяцев',
            'pok13' => '4.4. в срок от 6 месяцев до 1 года',
            'pok14' => '4.5. в срок от 1 года до 1,5 лет ',
            'pok15' => '4.6. в срок от 1,5 до 2 лет',
            'pok16' => '4.7. в сроки свыше 2 лет',
            'pok17' => '5. Количество дошкольных образовательных учреждений, подведомственных Минобороны России, которые необходимо принять в муниципальную собственность субъекта Российской Федерации',
            'pok18' => '5.1. Количество дошкольных образовательных учреждений, подведомственных Минобороны России, принятых в муниципальную собственность субъекта Российской Федерации',
            'pok19' => '5.2. Численность детей в возрасте 7 лет и старше, получающих услуги по дошкольному образованию, а также присмотру и уходу',
            'remark' => 'Примечания по отчету',
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
        $criteria->compare('pok1',$this->pok1);
        $criteria->compare('pok2',$this->pok2);
        $criteria->compare('pok3',$this->pok3);
        $criteria->compare('pok4',$this->pok4);
        $criteria->compare('pok5',$this->pok5);
        $criteria->compare('pok6',$this->pok6);
        $criteria->compare('pok7',$this->pok7);
        $criteria->compare('pok8',$this->pok8);
        $criteria->compare('pok9',$this->pok9);
        $criteria->compare('pok10',$this->pok10);
        $criteria->compare('pok11',$this->pok11);
        $criteria->compare('pok12',$this->pok12);
        $criteria->compare('pok13',$this->pok13);
        $criteria->compare('pok14',$this->pok14);
        $criteria->compare('pok15',$this->pok15);
        $criteria->compare('pok16',$this->pok16);
        $criteria->compare('pok17',$this->pok17);
        $criteria->compare('pok18',$this->pok18);
        $criteria->compare('pok19',$this->pok19);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Doo_3_7 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

