<?php

namespace frontend\widgets;

use common\components\StaticFunctions;
use common\models\Advertise;
use common\models\Languages;
use common\models\Menu;
use common\models\NewsCategory;
use common\models\Post;
use common\models\SearchForm;
use Yii;
use yii\base\Widget;

class Header extends Widget {

    public function run()
    {
        $langs = Languages::find()->all();
        return $this->render('header', [
            'langs' => $langs
        ]);
    }

}