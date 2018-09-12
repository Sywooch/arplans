<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 12.09.2018
 * Time: 9:53
 */

namespace modules\shop\frontend\controllers;


use modules\shop\models\Service;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ServiceController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView()
    {
        $slug = \Yii::$app->request->get('slug');
        $model = Service::findOne(['slug' => $slug]);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        return $this->render('view', ['model' => $model]);
    }
}