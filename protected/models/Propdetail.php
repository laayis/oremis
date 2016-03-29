<?php

/**
 * This is the model class for table "ent_propdetail".
 *
 * The followings are the available columns in table 'ent_propdetail':
 * @property integer $id
 * @property string $category
 * @property integer $fk_proptype
 * @property string $name
 * @property string $location
 * @property string $description
 * @property integer $fk_owner
 * @property string $value
 * @property string $status
 * @property string $photos
 *
 * The followings are the available model relations:
 * @property User $fkOwner
 * @property Proptype $fkProptype
 * @property Proprecommendation[] $proprecommendations
 * @property Visitschedule[] $visitschedules
 */
class Propdetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ent_propdetail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category, fk_proptype, name, location, description, fk_owner, value, photos', 'required'),
			array('fk_proptype, fk_owner', 'numerical', 'integerOnly'=>true),
			array('category', 'length', 'max'=>4),
			array('name', 'length', 'max'=>50),
			array('location', 'length', 'max'=>100),
			array('value', 'length', 'max'=>20),
			array('status', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, category, fk_proptype, name, location, description, fk_owner, value, status, photos', 'safe', 'on'=>'search'),
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
			'fkOwner' => array(self::BELONGS_TO, 'User', 'fk_owner'),
			'fkProptype' => array(self::BELONGS_TO, 'Proptype', 'fk_proptype'),
			'proprecommendations' => array(self::HAS_MANY, 'Proprecommendation', 'fk_propdetail'),
			'visitschedules' => array(self::HAS_MANY, 'Visitschedule', 'fk_propdetail'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category' => 'Category',
			'fk_proptype' => 'Fk Proptype',
			'name' => 'Name',
			'location' => 'Location',
			'description' => 'Description',
			'fk_owner' => 'Fk Owner',
			'value' => 'Value',
			'status' => 'Status',
			'photos' => 'Photos',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('fk_proptype',$this->fk_proptype);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('fk_owner',$this->fk_owner);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('photos',$this->photos,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Propdetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}