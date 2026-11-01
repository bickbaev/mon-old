<?php

/**
 * This is the model class for table "usluga16_res".
 *
 * The followings are the available columns in table 'usluga16_res':
 * @property string $id_usluga
 * @property string $id_report
 * @property string $id_pok
 * @property double $col
 * @property double $col2
 */
class Usluga16_res extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'usluga16_res';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_pok, col, col2', 'required'),
            array('col, col2', 'numerical'),
            array('id_report, id_pok', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>10),
            array('id_pok', 'length', 'max'=>9),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_usluga, id_report, id_pok, col, col2', 'safe', 'on'=>'search'),
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
            'id_usluga' => 'Id Usluga',
            'id_report' => 'Id Report',
            'id_pok' => 'Id Pok',
            'col' => 'Объем услуги на 01.01.17',
            'col2' => 'Объем услуги на 01.09.17',
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

        $criteria->compare('id_usluga',$this->id_usluga,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_pok',$this->id_pok,true);
        $criteria->compare('col',$this->col);
        $criteria->compare('col2',$this->col2);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Usluga16_res the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}

