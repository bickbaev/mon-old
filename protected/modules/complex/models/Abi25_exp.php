<?php

/**
 * This is the model class for table "abi25_exp".
 *
 * The followings are the available columns in table 'abi25_exp':
 * @property string $id
 * @property string $id_report
 * @property string $name
 * @property string $patr
 * @property string $surname
 * @property string $burthdate
 * @property string $lic_code
 * @property string $lic_tel
 * @property string $lic_mail
 * @property string $id_compet
 * @property string $gl_exp
 * @property string $exp
 * @property string $podg_exp
 * @property string $podg_nac_exp
 * @property string $rabota
 * @property string $dol
 * @property string $id_obr
 * @property string $uch_st
 * @property string $spec
 * @property string $dop
 * @property string $staz
 * @property string $opit
 * @property string $data_att
 * @property string $scan
 * @property string $scan_r
 * @property string $sogl
 * @property string $sogl_r
 * @property string $comment
 * @property string $red
 * @property string $r_date
 */
class Abi25_exp extends CActiveRecord
{
    public $file1;
    public $file2;
    public $file3;
    public $file4;
    public $file5;
    public $file6;
    public $id_comp;
    
    const FILE_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/spz/abi25';     
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'abi25_exp';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, patr, surname, burthdate, lic_code, lic_tel, lic_mail, id_compet, rabota, dol, id_obr, spec, staz, opit', 'required'),
            array('id_report, id_compet, id_obr, staz, opit', 'length', 'max'=>10),
            array('name, patr, surname, lic_mail, dol, spec, scan, scan_r, sogl, sogl_r, red', 'length', 'max'=>255),
            
            array('name, patr, surname', 'match', 'pattern'=>'/^[А-ЯЁ][а-яё\-]+$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы и дефис. Первый символ должен быть заглавной буквой, остальные строчными'),
            array('burthdate, data_att', 'date', 'format'=>'dd.MM.yyyy'),
            array('lic_mail', 'email'),
            array('lic_mail', 'match', 'pattern' => '/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', 'message' => 'Адрес электронной почты должен содержать только строчные буквы'),            
            array('lic_mail', 'EmailDomainValidator', 
                  'checkMX' => true, 'checkA' => false),              
            array('lic_code', 'length', 'is'=>3),
            array('lic_tel', 'length', 'is'=>7),
            array('lic_code, lic_tel', 'match', 'pattern'=>'/^[0-9]*$/u', 'message'=>'В строке "{attribute}" можно использовать только цифры'),            
            array('id_compet', 'InTableValidator', 
                'table' => 'abi25_compet',
                'valueColumn' => 'id',
                'message' => 'Указанная компетенция не существует',
            ),
            array('gl_exp, exp, podg_exp, podg_nac_exp, uch_st', 'in', 'range' => array(0,1)),
            array('rabota, dol, spec, dop', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            array('id_obr', 'InTableValidator', 
                'table' => 'abi25_exp_obr',
                'valueColumn' => 'id',
                'message' => 'Указанного уровня не существует',
            ),
            array('staz, opit', 'in','range'=>range(1,60)),
            array('file1, file2', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'pdf',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('file3, file4, file5, file6', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'pdf, jpg, gif, png, jpeg',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),            
            //array('file1', 'file1_val'),
            array('file2', 'file2_val'),
            array('file3', 'file3_val'),
            array('file4', 'file4_val'),
            array('file5', 'file5_val'),
            array('file6', 'file6_val'),
            array('id_comp', 'InTableValidator', 
                'table' => 'abi25_comp',
                'valueColumn' => 'id',
                'message' => 'Указанного значения не существует',
            ),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, id_report, name, patr, surname, burthdate, lic_code, lic_tel, lic_mail, id_compet, gl_exp, exp, podg_exp, podg_nac_exp, rabota, dol, id_obr, uch_st, spec, dop, staz, opit, data_att, scan, scan_r, sogl, sogl_r, comment, red, r_date', 'safe', 'on'=>'search'),
        );
    }    
    
    public function file1_val ($attribute,$params)
    {            
        if(!$this->file1->size && !$this->scan_r) $this->addError('file1', 'Необходимо загрузить документ о прохождении подготовки в качестве эксперта');
    }

