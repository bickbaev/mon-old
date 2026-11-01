<?php

/**
 * This is the model class for table "site2013".
 *
 * The followings are the available columns in table 'site2013':
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
 * @property string $p_date
 * @property string $remark
 */
class Site2013 extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Site2013 the static model class
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
        return 'site2013';
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
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27', 'length', 'max'=>1),
            array('p_date, remark', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, p_date, remark', 'safe', 'on'=>'search'),
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
            'site2' => 'Адрес сайта',
            'pok1' => 'Филиал',            
            'pok2' => '1.1 о дате создания образовательной организации, об учредителе, учредителях образовательной организации, о месте нахождения образовательной организации, режиме, графике работы, контактных телефонах и об адресах электронной почты',
            'pok3' => '1.2 наименование структурных подразделений (органов управления)',
            'pok4' => '1.3 об описании образовательной программы с приложением ее копии',
            'pok5' => '1.4 об учебном плане с приложением его копии',
            'pok6' => '1.5 о календарном учебном графике с приложением его копии',
            'pok7' => '1.6 о методических и об иных документах',
            'pok8' => '1.7 о реализуемых образовательных программах с указанием учебных предметов',
            'pok9' => '1.8 о ФГОС и об образовательных стандартах',
            'pok10' => '1.9 о руководителе образовательной организации, его заместителях',
            'pok11' => '1.10 о персональном составе педагогических работников',
            'pok12' => '1.11 о материально-техническом обеспечении образовательной деятельности',
            'pok13' => '1.12 об условиях питания и охраны здоровья обучающихся',
            'pok14' => '1.13 о доступе к информационным системам и ИКТ',
            'pok15' => '1.14 об электронных образовательных ресурсах',
            'pok16' => '1.15 о наличии мер социальной поддержки',
            'pok17' => '1.16 госзадании',
            'pok18' => '1.17 о поступлении финансовых и материальных средств и об их расходовании по итогам финансового года',
            'pok19' => '2.1 устава образовательной организации',
            'pok20' => '2.2 лицензии',
            'pok21' => '2.3 свидетельства о государственной аккредитации',
            'pok22' => '2.4 плана финансово-хозяйственной деятельности образовательной организации',
            'pok23' => '2.5 локальных нормативных актов',
            'pok24' => '2.6 отчета о результатах самообследования', 
            'pok25' => '2.7 документа о порядке оказания платных образовательных услуг',
            'pok26' => '3.1 ссылка на официальный сайт МОиН РФ',
            'pok27' => 'Сайт не работает',             
            'p_date' => 'Дата проверки сайта',
            'remark' => 'Примечания по сайту',
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
        $criteria->compare('pok27',$this->pok26,true);        
        $criteria->compare('p_date',$this->p_date,true);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    protected function beforeSave()
    {
    $this->p_date=date('Y-m-d', time());
    return TRUE;
    }    
    
    protected function afterFind()
    {
    if($this->p_date == '0000-00-00' || $this->p_date == '') $this->p_date='';
    else $this->p_date=date('d.m.Y', strtotime($this->p_date));
    }       
}