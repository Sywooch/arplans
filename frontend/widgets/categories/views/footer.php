<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 10.10.2018
 * Time: 10:30
 */
/* @var $models \modules\shop\models\Category */
/* @var $services \modules\shop\models\Service */
?>
<section class="section columns">
    <h4 class="title">проекты</h4>
    <ul>
        <? foreach ($models as $model): ?>
            <li><?= \yii\helpers\Html::a($model->name, \yii\helpers\Url::to('/shop/' . $model->slug)) ?></li>
        <? endforeach; ?>
        <? foreach ($services as $service): ?>
            <li><?= \yii\helpers\Html::a($service->name, \yii\helpers\Url::to('/shop/service/' . $service->slug)) ?></li>
        <? endforeach; ?>
        <li><?= \yii\helpers\Html::a('Новинки', \yii\helpers\Url::to('/shop/compilation/new')) ?></li>
        <li><?= \yii\helpers\Html::a('Скидки', \yii\helpers\Url::to('/shop/compilation/discount')) ?></li>
        <li><?= \yii\helpers\Html::a('Бесплатные проекты', \yii\helpers\Url::to('/shop/compilation/free')) ?></li>
    </ul>
</section>
