<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 01.11.2018
 * Time: 12:59
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $users \common\models\User[]*/

$this->title = 'Главная страница';
?>
<h1><?= $this->title ?></h1>

<? $form = ActiveForm::begin(['method' => 'post']); ?>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <p style="font-weight: bold;">Информация на странице</p>
            <?= $form->field($model, 'main_page_offer') ?>
            <?= $form->field($model, 'main_page_offer_annotation') ?>
            <?= $form->field($model, 'main_page_text') ?>
            <?= $form->field($model, 'main_page_author')->dropDownList($users) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p style="font-weight: bold;">SEO</p>
            <?= $form->field($model, 'main_page_seo_title') ?>
            <?= $form->field($model, 'main_page_seo_description') ?>
            <?= $form->field($model, 'main_page_seo_keywords') ?>
        </div>
    </div>

    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
    <? ActiveForm::end() ?>

    <div class="buttons-panel">
        <?= Html::a('cancel', Url::to('/admin/modules/partner/builder'), ['class' => 'btn btn-admin']) ?>
        <?= Html::a('На сайте', Url::to('/about'), ['target' => '_blank', 'class' => 'btn btn-admin']) ?>
    </div>
</div>