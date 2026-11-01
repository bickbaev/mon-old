<?php

/**
 * This is the model class for table "karta_npo".
 *
 * The followings are the available columns in table 'karta_npo':
 * @property string $id_npo_prof
 * @property string $id_report
 * @property string $id_npo
 * @property integer $npo_prog
 * @property integer $npo_forma
 * @property integer $npo_oplata
 * @property integer $srok
 * @property string $nachalo
 * @property string $zdorov
 * @property integer $obsh
 * @property string $address
 * @property integer $kurs
 * @property string $link
 */
class Karta_npo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Karta_npo the static model class
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
		return 'karta_npo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_report, id_npo, npo_prog, npo_forma, npo_oplata, srok, nachalo', 'required'),
                        array('srok', 'numerical'),
			array('id_npo_prof, id_report, npo_prog, npo_forma, npo_oplata, obsh, kurs', 'numerical', 'integerOnly'=>true),
			array('id_npo_prof, id_report', 'length', 'max'=>10),
			array('id_npo', 'length', 'is'=>9),
			array('zdorov, address, link', 'length', 'max'=>255),
			array('nachalo', 'type', 'type'=>'date', 'dateFormat'=>'dd.MM.yyyy'),
                        array('link', 'url'),
                        array('obsh', 'obsh_val'),
                        array('id_npo, zdorov, address, link','filter','filter'=>array($obj=new CHtmlPurifier(),'purify')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_npo_prof, id_report, id_npo, npo_prog, npo_forma, npo_oplata, srok, nachalo, zdorov, obsh, address, kurs, link', 'safe', 'on'=>'search'),
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
			'id_npo_prof' => 'Id Npo Prof',
			'id_report' => 'Id Report',
			'id_npo' => 'Код профессии НПО',
			'npo_prog' => 'Программа обучения',
			'npo_forma' => 'Форма обучения',
			'npo_oplata' => 'Оплата за обучение',
			'srok' => 'Срок обучения в месяцах (например, 18,5)',
			'nachalo' => 'Дата начала обучения',
			'zdorov' => 'Ограничения по здоровью (группы здоровья)',
			'obsh' => 'Наличие общежития',
			'address' => 'Адрес общежития',
			'kurs' => 'Наличие подготовительных курсов',
			'link' => 'Ссылка на страницу сайта учреждения с более подробной информацией о профессии',
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

		$criteria->compare('id_npo_prof',$this->id_npo_prof,true);
		$criteria->compare('id_report',$this->id_report,true);
		$criteria->compare('id_npo',$this->id_npo,true);
		$criteria->compare('npo_prog',$this->npo_prog);
		$criteria->compare('npo_forma',$this->npo_forma);
		$criteria->compare('npo_oplata',$this->npo_oplata);
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