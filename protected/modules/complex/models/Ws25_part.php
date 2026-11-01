<?php

/**
 * This is the model class for table "ws25_part".
 *
 * The followings are the available columns in table 'ws25_part':
 * @property string $id
 * @property string $id_report
 * @property string $parent_id
 * @property string $id_compet
 * @property string $id_cat
 * @property string $id_stat
 * @property string $name
 * @property string $patr
 * @property string $surname
 * @property string $burthdate
 * @property string $pers_mail
 * @property string $nas_punkt
 * @property string $lic_code
 * @property string $lic_tel
 * @property string $id_gr
 * @property string $id_est
 * @property string $ano_org
 * @property string $rabota
 * @property string $org_mail
 * @property string $id_po
 * @property string $klass
 * @property string $dol
 * @property string $end_god
 * @property string $per_name
 * @property string $per_patr
 * @property string $per_surname
 * @property string $per_code
 * @property string $per_tel
 * @property string $id_size
 * @property string $housing
 * @property string $sogl
 * @property string $sogl_r
 * @property string $exp
 * @property string $exp_r
 * @property string $red
 * @property string $r_date
 */
class Ws25_part extends CActiveRecord
{
    public $file1;
    public $file2;
    
    public $est_name;
    
    const FILE_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/spz/ws';    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ws25_part';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, patr, surname, burthdate, pers_mail, nas_punkt, lic_code, lic_tel, id_gr, org_mail, id_size', 'required'),
            array('id_compet, id_cat, id_stat, dol', 'required', 'on'=>'user2'),
            array('id_compet, klass, end_god', 'required', 'on'=>'contest'),
            array('per_name', 'check_per', 'on'=>'contest'),
            array('end_god', 'check_god', 'on'=>'contest'),
            array('burthdate', 'check_burthdate'),
            array('id_gr', 'in', 'range'=>array(1), 'on'=>'contest'),
            array('id_po', 'check_po', 'on'=>'contest'),
            array('id_gr', 'InTableValidator', 
                'table' => 'ws25_country',
                'valueColumn' => 'id',
                'message' => 'Указанного гражданства не существует',
            ),            
            array('dol', 'required', 'on'=>'accomp'),
            array('dol', 'required', 'on'=>'mentor'),
            array('file2', 'file2_val', 'on'=>'mentor'),
            array('id_cat', 'InTableValidator', 
                'table' => 'ws25_cat',
                'valueColumn' => 'id',
                'message' => 'Указанная категория не существует',
            ),
            array('id_compet', 'InTableValidator', 
                'table' => 'ws25_compet',
                'valueColumn' => 'id',
                'message' => 'Указанная компетенция не существует',
            ),
            array('id_stat', 'InTableValidator', 
                'table' => 'ws25_stat',
                'valueColumn' => 'id',
                'message' => 'Указанного статуса не существует',
            ),
            array('nas_punkt', 'InTableValidator', 
                'table' => 'ws25_so',
                'valueColumn' => 'naim',
                'message' => 'Указанного населенного пункта в Самарской области не существует',
            ),
            array('id_comp', 'InTableValidator', 
                'table' => 'ws25_compet',
                'valueColumn' => 'id',
                'message' => 'Указанного приемной кампании не существует',
            ),            
            //array('name, patr, surname, per_name, per_patr, per_surname', 'match', 'pattern'=>'/^[а-яА-ЯёЁ\-\s]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и тире'),
            array('name, patr, surname, per_name, per_patr, per_surname', 'match', 'pattern'=>'/^[А-ЯЁ][а-яё\-\s]+$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и дефис. Первый символ должен быть заглавной буквой, остальные строчными'),
            array('burthdate', 'date', 'format'=>'dd.MM.yyyy'),            
            array('pers_mail, org_mail', 'email'),
            array('pers_mail, org_mail', 'match', 'pattern' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', 'message' => 'Адрес электронной почты должен содержать только строчные буквы'),            
            array('pers_mail', 'validateUniqueEmail', 'on'=>array('contest', 'accomp', 'mentor')),
            array('pers_mail, org_mail', 'EmailDomainValidator', 
                  'checkMX' => true, 'checkA' => false),            
            array('lic_code, per_code', 'length', 'is'=>3),
            array('lic_tel, per_tel', 'length', 'is'=>7),
            array('lic_code, lic_tel, per_code, per_tel', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),
            array('nas_punkt, dol, rabota, est_name', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\/\(\)\-\s\«\»\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            array('id_size', 'InTableValidator', 
                'table' => 'ws25_size',
                'valueColumn' => 'id',
                'message' => 'Указанного размера не существует',
            ),            
            array('ano_org, housing', 'in','range'=>array(0,1)),
            array('file1', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip, pdf, jpg, gif, png, jpeg',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('file2', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip, pdf',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),            
            array('file1', 'file1_val'),
            array('rabota', 'rabota_val'),
            array('id_po', 'InTableValidator', 
                'table' => 'po_new',
                'valueColumn' => 'id_po',
                'message' => 'Указанной специальности не существует',
            ),
            array('klass', 'in','range'=>range(1,12)),
            array('end_god', 'in','range'=>range(2025, 2055)),
            
            array('id_report, parent_id, id_compet, id_cat, id_stat, id_gr, id_est, ano_org, id_po, end_god, id_size, housing', 'length', 'max'=>10),
            array('name, patr, surname, pers_mail, nas_punkt, org_mail, dol, per_name, per_patr, per_surname, sogl, sogl_r, exp, exp_r, red', 'length', 'max'=>255),
            array('klass', 'length', 'max'=>2),
            
            //array('est_name', 'pattern'=>'/^[а-яА-Я0-9№,\.\-\s\"]*$/u', 'message'=>'В названиях можно использовать только буквы кириллицы, цифры, тире, знак номера и кавычки'),
            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_report, parent_id, id_compet, id_cat, id_stat, name, patr, surname, burthdate, pers_mail, nas_punkt, lic_code, lic_tel, id_gr, id_est, ano_org, rabota, org_mail, id_po, klass, dol, end_god, per_name, per_patr, per_surname, per_code, per_tel, id_size, housing, sogl, sogl_r, exp, exp_r, red, r_date', 'safe', 'on'=>'search'),
        );
    }
    
