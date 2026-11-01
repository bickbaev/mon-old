<?php

/**
 * This is the model class for table "doo_0_3".
 *
 * The followings are the available columns in table 'doo_0_3':
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
 * @property string $remark
 */
class Doo_0_3 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'doo_0_3';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok2, pok3, pok9', 'required'),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17', 'numerical', 'integerOnly'=>true),
            //array('pok1', 'pok1_prov'),
            array('pok2', 'pok2_prov'),
            array('pok5', 'pok5_prov'),
            array('pok9', 'pok9_prov'),
            array('pok9', 'pok9_2_prov'),
            array('id_report', 'length', 'max'=>10),
            array('remark', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\!\(\)\-\—\–\r\n\s\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, дефис, точку, запятую, восклицательный знак, знак номера, кавычки вида " и скобки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, remark', 'safe', 'on'=>'search'),
        );
    }
    
    public function pok1_prov ($attribute,$params)
    {            
        if($this->pok1 < ($this->pok2 + $this->pok9)) $this->addError('pok1','Показатель 1 не может быть меньше суммы 2.1 и 3.');
    }        
    
    public function pok2_prov ($attribute,$params)
    {            
        if($this->pok2 < ($this->pok3 + $this->pok4 + $this->pok5 + $this->pok8)) $this->addError('pok2','Показатель 2.1 не может быть меньше суммы 2.1.1, 2.1.2, 2.1.3, 2.1.4');
    }

    public function pok5_prov ($attribute,$params)
    {            
        if($this->pok5 < ($this->pok6 + $this->pok7)) $this->addError('pok5','Показатель 2.1.3 не может быть меньше суммы последующих двух показателей');
    }

    public function pok9_prov ($attribute,$params)
    {            
        if($this->pok9 < $this->pok10) $this->addError('pok9','Показатель 3 не может быть меньше актуального спроса');
    }

    public function pok9_2_prov ($attribute,$params)
    {            
        if($this->pok9 < ($this->pok11 + $this->pok12 + $this->pok13 + $this->pok14 + $this->pok15 + $this->pok16 + $this->pok17)) $this->addError('pok9','Показатель 3 не может быть меньше суммы 4.1-4.7');
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
            'pok1' => '1. Численность детей в возрасте до 3 лет, зарегистрированных на территории муниципалитета',
            'pok2' => '2.1. Численность детей, получающих образовательные услуги по дошкольному образованию и (или) присмотру и уходу',
            'pok3' => '2.1.1. Посещающих муниципальные и государственные дошкольные учреждения (детские сады разных видов, дошкольные группы в образовательных учреждениях для детей дошкольного и младшего школьного возраста, дошкольные группы в общеобразовательных школах, в учреждениях дополнительного образования детей) в режиме полного дня, продленного дня или круглосуточного пребывания',
            'pok4' => '2.1.2. Получающих дошкольное образование в группах кратковременного пребывания (иных формах кратковременного пребывания)',
            'pok5' => '2.1.3. Посещающих частные дошкольные образовательные организации и индивидуальных предпринимателей, имеющих лицензию на осуществление образовательной деятельности:',
            'pok6' => 'из пункта 2.1.3. в режиме полного дня',
            'pok7' => 'из пункта 2.1.3. в иных формах кратковременного пребывания',
            'pok8' => '2.1.4. Численность детей, посещающих частные организации и индивидуальных предпринимателей, не имеющих лицензию на осуществление образовательной деятельности',
            'pok9' => '3. Численность детей, поставленных на учет для предоставления места в государственных или муниципальных дошкольных учреждениях, функционирующих в режиме полного дня (зарегистрированных в электронной очереди или в едином реестре, созданном в муниципальном районе (городском округе) или в субъекте Российской Федерации)',
            'pok10' => 'Из п. 3. численность детей, не обеспеченных местом в дошкольной образовательной организации на желаемую дату (актуальный спрос)',
            'pok11' => '4.1. в течение ближайшего месяца',
            'pok12' => '4.2. в срок от 1 месяца до 3 месяцев',
            'pok13' => '4.3. в срок от 3 месяцев до 6 месяцев',
            'pok14' => '4.4. в срок от 6 месяцев до 1 года',
            'pok15' => '4.5. в срок от 1 года до 1,5 лет',
            'pok16' => '4.6. в срок от 1,5 до 2 лет',
            'pok17' => '4.7. в сроки свыше 2 лет',
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
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Doo_0_3 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
