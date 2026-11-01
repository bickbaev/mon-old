<?php

/**
 * This is the model class for table "mnk19".
 *
 * The followings are the available columns in table 'mnk19':
 * @property string $id_mnk
 * @property string $id_report
 * @property string $nazv
 * @property string $plan
 * @property string $fact
 * @property string $praz
 * @property string $mesto
 * @property string $addr
 */
class Mnk19 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mnk19';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, nazv, plan, praz, mesto, addr', 'required'),
            array('id_report', 'length', 'max'=>10),
            array('plan, fact', 'length', 'max'=>5),
            array('plan, fact', 'numerical', 'integerOnly'=>true),
            array('mesto', 'length', 'max'=>255),
            array('praz', 'type', 'type'=>'datetime', 'datetimeFormat'=>'dd.MM.yyyy hh:mm'),
            array('nazv, addr', 'length', 'max'=>1024),
            array('mesto, addr, nazv', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\!\(\)\-\—\–\r\n\s\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, дефис, точку, запятую, восклицательный знак, знак номера, кавычки вида " и скобки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
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
            'id_met' => 'Id Met',
            'id_report' => 'Id Report',
            'nazv' => 'Наименование мероприятия',
            'plan' => 'Планируемое число участников, чел. (заполняется до 27 декабря 2019 года)',
            'fact' => 'Фактическое число участников, чел. (заполняется до 9 января 2020 года)',
            'praz' => 'Дата и время проведения мероприятия',
            'mesto' => 'Название организации/структурного подразделения, в котором будет проходить мероприятие',
            'addr' => 'Адрес места проведения (в формате населенный пункт, улица, дом)',
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

        $criteria->compare('id_met',$this->id_met,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_type',$this->id_type,true);
        $criteria->compare('naim',$this->naim,true);
        $criteria->compare('spec',$this->spec,true);
        $criteria->compare('hud',$this->hud,true);
        $criteria->compare('colvo',$this->colvo,true);
        $criteria->compare('d_prov',$this->d_prov,true);
        $criteria->compare('mesto',$this->mesto,true);
        $criteria->compare('otv',$this->otv,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Am_met20 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    { 
        if($this->praz != '') $this->praz=date('Y-m-d H:i', strtotime($this->praz));              
        return TRUE;
    }
    
    protected function afterFind()
    { 
        if($this->praz == '0000-00-00 00:00:00' || $this->praz == '') $this->praz='';
        else $this->praz=date('d.m.Y H:i', strtotime($this->praz)); 
        return TRUE;
    }     
}



