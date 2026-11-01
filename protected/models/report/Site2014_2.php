<?php

/**
 * This is the model class for table "site2014_2".
 *
 * The followings are the available columns in table 'site2014_2':
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
 * @property string $p_date
 * @property string $remark
 */
class Site2014_2 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'site2014_2';
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
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15', 'length', 'max'=>1),
            array('p_date, remark', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_report, site2, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, p_date, remark', 'safe', 'on'=>'search'),
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
            'pok1' => 'Cпециальный раздел «Сведения об образовательной организации» и надлежащее его оформление (пункты Приказа Рособрнадзора 2,4,5,6,7)',
            'pok2' => 'Подраздел «Основные сведения»',
            'pok3' => 'Подраздел «Структура и органы управления образовательной организацией»',
            'pok4' => 'Подраздел «Документы»',
            'pok5' => 'Подраздел «Образование»',
            'pok6' => 'Подраздел «Образовательные стандарты»',
            'pok7' => 'Подраздел «Руководство. Педагогический состав»',
            'pok8' => 'Подраздел «Материально-техническое обеспечение и оснащенность образовательного процесса»',
            'pok9' => 'Подраздел «Стипендии и иные виды материальной поддержки»',
            'pok10' => 'Подраздел «Платные образовательные услуги»',
            'pok11' => 'Подраздел «Финансово-хозяйственная деятельность»',
            'pok12' => 'Подраздел «Вакантные места для приёма (перевода)»',
            'pok13' => 'Ссылка на официальный сайт Министерства образования и науки Российской Федерации в сети «Интернет»',
            'pok14' => 'Сайт не работает',
            'pok15' => 'Филиал',
            'p_date' => 'Дата проверки сайта',
            'remark' => 'Примечания по сайту',
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
        $criteria->compare('p_date',$this->p_date,true);
        $criteria->compare('remark',$this->remark,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Site2014_2 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
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

