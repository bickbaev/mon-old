<?php

/**
 * This is the model class for table "siroty_zan".
 *
 * The followings are the available columns in table 'siroty_zan':
 * @property string $id_zan
 * @property string $naim_zan
 */
class Siroty_zan extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Siroty_zan the static model class
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
        return 'siroty_zan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('naim_zan', 'required'),
            array('naim_zan', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_zan, naim_zan', 'safe', 'on'=>'search'),
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
            'id_zan' => 'Id Zan',
            'naim_zan' => 'Naim Zan',
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

        $criteria->compare('id_zan',$this->id_zan,true);
        $criteria->compare('naim_zan',$this->naim_zan,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 