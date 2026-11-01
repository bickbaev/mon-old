<?php

/**
 * This is the model class for table "karta_spo".
 *
 * The followings are the available columns in table 'karta_spo':
 * @property string $id_spo_prof
 * @property string $id_report
 * @property string $id_spo
 * @property integer $spo_prog
 * @property integer $spo_forma
 * @property integer $spo_oplata
 * @property integer $srok
 * @property string $nachalo
 * @property string $zdorov
 * @property integer $obsh
 * @property string $address
 * @property integer $kurs
 * @property string $link
 */
class Karta_spo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Karta_spo the static model class
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
		return 'karta_spo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    
			array('id_report, id_spo, spo_prog, spo_forma, spo_oplata, srok, nachalo', 'required'),
                        array('srok', 'numerical'),
			array('id_spo_prof, id_report, spo_prog, spo_forma, spo_oplata, obsh, kurs', 'numerical', 'integerOnly'=>true),
			array('id_spo_prof, id_report', 'length', 'max'=>10),
			array('id_spo', 'length', 'is'=>6),
			array('zdorov, address, link', 'length', 'max'=>255),
			array('nachalo', 'type', 'type'=>'date', 'dateFormat'=>'dd.MM.yyyy'),
                        array('link', 'url'),
                        array('obsh', 'obsh_val'),
                        array('id_spo, zdorov, address, link','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),                    

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_spo_prof, id_report, id_spo, spo_prog, spo_forma, spo_oplata, srok, nachalo, zdorov, obsh, address, kurs, link', 'safe', 'on'=>'search'),
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
			'id_spo_prof' => 'Id Spo Prof',
			'id_report' => 'Id Report',
			'id_spo' => 'Код специальности СПО',
			'spo_prog' => 'Программа обучения',
			'spo_forma' => 'Форма обучения',
			'spo_oplata' => 'Оплата за обучение',
			'srok' => 'Срок обучения в месяцах',
			'nachalo' => 'Дата начала обучения',
			'zdorov' => 'Ограничения по здоровью (группы здоровья)',
			'obsh' => 'Наличие общежития',
			'address' => 'Адрес общежития',
			'kurs' => 'Наличие подготовительных курсов',
			'link' => 'Ссылка на страницу сайта учреждения с более подробной информацией',                    
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

		$criteria->compare('id_spo_prof',$this->id_spo_prof,true);
		$criteria->compare('id_report',$this->id_report,true);
		$criteria->compare('id_spo',$this->id_spo,true);
		$criteria->compare('spo_prog',$this->spo_prog);
		$criteria->compare('spo_forma',$this->spo_forma);
		$criteria->compare('spo_oplata',$this->spo_oplata);
		$criteria->compare('srok',$this->srok);
		$criteria->compare('nachalo',$this->nachalo,true);
		$criteria->compare('zdorov',$this->zdorov,true);
		$criteria->compare('obsh',$this->obsh);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('kurs',$this->kurs);
		$criteria->compare('link',$this->link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function obsh_val($attribute) {
            if($this->obsh && $this->address == '') {$this->addError('address','Необходимо указать адрес общежития.');}
        }


        protected function beforeSave()
        { 
            if($this->nachalo != '') $this->nachalo=date('Y-m-d', strtotime($this->nachalo));
            return TRUE;
        }
        
        protected function afterFind()
        { 
            if($this->nachalo == '0000-00-00' || $this->nachalo == '') $this->nachalo='';
            else $this->nachalo=date('d.m.Y', strtotime($this->nachalo));
            return TRUE;
        }        
}