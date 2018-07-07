<?php

namespace app\controllers;

use app\models\EatAppleForm;
use app\repositories\AppleRepository;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * AppleController implements the CRUD actions for Apple model.
 */
class AppleController extends BaseController
{
    /**
     * @var AppleRepository
     */
    private $apple;


    public function init()
    {
        $this->apple = new AppleRepository();

        parent::init();
    }

    /**
     * Creates a new Apple models.
     * If creation is successful, the browser will be redirected to the 'home' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->apple->createRand();

        Yii::$app->getSession()->setFlash('success', 'Apples successfully created');

        return $this->redirect(['site/index']);
    }

    /**
     * Creates a new Apple models.
     * If creation is successful, the browser will be redirected to the 'home' page.
     * @return mixed
     */
    public function actionClear()
    {
        $this->apple->clear();

        Yii::$app->getSession()->setFlash('success', 'Apples successfully cleared');

        return $this->redirect(['site/index']);
    }

    /**
     * @param $id
     * @return Response
     */
    public function actionDown($id)
    {
        $model =  $this->apple->getByPK($id);

        $this->ensureExist($model);

        if($this->apple->down($model)){
            Yii::$app->getSession()->setFlash('success', 'The apple fell to the ground.');
        }else{
            Yii::$app->getSession()->setFlash('error', 'The apple is already on the ground.');
        }

        return $this->redirect(['site/index']);
    }

    /**
     * @return array|Response
     */
    public function actionEat()
    {
        $model = new EatAppleForm();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->eat();
            return $this->goBack(['site/index']);
        }

        return $this->redirect(['site/index']);
    }
}
