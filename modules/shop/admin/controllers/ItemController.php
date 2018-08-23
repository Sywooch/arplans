<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 11:16
 */

namespace modules\shop\admin\controllers;


use Imagine\Image\Box;
use modules\admin\controllers\AdminController;
use modules\shop\models\Item;
use modules\shop\models\ItemImage;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class ItemController extends AdminController
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class'        => AccessControl::className(),
            'denyCallback' => function ($rule, $action) {
                return $this->redirect('/');
            },
            'rules'        => [
                [
                    'actions' => [],
                    'allow'   => true,
                    'roles'   => [
                        'shop_item',
                    ],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * Вывод списка товаров
     * @return string
     */
    public function actionIndex()
    {
        $query = Item::find();
        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'sort'  => [
                    'defaultOrder' => [
                        'id' => SORT_ASC
                    ]
                ],
            ]
        );
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    /**
     * Создание нового товара
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();
        return $this->modify($model);
    }

    /**
     * Редактирование товара
     * @param $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $this->modify($model);
    }

    /**
     * @param $model Item
     * @return string|Response
     */
    public function modify($model)
    {
        $post = Yii::$app->request->post();

        if ($model->load($post)) {
            if ($model->save()) {
                if (isset($post['new-images'])) {
                    $newImages = explode(':', $post['new-images']);
                    foreach ($newImages as $newImage) {
                        if ($newImage) {
                            $image = new ItemImage();
                            $image->item_id = $model->id;
                            $image->image = $newImage;
                            if (!$image->save()) {
                                throw new Exception('Ошибка сохранения изображения');
                            };
                        }
                    }
                }
                if (!$model->image_id) {
                    $model->image_id = $model->images ? $model->images[0]->id : null;
                    $model->save();
                }
                Yii::$app->session->setFlash('success', 'Товар добавлен успешно');
            } else {
                Yii::$app->session->setFlash('danger', 'Ошибка при создании категории');
            }
            return $this->redirect(Url::to(['item/update', 'id' => $model->id]));
        }

        return $this->render('_form', [
            'model' => $model,
        ]);
    }

    /**
     * Загрузка фото по ajax
     * @return array
     */
    public function actionUpload()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new ItemImage();
        $image = UploadedFile::getInstance($model, 'image');
        if ($image && $image->tempName) {
            $model->image = $image;
            if ($model->validate(['image'])) {
                $dir = Yii::getAlias('@webroot/uploads/shop/item/');
                $path = date('ymdHis') . '/';
                \common\models\Image::createDirectory($dir . $path);
                $fileName = $model->image->baseName . '.' . $model->image->extension;
                $model->image->saveAs($dir . $path . $fileName);
                $model->image = '/uploads/shop/item/' . $path . $fileName;
                $photo = Image::getImagine()->open($dir . $path . $fileName);
                $photo->thumbnail(new Box(900, 900))->save($dir . $path . $fileName, ['quality' => 90]);
                if (file_exists($dir . $path . $fileName)) {
                    return ['status' => 'success', 'file' => $model->image, 'block' => $this->renderAjax('_image', ['model' => $model])];
                }
            }
        }
        return ['status' => 'fail', 'message' => ' Ошибка при загрузке изображения'];
    }

    /**
     * Удаление картинки товара через ajax
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDeleteImage()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $get = Yii::$app->request->get();
        if (intval($get['id'])) {
            $model = ItemImage::findOne(['id' => $get['id']]);
            $item = Item::find()->where(['image_id' => $get['id']])->one();
            if ($model) {
                $fileName = Yii::getAlias('@webroot') . $model->image;
                if (file_exists($fileName)) {
                    unlink($fileName);
                }
                $thumbName = Yii::getAlias('@webroot') . $model->thumb;
                if (file_exists($thumbName)) {
                    unlink($thumbName);
                }
                $model->delete();
                if ($item) {
                    $item->image_id = null;
                    $item->save();
                }
            } else {
                return ['status' => 'fail', 'message' => 'Ошибка при удалении изображеия'];
            }
        } elseif (isset($get['file'])) {
            $fileName = Yii::getAlias('@webroot') . $get['file'];
            unlink($fileName);
        }
        return ['status' => 'success'];
    }

    /**
     * Устанавливает через ajax основное фото для товара
     * @return array
     */
    public function actionSetPreview()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $id = Yii::$app->request->get('id');
        $model = ItemImage::findOne(['id' => $id]);
        if ($model) {
            $item = $model->item;
            if ($item) {
                $item->image_id = $model->id;
                if ($item->save()) {
                    return ['status' => 'success'];
                }
            }
        }
        return ['status' => 'fail'];
    }


    /**
     * @param $id
     * @return Item|null
     * @throws NotFoundHttpException
     */
    public function findModel($id)
    {
        if (($model = Item::find()->where(['id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}