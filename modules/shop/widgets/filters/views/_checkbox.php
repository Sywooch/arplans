<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 20.08.2018
 * Time: 14:44
 */

/* @var $catalog \modules\shop\models\Catalog */
?>
<div class="catalog-filters--section show-more-parent show">
    <div class="catalog-filters--head">
        <h3 class="form-title"><?= $catalog->name ?></h3>
        <? $checked = Yii::$app->request->get($catalog->id) ?>
        <span class="show-more"></span>
    </div>
    <div class="catalog-filters--main show-more-hidden" style="display: block;">
        <? if ($catalog->columns_in_filter === 3): ?>
            <? $catalogItemsArray = \common\helpers\FormatHelper::divideArray($catalog->catalogItems, 3) ?>
            <div class="form-row col-lg-3">
                <? foreach ($catalogItemsArray as $catalogItems): ?>
                    <? foreach ($catalogItems as $catalogItem): ?>
                        <? $name = $catalog->id . '[' . $catalogItem->id . ']'; ?>
                        <div class="form-row-element">
                            <div class="check">
                                <label>
                                    <input type="checkbox"
                                           name="<?= $name ?>" <?= isset($checked[$catalogItem->id]) ? 'checked' : '' ?>>
                                    <span><?= $catalogItem->name ?></span>
                                </label>
                            </div>
                        </div>
                    <? endforeach; ?>
                <? endforeach; ?>
            </div>
        <? elseif ($catalog->columns_in_filter === 2): ?>
            <? $catalogItemsArray = \common\helpers\FormatHelper::divideArray($catalog->catalogItems, 2) ?>
            <div class="form-row col-lg-2">
                <? foreach ($catalogItemsArray as $catalogItems): ?>
                    <? foreach ($catalogItems as $catalogItem): ?>
                        <? $name = $catalog->id . '[' . $catalogItem->id . ']'; ?>
                        <div class="form-row-element">
                            <div class="check">
                                <label>
                                    <input type="checkbox"
                                           name="<?= $name ?>" <?= isset($checked[$catalogItem->id]) ? 'checked' : '' ?>>
                                    <span><?= $catalogItem->name ?></span>
                                </label>
                            </div>
                        </div>
                    <? endforeach; ?>
                <? endforeach; ?>
            </div>
        <? else: ?>
            <? foreach ($catalog->catalogItems as $catalogItem): ?>
                <? $name = $catalog->id . '[' . $catalogItem->id . ']'; ?>
                <div class="form-row-element">
                    <div class="check">
                        <label>
                            <input type="checkbox"
                                   name="<?= $name ?>" <?= isset($checked[$catalogItem->id]) ? 'checked' : '' ?>>
                            <span><?= $catalogItem->name ?></span>
                        </label>
                    </div>
                </div>
            <? endforeach; ?>
        <? endif; ?>
    </div>

</div>
