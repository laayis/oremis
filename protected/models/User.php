<?php

/**
 * This is the model class for table "ent_user".
 *
 * The followings are the available columns in table 'ent_user':
 * @property integer $id
 * @property string $usrtype
 * @property string $fullname
 * @property string $username
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property string $regdate
 *
 * The followings are the available model relations:
 * @property Propdetail[] $propdetails
 * @property Proprequirement[] $proprequirements
 * @property Visitschedule[] $visitschedules
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ent_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usrtype, fullname, username, address, phone, email, password, regdate', 'required'),
			array('usrtype', 'length', 'max'=>14),
			array('fullname', 'length', 'max'=>50),
			array('username', 'length', 'max'=>20),
			array('address, email', 'length', 'max'=>40),
			array('phone', 'length', 'max'=>10),
			array('password', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usrtype, fullname, username, address, phone, email, regdate', 'safe', 'on'=>'search'),
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
			'propdetails' => array(self::HAS_MANY, 'Propdetail', 'fk_owner'),
			'proprequirements' => array(self::HAS_MANY, 'Proprequirement', 'fk_client'),
			'visitschedules' => array(self::HAS_MANY, 'Visitschedule', 'fk_client'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usrtype' => 'User Type',
			'fullname' => 'Full Name',
			'username' => 'Username',
			'address' => 'Address',
			'phone' => 'Phone',
			'email' => 'Email',
			'password' => 'Password',
			'regdate' => 'Registration Date',
			'newpwd' => 'New Password',
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
		$criteria->compare('usrtype',$this->usrtype,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('regdate',$this->regdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
