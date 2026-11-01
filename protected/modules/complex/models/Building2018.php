<?php

/**
 * This is the model class for table "building2018".
 *
 * The followings are the available columns in table 'building2018':
 * @property string $id_building
 * @property string $id_report
 * @property string $id_mun
 * @property integer $nas_punkt_type
 * @property string $nas_punkt
 * @property integer $street_type
 * @property string $street
 * @property string $dom
 * @property string $litera
 * @property string $pl
 * @property string $godp
 * @property string $eta
 * @property string $izn
 * @property string $sport
 * @property string $pish
 * @property string $vodo
 * @property string $kanal
 * @property string $otopl
 * @property string $ogr
 * @property string $otd
 * @property string $fil
 * @property string $hoz
 * @property string $bass
 * @property string $sportz
 * @property string $doo
 * @property string $noo
 * @property string $ooo
 * @property string $soo
 * @property string $dop
 * @property string $dpredo
 * @property string $spo
 * @property string $oppo
 * @property string $dpo
 * @property string $ovo
 * @property string $aps
 * @property string $di
 * @property string $pokr
 * @property string $v01
 * @property string $chop
 * @property string $vohr
 * @property string $vahta
 * @property string $kevp
 * @property string $video
 * @property string $skud
 * @property string $sszd
 * @property string $sszem
 * @property string $tp
 * @property string $sanvn
 * @property string $sannar
 */
class Building2018 extends CActiveRecord
{
    
    public $file1d;
    public $file2d;
    public $file3d;
    public $file4d;
    public $file5d;
    public $file6d;
    public $file7d;
    public $file8d;
    public $doc1u;    
    public $doc2u; 
    public $doc3u;
    public $doc4u;    
    public $doc5u; 
    public $doc6u; 
    public $doc7u;    
    public $doc8u;     

