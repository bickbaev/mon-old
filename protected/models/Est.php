<?php

/**
 * This is the model class for table "est".
 *
 * The followings are the available columns in table 'est':
 * @property integer $id_est
 * @property integer $pid_est
 * @property string $est_name
 * @property integer $type_adm
 * @property integer $status
 * @property integer $cab_status
 * @property integer $id_okr
 * @property integer $id_raion
 * @property integer $id_type
 */
class Est extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'est';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pid_est, est_name', 'required'),
            array('pid_est, type_adm, status, cab_status, id_okr, id_raion, id_type', 'numerical', 'integerOnly'=>true),
            array('id_okr', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_okr',
                'message' => 'Указанного значения не существует',
            ),
            array('id_raion', 'InTableValidator', 
                'table' => 'est',
                'valueColumn' => 'id_raion',
                'message' => 'Указанного значения не существует',
            ),
            array('status, cab_status', 'in', 'range' => array(0,1)),
            array('type_adm', 'in', 'range' => range(0,4)),
            array('est_name', 'length', 'max'=>255),            
            array('est_name', 'match', 'pattern'=>'/^[а-яА-ЯёЁa-zA-Z0-9№,\.\:\?\!\(\)\-\—\–\r\n\s\+\&\/\«\»\"\"]*$/u', 'message'=>'В строке "{attribute}" можно использовать только буквы кириллицы, латиницы, цифры, тире, дефис, точку, запятую, восклицательный знак, +, &, /, знак номера, кавычки вида ", «, » и скобки'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_est, pid_est, est_name, type_adm, status, cab_status, id_okr, id_raion, id_type', 'safe', 'on'=>'search'),
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
            'id_est' => 'Id Est',
            'pid_est' => 'Pid Est',
            'est_name' => 'Наименование',
            'type_adm' => 'Type Adm',
            'status' => 'Status',
            'cab_status' => 'Cab Status',
            'id_okr' => 'Id Okr',
            'id_raion' => 'Id Raion',
            'id_type' => 'Id Type',
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

        $criteria->compare('id_est',$this->id_est);
        $criteria->compare('pid_est',$this->pid_est);
        $criteria->compare('est_name',$this->est_name,true);
        $criteria->compare('type_adm',$this->type_adm);
        $criteria->compare('status',$this->status);
        $criteria->compare('cab_status',$this->cab_status);
        $criteria->compare('id_okr',$this->id_okr);
        $criteria->compare('id_raion',$this->id_raion);
        $criteria->compare('id_type',$this->id_type);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Est the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function getAllEst($id_est) {
        $ou = array($id_est);
        $command = Yii::app()->db->createCommand('select type_adm from est where id_est='.$id_est);
        $type_adm = $command->queryScalar();
        switch ($type_adm) {
        case 0:
            return $ou;
        case 2:
            $command = Yii::app()->db->createCommand('select id_est from est where id_raion='.$id_est);
            return $command->queryColumn();
        case 3:
            $command = Yii::app()->db->createCommand('select id_est from est where id_okr='.$id_est);
            return $command->queryColumn();
        case 4:
            $command = Yii::app()->db->createCommand('select id_est from est');
            return $command->queryColumn();
        }
    /*
     * Возвращает подчиненных первого уровня по известному $id_est
     */
    }
    protected function getAllEstByPid($id_est) {
        $command = Yii::app()->db->createCommand('select id_est from est where pid_est='.$id_est);
        return $command->queryColumn();
    }

    // Метод для поиска подходящих записей
    public function searchForAutocomplete($term)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'id_est, est_name'; // поле, по которому ищем

        //$criteria->addSearchCondition('naim', $term); 
        // Очистка и обрезка ввода
        $safeTerm = trim(strip_tags($term)); // Удаляем HTML/JS-теги
        $safeTerm = CHtml::encode($safeTerm); // Экранируем спецсимволы

        // Поиск только если есть безопасный ввод
        if (empty($safeTerm) || (mb_strlen($safeTerm, 'UTF-8') < 2)) {
            return []; // Возвращаем пустой результат при пустом вводе
        } else {
            $criteria->addSearchCondition('est_name', $safeTerm, true); // `true` для добавления `LIKE %term%`                
        } 

        $criteria->limit = 30; // ограничение количества результатов           
        return $this->findAll($criteria);
    }

    // Преобразование результатов в формат для автодополнения
    public static function getAutocompleteData($term)
    {
        $model = new self;
        $results = $model->searchForAutocomplete($term);

        $data = array();
        foreach($results as $result) {
            $data[] = array(
                'label' => $result->est_name, // что показывать в выпадающем списке
                'value' => $result->est_name, // что подставлять в поле
                'id' => $result->id_est,     // скрытый идентификатор
            );
        }
        return $data;
    }    
}