    public function file2_val ($attribute,$params)
    {            
        if(!$this->file2->size && !$this->sogl_r) $this->addError('file2', 'Необходимо загрузить файл согласия на обработку персональных данных');
    }

    public function file3_val ($attribute,$params)
    {            
        if(!$this->file3->size && !$this->doc_obr_r) $this->addError('file3', 'Необходимо загрузить скан-копию документа об образовании');
    }

    public function file4_val ($attribute,$params)
    {            
        if(!$this->file4->size && !$this->doc_staz_r) $this->addError('file4', 'Необходимо загрузить скан-копию документа подтверждающего стаж работы');
    }
    
    public function file5_val ($attribute,$params)
    {            
        if(!$this->file5->size && !$this->doc_snils_r) $this->addError('file5', 'Необходимо загрузить скан-копию СНИЛС');
    }
        
    public function file6_val ($attribute,$params)
    {            
        if(!$this->file6->size && !$this->doc_pass_r) $this->addError('file6', 'Необходимо загрузить скан-копию паспорта');
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
            'obr'=>array(self::BELONGS_TO, 'Abi25_exp_obr', array('id_obr'=>'id')),
            'compet'=>array(self::BELONGS_TO, 'Abi25_compet', array('id_compet'=>'id')),
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
            'lic_code' => 'Код',
            'lic_tel' => 'Телефон',
            'lic_mail' => 'Личная электронная почта',
            'id_compet' => 'Компетенция',
            'gl_exp' => 'Опыт участия в РЧ "Абилимпикс" в качестве главного эксперта',
            'exp' => 'Опыт участия в РЧ "Абилимпикс" в качестве эксперта',
            'podg_exp' => 'Прохождение курсов повышения квалификации по программе "Подготовка экспертов чемпионатов по профессиональному мастерству "Абилимпикс"',
            'podg_nac_exp' => 'Прохождение курсов повышения квалификации по программе "Подготовка национальных экспертов чемпионатов профессионального мастерства "Абилимпикс"',
            'rabota' => 'Место работы',
            'dol' => 'Должность',
            'id_obr' => 'Уровень образования',
            'uch_st' => 'Наличие ученой степени',
            'spec' => 'Специальность, профессия',
            'dop' => 'Профессиональное / дополнительное образование в соответствии с компетенцией',
            'staz' => 'Стаж работы в заявленной компетенции, лет',
            'opit' => 'Опыт работы с людьми с инвалидностью, лет',
            'data_att' => 'Дата окончания обучения на регионального эксперта',
            'scan' => 'Scan',
            'scan_r' => 'Scan R',
            'sogl' => 'Sogl',
            'sogl_r' => 'Sogl R',
            'comment' => 'Комментарий',
            'red' => 'Кто последний редактировал',
            'r_date' => 'Время последнего редактирования',
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
            $criteria->condition = 'abi25_comp.id = :compId';
            $criteria->params = array(':compId' => $this->id_comp);            
        }*/        

        $criteria->compare('id',$this->id,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('patr',$this->patr,true);
        $criteria->compare('surname',$this->surname,true);
        $criteria->compare('burthdate',$this->burthdate,true);
        $criteria->compare('lic_code',$this->lic_code,true);
        $criteria->compare('lic_tel',$this->lic_tel,true);
        $criteria->compare('lic_mail',$this->lic_mail,true);
        $criteria->compare('id_compet',$this->id_compet,true);
        $criteria->compare('gl_exp',$this->gl_exp,true);
        $criteria->compare('exp',$this->exp,true);
        $criteria->compare('podg_exp',$this->podg_exp,true);
        $criteria->compare('podg_nac_exp',$this->podg_nac_exp,true);
        $criteria->compare('rabota',$this->rabota,true);
        $criteria->compare('dol',$this->dol,true);
        $criteria->compare('id_obr',$this->id_obr,true);
        $criteria->compare('uch_st',$this->uch_st,true);
        $criteria->compare('spec',$this->spec,true);
        $criteria->compare('dop',$this->dop,true);
        $criteria->compare('staz',$this->staz,true);
        $criteria->compare('opit',$this->opit,true);
        $criteria->compare('data_att',$this->data_att,true);
        $criteria->compare('scan',$this->scan,true);
        $criteria->compare('scan_r',$this->scan_r,true);
        $criteria->compare('sogl',$this->sogl,true);
        $criteria->compare('sogl_r',$this->sogl_r,true);
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
     * @return Abi25_exp the static model class
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
        if($this->data_att != '') $this->data_att = date('Y-m-d', strtotime($this->data_att)); 

        return TRUE;        
    }
    
