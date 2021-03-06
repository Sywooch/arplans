<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 17:13
 */

namespace modules\shop\frontend\controllers;

use modules\content\models\ContentBlock;
use modules\shop\models\Item;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;


class CompilationController extends Controller
{
    public function actionNew()
    {
        $query = Item::find()->where(['is_active' => Item::IS_ACTIVE, 'is_deleted' => Item::IS_NOT_DELETED])->andWhere(['is_new' => 1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $description = ContentBlock::getValue('compilation_new_description');
        $name = ContentBlock::getValue('compilation_new_name');

        return $this->render('compilation', [
            'dataProvider' => $dataProvider,
            'favorites'    => Yii::$app->user->isGuest ? [] : Yii::$app->user->identity->getFavoriteIds(),
            'description'  => $description,
            'name'         => $name,
            'type'         => 'new'
        ]);
    }

    public function actionDiscount()
    {
        $query = Item::find()->where(['is_active' => Item::IS_ACTIVE, 'is_deleted' => Item::IS_NOT_DELETED])->andWhere(['>', 'discount', 1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $description = ContentBlock::getValue('compilation_discount_description');
        $name = ContentBlock::getValue('compilation_discount_name');
        return $this->render('compilation', [
            'dataProvider' => $dataProvider,
            'favorites'    => Yii::$app->user->isGuest ? [] : Yii::$app->user->identity->getFavoriteIds(),
            'description'  => $description,
            'name'         => $name,
            'type'         => 'discount'
        ]);
    }

    public function actionFree()
    {
        $query = Item::find()->where(['is_active' => Item::IS_ACTIVE, 'is_deleted' => Item::IS_NOT_DELETED])->andWhere(['or', ['price' => 0], ['is', 'price', null]]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $description = ContentBlock::getValue('compilation_free_description');
        $name = ContentBlock::getValue('compilation_free_name');
        return $this->render('compilation', [
            'dataProvider' => $dataProvider,
            'favorites'    => Yii::$app->user->isGuest ? [] : Yii::$app->user->identity->getFavoriteIds(),
            'description'  => $description,
            'name'         => $name,
            'type'         => 'free'
        ]);
    }
}