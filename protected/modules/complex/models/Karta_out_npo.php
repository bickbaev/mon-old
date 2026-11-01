<?php

/**
 * This is the model class for table "karta_out_npo".
 *
 * The followings are the available columns in table 'karta_out_npo':
 * @property string $id_npo_out
 * @property string $id_report
 * @property string $id_npo
 * @property string $year1
 * @property string $year2
 * @property string $year3
 * @property string $year4
 */
class Karta_out_npo extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Karta_out_npo the static model class
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
        return 'karta_out_npo';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_npo', 'required'),
            array('id_report', 'length', 'max'=>10),
            array('id_npo', 'length', 'is'=>9),
            array('year1, year2, year3, year4', 'length', 'max'=>6),
            array('year1, year2, year3, year4', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_npo_out, id_report, id_npo, year1, year2, year3, year4', 'safe', 'on'=>'search'),
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
            'id_npo_out' => 'Id Npo Out',
            'id_report' => 'Id Report',
            'id_npo' => 'Код профессии НПО',
            'year1' => 'Year1',
            'year2' => 'Year2',
            'year3' => 'Year3',
            'year4' => 'Year4',
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

        $criteria->compare('id_npo_out',$this->id_npo_out,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_npo',$this->id_npo,true);
        $criteria->compare('year1',$this->year1,true);
        $criteria->compare('year2',$this->year2,true);
        $criteria->compare('year3',$this->year3,true);
        $criteria->compare('year4',$this->year4,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
} 