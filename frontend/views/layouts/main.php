<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="termiziy.uz - <?=\common\models\Settings::findOne('title')->getLang('val');?>" >
    <title><?= Html::encode($this->title) ?></title>

    <?= Html::csrfMetaTags() ?>

    <?php $this->head() ?>

</head>

<body class="unsticky-header">

    <?php $this->beginBody() ?>

    <?= \frontend\widgets\Header::widget();?>

    <div class="wrapper">

            <?= $content;?>

    </div>

    <?= \frontend\widgets\Footer::widget();?>

    <?php $this->endBody() ?>

    
</body>

</html>

<?php $this->endPage() ?>
