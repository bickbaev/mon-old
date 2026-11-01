<?php

/**
 * This is the model class for table "us19_res".
 *
 * The followings are the available columns in table 'us19_res':
 * @property string $id_usluga
 * @property string $id_report
 * @property string $id_pok
 * @property double $col1
 * @property double $col2
 * @property double $col3
 * @property double $col4
 * @property double $col5
 * @property double $col6
 */
class Us19_res extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'us19_res';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_pok, col1, col2, col3, col4, col5, col6', 'required'),
            array('col1, col2, col3, col4, col5, col6', 'numerical'),
            array('id_report, id_pok', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>10),
            array('id_pok', 'length', 'max'=>9),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_usluga, id_report, id_pok, col1, col2, col3, col4, col5, col6', 'safe', 'on'=>'search'),
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
            'col1' => 'Col1',
            'col2' => 'Col2',
            'col3' => 'Col3',
            'col4' => 'Col4',
            'col5' => 'Col5',
            'col6' => 'Col6',
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
        $criteria->compare('col1',$this->col1);
        $criteria->compare('col2',$this->col2);
        $criteria->compare('col3',$this->col3);
        $criteria->compare('col4',$this->col4);
        $criteria->compare('col5',$this->col5);
        $criteria->compare('col6',$this->col6);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Us19_res the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
