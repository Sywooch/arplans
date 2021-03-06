<?php

namespace modules\shop\models;


use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "shop_item".
 *
 * @property string $id
 * @property string $category_id
 * @property string $slug
 * @property string $name
 * @property string $exact_gab
 * @property string $description
 * @property string $build_price
 * @property string $video
 * @property string $project
 * @property string $seo_title
 * @property string $seo_keywords
 * @property string $seo_description
 * @property int $price
 * @property int $discount
 * @property int $image_id
 * @property int $rooms
 * @property int $bathrooms
 * @property int $live_area
 * @property int $common_area
 * @property int $useful_area
 * @property int $one_floor
 * @property int $two_floor
 * @property int $mansard
 * @property int $cellar
 * @property int $oriel
 * @property int $garage
 * @property int $double_garage
 * @property int $tent
 * @property int $terrace
 * @property int $balcony
 * @property int $light2
 * @property int $pool
 * @property int $sauna
 * @property int $gas_boiler
 * @property int $is_new
 * @property int $is_active
 * @property int $is_deleted
 * @property int $sort
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 * @property ItemImage $image
 * @property ItemOption[] $itemOptions
 * @property ItemImage[] $images
 */
class Item extends \yii\db\ActiveRecord
{
    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;

    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    const IS_NEW = 1;

    public $cost;