    public function nsov() {
        $razn = $this->calc_vozr();
        if($razn[1] < 18) return true;
        else return false;
    }
    
    public function can_red() {
        if($this->compet->red) return true;
        else return false;
    }    
    
    public function check_po($attribute,$params)
    {
        if(!$this->id_po && ($this->id_cat == 1)) $this->addError('id_po', 'Необходимо указать код и наименование специальности обучения');
    }     
    
    public function check_god($attribute,$params)
    {
        if($this->end_god < date('Y')) $this->addError('end_god', 'Год окончания обучения в учебном заведении не может быть меньше текущего года');
    }    
    
    public function check_per($attribute,$params)
    {
        $razn = $this->calc_vozr();
        if($razn[1] < 18) {
            if(!$this->per_name) $this->addError('per_name', 'Для несовершеннолетнего необходимо указать имя родителя (законного представителя)');
            if(!$this->per_patr) $this->addError('per_patr', 'Для несовершеннолетнего необходимо указать отчество родителя (законного представителя)');
            if(!$this->per_surname) $this->addError('per_surname', 'Для несовершеннолетнего необходимо указать фамилию родителя (законного представителя)');
            if(!$this->per_code) $this->addError('per_code', 'Для несовершеннолетнего необходимо указать код города родителя (законного представителя)');
            if(!$this->per_tel) $this->addError('per_tel', 'Для несовершеннолетнего необходимо указать телефон родителя (законного представителя)');
        }    
    }        
    
    public function check_burthdate($attribute,$params)
    {
        $razn = $this->calc_vozr();
        if($razn[1] < 14) $this->addError('burthdate', 'Возраст на '.date('d.m.Y', strtotime($razn[2])).' должен быть не менее 14 лет');
    }

    public function calc_vozr() {       
        $rv = Yii::app()->db->createCommand('SELECT rv FROM ws25_comp where id_rep_type = '.$this->report->id_rep_type)->queryScalar();
        $now = DateTime::createFromFormat("Y-m-d", $rv); // дата расчета возраста
        $date = DateTime::createFromFormat("Y-m-d", date('Y-m-d', strtotime($this->burthdate))); // дата рождения
        $interval = $now->diff($date); // получаем разницу в виде объекта DateInterval
        return array(1 => $interval->y, 2 => $rv);         
    }    
    
    public function rabota_val ($attribute,$params)
    {            
        if($this->ano_org && !$this->rabota) $this->addError('rabota', 'Необходимо указать место работы');
    }    
    
    
    public function file1_val ($attribute,$params)
    {            
        if(!$this->file1->size && !$this->sogl_r) $this->addError('file1', 'Необходимо загрузить файл согласия на обработку персональных данных');
    }

