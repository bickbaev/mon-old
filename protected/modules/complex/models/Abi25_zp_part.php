<?php

/**
 * This is the model class for table "abi25_zp_part".
 *
 * The followings are the available columns in table 'abi25_zp_part':
 * @property string $id
 * @property string $id_report
 * @property string $name
 * @property string $patr
 * @property string $surname
 * @property string $burthdate
 * @property string $id_compet
 * @property string $id_cat
 * @property string $id_est
 * @property string $lic_code
 * @property string $lic_tel
 * @property string $lic_mail
 * @property string $id_noz
 * @property string $id_gr
 * @property string $ovz
 * @property string $id_spr
 * @property string $spr_date
 * @property string $spr
 * @property string $spr_r
 * @property string $id_size
 * @property string $osob1
 * @property string $osob2
 * @property string $osob3
 * @property string $osob4
 * @property string $osob5
 * @property string $osob6
 * @property string $osob7
 * @property string $osob7_podr
 * @property string $sogl
 * @property string $sogl_r
 * @property string $per_name
 * @property string $per_patr
 * @property string $per_surname
 * @property string $per_code
 * @property string $per_tel
 * @property string $per_sogl
 * @property string $per_sogl_r
 * @property string $comment
 * @property string $red
 * @property string $r_date
 */
class Abi25_zp_part extends CActiveRecord
{
    public $file1;
    public $file2;
    public $file3;
    public $file4;
    public $id_comp;
    
    public $id_okr;
    public $est_name;      
    
