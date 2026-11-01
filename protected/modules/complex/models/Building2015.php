<?php

/**
 * This is the model class for table "building2015".
 *
 * The followings are the available columns in table 'building2015':
 * @property string $id_building
 * @property string $id_report
 * @property string $id_mun
 * @property integer $nas_punkt_type
 * @property string $nas_punkt
 * @property integer $street_type
 * @property string $street
 * @property string $dom
 * @property string $litera
 * @property string $pok1
 * @property string $pok2
 * @property string $pok3
 * @property string $pok4
 * @property string $pok5
 * @property string $pok6
 * @property string $pok7
 * @property string $pok8
 * @property string $pok9
 * @property string $pok10
 * @property string $pok11
 * @property string $pok12
 * @property string $pok13
 * @property string $pok14
 * @property string $pok15
 * @property string $pok16
 * @property string $pok17
 * @property string $pok18
 * @property string $pok19
 * @property string $pok20
 * @property string $pok21
 * @property string $doc1
 * @property string $doc2
 * @property string $doc3
 * @property string $doc4
 * @property string $doc5
 */
class Building2015 extends CActiveRecord
{
    
    public $doc1u;    
    public $doc2u; 
    public $doc3u; 
    public $doc4u; 
    public $doc5u;
    public $file1d;
    public $file2d;
    public $file3d;
    public $file4d;
    public $file5d;
    
