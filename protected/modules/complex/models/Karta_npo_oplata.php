<?php

/**
 * This is the model class for table "karta_npo_oplata".
 *
 * The followings are the available columns in table 'karta_npo_oplata':
 * @property string $npo_oplata
 * @property string $npo_prog_naim
 */
class Karta_npo_oplata extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Karta_npo_oplata the static model class
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
		return 'karta_npo_oplata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('npo_oplata', 'required'),
			array('npo_oplata', 'length', 'max'=>3),
			array('npo_prog_naim', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('npo_oplata, npo_prog_naim', 'safe', 'on'=>'search'),
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
			'npo_oplata' => 'Npo Oplata',
			'npo_prog_naim' => 'Npo Prog Naim',
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

		$criteria->compare('npo_oplata',$this->npo_oplata,true);
		$criteria->compare('npo_prog_naim',$this->npo_prog_naim,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}