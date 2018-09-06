<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 12:07
 */

/* @var $model \modules\shop\models\Item */
/* @var $favorites array */
?>

<div class="custom-row-col col-33">
    <div class="project-page--info static">
        <div class="main-data">
            <div class="index"><?= $model->name ?></div>
            <div class="price">
                <div class="current-price"><?= $model->discount ? $model->price - $model->discount : $model->price ?>
                    &#8381;
                </div>
                <? if ($model->discount): ?>
                    <div class="old-price"><?= $model->price ?> руб</div>
                <? endif; ?>
            </div>
        </div>
        <div class="data">
            <div class="data-col">
                <div class="actions">
                    <a class="btn-square-min js-to-cart" data-id="<?= $model->id ?>">Купить проект</a>
                    <a class="icon-liked js-favor <?= array_key_exists($model->id, $favorites) ? 'liked' : '' ?>"
                       data-id="<?= $model->id ?>">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="#icon-heart"/>
                        </svg>
                    </a>
                </div>
                <div class="feature">
                    <i class="icon-feature">
                        <svg xmlns="http://www.w3.org/2000/svg">
                            <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                 xlink:href="#icon-feature"/>
                        </svg>
                    </i>
                    <span>Замена материала стен и зеркальное отображение бесплатно</span>
                </div>
            </div>
            <div class="data-col">
                <div class="info">
                    <i class="icon-sign">i</i>
                    <ul>
                        <li>
                            <span class="head">Жилая:</span>
                            <span class="text"><?= $model->live_area ?> м<sup>2</sup></span>
                        </li>
                        <li>
                            <span class="head">Полезная:</span>
                            <span class="text"><?= $model->useful_area ?> м<sup>2</sup></span>
                        </li>
                        <li>
                            <span class="head">Общая:</span>
                            <span class="text"><?= $model->common_area ?> м<sup>2</sup></span>
                        </li>
                    </ul>
                </div>
                <div class="estimate">
                    <a href="#" class="btn-add"><span>Получить точную смету</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
