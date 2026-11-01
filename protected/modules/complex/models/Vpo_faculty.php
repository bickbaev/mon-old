<?php

/**
 * This is the model class for table "vpo_faculty".
 *
 * The followings are the available columns in table 'vpo_faculty':
 * @property string $id_faculty
 * @property string $naim_faculty
 * @property string $id_report
 * @property string $link
 */
class Vpo_faculty extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'vpo_faculty';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, naim_faculty', 'required'),
            array('id_faculty, id_report', 'numerical', 'integerOnly'=>true),
            array('naim_faculty, link', 'length', 'max'=>255),
            array('naim_faculty', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            array('id_report', 'length', 'max'=>10),
            array('link', 'url'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_faculty, naim_faculty, id_report, link', 'safe', 'on'=>'search'),
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
            'id_faculty' => 'Id Faculty',
            'naim_faculty' => 'Название факультета/института',
            'id_report' => 'Id Report',
            'link' => 'Ссылка на страницу сайта с более подробной информацией об институте/филиале',
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

        $criteria->compare('id_faculty',$this->id_faculty,true);
        $criteria->compare('naim_faculty',$this->naim_faculty,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('link',$this->link,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vpo_faculty the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
