<?php

/**
 * This is the model class for table "ws25_compet".
 *
 * The followings are the available columns in table 'ws25_compet':
 * @property string $id
 * @property string $id_comp
 * @property string $naim
 * @property integer $jun
 * @property integer $osn
 */
class Ws25_compet extends CActiveRecord
{
    public $id_cat;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ws25_compet';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('naim', 'required'),
            array('id_comp, jun, osn, nov, red, id_cat', 'numerical', 'integerOnly'=>true),
            array('nov, red', 'in','range'=>array(0,1)),
            array('naim', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, naim, jun, osn', 'safe', 'on'=>'search'),
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
            'id' => 'ID',
            'naim' => 'Название',
            'jun' => 'Jun',
            'osn' => 'Osn',
            'id_cat' => 'Категория',
            'nov' => 'Создание новых заявок',
            'red' => 'Редактирование заявок',
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
    public function search($id_comp = null)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;
        if (!empty($id_comp)) {
            $criteria->addCondition('id_comp = :id_comp');
            $criteria->params[':id_comp'] = $id_comp;
        }
        
        /*if (!empty($this->id_cat)) {
            $criteria->addCondition('jun = 1');
        } */       
        
        if ($this->id_cat == 1) {
            $criteria->addCondition('osn = 1');
        }
        if ($this->id_cat == 2) {
            $criteria->addCondition('jun = 1');
        }        

        $criteria->compare('id',$this->id,true);
        $criteria->compare('naim',$this->naim,true);
        //$criteria->compare('jun',$this->jun,false);
        //$criteria->compare('osn',$this->osn);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Ws25_comp the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function get_compet($school, $id_comp, $act) {
        if($school) {
            if($act == 1) return $this->findAll('jun=:jun and id_comp=:id_comp and nov = 1', array(':jun'=>1, ':id_comp'=>$id_comp));
            else return $this->findAll('jun=:jun and id_comp=:id_comp and red = 1', array(':jun'=>1, ':id_comp'=>$id_comp));
        } 
        else {
            if($act == 1) return $this->findAll('osn=:osn and id_comp=:id_comp and nov = 1', array(':osn'=>1, ':id_comp'=>$id_comp));
            else return $this->findAll('osn=:osn and id_comp=:id_comp and red = 1', array(':osn'=>1, ':id_comp'=>$id_comp));          
        }
    }
    
    public function get_compet_cat($id_cat, $id_comp, $act) {
        //if($id_cat == 2) return $this->findAll('jun=:jun and id_comp=:id_comp', array(':jun'=>1, ':id_comp'=>$id_comp));
        //else return $this->findAll('osn=:osn and id_comp=:id_comp', array(':osn'=>1, ':id_comp'=>$id_comp));
        if($id_cat == 2) {
            if($act == 1) return $this->findAll('jun=:jun and id_comp=:id_comp and nov = 1', array(':jun'=>1, ':id_comp'=>$id_comp));
            else return $this->findAll('jun=:jun and id_comp=:id_comp and red = 1', array(':jun'=>1, ':id_comp'=>$id_comp));
        } 
        else {
            if($act == 1) return $this->findAll('osn=:osn and id_comp=:id_comp and nov = 1', array(':osn'=>1, ':id_comp'=>$id_comp));
            else return $this->findAll('osn=:osn and id_comp=:id_comp and red = 1', array(':osn'=>1, ':id_comp'=>$id_comp));          
        }        
    }    
}