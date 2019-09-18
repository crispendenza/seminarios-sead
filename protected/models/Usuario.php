<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $id
 * @property string $cpf
 * @property string $primeiro_nome
 * @property string $sobrenome
 * @property string $email
 * @property string $senha
 * @property string $token
 * @property integer $access_level
 *
 * The followings are the available model relations:
 * @property Seminario[] $seminarios
 */
class Usuario extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'usuario';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('cpf, primeiro_nome, sobrenome, email, senha, token', 'required'),
            array('cpf', 'ext.validators.cpf'),
            array('access_level', 'numerical', 'integerOnly' => true),
            array('cpf', 'length', 'max' => 14),
            array('senha', 'length', 'max' => 34),
            array('token', 'length', 'max' => 150),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, cpf, primeiro_nome, sobrenome, email, senha, access_level, token', 'safe', 'on' => 'search'),
            array('cpf', 'multipleUnique', 'on' => 'insert'),
            array('email', 'multipleUnique', 'on' => 'insert'),
        );
    }

    public function multipleUnique($attribute, $params) {
        $model = Usuario::model()->findByAttributes(array(
            $attribute => $this->$attribute,
        ));
        if (!empty($model)) {
            $this->addError($attribute, 'Este ' . $attribute . ' já existe.');
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'seminarios' => array(self::MANY_MANY, 'Seminario', 'inscricao(usuario_id, seminario_id)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cpf' => 'CPF',
            'primeiro_nome' => 'Primeiro Nome',
            'sobrenome' => 'Sobrenome',
            'email' => 'Email',
            'senha' => 'Senha',
            'access_level' => 'Tipo de Permissão',
            'token' => 'Token',
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
        $criteria->compare('cpf', $this->cpf, true);
        $criteria->compare('primeiro_nome', $this->primeiro_nome, true);
        $criteria->compare('sobrenome', $this->sobrenome, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('senha', $this->senha, true);
        $criteria->compare('access_level', $this->access_level);
        $criteria->compare('token', $this->token);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Usuario the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
