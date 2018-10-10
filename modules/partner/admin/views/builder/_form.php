<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 19.09.2018
 * Time: 12:10
 */

use common\models\Region;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;


/* @var $model \modules\partner\models\Builder */

$this->title = $model->isNewRecord ? 'Добавление застройщика' : 'Редактирование застройщика';
$viewPostClass = $model->isNewRecord ? 'btn btn-admin disabled' : 'btn btn-admin';
?>
<h1><?= $this->title ?></h1>
<!--Фото товара-->
<div class="images-block" data-type="partner/builder">
    <p style="font-weight: bold">Фото</p>
    <div class="images-panel">
        <? foreach ($model->images as $image): ?>
            <?= $this->render('_image', ['model' => $image]) ?>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
    <form name="uploader" enctype="multipart/form-data" method="POST">
        <div class="upload">
            <?= Html::hiddenInput('type', 1) ?>
            <div class="upload-input">
                <?= Html::fileInput('images[]', '', ['class' => 'item-image-input', 'multiple' => true, 'accept' => 'image/*']) ?>
            </div>
            <div class="upload-button">
                <?= Html::submitButton('Загрузить фото', ['class' => 'btn btn-admin add-photo']) ?>
            </div>
        </div>
    </form>
</div>

<? $form = ActiveForm::begin(['method' => 'post', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="post-form">
    <div class="row">
        <div class="col-md-6">
            <?= Html::hiddenInput('new-images', '', ['class' => 'new-images-input']) ?>
            <?= Html::hiddenInput('new-benefits', '', ['class' => 'new-benefits-input']) ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'is_active')->checkbox() ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-5">
            <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Region::find()->all(), 'id', 'name'), ['prompt' => '']) ?>
            <?= $form->field($model, 'phones') ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'address') ?>
            <?= $form->field($model, 'url') ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6">
            <?= $form->field($model, 'logo')->fileInput(['accept' => 'image/*']) ?>
            <? if ($model->logo): ?>
                <div class="image-admin-preview">
                    <?= Html::img($model->logo, ['class' => 'img-admin']) ?>
                </div>
            <? endif; ?>
        </div>
    </div>
    <div class="project-block">
        <? if ($model->price_list): ?>
            <div class="old-project">
                <p style="font-weight: bold">Прайслист</p>
                <?= Html::a('Скачать', Url::to($model->price_list), ['class' => 'btn btn-admin']) ?>
                <div class="js-show-project-field btn btn-admin">Заменить</div>
            </div>
        <? endif; ?>
        <div class="item-project-field" <?= $model->price_list ? 'style="display:none;"' : '' ?>>
            <?= $form->field($model, 'price_list')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= \frontend\widgets\benefit\Benefit::widget(['model' => $model]) ?>
        </div>
    </div>
    <?= $form->field($model, 'description')->textarea()->widget(Widget::className(), [
        'settings' => [
            'lang'                     => 'ru',
            'minHeight'                => 200,
            'imageUpload'              => Url::to(['builder/image-upload']),
            'imageUploadErrorCallback' => new JsExpression('function (response) { alert("При загрузке произошла ошибка! Максимальная ширина изображения 1200px, высота - 1000px."); }'),
            'buttons'                  => ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'link', 'image'],
            'plugins'                  => [
                'fullscreen',
                'imagemanager',
                'video'
            ],
        ]]) ?>
    <p style="font-weight: bold; margin-top: 30px;">Работы</p>
    <div class="checkbox-panel row">
        <div class="col-sm-4"><?= $form->field($model, 'finishing')->checkbox() ?></div>
        <div class="col-sm-4"><?= $form->field($model, 'santech')->checkbox() ?></div>
        <div class="col-sm-4"> <?= $form->field($model, 'electric')->checkbox() ?></div>
    </div>
    <p style="font-weight: bold; margin-top: 30px;">Строительство домов</p>
    <div class="checkbox-panel row">
        <div class="col-sm-4">
            <?= $form->field($model, 'glued_timber')->checkbox() ?>
            <?= $form->field($model, 'profiled_timber')->checkbox() ?>
            <?= $form->field($model, 'wooden_frame')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'lstk')->checkbox() ?>
            <?= $form->field($model, 'carcass')->checkbox() ?>
            <?= $form->field($model, 'combined')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'brick')->checkbox() ?>
            <?= $form->field($model, 'block')->checkbox() ?>
        </div>
    </div>
    <p style="font-weight: bold; margin-top: 30px;">Материалы</p>
    <div class="checkbox-panel row">
        <div class="col-sm-4">
            <?= $form->field($model, 'wooden')->checkbox() ?>
            <?= $form->field($model, 'stone')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'roof')->checkbox() ?>
            <?= $form->field($model, 'windows')->checkbox() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'stretch_ceiling')->checkbox() ?>
        </div>
    </div>
    <p style="font-weight: bold; margin-top: 30px;">География</p>
    <div class="checkbox-panel">
        <?= $form->field($model, 'surround_region')->checkbox() ?>
        <?= $form->field($model, 'any_region')->checkbox() ?>
    </div>
</div>
<div class="post-form">
    <?= $form->field($model, 'seo_title') ?>
    <?= $form->field($model, 'seo_keywords') ?>
    <?= $form->field($model, 'seo_description') ?>
</div>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-admin save-post']) ?>
<? ActiveForm::end() ?>

<div class="buttons-panel" title="<?= $model->isNewRecord ? 'Застройщик еще не добавлен' : '' ?>">
    <?= Html::a('cancel', Url::to('/admin/modules/partner/builder'), ['class' => 'btn btn-admin']) ?>
    <?= Html::a('На сайте', Url::to('/builder/' . $model->slug), ['target' => '_blank', 'class' => $viewPostClass]) ?>
</div>