<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use modules\shop\models\Cart;
use modules\shop\models\Catalog;
use modules\shop\models\Favorite;
use modules\shop\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\Response;

class FavoriteController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->isGuest) {
            $query = Item::find()->alias('i')->select('i.*, (`i`.`price`-`i`.`discount`) as cost')
                ->innerJoin(Favorite::tableName() . ' f', 'f.item_id=i.id')
                ->where(['f.user_id' => \Yii::$app->user->id, 'i.is_active' => Item::IS_ACTIVE, 'i.is_deleted' => Item::IS_NOT_DELETED]);
            $dataProvider = new ActiveDataProvider([
                'query' => $query
            ]);
            $sizeCatalog = Catalog::findOne(['slug' => 'size']);
            return $this->render('index', ['dataProvider' => $dataProvider, 'sizeCatalog' => $sizeCatalog, 'inCart'=>Cart::getInCart()]);
        }
    }

    /**
     * Добавляем/удаляем товар в избранное
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionAdd()
    {
        $addCounter = 0;
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $get = \Yii::$app->request->get();
        $fav = false;
        $message = '';
        $title = '';
        if (!\Yii::$app->user->isGuest) {
            $model = Favorite::find()->where(['item_id' => intval($get['id']), 'user_id' => \Yii::$app->user->id])->one();
            if (!$model && isset($get['fav']) && $get['fav'] === 'true') {
                $model = new Favorite();
                $model->item_id = intval($get['id']);
                $model->user_id = \Yii::$app->user->id;
                if ($model->save()) {
                    $addCounter = 1;
                    $fav = true;
                }
            } else if ($model && isset($get['fav']) && $get['fav'] === 'true') {
                $fav = true;
            } else if ($model && isset($get['fav']) && $get['fav'] === 'false') {
                $model->delete();
                $addCounter = -1;
            }
        }else{
            $title = ' Вы не авторизованы';
            $message = 'После авторизации Вам будет доступна функция добавления понравившихся проектов в подборку для сравнения. <p><a href="/site/login" style="color: #2196f3">Войти</a></p><p><a href="/site/signup" style="color: #2196f3">Зарегистрироваться</a></p>';
        }
        return ['fav' => $fav, 'counter' => $addCounter, 'title'=>$title, 'message'=>$message];
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $id = \Yii::$app->request->get('id');
        if ($id) {
            $model = Favorite::findOne(['item_id' => $id, 'user_id'=>\Yii::$app->user->id]);
            if ($model) {
                $model->delete();
                return ['status' => 'success'];
            }
        }
        return ['status' => 'fail'];
    }
}