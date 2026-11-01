<?php

/**
 * This is the model class for table "zpmp_school_2022".
 *
 * The followings are the available columns in table 'zpmp_school_2022':
 * @property string $id_zpmp
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
 * @property string $pok14
 * @property string $pok15
 */
class Zpmp_school_2022 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'zpmp_school_2022';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4, pok8, pok9, pok10, pok14', 'required'),
            array('pok1, pok2', 'match', 'pattern'=>'/^[а-яА-ЯёЁ\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и тире'),
            array('pok3', 'match', 'pattern'=>'/^[а-яА-ЯёЁ]*$/u', 'message'=>'В отчестве можно использовать только буквы кириллицы'),
            array('pok4, pok12', 'date', 'format' => 'dd.MM.yyyy'),
            array('pok5', 'in','range'=>range(1,37)),
            array('pok6', 'in','range'=>range(1,10)),
            array('pok7, pok9', 'match', 'pattern'=>'/^[а-яА-Я0-9\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры и тире'),
            array('pok8', 'in','range'=>range(1,22)),
            array('pok10, pok11', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9\.\-\—\–\s\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку и пробел'),
            array('pok6', 'check_pok6'),
            array('pok7', 'check_pok7'),            
            array('pok1, pok2, pok3, pok7, pok9, pok10, pok11', 'length', 'max'=>255),
            array('pok14', 'in','range'=>range(1,3)),
            array('pok17', 'in','range'=>range(0,1)),
            //array('pok18', 'in','range'=>range(1,99)),
            array('pok18', 'numerical', 'integerOnly'=>true),
            array('pok19', 'match', 'pattern'=>'/^[а-яА-Я\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры и тире'),
            array('pok17', 'check_pok17'),
            array('pok5', 'check_pok5'),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_zpmp, id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15', 'safe', 'on'=>'search'),
        );
    }
    
    public function check_pok6($attribute,$params)
    {
        if($this->pok5 > 10 && !$this->pok6) $this->addError('pok6', 'Необходимо заполнить поле «Тип населенного пункта».');
        if($this->pok17 && !$this->pok6) $this->addError('pok6', 'Необходимо заполнить поле «Тип населенного пункта».');
    } 
    
    public function check_pok7($attribute,$params)
    {
        if($this->pok5 > 10 && !$this->pok7) $this->addError('pok7', 'Необходимо заполнить поле «Населенный пункт».');
        if($this->pok17 && !$this->pok7) $this->addError('pok7', 'Необходимо заполнить поле «Населенный пункт».');
    }

    public function check_pok17($attribute,$params)
    {
        if($this->pok17) {
            if(!$this->pok18) $this->addError('pok18', 'Необходимо выбрать регион РФ.');
            if(!$this->pok19) $this->addError('pok19', 'Необходимо указать муниципалитет региона РФ.');
            if($this->pok18 == 63) $this->addError('pok18', 'Для Самарской области выберите муниципалитет в другом поле');
        }    
    }
    
    public function check_pok5($attribute,$params)
    {
        if(!$this->pok5 && !$this->pok17) {
            $this->addError('pok5', 'Необходимо указать муниципалитет');
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
            'report'=>array(self::BELONGS_TO, 'Report', 'id_report'),
            'mun'=>array(self::BELONGS_TO, 'Mun', 'pok5'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id_zpmp' => 'Id Zpmp',
            'id_report' => 'Id Report',
            'pok1' => 'Фамилия',
            'pok2' => 'Имя',
            'pok3' => 'Отчество',
            'pok4' => 'Дата рождения',
            'pok5' => 'Муниципалитет (адреса регистрации)',
            'pok6' => 'Тип населенного пункта',
            'pok7' => 'Населенный пункт',
            'pok8' => 'Тип улицы',
            'pok9' => 'Улица',
            'pok10' => 'Дом',
            'pok11' => 'Квартира',
            'pok12' => 'Дата начала действия льготы',
            'pok13' => 'Дата запроса',
            'pok14' => 'Тип',
            'pok15' => 'Результат проверки',
            'pok16' => 'Дата проверки',
            'pok17' => 'Муниципалитет другого региона РФ',
            'pok18' => 'Регион РФ',
            'pok19' => 'Миниципалитет региона РФ',            
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

        $criteria->compare('id_zpmp',$this->id_zpmp,true);
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
        $criteria->compare('pok14',$this->pok14,true);
        $criteria->compare('pok15',$this->pok15,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Zpmp_school_2022 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    { 
        if($this->pok4 != '') $this->pok4 = date('Y-m-d', strtotime($this->pok4));
        if($this->pok12 != '') $this->pok12 = date('Y-m-d', strtotime($this->pok12));
        $this->pok13 = date('Y-m-d H:i:s', time());        

        return TRUE;
    }

    protected function afterFind()
    { 
        if($this->pok4 == '0000-00-00' || $this->pok4 == '') $this->pok4 = '';
        else $this->pok4 = date('d.m.Y', strtotime($this->pok4));
        if($this->pok12 == '0000-00-00' || $this->pok12 == '') $this->pok12 = '';
        else $this->pok12 = date('d.m.Y', strtotime($this->pok12));
        if($this->pok13 == '0000-00-00 00:00:00' || $this->pok13 == '') $this->pok13 = '';
        else $this->pok13 = date('d.m.Y H:i:s', strtotime($this->pok13));
        if($this->pok16 == '0000-00-00 00:00:00' || $this->pok16 == '') $this->pok16 = '';
        else $this->pok16 = date('d.m.Y H:i:s', strtotime($this->pok16));         

        return TRUE;
    }

    public function get_addr() {
        if($this->pok17) {
            $gorod = Region::model()->findByPk($this->pok18)->naim_region.', '.$this->pok19.', '.Contact_gor::model()->findByPk($this->pok6)->naim_gor.' '.$this->pok7;
        }
        else {        
            if($this->pok5 < 11) $gorod = Mun::model()->findByPk($this->pok5)->naim_mun;
            else $gorod = Mun::model()->findByPk($this->pok5)->naim_mun.', '.Contact_gor::model()->findByPk($this->pok6)->naim_gor.' '.$this->pok7;
        }    
        if($this->pok8 == 22) $ul = $this->pok9;
        else $ul = Contact_ul::model()->findByPk($this->pok8)->naim_ul.' '.$this->pok9;
        if(!$this->pok11) $kv = '';
        else $kv = ', кв.'.$this->pok11;
        return $gorod.', '.$ul.', д.'.$this->pok10.$kv;        
    }
    
    public function get_region() {
        if(!$this->pok17) {
            return 'Самарская область, ';
        }
        else {
            return '';
        }        
    }
    
    public function get_pok15() {
        if($this->pok15 == 1) return 'не подтверждено';
        elseif($this->pok15 == 2) return 'подтверждено';
        else return '';
    }       
}

