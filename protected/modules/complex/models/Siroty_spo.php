<?php

/**
 * This is the model class for table "siroty_spo".
 *
 * The followings are the available columns in table 'siroty_spo':
 * @property string $id_spo_sir
 * @property string $id_report
 * @property string $sir_num
 * @property string $id_spo
 * @property integer $id_zan
 * @property string $mesto
 * @property string $id_nez
 * @property string $nez
 * @property string $cnz
 */
class Siroty_spo extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Siroty_spo the static model class
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
        return 'siroty_spo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, sir_num, id_spo, id_zan', 'required'),
            array('id_zan, id_nez, cnz', 'numerical', 'integerOnly'=>true),
            array('id_report, sir_num', 'length', 'max'=>10),
            array('id_spo', 'length', 'is'=>6),
            array('mesto, nez', 'length', 'max'=>255),
            array('id_spo', 'check_spo'),            
            array('id_nez', 'length', 'max'=>3),
            array('cnz', 'length', 'max'=>1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_spo_sir, id_report, sir_num, id_spo, id_zan, mesto, id_nez, nez, cnz', 'safe', 'on'=>'search'),
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
            'id_spo_sir' => 'Id Spo Sir',
            'sir_num' => '№ учащегося',
            'id_report' => 'Id Report',            
            'id_spo' => 'Код специальности СПО',
            'id_zan' => 'Вид занятости',
            'mesto' => 'Место занятости (наименование предприятия или образовательного учреждения)',
            'id_nez' => 'Причина незанятости',
            'nez' => 'Дополнительная информация о причине незанятости',
            'cnz' => 'Поставлен на учёт в ЦЗН',
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

        $criteria->compare('id_spo_sir',$this->id_spo_sir,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('sir_num',$this->sir_num,true);
        $criteria->compare('id_spo',$this->id_spo,true);
        $criteria->compare('id_zan',$this->id_zan);
        $criteria->compare('mesto',$this->mesto,true);
        $criteria->compare('id_nez',$this->id_nez,true);
        $criteria->compare('nez',$this->nez,true);
        $criteria->compare('cnz',$this->cnz,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function check_spo($attribute) {
        
        if(!Spo::model()->exists('id_spo=:id_spo',array(':id_spo'=>$this->id_spo))) $this->addError($attribute, 'Неверный код специальности СПО');
    }    
}