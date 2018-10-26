<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 25.10.2018
 * Time: 14:37
 */

use yii\helpers\Url;

/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = 'История заказов';

$columns = [
    [
        'class'   => 'yii\grid\SerialColumn',
        'options' => ['style' => 'width:40px'],
    ],
    [
        'label'     => 'Номер заказа',
        'attribute' => 'id',
    ],
    [
        'label'     => 'Дата оформления заказа',
        'attribute' => 'created_at',
        'value'     => function ($model) {
            return date('d m Y', strtotime($model->created_at));
        }
    ],
    [
        'label'   => 'Сумма заказа',
        'format'  => 'html',
        'options' => ['style' => 'width:100px'],
        'value'   => function ($model) {
            return $model->price. 'руб.';
        }
    ],
    [
        'attribute' => 'status',
    ],
];
?>
<div class="section">
    <div class="content content--lg mobile-wide">
        <div class="request--wrap gradient">
            <div class="content content--xs">
                <h1 class="title title-lg"><?= $this->title ?></h1>
                <div class="profile-form">
                    <?= $this->render('_tabs') ?>
                    <?= \yii\grid\GridView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            'rowOptions'   => function ($model, $key, $index, $grid) {
                                return ['onclick' => 'window.location = "' . Url::to(['/profile/order', 'id' => $model->id]) . '"'];
                            },
                            'layout'       => '{items}{pager}',
                            'columns'      => $columns
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>