    const DOC_PATH = '/var/www/cposo/data/www/mon.cposo.ru/protected/building18';    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'building2018';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id_report, id_mun, dom, pl, godp, eta, izn', 'required'),
            array('id_mun, pl, godp, eta, izn, nas_punkt_type, street_type, sport, pish, vodo, kanal, otopl, ogr, otd, fil, hoz, bass, sportz, doo, noo, ooo, soo, dop, dpredo, spo, oppo, dpo, ovo, aps, di, pokr, v01, chop, vohr, vahta, kevp, video, skud, sannar, sanvn', 'numerical', 'integerOnly'=>true),
            array('sport, pish, vodo, kanal, otopl, ogr, otd, fil, hoz, bass, sportz, doo, noo, ooo, soo, dop, dpredo, spo, oppo, dpo, ovo, aps, di, pokr, v01, chop, vohr, vahta, kevp, video, skud', 'in', 'range'=>array(0,1)),
            array('id_report', 'length', 'max'=>10),
            array('id_mun, izn, sanvn, sannar', 'length', 'max'=>3),
            array('file1d, file2d, file3d, file4d, file5d, file6d, file7d, file8d', 'in','range'=>array(0, 1)),
            array('nas_punkt, street, dom, litera, sszd, sszem, tp, inoe1, inoe2, inoe3, inoe4, inoe5', 'length', 'max'=>255),
            array('pl', 'length', 'max'=>5),
            array('godp', 'length', 'max'=>4),
            array('eta', 'length', 'max'=>2),
            array('nazv1, nazv2, nazv3, nazv4, nazv5', 'match', 'pattern'=>'/^[а-яА-ЯёЁ0-9№,\.\(\)\-\s\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, цифры, тире, точку, знак номера, скобки и кавычки'),
            array('doc1u, doc2u, doc3u, doc4u, doc5u, doc6u, doc7u, doc8u', 'file',
                'allowEmpty'  => true,
                'maxFiles'   => 1,
                'maxSize'   => 26214400,
                'minSize'   => 0,
                'types'   => 'zip',
                'tooLarge'   => 'Вы загружаете файл слишком большого размера',
            ),
            //array('doc4u, doc5u, doc6u, doc7u, doc8u', 'doc'),            
            array('sport, pish, vodo, kanal, otopl, ogr, otd, fil, hoz, bass, sportz, doo, noo, ooo, soo, dop, dpredo, spo, oppo, dpo, ovo, aps, di, pokr, v01, chop, vohr, vahta, kevp, video, skud', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_building, id_report, id_mun, nas_punkt_type, nas_punkt, street_type, street, dom, litera, pl, godp, eta, izn, sport, pish, vodo, kanal, otopl, ogr, otd, fil, hoz, bass, sportz, doo, noo, ooo, soo, dop, dpredo, spo, oppo, dpo, ovo, aps, di, pokr, v01, chop, vohr, vahta, kevp, video, skud, sszd, sszem, tp, sanvn, sannar', 'safe', 'on'=>'search'),
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
            'pl' => 'Площадь общая, м2',
            'godp' => 'Год постройки',
            'eta' => 'Этажность',
            'izn' => 'Износ по состоянию на начало года',
            'sport' => 'Наличие спортплощадки на прилегающей территории',
            'pish' => 'Наличие пищеблока',
            'vodo' => 'Наличие водопровода',
            'kanal' => 'Наличие водоотведения (канализации)',
            'otopl' => 'Наличие центрального отопления',
            'ogr' => 'Имеет ограждение территории',
            'otd' => 'Отдельное здание',
            'fil' => 'Филиал (структурное подразделение)',
            'hoz' => 'Хозяйственная постройка',
            'bass' => 'Бассейн',
            'sportz' => 'Спортивный зал',
            'doo' => 'образовательные программы дошкольного образования',
            'noo' => 'образовательные программы начального общего образования',
            'ooo' => 'образовательные программы основного общего образования',
            'soo' => 'образовательные программы среднего общего образования',
            'dop' => 'дополнительные общеразвивающие программы',
            'dpredo' => 'дополнительные предпрофессиональные программы',
            'spo' => 'образовательные программы среднего профессионального образования',
            'oppo' => 'основные программы профессионального обучения',
            'dpo' => 'дополнительные профессиональные программы',
            'ovo' => 'образовательные программы высшего образования',
            'aps' => 'Наличие автоматической пожарной сигнализации',
            'di' => 'Наличие дымовых извещателей',
            'pokr' => 'Наличие пожарных кранов и рукавов',
            'v01' => 'Вывод «01»',
            'chop' => 'ЧОП',
            'vohr' => 'ВОХР',
            'vahta' => 'Вахтер',
            'kevp' => 'Наличие технических средств охраны (КЭВП)',
            'video' => 'Наличие видеонаблюдения',
            'skud' => 'Наличие системы контроля и управления доступом',
            'sszd' => 'Свидетельство о собственности на здание',
            'sszem' => 'Свидетельство о собственности на землю',
            'tp' => 'Технический паспорт',
            'sanvn' => 'Число санузлов внутри здания',
            'sannar'=> 'Число санузлов снаружи знания на прилегающей территории',
            'nazv1' => '',
            'nazv2' => '',
            'nazv3' => '',
            'nazv4' => '',
            'nazv5' => '',
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
        $criteria->compare('pl',$this->pl,true);
        $criteria->compare('godp',$this->godp,true);
        $criteria->compare('eta',$this->eta,true);
        $criteria->compare('izn',$this->izn,true);
        $criteria->compare('sport',$this->sport,true);
        $criteria->compare('pish',$this->pish,true);
        $criteria->compare('vodo',$this->vodo,true);
        $criteria->compare('kanal',$this->kanal,true);
        $criteria->compare('otopl',$this->otopl,true);
        $criteria->compare('ogr',$this->ogr,true);
        $criteria->compare('otd',$this->otd,true);
        $criteria->compare('fil',$this->fil,true);
        $criteria->compare('hoz',$this->hoz,true);
        $criteria->compare('bass',$this->bass,true);
        $criteria->compare('sportz',$this->sportz,true);
        $criteria->compare('doo',$this->doo,true);
        $criteria->compare('noo',$this->noo,true);
        $criteria->compare('ooo',$this->ooo,true);
        $criteria->compare('soo',$this->soo,true);
        $criteria->compare('dop',$this->dop,true);
        $criteria->compare('dpredo',$this->dpredo,true);
        $criteria->compare('spo',$this->spo,true);
        $criteria->compare('oppo',$this->oppo,true);
        $criteria->compare('dpo',$this->dpo,true);
        $criteria->compare('ovo',$this->ovo,true);
        $criteria->compare('aps',$this->aps,true);
        $criteria->compare('di',$this->di,true);
        $criteria->compare('pokr',$this->pokr,true);
        $criteria->compare('v01',$this->v01,true);
        $criteria->compare('chop',$this->chop,true);
        $criteria->compare('vohr',$this->vohr,true);
        $criteria->compare('vahta',$this->vahta,true);
        $criteria->compare('kevp',$this->kevp,true);
        $criteria->compare('video',$this->video,true);
        $criteria->compare('skud',$this->skud,true);
        $criteria->compare('sszd',$this->sszd,true);
        $criteria->compare('sszem',$this->sszem,true);
        $criteria->compare('tp',$this->tp,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Building2018 the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function zam($rps) {
        $res = '';
        foreach($rps as $rp) {
            if($this->$rp) {
                if($res == '') $res = $this->getAttributeLabel($rp);
                else $res = $res.'<br/>'.$this->getAttributeLabel($rp);
            }
        }
        return $res;        
    }
    
    public function danet($pok) {
        if($this->$pok) return 'Да';
        else return 'Нет';
    }
    
    public function address() {
        if($this->litera) $korpus = ', корпус '.$this->litera;
        return Contact_gor::model()->findByPk($this->nas_punkt_type)->naim_gor.' '.$this->nas_punkt.', '.Contact_ul::model()->findByPk($this->street_type)->naim_ul.' '.$this->street.', дом №'.$this->dom.$korpus;
    }
    
    public function inoe() {
        $res = '';
        for($i = 1; $i < 6; $i++) {
            $pok = 'nazv'.$i;
            if($this->$pok) {
                if($res == '') $res = CHtml::link($this->$pok,array('building2018/bdown','id'=>($i + 3), 'id_report' => $this->id_report, 'id_building' => $this->id_building));
                else $res = $res.'<br/>'.CHtml::link($this->$pok,array('building2018/bdown','id'=>($i + 3), 'id_report' => $this->id_report, 'id_building' => $this->id_building));
            }            
        }
        return $res;
    }


    protected function beforeSave()
    { 
        $extension = 'zip';
        $id_rep_type = Report::model()->findByPk($this->id_report)->id_rep_type;
        $file_path = self::DOC_PATH.'/'.$id_rep_type;        
        if(!file_exists($file_path)) mkdir($file_path, 0700, true);      
        $poks = array(1 => 'sszd', 2 => 'sszem', 3 => 'tp', 4 => 'inoe1', 5 => 'inoe2', 6 => 'inoe3', 7 => 'inoe4', 8 => 'inoe5');
        for($k = 1; $k < 9; $k++) {
            $doc = 'doc'.$k;
            $pok = $poks[$k];
            $file = 'file'.$k.'d';
            if($this->$file) {
                if($this->$pok) {
                    unlink($file_path.'/'.$this->$pok);
                }
                $this->$pok = '';                    
            }
            elseif ($file = CUploadedFile::getInstance($this, $doc.'u'))
            {               
                $filename = $this->getRandomFileName($file_path, $extension);
                $basename = $filename.'.'.$extension;
                if($file->saveAs($file_path.'/'.$basename)) {
                    if($this->$pok) {
                        unlink($file_path.'/'.$this->$pok);
                    }
                    $this->$pok = $basename;
                }
            }
        }        
        return TRUE;
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
}