    const FILE_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/spz/abi25_zp';    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'abi25_zp_part';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, patr, surname, burthdate, id_compet, lic_code, lic_tel, lic_mail, id_noz, id_size, per_name, per_patr, per_surname, per_code, per_tel', 'required'),
            array('id, id_report, id_compet, id_cat, id_est, id_noz, id_gr, ovz, id_spr, id_size', 'length', 'max'=>10),
            array('name, patr, surname, lic_mail, spr, spr_r, sogl, sogl_r, per_name, per_patr, per_surname, per_sogl, per_sogl_r, red', 'length', 'max'=>255),

            array('name, patr, surname, per_name, per_patr, per_surname', 'match', 'pattern'=>'/^[А-ЯЁ][а-яё\-]+$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и дефис. Первый символ должен быть заглавной буквой, остальные строчными'),
            array('burthdate, spr_date', 'date', 'format'=>'dd.MM.yyyy'), 
            array('burthdate', 'check_burthdate'),
            array('spr_date', 'check_spr_date'),
            array('lic_mail', 'email'),
            array('lic_mail', 'match', 'pattern' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', 'message' => 'Адрес электронной почты должен содержать только строчные буквы'),            
            array('lic_mail', 'EmailDomainValidator', 
                  'checkMX' => true, 'checkA' => false),              
            array('lic_code, per_code', 'length', 'is'=>3),
            array('lic_tel, per_tel', 'length', 'is'=>7),
            array('lic_code, lic_tel, per_code, per_tel', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),            
            array('id_compet', 'InTableValidator', 
                'table' => 'abi25_compet',
                'valueColumn' => 'id',
                'message' => 'Указанная компетенция не существует',
            ),
            array('ovz', 'check_ovz'),
            array('id_noz', 'InTableValidator', 
                'table' => 'abi25_noz',
                'valueColumn' => 'id',
                'message' => 'Указанной нозологии не существует',
            ),
            array('id_spr', 'InTableValidator', 
                'table' => 'abi25_spr',
                'valueColumn' => 'id',
                'message' => 'Указанного вида справки не существует',
            ),
            array('id_size', 'InTableValidator', 
                'table' => 'abi25_zp_size',
                'valueColumn' => 'id',
                'message' => 'Указанного размера не существует',
            ),
            array('id_cat', 'InTableValidator', 
                'table' => 'abi25_zp_cat',
                'valueColumn' => 'id',
                'message' => 'Указанной возрастной категории не существует',
            ),            
            array('osob1, osob2, osob3, osob4, osob5, osob6, osob7, nonq, notap', 'in', 'range' => array(0,1)),
            array('osob7', 'check_osob7'),
            array('osob7_podr, est_name', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            array('file1, file2, file3, file4', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'pdf',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),             
            array('file1', 'file1_val'),
            array('file2', 'file2_val'),
            array('file3', 'file3_val'),
            array('file4', 'file4_val'),
            array('id_comp', 'InTableValidator', 
                'table' => 'abi25_zp_comp',
                'valueColumn' => 'id',
                'message' => 'Указанного значения не существует',
            ),
            array('id_okr', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_okr',
                'message' => 'Указанного значения не существует',
            ),             
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_report, name, patr, surname, burthdate, id_compet, id_cat, id_est, lic_code, lic_tel, lic_mail, id_noz, id_gr, ovz, id_spr, spr_date, spr, spr_r, id_size, osob1, osob2, osob3, osob4, osob5, osob6, osob7, osob7_podr, sogl, sogl_r, per_name, per_patr, per_surname, per_code, per_tel, per_sogl, per_sogl_r, comment, red, r_date', 'safe', 'on'=>'search'),
        );
    }
    
    public function check_burthdate($attribute,$params)
    {
        $razn = $this->calc_vozr();
        if($razn[1] > 13 || $razn[1] < 5) $this->addError('burthdate', 'Возраст на '.date('d.m.Y', strtotime($razn[2])).' должен быть от 5 до 14 лет');
    }

    public function calc_vozr() {       
        $rv = Yii::app()->db->createCommand('SELECT rv FROM abi25_zp_comp where id_rep_type = '.$this->report->id_rep_type)->queryScalar();
        $now = DateTime::createFromFormat("Y-m-d", $rv); // дата расчета возраста
        $date = DateTime::createFromFormat("Y-m-d", date('Y-m-d', strtotime($this->burthdate))); // дата рождения
        $interval = $now->diff($date); // получаем разницу в виде объекта DateInterval
        return array(1 => $interval->y, 2 => $rv);         
    }
        
    public function can_red() {
        if($this->compet->red) return true;
        else return false;
    }     
    
    public function check_spr_date($attribute,$params)
    {
        if($this->id_gr) {
            $cd = Yii::app()->db->createCommand('SELECT rv FROM abi25_zp_comp where id_rep_type = '.$this->report->id_rep_type)->queryScalar();
            if(strtotime($this->spr_date) < strtotime($cd)) $this->addError('spr_date', 'Справка должна быть действительна во время конкурса');
            if(!$this->id_spr && $this->id_gr) $this->addError('id_spr', 'Необходимо выбрать вид справки об инвалидности');
        }
    }    
    
    public function check_osob7($attribute,$params)
    {
        if(!$this->osob7_podr && $this->osob7) $this->addError('osob7_podr', 'Необходимо заполнить дополнительные особые условия');
    }    

    public function check_ovz($attribute,$params)
    {
        if(!$this->ovz && !$this->id_gr) {
            $this->addError('ovz', 'Необходимо указать группу инвалидности или ОВЗ');
            $this->addError('id_gr', 'Необходимо указать группу инвалидности или ОВЗ');
        }   
    }    
    
    public function file1_val ($attribute,$params)
    {            
        if(!$this->file1->size && !$this->spr_r && $this->id_gr) $this->addError('file1', 'Необходимо загрузить файл справки');
    }

    public function file2_val ($attribute,$params)
    {            
        if(!$this->file2->size && !$this->sogl_r) $this->addError('file2', 'Необходимо загрузить файл согласия на обработку персональных данных конкурсанта');
    }

    public function file3_val ($attribute,$params)
    {            
        if(!$this->file3->size && !$this->per_sogl_r) $this->addError('file3', 'Необходимо загрузить файл согласия на обработку персональных данных сопровождающего');
    }    
        
    public function file4_val ($attribute,$params)
    {            
        if(!$this->file4->size && !$this->spro_r && $this->ovz) $this->addError('file4', 'Необходимо загрузить файл справки об ОВЗ');        
    }     

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.       
        return array(
            'report'=>array(self::BELONGS_TO, 'Report', 'id_report'),
            'compet'=>array(self::BELONGS_TO, 'Abi25_zp_compet', array('id_compet'=>'id')),
            'cat'=>array(self::BELONGS_TO, 'Abi25_zp_cat', array('id_cat'=>'id')),
            'noz'=>array(self::BELONGS_TO, 'Abi25_noz', array('id_noz'=>'id')),
            'gr'=>array(self::BELONGS_TO, 'Abi25_gr', array('id_gr'=>'id')),
            'size'=>array(self::BELONGS_TO, 'Abi25_zp_size', array('id_size'=>'id')),
            'spr_link'=>array(self::BELONGS_TO, 'Abi25_spr', array('id_spr'=>'id')),
            'est'=>array(self::BELONGS_TO, 'Est', array('id_est'=>'id_est')),
            'user'=>array(self::BELONGS_TO, 'User', array('red'=>'user_id')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'id_report' => 'Id Report',
            'surname' => 'Фамилия',            
            'name' => 'Имя',
            'patr' => 'Отчество',
            'burthdate' => 'Дата рождения',
            'id_compet' => 'Компетенция',
            'id_cat' => 'Категория',
            'id_est' => 'Организация',
            'lic_code' => 'Код',
            'lic_tel' => 'Телефон',
            'lic_mail' => 'Личная электронная почта',
            'id_noz' => 'Вид нозологии',
            'id_gr' => 'Группа инвалидности',
            'id_spr' => 'Вид справки об инвалидности',
            'spr_date' => 'Срок действия справки об инвалидности',
            'ovz' => 'ОВЗ',            
            'spr' => 'Spr',
            'spr_r' => 'Spr R',
            'id_size' => 'Размер одежды',
            'osob1' => 'Наличие на площадке переводчиков РЖЯ',
            'osob2' => 'Наличие на площадке тифлосурдопереводчиков',
            'osob3' => 'Наличие на площадке тьюторов',
            'osob4' => 'Наличие на площадке тифлокомментаторов',
            'osob5' => 'Наличие на площадке лупы',
            'osob6' => 'Увеличенный шрифт задания',
            'osob7' => 'Иное',
            'osob7_podr' => 'Иное подробнее',
            'sogl' => 'Sogl',
            'sogl_r' => 'Sogl R',
            'per_name' => 'Имя сопровождающего',
            'per_patr' => 'Отчество сопровождающего',
            'per_surname' => 'Фамилия сопровождающего',
            'per_code' => 'Код',
            'per_tel' => 'Телефон сопровождающего',
            'per_sogl' => 'Per Sogl',
            'per_sogl_r' => 'Per Sogl R',
            'comment' => 'Комментарий',
            'nonq' => 'Не прошёл отборочные соревнования',
            'notap' => 'Не явился на чемпионат / снялся с чемпионата',             
            'red' => 'Кто последний редактировал',
            'r_date' => 'Время последнего редактирования',
            'id_okr' => 'ТУ/ДО',
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
    public function search($id_comp)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        
        $criteria->condition = 'id_comp = '.$id_comp;
        
        /*if($this->id_comp) {
            $criteria->with = array(
                'report' => array(
                    'with' => 'abi25_comp_link'
                )
            );
            $criteria->condition = 'abi25_zp_comp.id = :compId';
            $criteria->params = array(':compId' => $this->id_comp);            
        }*/
        
        // Добавляем join с таблицей report
        $criteria->with = array(
            'report' => array(
                'with' => array(
                    'est' // связь из модели Report с моделью Est
                )
            )
        );

        // Фильтрация по id_okr
        if (!empty($this->id_okr)) {
            $criteria->compare('est.id_okr', $this->id_okr);
        }
        
        // Фильтрация по est_name
        if (!empty($this->est_name)) {
            $criteria->compare('est.est_name', $this->est_name, true);
        }         

        $criteria->compare('id',$this->id,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('patr',$this->patr,true);
        $criteria->compare('surname',$this->surname,true);
        $criteria->compare('burthdate',$this->burthdate,true);
        $criteria->compare('id_compet',$this->id_compet,false);
        $criteria->compare('id_cat',$this->id_cat,true);
        $criteria->compare('id_est',$this->id_est,true);
        $criteria->compare('lic_code',$this->lic_code,true);
        $criteria->compare('lic_tel',$this->lic_tel,true);
        $criteria->compare('lic_mail',$this->lic_mail,true);
        $criteria->compare('id_noz',$this->id_noz,true);
        $criteria->compare('id_gr',$this->id_gr,true);
        $criteria->compare('ovz',$this->ovz,true);
        $criteria->compare('id_spr',$this->id_spr,true);
        $criteria->compare('spr_date',$this->spr_date,true);
        $criteria->compare('spr',$this->spr,true);
        $criteria->compare('spr_r',$this->spr_r,true);
        $criteria->compare('id_size',$this->id_size,true);
        $criteria->compare('osob1',$this->osob1,true);
        $criteria->compare('osob2',$this->osob2,true);
        $criteria->compare('osob3',$this->osob3,true);
        $criteria->compare('osob4',$this->osob4,true);
        $criteria->compare('osob5',$this->osob5,true);
        $criteria->compare('osob6',$this->osob6,true);
        $criteria->compare('osob7',$this->osob7,true);
        $criteria->compare('osob7_podr',$this->osob7_podr,true);
        $criteria->compare('sogl',$this->sogl,true);
        $criteria->compare('sogl_r',$this->sogl_r,true);
        $criteria->compare('per_name',$this->per_name,true);
        $criteria->compare('per_patr',$this->per_patr,true);
        $criteria->compare('per_surname',$this->per_surname,true);
        $criteria->compare('per_code',$this->per_code,true);
        $criteria->compare('per_tel',$this->per_tel,true);
        $criteria->compare('per_sogl',$this->per_sogl,true);
        $criteria->compare('per_sogl_r',$this->per_sogl_r,true);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('red',$this->red,true);
        $criteria->compare('r_date',$this->r_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Abi25_part the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    protected function beforeSave()
    { 
        $this->r_date = date('Y-m-d H:i:s',time());
        $this->red = Yii::app()->session['id'];
        if($this->burthdate != '') $this->burthdate = date('Y-m-d', strtotime($this->burthdate)); 
        if($this->spr_date != '') $this->spr_date = date('Y-m-d', strtotime($this->spr_date));

        return TRUE;        
    }
    
    protected function afterFind()
    { 
        if($this->burthdate == '0000-00-00' || $this->burthdate == '') $this->burthdate = '';
        else $this->burthdate = date('d.m.Y', strtotime($this->burthdate));
        if($this->spr_date == '0000-00-00' || $this->spr_date == '') $this->spr_date = '';
        else $this->spr_date = date('d.m.Y', strtotime($this->spr_date));        
        if($this->r_date == '0000-00-00 00:00:00' || $this->r_date == '') $this->r_date='';
        else $this->r_date=date('d.m.Y H:i:s', strtotime($this->r_date));        
        
        return TRUE;
    }
    
    public function afterSave()
    {
        parent::afterSave();
        
        $file_path = self::FILE_PATH.'/'.Report::model()->findByPk($this->id_report)->id_rep_type.'/'.$this->id_report;
        
        if(!empty($this->file1))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file1->extensionName);
            if($this->spr_r) unlink($file_path.'/'.$this->spr);
            if($this->file1->saveAs($file_path.'/'.strtolower($this->id.'-spr.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'spr' => strtolower($this->id.'-spr.'.$extension),
                    'spr_r' => $this->file1->name
                ));                
            }
        }

        if(!empty($this->file2))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file2->extensionName);
            if($this->sogl_r) unlink($file_path.'/'.$this->sogl);
            if($this->file2->saveAs($file_path.'/'.strtolower($this->id.'-sogl.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'sogl' => strtolower($this->id.'-sogl.'.$extension),
                    'sogl_r' => $this->file2->name
                ));                
            }
        }
        
        if(!empty($this->file3))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file3->extensionName);
            if($this->per_sogl_r) unlink($file_path.'/'.$this->per_sogl);
            if($this->file3->saveAs($file_path.'/'.strtolower($this->id.'-per_sogl.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'per_sogl' => strtolower($this->id.'-per_sogl.'.$extension),
                    'per_sogl_r' => $this->file3->name
                ));                
            }
        } 
                
        if(!empty($this->file4))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file4->extensionName);
            if($this->spro_r) unlink($file_path.'/'.$this->spro);
            if($this->file4->saveAs($file_path.'/'.strtolower($this->id.'-spro.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'spro' => strtolower($this->id.'-spro.'.$extension),
                    'spro_r' => $this->file4->name
                ));                
            }
        }         
        
        return TRUE;

    }

    protected function beforeDelete()
    {
        parent::beforeDelete();
        
        $file_path = self::FILE_PATH.'/'.Report::model()->findByPk($this->id_report)->id_rep_type.'/'.$this->id_report;
        if($this->spr_r) unlink($file_path.'/'.$this->spr);        
        if($this->sogl_r) unlink($file_path.'/'.$this->sogl);
        if($this->per_sogl_r) unlink($file_path.'/'.$this->per_sogl);
        if($this->spro_r) unlink($file_path.'/'.$this->spro);        
        
        return TRUE;
    }

    public function get_rv() {
        return Yii::app()->db->createCommand('SELECT abi25_zp_comp.rv FROM abi25_zp_comp WHERE abi25_zp_comp.id_rep_type = ( SELECT id_rep_type FROM report where id_report = '.$this->id_report.' )')->queryScalar();
    }
}

