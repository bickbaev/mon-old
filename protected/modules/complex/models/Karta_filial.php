<?php

/**
 * This is the model class for table "karta_filial".
 *
 * The followings are the available columns in table 'karta_filial':
 * @property string $id_fil
 * @property string $id_report
 * @property string $id_mun
 * @property string $address
 */
class Karta_filial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Karta_filial the static model class
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
		return 'karta_filial';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_report, id_mun, address', 'required'),
                        array('id_fil, id_report, id_mun', 'numerical', 'integerOnly'=>true),                    
			array('id_fil, id_report', 'length', 'max'=>10),
			array('id_mun', 'length', 'max'=>3),
			array('address', 'length', 'max'=>255),
                        array('address','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_fil, id_report, id_mun, address', 'safe', 'on'=>'search'),
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
			'id_fil' => 'Id Fil',
			'id_report' => 'Id Report',
			'id_mun' => 'Муниципалитет',
			'address' => 'Почтовый адрес филиала',
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

		$criteria->compare('id_fil',$this->id_fil,true);
		$criteria->compare('id_report',$this->id_report,true);
		$criteria->compare('id_mun',$this->id_mun,true);
		$criteria->compare('address',$this->address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}