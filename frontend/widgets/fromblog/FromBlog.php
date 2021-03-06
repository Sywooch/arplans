<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 30.08.2018
 * Time: 15:15
 */

namespace frontend\widgets\fromblog;


use common\models\Post;
use common\models\Tag;
use yii\base\Widget;

class FromBlog extends Widget
{
    public $viewName = 'index';
    public $limit = 10;

    public function run()
    {
        $models = Post::find()->where(['status' => Post::STATUS_PUBLISHED, 'on_main' => 1])->all();
        $tags = Tag::find()->alias('t')
            ->joinWith('posts')
            ->where(['status' => Post::STATUS_PUBLISHED])->limit($this->limit)->all();
        $content = $this->render($this->viewName, ['models' => $models, 'tags' => $tags]);
        return $content;
    }
}