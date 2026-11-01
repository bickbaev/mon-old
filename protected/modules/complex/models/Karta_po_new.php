<?php

/**
 * This is the model class for table "karta_po_new".
 *
 * The followings are the available columns in table 'karta_po_new':
 * @property string $id_po_new
 * @property string $id_report
 * @property string $id_po
 * @property integer $po_prog
 * @property integer $po_forma
 * @property integer $po_oplata
 * @property integer $srok
 * @property string $nachalo
 * @property string $zdorov
 * @property integer $obsh
 * @property string $address
 * @property integer $kurs
 * @property string $link
 */
class Karta_po_new extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'karta_po_new';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_po, po_prog, po_forma, po_oplata, srok, nachalo', 'required'),
            array('srok', 'numerical'),
            array('id_report, po_prog, po_forma, po_oplata, obsh, kurs', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>10),
            //array('id_po', 'length', 'is'=>9),
            array('zdorov, address, link', 'length', 'max'=>255),
            array('nachalo', 'type', 'type'=>'date', 'dateFormat'=>'dd.MM.yyyy'),
            array('link', 'url'),
            array('obsh', 'obsh_val'),
            array('id_po', 'po_prov'),
            array('id_po, zdorov, address, link','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),  
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_po_new, id_report, id_po, po_prog, po_forma, po_oplata, srok, nachalo, zdorov, obsh, address, kurs, link', 'safe', 'on'=>'search'),
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
            'id_po_new' => 'Id Po New',
            'id_report' => 'Id Report',
            'id_po' => 'Код проф./специальности',
            'po_prog' => 'Программа обучения',
            'po_forma' => 'Форма обучения',
            'po_oplata' => 'Оплата за обучение',
            'srok' => 'Срок обучения в месяцах (например, 18,5)',
            'nachalo' => 'Дата начала обучения',
            'zdorov' => 'Ограничения по здоровью (группы здоровья)',
            'obsh' => 'Наличие общежития',
            'address' => 'Адрес общежития',
            'kurs' => 'Наличие подготовительных курсов',
            'link' => 'Ссылка на страницу сайта учреждения с более подробной информацией о профессии/специальности',
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

        $criteria->compare('id_po_new',$this->id_po_new,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_po',$this->id_po,true);
        $criteria->compare('po_prog',$this->po_prog);
        $criteria->compare('po_forma',$this->po_forma);
        $criteria->compare('po_oplata',$this->po_oplata);
        $criteria->compare('srok',$this->srok);
        $criteria->compare('nachalo',$this->nachalo,true);
        $criteria->compare('zdorov',$this->zdorov,true);
        $criteria->compare('obsh',$this->obsh);
        $criteria->compare('address',$this->address,true);
        $criteria->compare('kurs',$this->kurs);
        $criteria->compare('link',$this->link,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Karta_po_new the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function obsh_val($attribute) {
        if($this->obsh && $this->address == '') {$this->addError('address','Необходимо указать адрес общежития.');}
    }
    
    public function po_prov($attribute) {
        $prof = Po_new::model()->findByPk($this->id_po);
        if(!$prof) {$this->addError('id_po','Неверный код профессии/специальности.');}
    }    


    protected function beforeSave()
    { 
        if($this->nachalo != '') $this->nachalo=date('Y-m-d', strtotime($this->nachalo));
        return TRUE;
    }

    protected function afterFind()
    { 
        if($this->nachalo == '0000-00-00' || $this->nachalo == '') $this->nachalo='';
        else $this->nachalo=date('d.m.Y', strtotime($this->nachalo));
        return TRUE;
    }     
}

