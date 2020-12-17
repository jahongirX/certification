<?php

namespace frontend\widgets;

use common\models\Advertise;
use yii\base\Widget;
use common\models\Menu;

class Footer extends Widget {

    public function run()
    {
        return $this->render('footer', [
        ]);
    }

}
