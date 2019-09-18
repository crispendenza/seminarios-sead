<?php

/**
 * This is the model class for table "inscricao".
 *
 * The followings are the available columns in table 'inscricao':
 * @property string $usuario_id
 * @property string $seminario_id
 * @property string $divulgacao
 * @property string $perfil
 * @property string $tipo_participacao
 * @property string $nome_social
 * @property string $nome_completo
 * @property boolean $periodo_manha
 * @property boolean $periodo_tarde
 * @property boolean $presenca_manha
 * @property boolean $presenca_tarde
 * @property string $tel
 * @property string $instituicao_depto
 * @property string $tel_residencial
 */
class Inscricao extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'inscricao';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('usuario_id, seminario_id, divulgacao, perfil, tipo_participacao, nome_completo, periodo_manha, periodo_tarde, presenca_manha, presenca_tarde, instituicao_depto, tel', 'required'),
            array('nome_social, tel, tel_residencial', 'safe'),
            array('periodo_manha, periodo_tarde, presenca_manha, presenca_tarde', 'boolean'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('usuario_id, seminario_id, divulgacao, perfil, tipo_participacao, nome_social, nome_completo, periodo_manha, periodo_tarde, presenca_manha, presenca_tarde, tel, tel_residencial, instituicao_depto', 'safe', 'on' => 'search'),          
            array('usuario_id', 'UniqueAttributesValidator', 'with'=>'seminario_id', 'message' => 'Você já está cadastrado neste seminário. Por favor, escolha outro.'),
        );
    }


    public function primaryKey() {
        return array('usuario_id', 'seminario_id');
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'usuario_id' => 'Usuário',
            'seminario_id' => 'Seminário',
            'divulgacao' => 'Divulgação',
            'perfil' => 'Perfil',
            'tipo_participacao' => 'Tipo Participação',
            'nome_social' => 'Nome Social',
            'nome_completo' => 'Nome Completo',
            'periodo_manha' => 'Período Manhã',
            'periodo_tarde' => 'Período Tarde',
            'presenca_manha' => 'Presença Manhã',
            'presenca_tarde' => 'Presença Tarde',
            'tel' => 'Celular',
            'instituicao_depto' => 'Instituição/ Departamento',
            'tel_residencial'=> 'Telefone Residência'
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

        $criteria->compare('usuario_id', $this->usuario_id, true);
        $criteria->compare('seminario_id', $this->seminario_id, true);
        $criteria->compare('divulgacao', $this->divulgacao, true);
        $criteria->compare('perfil', $this->perfil, true);
        $criteria->compare('tipo_participacao', $this->tipo_participacao, true);
        $criteria->compare('nome_social', $this->nome_social, true);
        $criteria->compare('nome_completo', $this->nome_completo, true);
        $criteria->compare('periodo_manha', $this->periodo_manha);
        $criteria->compare('periodo_tarde', $this->periodo_tarde);
        $criteria->compare('presenca_manha', $this->presenca_manha);
        $criteria->compare('presenca_tarde', $this->presenca_tarde);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('instituicao_depto', $this->instituicao_depto, true);
        $criteria->compare('tel_residencial', $this->tel_residencial, true);
         $criteria->order = 'usuario_id, seminario_id ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }



    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Inscricao the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    
   
}
