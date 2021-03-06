<?php

namespace modules\partner\models;

use common\models\Region;

/**
 * This is the model class for table "village".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $address
 * @property string $phones
 * @property string $url
 * @property string $email
 * @property string $price_list
 * @property string $logo
 * @property string $lat
 * @property string $lng
 * @property int $image_id
 * @property int $back_image_id
 * @property int $region_id
 * @property int $electric
 * @property int $gas
 * @property string $description
 * @property string $seo_description
 * @property string $seo_title
 * @property string $seo_keywords
 * @property int $water
 * @property int $internet
 * @property int $gas_boiler
 * @property int $territory_control
 * @property int $fire_alarm
 * @property int $security_alarm
 * @property int $shop
 * @property int $children_club
 * @property int $sports_center
 * @property int $sports_ground
 * @property int $golf_club
 * @property int $beach
 * @property int $life_service
 * @property int $forest
 * @property int $reservoir
 * @property int $is_office
 * @property int $no_page
 * @property int $sort
 *
 * @property Region $region
 * @property VillageImage $image
 * @property VillageImage $background
 * @property VillageBenefit[] $benefits
 * @property VillageImage[] $images
 */
class Village extends \yii\db\ActiveRecord
{
    const IS_ACTIVE = 1;
    const IS_NOT_ACTIVE = 0;

    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    const PAGE_NEED = 0;
    const IS_OFFICE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'village';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'back_image_id', 'region_id', 'sort', 'electric', 'gas', 'water', 'internet', 'gas_boiler', 'territory_control', 'fire_alarm', 'security_alarm', 'shop', 'children_club', 'sports_center', 'sports_ground', 'golf_club', 'beach', 'life_service', 'forest', 'reservoir', 'is_office', 'no_page'], 'integer'],
            [['name', 'slug', 'email', 'address', 'phones', 'url', 'seo_description', 'seo_title', 'seo_keywords'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['slug', 'name'], 'unique'],
            [['lat', 'lng'], 'string', 'max' => 10],
            [['price_list'], 'file'],
            [['logo'], 'file', 'extensions' => 'png, jpg, gif', 'maxSize' => 1024 * 1024 * 3],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'              => 'ID',
            'name'            => 'Название',
            'description'     => 'Описание',
            'seo_description' => 'Описание (SEO)',
            'seo_title'       => 'Заголовок (SEO)',
            'seo_keywords'    => 'Ключевые слова (SEO)',
            'slug'            => 'Slug',
            'address'         => 'Адрес',
            'phones'          => 'Телефоны (через запятую)',
            'url'             => 'Сайт',
            'email'           => 'Email',
            'price_list'      => 'Прайслист',
            'logo'            => 'Логотип',
            'image_id'        => 'Основное изображение',
            'back_image_id'   => 'Фоновое изображение',
            'region_id'       => 'Регион',
            'is_active'       => 'Активен',
            'is_office'       => 'Офис продаж',
            'no_page'         => 'Не создавать страницу',

            'electric'   => 'Электроснабжение',
            'gas'        => 'Газоснабжение',
            'water'      => 'Водоснабжение',
            'internet'   => 'Интернет',
            'gas_boiler' => 'Газовая котельная',

            'territory_control' => 'Охрана территории и подъездов',
            'fire_alarm'        => 'Противопожарная сигнализация',
            'security_alarm'    => 'Охранная сигнализация',

            'shop'          => 'Магазины',
            'children_club' => 'Детский клуб',
            'sports_center' => 'Спортивно-оздоровительный комплекс',
            'sports_ground' => 'Спортивные площадки',
            'golf_club'     => 'Гольф-клуб',
            'beach'         => 'Пляж',
            'life_service'  => 'Служба быта',

            'forest'    => 'Лесозона',
            'reservoir' => 'Водоем',

            'lat'  => 'Широта (в формате 55.555555)',
            'lng'  => 'Долгота (в формате 55.555555)',
            'sort' => 'Сортировка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBenefits()
    {
        return $this->hasMany(VillageBenefit::className(), ['village_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(VillageImage::className(), ['village_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery|VillageImage
     */
    public function getImage()
    {
        return $this->hasOne(VillageImage::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery|VillageImage
     */
    public function getBackground()
    {
        return $this->hasOne(VillageImage::className(), ['id' => 'back_image_id']);
    }

    /**
     * @return VillageImage|string
     * @param $is_object bool
     */
    public function getMainImage($is_object=false)
    {
        if ($this->image) {
            $image = $this->image;
        } elseif ($this->images) {
            $image = $this->images[0];
        }
        if (isset($image) && $image) {
            return $is_object ? $image : $image->file;
        }
        return null;
    }

    /**
     * @return VillageImage|string
     * @param $is_object bool
     */
    public function getBackImage($is_object=false)
    {
        if ($this->background) {
            $image = $this->background;
        } elseif ($this->images) {
            $image = $this->images[0];
        }
        if (isset($image) && $image) {
            return $is_object ? $image : $image->file;
        }
        return null;
    }

    /**
     * @param array $get
     * @return \yii\db\ActiveQuery
     */
    public static function getFilteredQuery(array $get)
    {
        // Делаем выборку товаров
        $query = self::find()->alias('v')->distinct()
            ->andWhere(['v.is_active' => self::IS_ACTIVE])
            ->andWhere(['v.is_deleted' => self::IS_NOT_DELETED])
            ->andWhere(['v.no_page' => self::PAGE_NEED]);

        // Фильтруем их по get параметрам

        // Регион
        if (isset($get['region'])) {
            $query->andWhere(['v.region_id' => intval($get['region'])]);
            unset($get['region']);
        }

        if (isset($get['networks']) && is_array($get['networks'])) {
            $networks[] = 'and';
            foreach ($get['networks'] as $k => $item) {
                $networks[] = ['v.' . $k => 1];
            }
            $query->andWhere($networks);
            unset($get['networks']);
        }

        if (isset($get['safety']) && is_array($get['safety'])) {
            $safety[] = 'and';
            foreach ($get['safety'] as $k => $item) {
                $safety[] = ['v.' . $k => 1];
            }
            $query->andWhere($safety);
            unset($get['safety']);
        }

        if (isset($get['infra']) && is_array($get['infra'])) {
            $infra[] = 'and';
            foreach ($get['infra'] as $k => $item) {
                $infra[] = ['v.' . $k => 1];
            }
            $query->andWhere($infra);
            unset($get['infra']);
        }

        if (isset($get['eco']) && is_array($get['eco'])) {
            $eco[] = 'and';
            foreach ($get['eco'] as $k => $item) {
                $eco[] = ['v.' . $k => 1];
            }
            $query->andWhere($eco);
            unset($get['eco']);
        }

        return $query;
    }
}
