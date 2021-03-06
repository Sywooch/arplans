<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 18.10.2018
 * Time: 12:31
 */

/* @var $model array */

use yii\helpers\Html;

?>
<h1>Заявка на добавление поселка</h1>
<h3>Заявитель</h3>
<p>Имя: <?= Html::encode($model['name']) ?></p>
<p>Телефон: <?= Html::encode($model['phone']) ?></p>
<p>Имя: <?= Html::encode($model['mail']) ?></p>

<h3>О поселке</h3>
<p>Название поселка: <?= Html::encode($model['city_name']) ?></p>
<p>Область: <?= Html::encode($model['region']) ?></p>
<p>Ближайший город: <?= Html::encode($model['nearest_city']) ?></p>
<p>Описание поселка: <?= Html::encode($model['description']) ?></p>
<p>Телефон отдела продаж: <?= Html::encode($model['sale_phone']) ?></p>
<p>Сайт отдела продаж: <?= Html::encode($model['sale_url']) ?></p>

<h3>Инженерные сети</h3>
<? if (isset($model['electric'])): ?>
    <p>электричество</p>
<? endif; ?>
<? if (isset($model['gas'])): ?>
    <p>газ</p>
<? endif; ?>
<? if (isset($model['water'])): ?>
    <p>водоснабжение</p>
<? endif; ?>
<? if (isset($model['interner'])): ?>
    <p>интернет</p>
<? endif; ?>

<h3>Инфраструктура</h3>
<? if (isset($model['stores'])): ?>
    <p>магазины</p>
<? endif; ?>
<? if (isset($model['children_club'])): ?>
    <p>детский клуб</p>
<? endif; ?>
<? if (isset($model['sports_center'])): ?>
    <p>спортивно-оздоровительный комплекс</p>
<? endif; ?>
<? if (isset($model['sports_ground'])): ?>
    <p>спортивные площадки</p>
<? endif; ?>
<? if (isset($model['golf_club'])): ?>
    <p>гольф-клуб</p>
<? endif; ?>
<? if (isset($model['beach'])): ?>
    <p>пляж</p>
<? endif; ?>
<? if (isset($model['life_service'])): ?>
    <p>службы быта</p>
<? endif; ?>

    <h3>Безопасность</h3>
<? if (isset($model['territory_control'])): ?>
    <p>охрана территории и подъездов</p>
<? endif; ?>
<? if (isset($model['fire_alarm'])): ?>
    <p>противопожарная сигнализация</p>
<? endif; ?>
<? if (isset($model['security_alarm'])): ?>
    <p>охранная сигнализация</p>
<? endif; ?>

    <h3>Экология</h3>
<? if (isset($model['forest'])): ?>
    <p>лесозона</p>
<? endif; ?>
<? if (isset($model['reservoir'])): ?>
    <p>водоем</p>
<? endif; ?>
