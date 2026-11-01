<?php

/**
 * This is the model class for table "mpit511".
 *
 * The followings are the available columns in table 'mpit511':
 * @property string $id_report
 * @property string $site2
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
 * @property string $p_date
 */
class Mpit511 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mpit511';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('site2', 'length', 'max'=>255),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33', 'in','range'=>array(0,1)),
            array('pok4', 'pok4_prov'),
            array('pok26', 'pok26_prov'),
            array('pok19', 'pok19_prov'),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, p_date', 'safe', 'on'=>'search'),
        );
    }
    
    public function pok4_prov ($attribute,$params)
    {            
        if($this->pok4 && ($this->pok3 || $this->pok2)) $this->addError('pok4','Необходимо выбрать один вариант, кем подписано меню');
    }
    
    public function pok26_prov ($attribute,$params)
    {            
        if($this->pok26 && ($this->pok25 || $this->pok24)) $this->addError('pok26','Необходимо выбрать один вариант, кем подписано меню');
    }

    public function pok19_prov ($attribute,$params)
    {            
        if(!$this->pok19 && ($this->pok20 || $this->pok21 || $this->pok22 || $this->pok23)) $this->addError('pok19','Вы указали, что меню не опубликовано');
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
            'site2' => 'Site2',
            'pok1' => 'Указан актуальный сезон организации питания  (весенне-летний период / осенне-зимний период)',
            'pok2' => 'Согласовано с директором ОУ',
            'pok3' => 'Утверждено руководителем организации питания',
            'pok4' => 'Утверждено директором ОУ',
            'pok5' => 'Территориальным отделом Роспотребнадзора',
            'pok6' => 'Родительским комитетом',
            'pok7' => 'Неделя (1-ая, 2-ая)',
            'pok8' => 'Дни (1-5 или 1-6 в зависимости от режима работы школы)',
            'pok9' => 'Прием пищи (завтрак, обед)',
            'pok10' => 'Наименование блюд',
            'pok11' => 'Вес блюд',
            'pok12' => 'Информация о пищевых веществах (белки, жиры, углеводы)',
            'pok13' => 'Информациия об энергетической ценности блюд',
            'pok14' => 'Номер рецептур блюд',
            'pok15' => 'Наличие суммарного объема блюд по приемам пищи (итого за завтрак, итого за обед)',
            'pok16' => 'Информация о витаминном составе',
            'pok17' => 'завтрак (12 лет и старше - 550 гр.)',
            'pok18' => 'обед (12 лет и старше - 800 гр.)',
            'pok19' => 'Меню опубликовано',
            'pok20' => 'Наименование приема пищи (завтрак, обед)',
            'pok21' => 'Наименование блюда',
            'pok22' => 'Масса порции',
            'pok23' => 'Калорийность порции',
            'pok24' => 'Согласовано с директором ОУ',
            'pok25' => 'Утверждено руководителем орагнизации питания',
            'pok26' => 'Утверждено директором ОУ',
            'pok27' => 'Ежедневное меню соответствует двухнедельному основному (организованному) меню приготавливаемых блюд',
            'pok28' => 'График приема пищи',
            'pok29' => 'Наличие документов, регламентирующих организацию питания',
            'pok30' => 'Наличие рекомендаций по организации здорового питания детей',
            'pok31' => 'Наличие информации о мероприятиях, проводмых для учащихся в целях формирования у них культуры питания ',
            'pok32' => 'Наличие информации об организаторе питания (ОУ или КШП), контакты ответственных (ФИО, тел.)',
            'pok33' => 'Наличие информации о Горячей линии по вопросам питания',
            'p_date' => 'P Date',
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
        $criteria->compare('site2',$this->site2,true);
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
        $criteria->compare('p_date',$this->p_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Mpit511 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