    public function file2_val ($attribute,$params)
    {            
        if(!$this->file2->size && !$this->exp_r) $this->addError('file2', 'Необходимо загрузить файл, подтверждающие наличие у эксперта-наставника официальной и(или) признанной квалификации');
    }    
    
    public function validateUniqueEmail($attribute, $params)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = "t.pers_mail = :pers_mail";
        $criteria->params = array(':pers_mail' => $this->pers_mail);
        
        // Добавляем join с таблицей статусов
        $criteria->join = 'INNER JOIN report s ON t.id_report = s.id_report';

        // Условие для связанной таблицы (например, только активные пользователи)
        $criteria->addCondition('s.id_rep_type = :id_rep_type');
        $criteria->params[':id_rep_type'] = $this->report->id_rep_type; // или другой нужный статус        
        
        if (!$this->isNewRecord) {
            $criteria->addCondition("id != :id");
            $criteria->params[':id'] = $this->id;
        }
        
        if (self::model()->count($criteria) > 0) {
            $this->addError('pers_mail', 'Этот адрес электронной почты уже используется');
        }
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
            'compet'=>array(self::BELONGS_TO, 'Ws25_compet', array('id_compet'=>'id')),
            'cat'=>array(self::BELONGS_TO, 'Ws25_cat', array('id_cat'=>'id')),
            'stat'=>array(self::BELONGS_TO, 'Ws25_stat', array('id_stat'=>'id')),
            'gr'=>array(self::BELONGS_TO, 'Ws25_country', array('id_gr'=>'id')),
            'size'=>array(self::BELONGS_TO, 'Ws25_size', array('id_size'=>'id')),
            'po'=>array(self::BELONGS_TO, 'Po_new', array('id_po'=>'id_po')),
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
            'parent_id' => 'Связанный ID',
            'id_compet' => 'Компетенция',
            'id_cat' => 'Категория',
            'id_stat' => 'Статус',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patr' => 'Отчество',
            //'surname' => 'Фамилия',
            'burthdate' => 'Дата рождения',
            'pers_mail' => 'Личная электронная почта',
            'nas_punkt' => 'Населенный пункт',
            'lic_code' => 'Код',
            'lic_tel' => 'Телефон (мобильный)',
            'id_gr' => 'Гражданство',
            'id_est' => 'Id Est',
            //'ano_org' => 'Не работает в организации от которой подается заявка',
            //'[mentor]rabota' => 'Место работы',
            //'[accomp]rabota' => 'Место работы',
            //'[contest]rabota' => 'Место учебы',
            'rabota' => 'Место работы/учебы',
            'org_mail' => 'Адрес электронной почты организации',
            'id_po' => 'Код и наименование специальности обучения',
            'klass' => 'Курс/Класс обучения',
            'dol' => 'Должность',
            'end_god' => 'Год окончания обучения в учебном заведении',
            'per_name' => 'Имя родителя (законного представителя)',
            'per_patr' => 'Отчество родителя (законного представителя)',
            'per_surname' => 'Фамилия родителя (законного представителя)',
            'per_code' => 'Код',
            'per_tel' => 'Телефон родителя (законного представителя)',
            'id_size' => 'Размер одежды',
            'housing' => 'Необходимо проживание во время чемпионата',
            '[contest]ano_org' => 'Не обучается в организации от которой подается заявка',           
            '[contest]housing' => 'Необходимо проживание во время чемпионата',
            '[mentor]ano_org' => 'Не работает в организации от которой подается заявка',
            '[mentor]housing' => 'Необходимо проживание во время чемпионата',
            '[accomp]ano_org' => 'Не работает в организации от которой подается заявка',
            '[accomp]housing' => 'Необходимо проживание во время чемпионата',
            'sogl' => 'Sogl',
            'sogl_r' => 'Sogl R',
            'exp' => 'Exp',
            'exp_r' => 'Exp R',
            'comment' => 'Комментарий',
            'red' => 'Кто последний редактировал',
            'r_date' => 'Время последнего редактирования',
            'file1' => 'Согласие на обработку персональных данных',
            'file2' => 'Документы, подтверждающие наличие у эксперта-наставника официальной и(или) признанной квалификации',
            'est_name' => 'Название организации',
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
        
        if($this->housing) $criteria->compare('housing',$this->housing);

