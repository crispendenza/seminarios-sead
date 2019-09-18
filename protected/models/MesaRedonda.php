<?php

/**
 * This is the model class for table "mesa_redonda".
 *
 * The followings are the available columns in table 'mesa_redonda':
 * @property string $id
 * @property string $nome
 * @property string $mediador
 * @property string $seminario_id
 * @property integer $periodo: 1->Manha, 2->Tarde, 3->Manha e Tarde
 *
 * The followings are the available model relations:
 * @property Seminario $seminario
 * @property Palestrante[] $palestrantes
 */
class MesaRedonda extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mesa_redonda';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, mediador, seminario_id, periodo', 'required'),
            array('periodo', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nome, mediador, seminario_id, periodo', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'seminario' => array(self::BELONGS_TO, 'Seminario', 'seminario_id'),
            'palestrantes' => array(self::HAS_MANY, 'Palestrante', 'mesa_redonda_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'mediador' => 'Mediador',
            'seminario_id' => 'Seminario',
            'periodo' => 'Periodo',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('mediador', $this->mediador, true);
        $criteria->compare('seminario_id', $this->seminario_id, true);
        $criteria->compare('periodo', $this->periodo);
        $criteria->order = 'id ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MesaRedonda the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /* retorna string com o período */
    public function getPeriodoString() {
        if ($this->periodo == 1)
            return 'Manhã';
        else if ($this->periodo == 2)
            return 'Tarde';
        else
            return 'Manhã e tarde';
    }
    public function getPeriodoStringById($p){
        if ($p == 1)
            return 'Manhã';
        else if ($p == 2)
            return 'Tarde';
        else
            return 'Manhã e tarde';
        
    }

}
