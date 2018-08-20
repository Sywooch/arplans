<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 15:36
 */
?>
<div class="sharing ">
    <div class="title">Поделиться</div>
    <ul>
        <li>
            <a href="https://www.facebook.com/sharer.php?u=<?= Yii::$app->request->getAbsoluteUrl() ?>"
               class="ico ico-fb">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-fb"/>
                </svg>
            </a>
        </li>
        <li>
            <a href="https://plus.google.com/share?url=<?= Yii::$app->request->getAbsoluteUrl() ?>" class="ico ico-gg">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-gg"/>
                </svg>
            </a>
        </li>
        <li>
            <a href="https://vk.com/share.php?url=<?= Yii::$app->request->getAbsoluteUrl() ?>" class="ico ico-vk">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-vk"/>
                </svg>
            </a>
        </li>
        <li>
            <a href="https://connect.ok.ru/offer?url=<?= Yii::$app->request->getAbsoluteUrl() ?>" class="ico ico-ok">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-ok"/>
                </svg>
            </a>
        </li>
    </ul>
</div>
