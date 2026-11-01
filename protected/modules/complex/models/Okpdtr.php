<?php

/**
 * This is the model class for table "okpdtr".
 *
 * The followings are the available columns in table 'okpdtr':
 * @property string $id_okpdtr
 * @property string $okpdtr_naim
 */
class Okpdtr extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Okpdtr the static model class
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
        return 'okpdtr';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('okpdtr_naim', 'required'),
            array('okpdtr_naim', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_okpdtr, okpdtr_naim', 'safe', 'on'=>'search'),
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
            'id_okpdtr' => 'Id Okpdtr',
            'okpdtr_naim' => 'Okpdtr Naim',
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

        $criteria->compare('id_okpdtr',$this->id_okpdtr,true);
        $criteria->compare('okpdtr_naim',$this->okpdtr_naim,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 