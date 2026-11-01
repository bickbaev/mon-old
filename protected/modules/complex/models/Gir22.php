<?php

/**
 * This is the model class for table "gir22".
 *
 * The followings are the available columns in table 'gir22':
 * @property string $id_gir
 * @property string $id_report
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property double $pok5
 * @property string $pok6
 * @property double $pok7
 * @property string $pok8
 * @property double $pok9
 * @property string $pok10
 * @property double $pok11
 * @property string $pok12
 * @property double $pok13
 * @property string $pok14
 * @property double $pok15
 * @property string $pok16
 * @property double $pok17
 * @property string $pok18
 * @property double $pok19
 * @property string $pok20
 * @property double $pok21
 * @property string $pok22
 * @property double $pok23
 * @property string $pok24
 * @property double $pok25
 * @property string $pok26
 * @property double $pok27
 * @property string $pok28
 * @property double $pok29
 * @property string $pok30
 * @property double $pok31
 * @property string $pok32
 * @property double $pok33
 * @property string $pok34
 * @property string $pok35
 * @property string $pok36
 * @property string $pok37
 * @property string $pok38
 * @property string $pok39
 * @property string $pok40
 */
class Gir22 extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'gir22';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, pok1, pok2, pok3, pok35, pok36', 'required'),
            array('pok1', 'in','range'=>array(1,2)),
            array('pok3', 'match', 'pattern'=>'/^[а-яА-ЯёЁ\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и тире'),
            array('pok2', 'match', 'pattern'=>'/^[а-яА-ЯёЁ]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы'),
            array('pok2', 'length', 'max'=>1),
            array('pok5, pok7, pok9, pok11, pok13, pok15, pok17, pok19, pok21, pok23, pok25, pok27, pok29, pok31, pok33', 'numerical'),
            array('pok4, pok6, pok8, pok10, pok12, pok14, pok16, pok18, pok20, pok22, pok24, pok26, pok28, pok30, pok32', 'numerical', 'integerOnly'=>true),
            array('pok4, pok6, pok8, pok10, pok12, pok14, pok16, pok18, pok20, pok22, pok24, pok26, pok28, pok30, pok32', 'in','range'=>array(0,1)),            
            array('pok3, pok35, pok36, pok37, pok38, pok39, pok40', 'length', 'max'=>255),
            array('pok34', 'length', 'max'=>1500),
            array('pok34, pok35, pok36, pok37, pok38, pok39, pok40', 'match', 'pattern'=>'/^[a-zA-Zа-яА-ЯёЁ0-9№,\.\(\)\-\«\»\:\;\s\"\_\?\!\=\%\&\/]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, точку, двоеточие, знак номера, скобки и кавычки, дробь'),
            array('pok35', 'pok35_prov'),
            array('pok37', 'pok37_prov'),
            array('pok39', 'pok39_prov'),
            array('pok36', 'pok36_prov'),
            array('pok38', 'pok38_prov'),
            array('pok40', 'pok40_prov'),
            array('pok4', 'pok4_prov'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_gir, id_report, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, pok22, pok23, pok24, pok25, pok26, pok27, pok28, pok29, pok30, pok31, pok32, pok33, pok34, pok35, pok36, pok37, pok38, pok39, pok40', 'safe', 'on'=>'search'),
        );
    }
    
    public function pok4_prov($attribute,$params) {
        $sum = 0;
        for($i = 0; $i < 15; $i++) {
            $m = 4 + $i*2;
            $n = $m + 1;
            $pok = 'pok'.$m;
            $pok_sr = 'pok'.$n;
            if($this->$pok && !$this->$pok_sr) $this->addError($pok_sr,'Необходимо ввести средний балл по предмету');
            if(!$this->$pok && $this->$pok_sr) $this->addError($pok,'Необходимо выбрать предмет');
            if($this->$pok) $sum = $sum + 1;
        }
        if(!$sum) $this->addError('pok4', 'Выберите хотя бы один предмет');
    }        
    
    public function pok35_prov($attribute,$params) {
        if($this->pok35 && !$this->pok36) $this->addError('pok36','Необходимо ввести специальность');
    }

    public function pok37_prov($attribute,$params) {
        if($this->pok37 && !$this->pok38) $this->addError('pok38','Необходимо ввести специальность');
    }

    public function pok39_prov($attribute,$params) {
        if($this->pok39 && !$this->pok40) $this->addError('pok40','Необходимо ввести специальность');
    }

    public function pok36_prov($attribute,$params) {
        if(!$this->pok35 && $this->pok36) $this->addError('pok35','Необходимо ввести название ВУЗа 1');
    }

    public function pok38_prov($attribute,$params) {
        if(!$this->pok37 && $this->pok38) $this->addError('pok37','Необходимо ввести название ВУЗа 2');
    } 

    public function pok40_prov($attribute,$params) {
        if(!$this->pok39 && $this->pok40) $this->addError('pok39','Необходимо ввести название ВУЗа 3');
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
            'id_gir' => 'Id Gir',
            'id_report' => 'Id Report',
            'pok1' => 'Параллель',
            'pok2' => 'Первая буква фамилии обучающегося',
            'pok3' => 'Имя обучающего',
            'pok4' => 'Русский язык',
            'pok5' => '',
            'pok6' => 'Математика',
            'pok7' => '',
            'pok8' => 'Литература',
            'pok9' => '',
            'pok10' => 'Физика',
            'pok11' => '',
            'pok12' => 'Химия',
            'pok13' => '',
            'pok14' => 'Биология',
            'pok15' => '',
            'pok16' => 'География',
            'pok17' => '',
            'pok18' => 'История',
            'pok19' => '',
            'pok20' => 'Обществознание',
            'pok21' => '',
            'pok22' => 'Иностранный язык (английский)',
            'pok23' => '',
            'pok24' => 'Иностранный язык (немецкий)',
            'pok25' => '',
            'pok26' => 'Иностранный язык (французский)',
            'pok27' => '',
            'pok28' => 'Иностранный язык (испанский)',
            'pok29' => '',
            'pok30' => 'Иностранный язык (китайский)',
            'pok31' => '',
            'pok32' => 'Информатика и информационно-коммуникационные технологии (ИКТ)',
            'pok33' => '',
            'pok34' => '',
            'pok35' => 'Предполагаемый для поступления ВУЗ 1',
            'pok36' => 'Специальность',
            'pok37' => 'Предполагаемый для поступления ВУЗ 2',
            'pok38' => 'Специальность',
            'pok39' => 'Предполагаемый для поступления ВУЗ 3',
            'pok40' => 'Специальность',
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

        $criteria->compare('id_gir',$this->id_gir,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('pok1',$this->pok1,true);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3,true);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5);
        $criteria->compare('pok6',$this->pok6,true);
        $criteria->compare('pok7',$this->pok7);
        $criteria->compare('pok8',$this->pok8,true);
        $criteria->compare('pok9',$this->pok9);
        $criteria->compare('pok10',$this->pok10,true);
        $criteria->compare('pok11',$this->pok11);
        $criteria->compare('pok12',$this->pok12,true);
        $criteria->compare('pok13',$this->pok13);
        $criteria->compare('pok14',$this->pok14,true);
        $criteria->compare('pok15',$this->pok15);
        $criteria->compare('pok16',$this->pok16,true);
        $criteria->compare('pok17',$this->pok17);
        $criteria->compare('pok18',$this->pok18,true);
        $criteria->compare('pok19',$this->pok19);
        $criteria->compare('pok20',$this->pok20,true);
        $criteria->compare('pok21',$this->pok21);
        $criteria->compare('pok22',$this->pok22,true);
        $criteria->compare('pok23',$this->pok23);
        $criteria->compare('pok24',$this->pok24,true);
        $criteria->compare('pok25',$this->pok25);
        $criteria->compare('pok26',$this->pok26,true);
        $criteria->compare('pok27',$this->pok27);
        $criteria->compare('pok28',$this->pok28,true);
        $criteria->compare('pok29',$this->pok29);
        $criteria->compare('pok30',$this->pok30,true);
        $criteria->compare('pok31',$this->pok31);
        $criteria->compare('pok32',$this->pok32,true);
        $criteria->compare('pok33',$this->pok33);
        $criteria->compare('pok34',$this->pok34,true);
        $criteria->compare('pok35',$this->pok35,true);
        $criteria->compare('pok36',$this->pok36,true);
        $criteria->compare('pok37',$this->pok37,true);
        $criteria->compare('pok38',$this->pok38,true);
        $criteria->compare('pok39',$this->pok39,true);
        $criteria->compare('pok40',$this->pok40,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Gir22 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function get_ege() {
        $res = '';
        for($i = 2; $i < 17; $i++) {
            $pok = 'pok'.$i*2;
            $i_ege = $i*2 + 1;
            $pok_ege = 'pok'.$i_ege;
            if($this->$pok) {
                if($res == '') $res = $this->getAttributeLabel($pok).' ('.$this->$pok_ege.')';
                else $res = $res.'<br>'.$this->getAttributeLabel($pok).' ('.$this->$pok_ege.')';
            }
        }
        return $res;
    }    
}