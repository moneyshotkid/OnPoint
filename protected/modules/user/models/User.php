<?php

class User extends CActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANED=-1;
	const ROLE_VENDOR='vendor';
	const ROLE_BUDTENDER='budtender';
	const ROLE_MANAGER='manager';
		const ROLE_OWNER='owner';
    const ROLE_DRIVER='driver';
	const ROLE_PATIENT='patient';
    public $role;
	
	/**
	 * The followings are the available columns in table 'users':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $activkey
	 * @var integer $createtime
	 * @var integer $lastvisit
	 * @var integer $superuser
	 * @var integer $status
     *  * @var integer $driverstatus
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return Yii::app()->getModule('user')->tableUsers;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		
		return ((Yii::app()->getModule('user')->isAdmin())?array(
			array('username, password, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email adress already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANED)),
			array('superuser', 'in', 'range'=>array(0,1)),

			array('createtime, lastvisit, superuser, status', 'numerical', 'integerOnly'=>true),
		):((Yii::app()->user->id==$this->id)?array(
			array('username, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('email', 'unique', 'message' => UserModule::t("This user's email adress already exists.")),
		):array(
            array('username, email', 'required'),
            array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
            array('email', 'email'),
            array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
            array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
            array('email', 'unique', 'message' => UserModule::t("This user's email adress already exists.")),
            array('id,username, password, email,status,lat,lon,superuser,createtime,activkey,role,lastcheckin,
            sponsor_id','safe'),
            )));
	}
	
		public static function getRoleOptions()
{
return array(
'owner' => 'Owner',
'vendor' => 'Vendor',
'patient' => 'Patient',
'dispatcher' => 'dispatcher',
    'driver' => 'driver',
);
}


    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {

            $this->createtime=new CDbExpression('NOW()');


        }else {
            $this->lastvisit=new CDbExpression('NOW()');

        }
        return CActiveRecord::beforeSave();
    }


    public function loadUser($id){
        $U=User::model()->findByPk($id);
        $user['username']=$U->username;
        $user['role']=$U->role;
        $user['id']=$U->id;
        return $user;
    }



// class User
    public function getFullName() {
        return $this->username;
    }

    public function getSuggest($q) {
    	$c = new CDbCriteria();
    	$c->addSearchCondition('username', $q, true, 'OR');
    	$c->addSearchCondition('email', $q, true, 'OR');
    	return $this->findAll($c);
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		$relations = array(
			'profile'=>array(self::HAS_ONE, 'Profile', 'user_id'),
            'patient'=>array(self::HAS_ONE, 'Patient', 'id'),
             'vendor'=>array(self::HAS_ONE, 'Vendor', 'id'),
		);
		if (isset(Yii::app()->getModule('user')->relations)) $relations = array_merge($relations,Yii::app()->getModule('user')->relations);
		return $relations;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>UserModule::t("username"),
			'password'=>UserModule::t("password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
			'email'=>UserModule::t("E-mail"),
			'verifyCode'=>UserModule::t("Verification Code"),
			'id' => UserModule::t("Id"),
			'activkey' => UserModule::t("activation key"),
			'createtime' => UserModule::t("Registration date"),
			'lastvisit' => UserModule::t("Last visit"),
			'superuser' => UserModule::t("Owner"),
				'role' => UserModule::t("Role"),
			'status' => UserModule::t("Status"),
            'driverstatus' => UserModule::t("Driver Status"),
					'lat' => UserModule::t("Last visit"),
			'lon' => UserModule::t("Owner"),
				'lastcheckin' => UserModule::t("Role"),
			'sponsor_id' => UserModule::t("Status"),
		);
	}
	
	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactvie'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANED,
            ),
			'budtender'=>array(
                'condition'=>'role='.self::ROLE_BUDTENDER,
            ),
            'patient'=>array(
                'condition'=>'role='.self::ROLE_PATIENT,
            ),
            'vendor'=>array(
                'condition'=>'role='.self::ROLE_VENDOR,
            ),
			   'manager'=>array(
                'condition'=>'role='.self::ROLE_MANAGER,
            ),
            'owner'=>array(
                'condition'=>'role='.self::ROLE_OWNER,
            ),
            'driver'=>array(
                'condition'=>'role='.self::ROLE_DRIVER,
            ),
            'superuser'=>array(
                'condition'=>'superuser=1',
            ),
            'notsafe'=>array(
            	'select' => 'id, username, password, email, activkey, createtime, lastvisit, superuser,role, status,
            	driverstatus,lat,lon,lastcheckin,sponsor_id',
            ),
        );
    }



	public function defaultScope()
    {
        return array(
            'select' => 'id, username, email, createtime, lastvisit, superuser,role, status,lat,lon,lastcheckin,sponsor_id',
        );
    }
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => UserModule::t('Not active'),
				self::STATUS_ACTIVE => UserModule::t('Active'),
				self::STATUS_BANED => UserModule::t('Banned'),
			),
			'AdminStatus' => array(
				'0' => UserModule::t('No'),
				'1' => UserModule::t('Yes'),
			),
            'Role'=>array(
              'owner' => 'Owner',
'vendor' => 'Vendor',
'patient' => 'Patient',
'dispatcher' => 'Dispatcher',
'manager' => 'Manager',
                'driver' => 'Driver',
            ),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
}