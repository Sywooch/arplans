<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_service".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $time
 * @property string $short_description
 * @property string $description
 * @property string $preview_text
 * @property string $measure
 * @property string $seo_description
 * @property string $seo_title
 * @property string $seo_keywords
 * @property float $price
 * @property int $in_cart
 * @property int $is_active
 * @property int $is_deleted
 * @property int $to_main_menu
 *
 * @property OrderService[] $shopOrderServices
 * @property Order[] $orders
 * @property ServiceImage[] $images
 * @property ServiceFile[] $files
 * @property ServiceBenefit[] $benefits
 */
class Service extends \yii\db\ActiveRecord
{
    const TYPE_IMAGE = 1;
    const TYPE_FILE = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'preview_text'], 'string'],
            [['price'], 'number'],
            [['measure'], 'string', 'max' => 15],
            [['in_cart', 'is_active', 'is_deleted', 'to_main_menu'], 'integer'],
            [['slug', 'name'], 'unique'],
            [['name', 'slug', 'time', 'short_description', 'seo_description', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'name'              => 'Название',
            'preview_text'      => 'Краткое описание',
            'slug'              => 'Url',
            'short_description' => 'Вводный текст',
            'seo_description'   => 'Описание (SEO)',
            'seo_title'         => 'Заголовок (SEO)',
            'seo_keywords'      => 'Ключевые слова (SEO)',
            'description'       => 'Описание',
            'time'              => 'Срок',
            'price'             => 'Цена',
            'measure'           => 'Единица измерения',
            'in_cart'           => 'Отображать в корзине',
            'is_active'         => 'Активна',
            'is_deleted'        => 'Удалена',
            'to_main_menu'      => 'В главное меню',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('shop_order_service', ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ServiceImage::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(ServiceFile::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefits()
    {
        return $this->hasMany(ServiceBenefit::className(), ['service_id' => 'id']);
    }
}