    //public $verifyCode;
    const IMAGE_PATH = '/var/www/mon/public_html/www/images';    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'building2015';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_mun, nas_punkt_type, nas_punkt, street_type, dom, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, ur1', 'required'),
            array('id_report, id_mun, nas_punkt_type, street_type, litera, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21, ur1', 'numerical', 'integerOnly'=>true),
            array('id_report', 'length', 'max'=>10),
            array('id_mun', 'length', 'max'=>3),
            array('nas_punkt, street, dom, litera, doc1, doc2, doc3, doc4, doc5', 'length', 'max'=>255),
            array('ur1', 'in','range'=>array(1, 2, 3)),
            array('file1d, file2d, file3d, file4d, file5d', 'in','range'=>array(0, 1)),
            array('pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21', 'in','range'=>array(1,2)),
            array('doc1u', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('doc2u', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ), 
            array('doc3u', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ), 
            array('doc4u', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ), 
            array('doc5u', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 5242880,
                'minSize'   => 0,
                'types'   => 'zip',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            array('doc2u', 'doc2u'),
            array('pok9', 'doc3u'),
            array('doc1u', 'akt_val'),
            //array('doc4u', 'doc4u'),            
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_building, id_report, id_mun, nas_punkt_type, nas_punkt, street_type, street, dom, litera, pok1, pok2, pok3, pok4, pok5, pok6, pok7, pok8, pok9, pok10, pok11, pok12, pok13, pok14, pok15, pok16, pok17, pok18, pok19, pok20, pok21', 'safe', 'on'=>'search'),
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
            'id_building' => 'Id Building',
            'id_report' => 'Id Report',
            'id_mun' => 'Муниципалитет',
            'nas_punkt_type' => 'Тип населенного пункта',
            'nas_punkt' => 'Название населенного пункта (только название, не нужно писать "г.", "пгт." и т.п.)',
            'street_type' => 'Тип улицы',
            'street' => 'Улица (только название, не нужно писать "ул.", "пр.", "пер." и т.п.)',
            'dom' => 'Номер дома (без номера корпуса)',
            'litera' => 'Номер корпуса',
            'pok1' => 'Наличие благоустроенного земельного участка с дорожками, площадками покрытыми асфальтобетоном и другим твердым покрытием, не требующего проведения капитального ремонта',
            'pok2' => 'Наличие ограждения территории, обеспечивающего безопасность детей и находящегося в технически исправном состоянии',
            'pok3' => 'Обеспечение температурного режима в соответствии с санитарными нормами и правилами',
            'pok4' => 'Наличие работающей системы холодного и горячего водоснабжения, обеспечивающей бесперебойный санитарный и хозяйственно-питьевой режим в соответствии с санитарными нормами и правилами (при отсутствии протечек)',
            'pok5' => 'Наличие работающей системы отопления, обеспечивающей необходимый температурный режим в помещениях зданий образовательных учреждений',
            'pok6' => 'Наличие работающей системы канализации',
            'pok7' => 'Наличие оборудованных туалетов в соответствии с санитарными нормами и правилами (наличие современного санитарно-технического оборудования, кабинок, отсутствие сколов и выбоин в плиточном покрытии стен и полов)',
            'pok8' => 'Наличие оборудованных аварийных выходов, отвечающих требованиям пожарной безопасности',
            'pok9' => 'Соответствие автоматической пожарной сигнализации и системы оповещения людей при пожаре требованиям пожарной безопасности',
            'pok10' => 'Соответствие электропроводки, электрооборудования требованиям пожарной безопасности',
            'pok11' => 'Соответствие путей эвакуации требованиям пожарной безопасности',
            'pok12' => 'Наличие деформаций наружных и внутренних стен (трещины, отклонение от вертикали, выпучивание, выпадение кирпичей)',
            'pok13' => 'Наличие следов протечек, промерзания наружных стен',
            'pok14' => 'Наличие в плоских крышах вздутий, пробоин, большое количество заплат кровельного покрытия, ржавление и разрушение настенных желобов (деталей водоприемных устройств), в скатных крышах – ослабление крепления отдельных листов к обрешетке, отдельные протечки, просветы, большое количество заплат, поражение гнилью и прогибы деревянных конструкций обрешетки и стропил, ржавление и разрушение настенных желобов (деталей водоприемных устройств)',
            'pok15' => 'Наличие ограждения кровли по периметру здания, высотой не менее 0,6 метра',
            'pok16' => 'Наличие в конструкции деревянного пола щелей между досками, стирание досок в ходовых местах, прогибы и просадка досок',
            'pok17' => 'Наличие в конструкции пола из рулонных материалов отставание в стыках от основания напольного покрытия и вздутие местами, истертость напольного покрытия местами',
            'pok18' => 'Наличие в оконных деревянных переплетах поражений гнилью, рассыхания, нарушение сопряжения, разрушение (отсутствие) отливов',
            'pok19' => 'Наличие в дверных деревянных переплетах скосов, по периметру неплотный притвор дверных полотен',
            'pok20' => 'Соответствие дверей на путях эвакуации техническому регламенту о требованиях пожарной безопасности (по огнестойкости, по высоте, по ширине, наличие приспособления для самозакрывания и уплотнения)',
            'pok21' => 'Наличие дефектов внутренних стен и перегородок (отставание или отбитые места накрывочного слоя, мелкие и глубокие трещины)',
            'doc1' => 'Акт комиссионного осмотра здания (помещений)',
            'doc2' => 'Предписание по устранению нарушений обязательных требований пожарной безопасности',
            'doc3' => 'Акт приемки в эксплуатацию автоматической пожарной сигнализации и системы оповещения людей при пожаре',
            'doc4' => 'Договор на обслуживание автоматической пожарной сигнализации',
            'doc5' => 'Отчет о техническом состоянии, подготовленный специализированной организацией',
            'doc1u' => 'Акт комиссионного осмотра здания (помещений)',
            'doc2u' => 'Предписание по устранению нарушений обязательных требований пожарной безопасности',
            'doc3u' => 'Акт приемки в эксплуатацию автоматической пожарной сигнализации и системы оповещения людей при пожаре',
            'doc4u' => 'Договор на обслуживание автоматической пожарной сигнализации',
            'doc5u' => 'Отчет о техническом состоянии, подготовленный специализированной организацией', 
            'ur1' => 'Укажите, какая образовательная программа преимущественно реализуется в данном здании (например, если в здании школа, где реализуются программы дополнительного образования, то необходимо выбрать "Общего образования")'
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

        $criteria->compare('id_building',$this->id_building,true);
        $criteria->compare('id_report',$this->id_report,true);
        $criteria->compare('id_mun',$this->id_mun,true);
        $criteria->compare('nas_punkt_type',$this->nas_punkt_type);
        $criteria->compare('nas_punkt',$this->nas_punkt,true);
        $criteria->compare('street_type',$this->street_type);
        $criteria->compare('street',$this->street,true);
        $criteria->compare('dom',$this->dom,true);
        $criteria->compare('litera',$this->litera,true);
        $criteria->compare('pok1',$this->pok1,true);
        $criteria->compare('pok2',$this->pok2,true);
        $criteria->compare('pok3',$this->pok3,true);
        $criteria->compare('pok4',$this->pok4,true);
        $criteria->compare('pok5',$this->pok5,true);
        $criteria->compare('pok6',$this->pok6,true);
        $criteria->compare('pok7',$this->pok7,true);
        $criteria->compare('pok8',$this->pok8,true);
        $criteria->compare('pok9',$this->pok9,true);
        $criteria->compare('pok10',$this->pok10,true);
        $criteria->compare('pok11',$this->pok11,true);
        $criteria->compare('pok12',$this->pok12,true);
        $criteria->compare('pok13',$this->pok13,true);
        $criteria->compare('pok14',$this->pok14,true);
        $criteria->compare('pok15',$this->pok15,true);
        $criteria->compare('pok16',$this->pok16,true);
        $criteria->compare('pok17',$this->pok17,true);
        $criteria->compare('pok18',$this->pok18,true);
        $criteria->compare('pok19',$this->pok19,true);
        $criteria->compare('pok20',$this->pok20,true);
        $criteria->compare('pok21',$this->pok21,true);
        $criteria->compare('doc1',$this->doc1,true);
        $criteria->compare('doc2',$this->doc2,true);
        $criteria->compare('doc3',$this->doc3,true);
        $criteria->compare('doc4',$this->doc4,true);
        $criteria->compare('doc5',$this->doc5,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    public function getRandomFileName($path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
 
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
 
        return $name;
    }    
    
    protected function beforeSave()
    { 
        $extension = 'zip';
        $id_rep_type = Report::model()->findByPk($this->id_report)->id_rep_type;
        $file_path = self::IMAGE_PATH.'/'.$id_rep_type;
        if(!file_exists($file_path)) mkdir($file_path, 0700, true);
        for($k = 1; $k < 6; $k++) {
            $doc = 'doc'.$k;
            $file = 'file'.$k.'d';
            if($this->$file) {
                if($this->$doc) {
                    unlink($file_path.'/'.$this->$doc);
                }
                $this->$doc = '';                    
            }
            elseif ($file = CUploadedFile::getInstance($this, $doc.'u'))
            {               
                $filename = $this->getRandomFileName($file_path, $extension);
                $basename = $filename.'.'.$extension;
                if($file->saveAs($file_path.'/'.$basename)) {
                    if($this->$doc) {
                        unlink($file_path.'/'.$this->$doc);
                    }
                    $this->$doc = $basename;                    
                }
            }
        }        
        return TRUE;
    } 
    
    public function doc2u ($attribute,$params)
    {            
        if($this->pok8 == 2 && !CUploadedFile::getInstance($this, 'doc2u')->size && !$this->doc2) $this->addError('doc2u','Необходимо прикрепить файл с документом "Предписание по устранению нарушений обязательных требований пожарной безопасности"');
        if($this->pok10 == 2 && !CUploadedFile::getInstance($this, 'doc2u')->size && !$this->doc2) $this->addError('doc2u','Необходимо прикрепить файл с документом "Предписание по устранению нарушений обязательных требований пожарной безопасности"');
        if($this->pok11 == 2 && !CUploadedFile::getInstance($this, 'doc2u')->size && !$this->doc2) $this->addError('doc2u','Необходимо прикрепить файл с документом "Предписание по устранению нарушений обязательных требований пожарной безопасности"');
        //if($this->pok15 == 2 && !CUploadedFile::getInstance($this, 'doc2u')->size && !$this->doc2) $this->addError('doc2u','Необходимо прикрепить файл с документом "Предписание по устранению нарушений обязательных требований пожарной безопасности"');
        if($this->pok20 == 2 && !CUploadedFile::getInstance($this, 'doc2u')->size && !$this->doc2) $this->addError('doc2u','Необходимо прикрепить файл с документом "Предписание по устранению нарушений обязательных требований пожарной безопасности"');
    }
    
    public function doc3u ($attribute,$params)
    {            
        if($this->pok9 == 1 && !CUploadedFile::getInstance($this, 'doc3u')->size && !CUploadedFile::getInstance($this, 'doc4u')->size && !$this->doc3 && !$this->doc4) {
            $this->addError('doc3u','Необходимо прикрепить файл с документом "Акт приемки в эксплуатацию" или файл с документом "Договор на обслуживание автоматической пожарной сигнализации"');
            $this->addError('doc4u','Необходимо прикрепить файл с документом "Акт приемки в эксплуатацию" или файл с документом "Договор на обслуживание автоматической пожарной сигнализации"');
        }    

    }
    
    public function akt_val ($attribute,$params)
    {            
        if(!CUploadedFile::getInstance($this, 'doc1u')->size && !$this->doc1) $this->addError('doc1u','Необходимо прикрепить файл с документом "Акт комиссионного осмотра здания (помещений)"');
    }     
    
    public function doc4u ($attribute,$params)
    {            
        if($this->pok9 == 1 && (!$this->doc3u || !$this->doc4u)) $this->addError('doc4u','Необходимо прикрепить файл с документом "Акт приемки в эксплуатацию" или файл с документом "Договор на обслуживание автоматической пожарной сигнализации"');

    }    

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Building2015 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}