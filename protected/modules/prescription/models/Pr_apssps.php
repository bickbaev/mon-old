<?php

/**
 * This is the model class for table "pr_apssps".
 *
 * The followings are the available columns in table 'pr_apssps':
 * @property string $id_report
 * @property string $id_build
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
 * @property string $pok27
 * @property string $pok28
 * @property string $pok29
 * @property string $pok30
 * @property string $pok31
 * @property string $pok32
 * @property string $pok33
 * @property string $pok34
 * @property string $pok35
 * @property string $pok36
 * @property string $status
 * @property string $id_rep_type
 * @property string $red
 */
class Pr_apssps extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pr_apssps';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_build', 'required'),
            array('pok3, pok4, pok5, pok6, pok13, pok14, pok16, pok18, pok31, pok32, pok35', 'length', 'max'=>255),            
            array('pok1, pok2, pok10, pok23, pok24', 'in','range'=>array(0,1)),
            array('pok3, pok4, pok5, pok6, pok13, pok14, pok16, pok18, pok31, pok32, pok35', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            array('pok7, pok8', 'in','range'=>range(1990, date('Y'))),
            array('pok9', 'in','range'=>array(1,3)),
            array('pok33, pok34', 'in','range'=>array(1,2)),
            array('pok11, pok12, pok19, pok20, pok21, pok22, pok25, pok26', 'numerical', 'integerOnly'=>true),
            array('pok15, pok17, pok27, pok28, pok29, pok30, pok36', 'date', 'format' => 'dd.MM.yyyy'),
            array('pok1', 'chk_aps'),
            array('pok2', 'chk_sps'),
            array('pok13', 'chk_pok13'),
            array('pok14', 'chk_pok14'),
            array('pok23', 'chk_pok23'),
            array('pok24', 'chk_pok24'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, id_build, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, status, id_rep_type, red', 'safe', 'on'=>'search'),
        );
    }
    
    public function chk_aps ($attribute,$params)
    {            
        if($this->pok1) {
            if(!$this->pok3) $this->addError('pok3', 'Необходимо заполнить поле');
            if(!$this->pok4) $this->addError('pok4', 'Необходимо заполнить поле');
            if(!$this->pok7) $this->addError('pok7', 'Необходимо заполнить поле');
            if(!$this->pok11) $this->addError('pok11', 'Необходимо заполнить поле');
            if(!$this->pok27) $this->addError('pok27', 'Необходимо заполнить поле');
            if(!$this->pok33) $this->addError('pok33', 'Необходимо заполнить поле');
        }    
    }
    
    public function chk_sps ($attribute,$params)
    {            
        if($this->pok2) {
            if(!$this->pok5) $this->addError('pok5', 'Необходимо заполнить поле');
            if(!$this->pok6) $this->addError('pok6', 'Необходимо заполнить поле');
            if(!$this->pok8) $this->addError('pok8', 'Необходимо заполнить поле');
            if(!$this->pok9) $this->addError('pok9', 'Необходимо заполнить поле');
            if(!$this->pok12) $this->addError('pok12', 'Необходимо заполнить поле');
            if(!$this->pok29) $this->addError('pok29', 'Необходимо заполнить поле');
            if(!$this->pok34) $this->addError('pok34', 'Необходимо заполнить поле');
        }    
    }
    
    public function chk_pok13 ($attribute,$params)
    {            
        if($this->pok13) {
            if(!$this->pok15) $this->addError('pok15', 'Необходимо заполнить поле');
            if(!$this->pok16) $this->addError('pok16', 'Необходимо заполнить поле');
            if(!$this->pok19) $this->addError('pok19', 'Необходимо заполнить поле');
            if(!$this->pok20) $this->addError('pok20', 'Необходимо заполнить поле');
        }    
    }
    
    public function chk_pok14 ($attribute,$params)
    {            
        if($this->pok14) {
            if(!$this->pok17) $this->addError('pok17', 'Необходимо заполнить поле');
            if(!$this->pok18) $this->addError('pok18', 'Необходимо заполнить поле');
            if(!$this->pok21) $this->addError('pok21', 'Необходимо заполнить поле');
            if(!$this->pok22) $this->addError('pok22', 'Необходимо заполнить поле');
        }    
    }

    public function chk_pok23 ($attribute,$params)
    {            
        if($this->pok23) {
            if(!$this->pok25) $this->addError('pok25', 'Необходимо заполнить поле');
            if(!$this->pok28) $this->addError('pok28', 'Необходимо заполнить поле');
            if(!$this->pok31) $this->addError('pok31', 'Необходимо заполнить поле');
        }    
    }

    public function chk_pok24 ($attribute,$params)
    {            
        if($this->pok24) {
            if(!$this->pok26) $this->addError('pok26', 'Необходимо заполнить поле');
            if(!$this->pok30) $this->addError('pok30', 'Необходимо заполнить поле');
            if(!$this->pok32) $this->addError('pok32', 'Необходимо заполнить поле');
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
            'id_build' => 'Id Build',
            'pok1' => 'Факт оснащения АПС',
            'pok2' => 'Факт оснащения СПС',
            'pok3' => 'Марка АПС',
            'pok4' => 'Модель АПС',
            'pok5' => 'Марка СПС',
            'pok6' => 'Модель СПС',
            'pok7' => 'Год установки АПС',
            'pok8' => 'Год установки СПС',
            'pok9' => 'Технология передачи сигнала СПС',
            'pok10' => 'Факт оснащения АПС системой голосового оповещения',
            'pok11' => 'Нормативный срок эксплуатации АПС (в годах по паспорту)',
            'pok12' => 'Нормативный срок эксплуатации СПС (в годах по паспорту)',
            'pok13' => 'Наименование обслуживающей организации АПС',
            'pok14' => 'Наименование обслуживающей организации СПС',
            'pok15' => 'Дата договора на обслуживание АПС в 2022 году',
            'pok16' => 'Номер договора на обслуживание АПС в 2022 году',
            'pok17' => 'Дата договора на обслуживание СПС в 2022 году',
            'pok18' => 'Номер договора на обслуживание СПС в 2022 году',
            'pok19' => 'Стоимость обслуживания АПС в месяц (в рублях)',
            'pok20' => 'Стоимость обслуживания АПС в год (в рублях)',
            'pok21' => 'Стоимость обслуживания СПС в месяц (в рублях)',
            'pok22' => 'Стоимость обслуживания СПС в год (в рублях)',
            'pok23' => 'Наличие планов по замене (реконструкции, модернизации) АПС в 2022 – 2023 году',
            'pok24' => 'Наличие планов по замене (реконструкции, модернизации) СПС в 2022 – 2023 году',
            'pok25' => 'Стоимость замены (реконструкции, модернизации) АПС (в рублях)',
            'pok26' => 'Стоимость замены (реконструкции, модернизации) СПС (в рублях)',
            'pok27' => 'Дата ввода в эксплуатацию АПС',
            'pok28' => 'Дата планируемой (реконструкции, модернизации) АПС',
            'pok29' => 'Дата ввода в эксплуатацию СПС',
            'pok30' => 'Дата планируемой (реконструкции, модернизации) СПС',
            'pok31' => 'Источник финансирования (пункт муниципальной программы) соответствующего мероприятия по замене (реконструкции, модернизации) АПС',
            'pok32' => 'Источник финансирования (пункт муниципальной программы) соответствующего мероприятия по замене (реконструкции, модернизации) СПС',
            'pok33' => 'Тип имущества АПС',
            'pok34' => 'Тип имущества СПС',
            'pok35' => 'Реквизиты акта обследования АПС в 2021 году',
            'pok36' => 'Срок действия акта обследования АПС в 2021 году',
            'status' => 'Status',
            'id_rep_type' => 'Id Rep Type',
            'red' => 'Red',
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
        $criteria->compare('id_build',$this->id_build,true);
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
        $criteria->compare('pok27',$this->pok27,true);
        $criteria->compare('pok28',$this->pok28,true);
        $criteria->compare('pok29',$this->pok29,true);
        $criteria->compare('pok30',$this->pok30,true);
        $criteria->compare('pok31',$this->pok31,true);
        $criteria->compare('pok32',$this->pok32,true);
        $criteria->compare('pok33',$this->pok33,true);
        $criteria->compare('pok34',$this->pok34,true);
        $criteria->compare('pok35',$this->pok35,true);
        $criteria->compare('pok36',$this->pok36,true);
        $criteria->compare('status',$this->status,true);
        $criteria->compare('id_rep_type',$this->id_rep_type,true);
        $criteria->compare('red',$this->red,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pr_apssps the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    { 
        if($this->pok15 != '') $this->pok15=date('Y-m-d', strtotime($this->pok15));
        if($this->pok17 != '') $this->pok17=date('Y-m-d', strtotime($this->pok17));
        if($this->pok27 != '') $this->pok27=date('Y-m-d', strtotime($this->pok27));
        if($this->pok28 != '') $this->pok28=date('Y-m-d', strtotime($this->pok28));
        if($this->pok29 != '') $this->pok29=date('Y-m-d', strtotime($this->pok29));
        if($this->pok30 != '') $this->pok30=date('Y-m-d', strtotime($this->pok30));
        if($this->pok36 != '') $this->pok36=date('Y-m-d', strtotime($this->pok36));
        $this->red = date('Y-m-d H:i:s',time());

        return TRUE;
    }

    protected function afterFind()
    { 
        if($this->pok15 == '0000-00-00' || $this->pok15 == '') $this->pok15='';
        else $this->pok15=date('d.m.Y', strtotime($this->pok15));
        if($this->pok17 == '0000-00-00' || $this->pok17 == '') $this->pok17='';
        else $this->pok17=date('d.m.Y', strtotime($this->pok17));
        if($this->pok27 == '0000-00-00' || $this->pok27 == '') $this->pok27='';
        else $this->pok27=date('d.m.Y', strtotime($this->pok27));
        if($this->pok28 == '0000-00-00' || $this->pok28 == '') $this->pok28='';
        else $this->pok28=date('d.m.Y', strtotime($this->pok28));
        if($this->pok29 == '0000-00-00' || $this->pok29 == '') $this->pok29='';
        else $this->pok29=date('d.m.Y', strtotime($this->pok29));
        if($this->pok30 == '0000-00-00' || $this->pok30 == '') $this->pok30='';
        else $this->pok30=date('d.m.Y', strtotime($this->pok30));
        if($this->pok36 == '0000-00-00' || $this->pok36 == '') $this->pok36='';
        else $this->pok36=date('d.m.Y', strtotime($this->pok36));        

        if($this->red == '0000-00-00 00:00:00' || $this->red == '') $this->red ='';
        else $this->red=date('d.m.Y H:i', strtotime($this->red));
        return TRUE;
    }    
}

