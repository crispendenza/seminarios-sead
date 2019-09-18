<?php

/**
 * This is the model class for table "seminario".
 *
 * The followings are the available columns in table 'seminario':
 * @property string $id
 * @property string $nome
 * @property string $data
 * @property boolean $periodo_manha
 * @property boolean $periodo_tarde
 *
 * The followings are the available model relations:
 * @property Usuario[] $usuarios
 * @property MesaRedonda[] $mesaRedondas
 */
class Seminario extends CActiveRecord {

    protected function beforeSave() {
        $this->data = date('Y-m-d', strtotime($this->data));
        return TRUE;
    }

    protected function afterFind() {
        $this->data = date('d-m-Y', strtotime($this->data));
        return TRUE;
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'seminario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nome, data, periodo_manha, periodo_tarde', 'required'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nome, data, periodo_manha, periodo_tarde', 'safe', 'on' => 'search'),
            array('data', 'date', 'format' => 'dd-mm-yyyy'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'usuarios' => array(self::MANY_MANY, 'Usuario', 'inscricao(seminario_id, usuario_id)'),
            'mesaRedondas' => array(self::HAS_MANY, 'MesaRedonda', 'seminario_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nome' => 'Nome',
            'data' => 'Data',
            'periodo_manha' => 'Periodo Manha',
            'periodo_tarde' => 'Periodo Tarde',
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
        $criteria->compare('data', $this->data, true);
        $criteria->compare('periodo_manha', $this->periodo_manha);
        $criteria->compare('periodo_tarde', $this->periodo_tarde);
        $criteria->order = 'id ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Seminario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getFullNameById($id) {
        $model = Seminario::model()->findByPk($id);
        return $model->nome;
    }

    /* retorna String com o período do curso */

    public function getPeriodoString($periodos) {

        if ($periodos[0] == 1) {
            if ($periodos[1] == 1)
                return 'Manhã e tarde';
            return 'Manhã';
        }
        if ($periodos[1] == 1)
            return 'Tarde';
    }

    public function getDateString($seminario_id) {
        $model = Seminario::model()->findByPk($seminario_id);
        // $data[0] = dia; [1] = mes; [2] = ano
        $data = explode("-", $model->data);
        switch ($data[1]) {
            case '1' : $data[1] = "Janeiro";
                break;
            case '2' : $data[1] = "Fevereiro";
                break;
            case '3': $data[1] = "Março";
                break;
            case '4': $data[1] = "Abril";
                break;
            case '5': $data[1] = "Maio";
                break;
            case '6': $data[1] = "Junho";
                break;
            case '7': $data[1] = "Julho";
                break;
            case '8': $data[1] = "Agosto";
                break;
            case '9': $data[1] = "Setembro";
                break;
            case '10': $data[1] = "Outubro";
                break;
            case '11': $data[1] = "Novembro";
                break;
            case '12': $data[1] = "Dezembro";
                break;
        }
        return $data[0] . " de " . $data[1] . " de " . $data[2];
    }

}