        $criteria->compare('id',$this->id,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('parent_id',$this->parent_id,true);
        $criteria->compare('id_compet',$this->id_compet,false);
        $criteria->compare('id_cat',$this->id_cat,false);
        $criteria->compare('id_stat',$this->id_stat,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('patr',$this->patr,true);
        $criteria->compare('surname',$this->surname,true);
        $criteria->compare('burthdate',$this->burthdate,true);
        $criteria->compare('pers_mail',$this->pers_mail,true);
        $criteria->compare('nas_punkt',$this->nas_punkt,true);
        $criteria->compare('lic_code',$this->lic_code,true);
        $criteria->compare('lic_tel',$this->lic_tel,true);
        $criteria->compare('id_gr',$this->id_gr,true);
        $criteria->compare('id_est',$this->id_est,true);
        $criteria->compare('ano_org',$this->ano_org,true);
        $criteria->compare('rabota',$this->rabota,true);
        $criteria->compare('org_mail',$this->org_mail,true);
        $criteria->compare('id_po',$this->id_po,true);
        $criteria->compare('klass',$this->klass,true);
        $criteria->compare('dol',$this->dol,true);
        $criteria->compare('end_god',$this->end_god,true);
        $criteria->compare('per_name',$this->per_name,true);
        $criteria->compare('per_patr',$this->per_patr,true);
        $criteria->compare('per_surname',$this->per_surname,true);
        $criteria->compare('per_code',$this->per_code,true);
        $criteria->compare('per_tel',$this->per_tel,true);
        $criteria->compare('id_size',$this->id_size,true);
        //$criteria->compare('housing',$this->housing,true);
        $criteria->compare('sogl',$this->sogl,true);
        $criteria->compare('sogl_r',$this->sogl_r,true);
        $criteria->compare('exp',$this->exp,true);
        $criteria->compare('exp_r',$this->exp_r,true);
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
     * @return Ws25_part the static model class
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

        return TRUE;        
    }
    
    protected function afterFind()
    { 
        if($this->burthdate == '0000-00-00' || $this->burthdate == '') $this->burthdate = '';
        else $this->burthdate = date('d.m.Y', strtotime($this->burthdate));
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
            if($this->sogl_r) unlink($file_path.'/'.$this->sogl);
            if($this->file1->saveAs($file_path.'/'.strtolower($this->id.'-sogl.'.$extension))) {
                //$this->sogl = strtolower($this->id.'-sogl.'.$extension);
                //$this->sogl_r = $this->file1->name;
                //$this->saveAttributes(array('sogl', 'sogl_r'));
                self::model()->updateByPk($this->id, array(
                    'sogl' => strtolower($this->id.'-sogl.'.$extension),
                    'sogl_r' => $this->file1->name
                ));                
            }
        }

        if(!empty($this->file2))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file2->extensionName);
            if($this->exp_r) unlink($file_path.'/'.$this->exp);
            if($this->file2->saveAs($file_path.'/'.strtolower($this->id.'-exp.'.$extension))) {
                //$this->exp = strtolower($this->id.'-exp.'.$extension);
                //$this->exp_r = $this->file2->name;
                //$this->saveAttributes(array('exp', 'exp_r'));
                self::model()->updateByPk($this->id, array(
                    'exp' => strtolower($this->id.'-exp.'.$extension),
                    'exp_r' => $this->file2->name
                ));                   
            }
        }
        
        return TRUE;

    }

    protected function beforeDelete()
    {
        parent::beforeDelete();
        
        $file_path = self::FILE_PATH.'/'.Report::model()->findByPk($this->id_report)->id_rep_type.'/'.$this->id_report;
        if($this->sogl_r) unlink($file_path.'/'.$this->sogl);
        if($this->exp_r) unlink($file_path.'/'.$this->exp);
        
        return TRUE;
    }    
    
    public function get_fio_accomp() {
        $accomp = $this->load_zav($this->id, 3);
        return $accomp->surname.' '.$accomp->name.' '.$accomp->patr;
    }

    public function get_fio_mentor() {
        $mentor = $this->load_zav($this->id, 2);
        return $mentor->surname.' '.$mentor->name.' '.$mentor->patr;
    }
    
    public function load_zav($id, $id_stat) {
        return Ws25_part::model()->find('parent_id=:parent_id and id_stat = :id_stat', array(':parent_id'=>$id, ':id_stat'=>$id_stat));
    }
}