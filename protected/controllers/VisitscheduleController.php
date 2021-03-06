<?php

class VisitscheduleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('view'),
				'roles'=>array('ViewSchedule'),
			),
			array('allow',
				'actions'=>array('create'),
				'roles'=>array('CreateSchedule'),
			),
			array('allow',
				'actions'=>array('update'),
				'roles'=>array('UpdateSchedule'),
			),
			array('allow',
				'actions'=>array('delete'),
				'roles'=>array('DeleteSchedule'),
			),
			array('allow',
				'actions'=>array('index'),
				'roles'=>array('ListSchedules'),
			),
			array('allow',
				'actions'=>array('admin'),
				'roles'=>array('SearchSchedule'),
			),
			array('allow',
				'actions'=>array('calender'),
				'roles'=>array('SearchSchedule'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/**
		Calender view of visitschedule
	**/
	public function actionCalender()
	{
		$model=new Visitschedule('search');
		$model->unsetAttributes();  // clear any default values
		$model->status="Verified";
		if(isset($_GET['Visitschedule']))
			$model->attributes=$_GET['Visitschedule'];

		$this->render('calender',array(
			'model'=>$model,
		));
	}
		
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($fk_propdetail)
	{
		$model=new Visitschedule;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Visitschedule']))
		{
			$client=User::model()->findByAttributes(array('username'=>Yii::app()->user->name));
			$model->attributes=$_POST['Visitschedule'];
			$model->fk_client=$client->id;
			$model->fk_propdetail=$fk_propdetail;
			if($model->save())
				$this->redirect(array('propdetail/admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Visitschedule']))
		{
			$model->attributes=$_POST['Visitschedule'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$client=User::model()->findByAttributes(array('username'=>Yii::app()->user->name));
		if(Yii::app()->user->role!="Admin"){
			$dataProvider=new CActiveDataProvider('Visitschedule', array(
				'criteria'=>array(
					'condition'=>'fk_client='.$client->id,
				),
			));
		}
		else{
			$dataProvider=new CActiveDataProvider('Visitschedule');
		}
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Visitschedule('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Visitschedule']))
			$model->attributes=$_GET['Visitschedule'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Visitschedule the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Visitschedule::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Visitschedule $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='visitschedule-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
