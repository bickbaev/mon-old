<?php

/**
 * This is the model class for table "pr_rep_name".
 *
 * The followings are the available columns in table 'pr_rep_name':
 * @property string $id_rep_type
 * @property string $rep_name
 * @property string $rep_mv
 * @property string $s_date
 * @property string $f_date
 * @property integer $date_type
 * @property string $rep_type
 * @property integer $archive
 * @property string $cur
 * @property string $zakr
 */
class Pr_rep_name extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'pr_rep_name';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('rep_name, rep_mv, s_date, f_date, date_type', 'required'),
            array('date_type, archive', 'numerical', 'integerOnly'=>true),
            array('rep_name, rep_mv', 'length', 'max'=>255),
            array('rep_type, cur, zakr', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_rep_type, rep_name, rep_mv, s_date, f_date, date_type, rep_type, archive, cur, zakr', 'safe', 'on'=>'search'),
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
            'id_rep_type' => 'Id Rep Type',
            'rep_name' => 'Rep Name',
            'rep_mv' => 'Rep Mv',
            's_date' => 'S Date',
            'f_date' => 'F Date',
            'date_type' => 'Date Type',
            'rep_type' => 'Rep Type',
            'archive' => 'Archive',
            'cur' => 'Cur',
            'zakr' => 'Zakr',
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

        $criteria->compare('id_rep_type',$this->id_rep_type,true);
        $criteria->compare('rep_name',$this->rep_name,true);
        $criteria->compare('rep_mv',$this->rep_mv,true);
        $criteria->compare('s_date',$this->s_date,true);
        $criteria->compare('f_date',$this->f_date,true);
        $criteria->compare('date_type',$this->date_type);
        $criteria->compare('rep_type',$this->rep_type,true);
        $criteria->compare('archive',$this->archive);
        $criteria->compare('cur',$this->cur,true);
        $criteria->compare('zakr',$this->zakr,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pr_rep_name the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
