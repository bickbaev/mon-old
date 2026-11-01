<?php

/**
 * This is the model class for table "bez24".
 *
 * The followings are the available columns in table 'bez24':
 * @property string $id
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
 */
class Bez24 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bez24';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10', 'required'),
            array('pok1, pok2', 'match', 'pattern'=>'/^[а-яА-ЯёЁ\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и тире'),
            array('pok3', 'match', 'pattern'=>'/^[а-яА-ЯёЁ]*$/u', 'message'=>'В отчестве можно использовать только буквы кириллицы'),
            array('pok4', 'date', 'format' => 'dd.MM.yyyy'),
            array('pok5', 'in','range'=>range(0,12)), 
            array('pok6, pok7, pok8', 'match', 'pattern'=>'/^[а-яА-ЯёЁ\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и тире'),
            array('pok9, pok11', 'match', 'pattern'=>'/^[а-яА-Я0-9\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры и тире'),
            array('pok10', 'in','range'=>range(1,37)),
            array('pok12, pok13, pok14, pok16, pok17, pok18, pok20, pok21, pok22, pok23, pok25', 'in','range'=>[0,1]),
            array('pok15, pok19, pok24', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9\.\-\—\–\s\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку и пробел'),
            array('id, id_report, pok5, pok10, pok12, pok13, pok14, pok16, pok17, pok18, pok20, pok21, pok22, pok23', 'length', 'max'=>10),
            array('pok1, pok2, pok3, pok6, pok7, pok8, pok9, pok11, pok15, pok19', 'length', 'max'=>255),
            array('pok10', 'check_pok10'),
            array('pok12', 'check_pok12'),
            array('pok12', 'check_pok12_2'),
            array('pok16', 'check_pok16'),
            array('pok16', 'check_pok16_2'),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24', 'safe', 'on'=>'search'),
        );
    }
    
    public function check_pok10($attribute,$params)
    {
        if($this->pok10 > 10 && !$this->pok11) $this->addError('pok11', 'Необходимо заполнить поле «Населенный пункт».');
    }

    public function check_pok12($attribute,$params)
    {
        if(!$this->pok12 && !$this->pok13 && !$this->pok14 && !$this->pok15) $this->addError('pok12', 'Необходимо выбрать условия прибывания учащегося в Самарской области.');
    }
    
    public function check_pok12_2($attribute,$params)
    {
        $sum = 0;
        for($k = 12; $k < 15; $k++) {
            $pok = 'pok'.$k;
            if($this->$pok) $sum = $sum + 1;
        }
        if($sum > 1) $this->addError('pok12', 'Необходимо выбрать одно условие прибывания учащегося в Самарской области.');
    } 
    
    public function check_pok16($attribute,$params)
    {
        if(!$this->pok16 && !$this->pok17 && !$this->pok18 && !$this->pok19) $this->addError('pok16', 'Необходимо выбрать условия прибывания учащегося в Самарской области.');
    }
    
    public function check_pok16_2($attribute,$params)
    {
        $sum = 0;
        for($k = 16; $k < 19; $k++) {
            $pok = 'pok'.$k;
            if($this->$pok) $sum = $sum + 1;
        }
        if($sum > 1) $this->addError('pok16', 'Необходимо выбрать одно условие прибывания учащегося в Самарской области.');
    }

    public function get_prob() {
        $res = '';
        if($this->pok20) $res = 'Учебники';
        if($this->pok21) $res = $res.'<br>Канцтовары';
        if($this->pok22) $res = $res.'<br>Школьная форма';
        if($this->pok23) $res = $res.'<br>Личное дело, документы';
        if($this->pok24) $res = $res.'<br>'.$this->pok24;
        return $res;
    }
    
    public function get_pers() {
        if($this->pok25) $vib = '<b>Выбыл из образовательной организации</b>';
        return "<b>".$this->pok1." ".$this->pok2." ".$this->pok3."</b><br>".$this->pok4."<br>".$this->pok5." параллель<br>".$vib;
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
            'pok1' => 'Фамилия',
            'pok2' => 'Имя',
            'pok3' => 'Отчество',
            'pok4' => 'Дата рождения',
            'pok5' => 'Паралллель, в которую зачислен учащийся',
            'pok6' => 'Страна',
            'pok7' => 'Регион',
            'pok8' => 'Муниципалитет',
            'pok9' => 'Населенный пункт',
            'pok10' => 'Муниципалитет',
            'pok11' => 'Населенный пункт',
            'pok12' => 'У родственников',
            'pok13' => 'Пункт временного размещения',
            'pok14' => 'Съемное жилье',
            'pok15' => 'Иное',
            'pok16' => 'Родители(ь)',
            'pok17' => 'Другие лица',
            'pok18' => 'По доверенности',
            'pok19' => 'Иное',
            'pok20' => 'Учебники (имеются проблемы с обеспечением учебниками и иными учебными материалами в полном объеме)',
            'pok21' => 'Канцтовары (имеются проблемы с обеспечением канцтоварами)',
            'pok22' => 'Школьная форма (имеются проблемы с обеспечением формой для обучения и спортивными занятиями)',
            'pok23' => 'Личное дело, документы (имеются проблемы с наличием необходимых документов)',
            'pok24' => 'Иное',
            'pok25' => 'Выбыл из образовательной организации',
            'create_date' => 'Время создания записи',
            'red' => 'Время последнего редактирования записи',
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

        $criteria->compare('id',$this->id,true);
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
        $criteria->compare('pok16',$this->pok16,true);
        $criteria->compare('pok17',$this->pok17,true);
        $criteria->compare('pok18',$this->pok18,true);
        $criteria->compare('pok19',$this->pok19,true);
        $criteria->compare('pok20',$this->pok20,true);
        $criteria->compare('pok21',$this->pok21,true);
        $criteria->compare('pok22',$this->pok22,true);
        $criteria->compare('pok23',$this->pok23,true);
        $criteria->compare('pok24',$this->pok24,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Bez24 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeSave()
    {
        if($this->isNewRecord) {
            $this->create_date = date('Y-m-d H:i:s');
        }
        else {
            $this->red = date('Y-m-d H:i:s');
        }       
        if($this->pok4 != '') $this->pok4 = date('Y-m-d', strtotime($this->pok4));       

        return true && parent::beforeSave();
    }

    protected function afterFind()
    { 
        if($this->pok4 == '0000-00-00' || $this->pok4 == '') $this->pok4 = '';
        else $this->pok4 = date('d.m.Y', strtotime($this->pok4));       
        /*if($this->create_date == '0000-00-00 00:00:00' || $this->create_date == '') $this->create_date = '';
        else $this->create_date = date('d.m.Y H:i:s', strtotime($this->create_date));*/
        if($this->red == '0000-00-00 00:00:00' || $this->red == '') $this->red = '';
        else $this->red = date('d.m.Y H:i:s', strtotime($this->red));        
        return TRUE;
    }    
}

