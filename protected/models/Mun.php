<?php

/**
 * This is the model class for table "mun".
 *
 * The followings are the available columns in table 'mun':
 * @property string $id_mun
 * @property string $naim_mun
 * @property string $type
 * @property string $sokr
 */
class Mun extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'mun';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sokr', 'required'),
            array('naim_mun, sokr', 'length', 'max'=>255),
            array('type', 'length', 'max'=>10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_mun, naim_mun, type, sokr', 'safe', 'on'=>'search'),
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
            'id_mun' => 'Id Mun',
            'naim_mun' => 'Naim Mun',
            'type' => 'Type',
            'sokr' => 'Sokr',
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

        $criteria->compare('id_mun',$this->id_mun,true);
        $criteria->compare('naim_mun',$this->naim_mun,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('sokr',$this->sokr,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Mun the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}