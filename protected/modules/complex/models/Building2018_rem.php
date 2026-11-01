<?php

/**
 * This is the model class for table "building2018_rem".
 *
 * The followings are the available columns in table 'building2018_rem':
 * @property string $id_rem
 * @property string $id_report
 * @property string $id_building
 * @property integer $cap
 * @property string $vid
 * @property integer $price
 * @property integer $god
 */
class Building2018_rem extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'building2018_rem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_building, price', 'required'),
            array('cap, price, god', 'numerical', 'integerOnly'=>true),
            array('id_report, id_building', 'length', 'max'=>10),
            array('price', 'length', 'max'=>9),
            array('god', 'in','range'=>range(2012, 2050)),
            array('cap', 'in','range'=>array(0, 1)),
            array('vid', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_rem, id_report, id_building, cap, vid, price, god', 'safe', 'on'=>'search'),
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
            'id_rem' => 'Id Rem',
            'id_report' => 'Id Report',
            'id_building' => 'Id Building',
            'cap' => 'Капитальный ремонт',
            'vid' => 'Вид работ',
            'price' => 'Стоимость работ, руб',
            'god' => 'Год проведения',
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

        $criteria->compare('id_rem',$this->id_rem,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_building',$this->id_building,true);
        $criteria->compare('cap',$this->cap);
        $criteria->compare('vid',$this->vid,true);
        $criteria->compare('price',$this->price);
        $criteria->compare('god',$this->god);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Building2018_rem the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
