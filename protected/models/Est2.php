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
class Est2 extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return Est the static model class
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
            array('id_est, pid_est', 'required'),
            array('pid_est, type_adm, status, cab_status, id_okr, id_raion, id_type', 'numerical', 'integerOnly'=>true),
            array('est_name', 'length', 'max'=>255),
            array('est_name', 'pattern'=>'/^[а-яА-Я0-9№,\.\-\s\"]*$/u', 'message'=>'В названиях можно использовать только буквы кириллицы, цифры, тире, знак номера и кавычки'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_est, pid_est, est_name, type_adm, status, cab_status, id_okr, id_raion, id_type', 'safe', 'on'=>'search'),
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
            'est_name' => 'Est Name',
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
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id_est',$this->id_est);

        $criteria->compare('pid_est',$this->pid_est);

        $criteria->compare('est_name',$this->est_name,true);

        $criteria->compare('type_adm',$this->type_adm);

        $criteria->compare('status',$this->status);

        return new CActiveDataProvider(get_class($this), array(
            'criteria'=>$criteria,
        ));
    }
    /*
     * Возвращает список кабинентов, которые может просматривать пользователь в
     * зависимости от $type_adm
     *      */
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
} 