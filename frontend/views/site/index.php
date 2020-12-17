<?php

$this->title = \common\models\Settings::findOne('title')->getLang('val');

?>

<?= \frontend\widgets\SectionMain::widget();?>
