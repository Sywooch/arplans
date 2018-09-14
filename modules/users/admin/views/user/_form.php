<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 09.08.2018
 * Time: 9:32
 */

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $rolesItems array */

/* @var $userRole */

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit ' . $model->username
?>
<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'email') ?>

<div class="form-group">
    <?= Html::label('Пароль', 'password-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('password', '', ['class' => 'form-control', 'id' => 'password-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('Фамилия', 'last_name-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[last_name]', $model->profile ? $model->profile->last_name : '', ['class' => 'form-control', 'id' => 'last_name-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('Имя', 'first_name-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[first_name]', $model->profile ? $model->profile->first_name : '', ['class' => 'form-control', 'id' => 'first_name-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('Отчество', 'patronymic-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[patronymic]', $model->profile ? $model->profile->patronymic : '', ['class' => 'form-control', 'id' => 'patronymic-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('ФИО', 'fio-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[fio]', $model->profile ? $model->profile->fio : '', ['class' => 'form-control', 'id' => 'fio-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('Телефон', 'phone-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[phone]', $model->profile ? $model->profile->phone : '', ['class' => 'form-control', 'id' => 'phone-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('Страна', 'country-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[country]', $model->profile ? $model->profile->country : '', ['class' => 'form-control', 'id' => 'country-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('Город', 'city-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[city]', $model->profile ? $model->profile->city : '', ['class' => 'form-control', 'id' => 'city-field']) ?>
</div>

<div class="form-group">
    <?= Html::label('Адрес', 'address-field', ['class' => 'control-label']) ?>
    <?= Html::textInput('Profile[address]', $model->profile ? $model->profile->address : '', ['class' => 'form-control', 'id' => 'address-field']) ?>
</div>

<?= $form->field($model, 'status')->dropDownList(User::getStatuses()) ?>
<div class="form-group">
    <?= Html::label('User role', 'userRole', ['class' => 'control-label']) ?>
    <?= Html::dropDownList('userRole', $userRole, $rolesItems, ['class' => 'form-control', 'id' => 'userRole']) ?>
</div>

<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-admin']) ?>
</div>
<?php ActiveForm::end(); ?>

