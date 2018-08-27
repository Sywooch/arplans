<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.08.2018
 * Time: 11:27
 */

use modules\shop\models\Catalog;

/* @var $category \modules\shop\models\Category */
/* @var  $filters \modules\shop\models\Catalog[] */
?>
<div class="custom-row-col col-sidebar">
    <div class="fixed-scrollbar">
        <div class="fixing">
            <div class="catalog-filters scrolled">
                <form action="/shop/<?= $category->slug ?>">
                    <div class="filter-form">
                        <div class="catalog-filters--section show-more-parent show">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Общая площадь</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden">
                                <div class="form-row-element">
                                    <div class="range">
                                        <div id="keypress" class="range-field"></div>
                                        <div class="range-inputs">
                                            от
                                            <input type="text" id="input-with-keypress-0">
                                            до
                                            <input type="text" id="input-with-keypress-1">
                                            м<sup>2</sup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent show">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Этажность</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden">
                                <div class="form-row">
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="floors[one_floor]" <?= isset($get['floors']['one_floor']) ? 'checked' : '' ?>>
                                                    <span>1-этажные</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="floors[two_floor]" <?= isset($get['floors']['two_floor']) ? 'checked' : '' ?>>
                                                    <span>2-этажные</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="floors[mansard]" <?= isset($get['floors']['mansard']) ? 'checked' : '' ?>>
                                                    <span>с мансардой</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent show">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Количество комнат</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden">
                                <div class="form-row-element">
                                    <div class="radio-flex">
                                        <label>
                                            <input type="checkbox" name="rooms[2]"
                                                   value="2" <?= isset($rooms[2]) ? 'checked' : '' ?>>
                                            <span>2</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" name="rooms[3]"
                                                   value="3" <?= isset($rooms[3]) ? 'checked' : '' ?>>
                                            <span>3</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" name="rooms[4]"
                                                   value="4" <?= isset($rooms[4]) ? 'checked' : '' ?>>
                                            <span>4</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" name="rooms[5]"
                                                   value="5" <?= isset($rooms[5]) ? 'checked' : '' ?>>
                                            <span>5</span>
                                        </label>
                                        <label>
                                            <input type="checkbox" name="rooms[6]"
                                                   value="6" <?= isset($rooms[6]) ? 'checked' : '' ?>>
                                            <span>6+</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog-filters--section show-more-parent show">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Удобства</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden">
                                <div class="form-row">
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="garage" <?= isset($get['garage']) ? 'checked' : '' ?>>
                                                    <span>гараж</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="double_garage" <?= isset($get['double_garage']) ? 'checked' : '' ?>>
                                                    <span>гараж на 2 места</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="light2" <?= isset($get['light2']) ? 'checked' : '' ?>>
                                                    <span>второй свет</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="sauna" <?= isset($get['sauna']) ? 'checked' : '' ?>>
                                                    <span>сауна</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="tent" <?= isset($get['tent']) ? 'checked' : '' ?>>
                                                    <span>навес</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="terrace" <?= isset($get['terrace']) ? 'checked' : '' ?>>
                                                    <span>терасса</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="balcony" <?= isset($get['balcony']) ? 'checked' : '' ?>>
                                                    <span>балкон</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="pool" <?= isset($get['pool']) ? 'checked' : '' ?>>
                                                    <span>бассейн</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="pedestal" <?= isset($get['pedestal']) ? 'checked' : '' ?>>
                                                    <span>с цоколем</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="cellar" <?= isset($get['cellar']) ? 'checked' : '' ?>>
                                                    <span>с подвалом</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <? foreach ($filters as $catalog): ?>
                            <? if ($catalog->view_type === Catalog::VIEW_CHECKBOX): ?>
                                <?= $this->render('_checkbox', ['catalog' => $catalog]) ?>
                            <? endif; ?>
                        <? endforeach; ?>
                        <div class="catalog-filters--section show-more-parent">
                            <div class="catalog-filters--head">
                                <h3 class="form-title">Подборки</h3>
                                <span class="show-more"></span>
                            </div>
                            <div class="catalog-filters--main show-more-hidden" style="display: none;">
                                <div class="form-row">
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="is_new" <?= isset($get['is_new']) ? 'checked' : '' ?>>
                                                    <span>новинки</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="discount" <?= isset($get['discount']) ? 'checked' : '' ?>>
                                                    <span>скидки</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row-col col-50">
                                        <div class="form-row-element">
                                            <div class="check">
                                                <label>
                                                    <input type="checkbox"
                                                           name="free" <?= isset($get['free']) ? 'checked' : '' ?>>
                                                    <span>бесплатно</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="reset">
                            <button type="reset">
                                <span>&times;</span>
                                сбросить фильтр
                            </button>
                        </div>
                        <div class="submit">
                            <button class="btn-square-min">показать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?=$this->render('_js')?>