    public function attributes()
    {
        return array_merge(parent::attributes(), ['cost']);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'category_id'], 'required'],
            [['cost'], 'safe'],
            [['price', 'discount', 'cost'], 'number'],
            [['category_id', 'rooms', 'bathrooms', 'live_area', 'common_area', 'useful_area',
                'one_floor', 'two_floor', 'mansard', 'cellar', 'oriel', 'garage', 'double_garage', 'tent', 'terrace',
                'balcony', 'light2', 'pool', 'sauna', 'gas_boiler', 'is_new', 'is_active', 'is_deleted', 'image_id', 'sort'], 'integer'],
            [['slug', 'name', 'video', 'seo_title', 'seo_keywords', 'seo_description', 'exact_gab'], 'string', 'max' => 255],
            [['description', 'build_price'], 'string'],
            [['slug'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
            [['project'], 'file', 'extensions' => 'png, jpg, gif, pdf'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'category_id'     => 'Категория',
            'slug'            => 'Url',
            'name'            => 'Название',
            'description'     => 'Описание',
            'video'           => 'Видео',
            'seo_title'       => 'Заголовок (SEO)',
            'seo_description' => 'Описание (SEO)',
            'seo_keywords'    => 'Ключевые слова (SEO)',
            'exact_gab'       => 'Точные габариты',
            'project'         => 'Проект',
            'image_id'        => 'Превью',
            'price'           => 'Цена',
            'discount'        => 'Скидка',
            'build_price'     => 'Цена строительства',
            'rooms'           => 'Количество комнат',
            'bathrooms'       => 'Количество санузлов',
            'live_area'       => 'Жилая площадь',
            'common_area'     => 'Общая площадь',
            'useful_area'     => 'Полезная площадь',
            'one_floor'       => 'Один этаж',
            'two_floor'       => 'Два этажа',
            'mansard'         => 'Мансарда',
            'cellar'          => 'Подвал',
            'oriel'           => 'Эркер',
            'garage'          => 'Гараж',
            'double_garage'   => 'Гараж на 2 авто',
            'tent'            => 'Навес',
            'terrace'         => 'Терраса',
            'balcony'         => 'Балкон',
            'light2'          => 'Второй свет',
            'pool'            => 'Бассейн',
            'sauna'           => 'Сауна',
            'gas_boiler'      => 'Газовая котельная',
            'is_new'          => 'Новинка',
            'is_active'       => 'Активен',
            'is_deleted'      => 'Удален',
            'sort'            => 'Сортировка',
            'created_at'      => 'Добавлен',
            'updated_at'      => 'Изменен'
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s', time());
        }
        $this->updated_at = date('Y-m-d H:i:s', time());
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getItemOptions()
    {
        return $this->hasMany(ItemOption::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ItemImage::className(), ['id' => 'image_id']);
    }

    /**
     * @return array|Item[]|\yii\db\ActiveRecord[]
     */
    public function getPhotos()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id'])->andWhere(['type' => ItemImage::TYPE_PHOTO])->all();
    }

    /**
     * @return array|Item[]|\yii\db\ActiveRecord[]
     */
    public function getPlans()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id'])->andWhere(['type' => ItemImage::TYPE_PLAN])->all();
    }

    /**
     * @return array|Item[]|\yii\db\ActiveRecord[]
     */
    public function getReady()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id'])->andWhere(['type' => ItemImage::TYPE_READY])->all();
    }

    public function getCost()
    {
        return ($this->price - $this->discount);
    }

    /**
     * Получаем основное фото товара
     * @param $is_object bool
     * @return string|ItemImage
     */
    public function getMainImage($is_object = false)
    {
        if ($this->image) {
            $image = $this->image;
        } elseif ($this->images) {
            $image = $this->images[0];
        }
        if (isset($image) && $image) {
            return $is_object ? $image : $image->image;
        }
        return null;
    }




    /**
     * @param Category|ActiveRecord $category
     * @param array $get
     * @return ActiveQuery
     */
    public static function getFilteredQuery(Category $category, array $get)
    {
        // Делаем выборку товаров
        $query = Item::find()->alias('i')->select('i.*, (`i`.`price`-`i`.`discount`) as cost')->distinct()
            ->leftJoin(ItemOption::tableName() . ' io', 'i.id=io.item_id')
            ->innerJoin(Category::tableName() . ' cat', 'i.category_id = cat.id')
            ->leftJoin(Catalog::tableName() . ' c', 'cat.id=c.category_id')
            ->where(['i.category_id' => $category->id])
            ->andWhere(['i.is_active' => Item::IS_ACTIVE])
            ->andWhere(['i.is_deleted' => Item::IS_NOT_DELETED]);

        // Фильтруем их по get параметрам
        // Убираем из параметров категорию и страницы
        unset($get['category']);
        unset($get['page']);
        unset($get['per-page']);
        unset($get['slug']);
        unset($get['id']);

        // Этажи
        if (isset($get['floors']) && is_array($get['floors'])) {
            $floors[] = 'or';
            foreach ($get['floors'] as $k => $floor) {
                $floors[] = ['>', 'i.' . $k, 0];
            }
            $query->andWhere($floors);
            unset($get['floors']);
        }

        // Со скидкой
        if (isset($get['discount'])) {
            $query->andWhere(['>', 'i.discount', 0]);
            unset($get['discount']);
        }

        // Новинки
        if (isset($get['is_new'])) {
            $query->andWhere(['i.is_new' => 1]);
        }

        // Бесплатные проекты
        if (isset($get['free'])) {
            $query->andWhere(['i.price' => 0]);
            unset($get['free']);
        }

        // По количеству комнат
        if (isset($get['rooms']) && is_array($get['rooms'])) {
            $rooms[] = 'or';
            foreach ($get['rooms'] as $k => $room) {
                $rooms[] = ['i.rooms' => $k];
            }
            $query->andWhere($rooms);
            unset($get['rooms']);
        }

        // По минимальной площади
        if (isset($get['minarea'])) {
            if ($get['minarea'] != 40) {
                $query->andWhere(['>=', 'i.common_area', intval($get['minarea'])]);
            }
            unset($get['minarea']);
        }

        // по максимальной площади
        if (isset($get['maxarea'])) {
            if ($get['maxarea'] != 300) {
                $query->andWhere(['<=', 'i.common_area', intval($get['maxarea'])]);
            }
            unset($get['maxarea']);
        }
        if (isset($get['sort'])) {
            unset($get['sort']);
        }

        // По остальным параметрам
        $query = self::addConditions($query, $get);

        return $query;
    }

    /**
     * Получаем массив с удобствами
     * @return array
     */
    public function getComfort()
    {
        $comfort = [];
        if ($this->mansard) $comfort[] = 'мансарда';
        if ($this->cellar) $comfort[] = 'подвал';
        if ($this->oriel) $comfort[] = 'эркер';
        if ($this->garage) $comfort[] = 'гараж';
        if ($this->double_garage) $comfort[] = 'гараж на 2 авто';
        if ($this->tent) $comfort[] = 'навес';
        if ($this->terrace) $comfort[] = 'терраса';
        if ($this->balcony) $comfort[] = 'балкон';
        if ($this->light2) $comfort[] = 'второй свет';
        if ($this->pool) $comfort[] = 'бассейн';
        if ($this->sauna) $comfort[] = 'сауна';
        if ($this->gas_boiler) $comfort[] = 'газовая котельная';
        return $comfort;
    }

    /**
     * Добавляем условия по чекбоксам свойств товара к выборке
     * @param ActiveQuery $query
     * @param array $get
     * @return ActiveQuery
     */
    public static function addConditions(ActiveQuery $query, array $get)
    {
        foreach ($get as $key => $item) {
            if (!is_array($item)) {
                $query->andWhere(['>', $key, 0]);
            } else {
                $values = [];
                foreach ($item as $k => $value) {
                    $values[] = $k;
                }
                $query->andWhere(['io.catalog_id' => $key])->andWhere(['in', 'io.catalog_item_id', $values]);
            }
        }
        return $query;
    }

    /**
     * @param $catalog_id
     * @return CatalogItem|mixed|null
     */
    public function getItemOptionCatalogItem(int $catalog_id)
    {
        if ($catalog_id) {
            $io = ItemOption::find()->where(['catalog_id' => $catalog_id, 'item_id' => $this->id])->one();
            /* @var $io ItemOption */
            if ($io) {
                return $io->catalogItem;
            }
        }
        return null;
    }

    /**
     * @param $slug string
     * @return ItemOption|ActiveRecord
     */
    public function getIO($slug)
    {
        return ItemOption::find()->alias('io')
            ->innerJoin(Item::tableName() . ' i', 'io.item_id=i.id')
            ->innerJoin(Catalog::tableName() . ' c', 'io.catalog_id=c.id')
            ->where(['c.slug' => $slug, 'i.id' => $this->id])
            ->andWhere(['or', ['c.category_id' => $this->category_id], ['is', 'c.category_id', null]])
            ->one();
    }

    /**
     * @param $slug
     * @return string
     */
    public function getCatalogValue($slug)
    {
        $io = $this->getIO($slug);
        return $io ? $io->catalogItem->name : '';
    }

    /**
     * Находит активный товар
     * @param $id
     * @return array|null|ActiveRecord|Item
     */
    public static function findActive($id)
    {
        return self::find()->where(['id' => intval($id), 'is_active' => self::IS_ACTIVE, 'is_deleted' => self::IS_NOT_DELETED])->one();
    }

    /**
     * Цена со скидкой
     * @return float
     */
    public function getPrice()
    {
        $price = $this->price - $this->discount;
        return $price >= 0 ? $price : 0;
    }
}
