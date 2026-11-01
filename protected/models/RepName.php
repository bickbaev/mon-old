<?php

/**
 * This is the model class for table "rep_name".
 *
 * The followings are the available columns in table 'rep_name':
 * @property string $id_rep_type
 * @property string $rep_name
 * @property string $rep_mv
 * @property string $s_date
 * @property string $f_date
 * @property integer $date_type
 * @property integer $archive
 *
 * The followings are the available model relations:
 */
class RepName extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return RepName the static model class
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
		return 'rep_name';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_rep_type, rep_name, rep_mv, s_date, f_date, date_type', 'required'),
			array('date_type, archive', 'numerical', 'integerOnly'=>true),
			array('id_rep_type', 'length', 'max'=>5),
			array('rep_name, rep_mv', 'length', 'max'=>255),
                        array('dop', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_rep_type, rep_name, rep_mv, s_date, f_date, date_type, archive', 'safe', 'on'=>'search'),
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
			'rep_name' => 'Название отчета',
			'rep_mv' => 'Таблица',
			's_date' => 'Начальная дата',
			'f_date' => 'Конечная дата',
			'date_type' => 'Тип отчета',
			'archive' => 'Архивный',
                        'dop'=> 'Дополнительная информация',
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

		$criteria->compare('id_rep_type',$this->id_rep_type,true);
		$criteria->compare('rep_name',$this->rep_name,true);
		$criteria->compare('rep_mv',$this->rep_mv,true);
		$criteria->compare('s_date',$this->s_date,true);
		$criteria->compare('f_date',$this->f_date,true);
		$criteria->compare('date_type',$this->date_type);
		$criteria->compare('archive',$this->archive);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        
        protected function afterFind()
        { 
            if($this->s_date == '0000-00-00' || $this->s_date == '') $this->s_date = '';
            else $this->s_date = date('d.m.Y', strtotime($this->s_date));
            if($this->f_date == '0000-00-00' || $this->f_date == '') $this->f_date = '';
            else $this->f_date = date('d.m.Y', strtotime($this->f_date));                

            return TRUE;
        }        
}