    protected function afterFind()
    { 
        if($this->burthdate == '0000-00-00' || $this->burthdate == '') $this->burthdate = '';
        else $this->burthdate = date('d.m.Y', strtotime($this->burthdate)); 
        if($this->data_att == '0000-00-00' || $this->data_att == '') $this->data_att = '';
        else $this->data_att = date('d.m.Y', strtotime($this->data_att));        
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
            if($this->scan_r) unlink($file_path.'/'.$this->scan);
            if($this->file1->saveAs($file_path.'/'.strtolower($this->id.'-exp_scan.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'scan' => strtolower($this->id.'-exp_scan.'.$extension),
                    'scan_r' => $this->file1->name
                ));                
            }
        }

        if(!empty($this->file2))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file2->extensionName);
            if($this->sogl_r) unlink($file_path.'/'.$this->sogl);
            if($this->file2->saveAs($file_path.'/'.strtolower($this->id.'-exp_sogl.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'sogl' => strtolower($this->id.'-exp_sogl.'.$extension),
                    'sogl_r' => $this->file2->name
                ));                
            }
        }
        
        if(!empty($this->file3))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file3->extensionName);
            if($this->doc_obr_r) unlink($file_path.'/'.$this->doc_obr);
            if($this->file3->saveAs($file_path.'/'.strtolower($this->id.'-doc_obr.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'doc_obr' => strtolower($this->id.'-doc_obr.'.$extension),
                    'doc_obr_r' => $this->file3->name
                ));                
            }
        }

        if(!empty($this->file4))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file4->extensionName);
            if($this->doc_staz_r) unlink($file_path.'/'.$this->doc_staz);
            if($this->file4->saveAs($file_path.'/'.strtolower($this->id.'-doc_staz.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'doc_staz' => strtolower($this->id.'-doc_staz.'.$extension),
                    'doc_staz_r' => $this->file4->name
                ));                
            }
        }

        if(!empty($this->file5))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file5->extensionName);
            if($this->doc_snils_r) unlink($file_path.'/'.$this->doc_snils);
            if($this->file5->saveAs($file_path.'/'.strtolower($this->id.'-doc_snils.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'doc_snils' => strtolower($this->id.'-doc_snils.'.$extension),
                    'doc_snils_r' => $this->file5->name
                ));                
            }
        }

        if(!empty($this->file6))
        {                 
            if(!file_exists($file_path)) mkdir($file_path, 0700, true);
            $extension = strtolower($this->file6->extensionName);
            if($this->doc_pass_r) unlink($file_path.'/'.$this->doc_pass);
            if($this->file6->saveAs($file_path.'/'.strtolower($this->id.'-doc_pass.'.$extension))) {
                self::model()->updateByPk($this->id, array(
                    'doc_pass' => strtolower($this->id.'-doc_pass.'.$extension),
                    'doc_pass_r' => $this->file6->name
                ));                
            }
        }        
        
        return TRUE;

    }

    protected function beforeDelete()
    {
        parent::beforeDelete();
        
        $file_path = self::FILE_PATH.'/'.Report::model()->findByPk($this->id_report)->id_rep_type.'/'.$this->id_report;
        if($this->scan_r) unlink($file_path.'/'.$this->scan);        
        if($this->sogl_r) unlink($file_path.'/'.$this->sogl);
        if($this->doc_obr_r) unlink($file_path.'/'.$this->doc_obr);
        if($this->doc_staz_r) unlink($file_path.'/'.$this->doc_staz);
        if($this->doc_snils_r) unlink($file_path.'/'.$this->doc_snils);
        if($this->doc_pass_r) unlink($file_path.'/'.$this->doc_pass);
        
        return TRUE;
    }    
}

