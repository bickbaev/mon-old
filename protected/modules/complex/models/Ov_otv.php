<?php

/**
 * This is the model class for table "ov_otv".
 *
 * The followings are the available columns in table 'ov_otv':
 * @property string $id_report
 * @property string $fio_otv
 * @property string $cod_tel
 * @property string $tel
 * @property string $mail
 */
class Ov_otv extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Ov_otv the static model class
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
        return 'ov_otv';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, fio_otv, cod_tel, tel', 'required'),
            array('id_report, cod_tel, tel', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>12),
            array('fio_otv, mail', 'length', 'max'=>255),
            array('cod_tel', 'length', 'is'=>3),
            array('tel', 'length', 'is'=>7),
            array('cod_tel, tel', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),            
            array('mail', 'email'),
            array('fio_otv','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_report, fio_otv, cod_tel, tel, mail', 'safe', 'on'=>'search'),
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
            'id_report' => 'Id Est',
            'fio_otv' => 'ФИО ответственного',
            'cod_tel' => 'Cod Tel',
            'tel' => 'Номер телефона ответственного',
            'mail' => 'e-mail ответственного',
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

        $criteria->compare('id_report',$this->id_est,true);
        $criteria->compare('fio_otv',$this->fio_otv,true);
        $criteria->compare('cod_tel',$this->cod_tel,true);
        $criteria->compare('tel',$this->tel,true);
        $criteria->compare('mail',$this->mail,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 
