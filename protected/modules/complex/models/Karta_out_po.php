<?php

/**
 * This is the model class for table "karta_out_po".
 *
 * The followings are the available columns in table 'karta_out_po':
 * @property string $id_po_out
 * @property string $id_report
 * @property string $id_po
 * @property string $year1
 * @property string $year2
 * @property string $year3
 * @property string $year4
 */
class Karta_out_po extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'karta_out_po';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_po', 'required'),
            array('id_report', 'length', 'max'=>10),
            array('year1, year2, year3, year4', 'length', 'max'=>6),
            array('year1, year2, year3, year4', 'numerical', 'integerOnly'=>true),
            //array('id_po', 'length', 'is'=>9),            
            array('id_po', 'po_prov'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_po_out, id_report, id_po, year1, year2, year3, year4', 'safe', 'on'=>'search'),
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
            'id_po_out' => 'Id Po Out',
            'id_report' => 'Id Report',
            'id_po' => 'Код профессии/специальности',
            'year1' => 'Year1',
            'year2' => 'Year2',
            'year3' => 'Year3',
            'year4' => 'Year4',
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

        $criteria->compare('id_po_out',$this->id_po_out,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_po',$this->id_po,true);
        $criteria->compare('year1',$this->year1,true);
        $criteria->compare('year2',$this->year2,true);
        $criteria->compare('year3',$this->year3,true);
        $criteria->compare('year4',$this->year4,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Karta_out_po the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function po_prov($attribute) {
        $prof = Po_new::model()->findByPk($this->id_po);
        if(!$prof) {$this->addError('id_po','Неверный код профессии/специальности.');}
    }      
}

