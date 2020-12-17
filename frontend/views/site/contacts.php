<?php

use common\components\StaticFunctions;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = \common\models\Settings::findOne('title')->getLang('val') . " - " . Yii::t('main', 'contacts');

?>

<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
    <div class="container">
        <div class="row">

            <div class="col-md-12 align-self-center p-static order-2 text-center">

                <h1 class="text-dark font-weight-bold text-8"><?=Yii::t('main','contacts')?></h1>

            </div>

            <div class="col-md-12 align-self-center order-1">

                <ul class="breadcrumb d-block text-center">
                    <li><a href="<?=\yii\helpers\Url::home()?>"><?=Yii::t('main','home')?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="contact-page">

    <div class="container">

        <div class="row py-4">
            <div class="col-lg-6">

                <div class="overflow-hidden mb-1">
                    <h2 class="font-weight-normal text-7 mt-2 mb-0 appear-animation animated maskUp appear-animation-visible" data-appear-animation="maskUp" data-appear-animation-delay="200" style="animation-delay: 200ms;"><strong class="font-weight-extra-bold"><?=Yii::t('main','contact-with-us')?></strong></h2>
                </div>
                <div class="overflow-hidden mb-4 pb-3">
                    <p class="mb-0 appear-animation animated maskUp appear-animation-visible" data-appear-animation="maskUp" data-appear-animation-delay="400" style="animation-delay: 400ms;"><?=\common\models\Settings::findOne('contacts-text')->getLang('val');?></p>
                </div>

                <?php $form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'class' => 'contact-form',
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,
                    'action' => '/site/contact-form'
                ]); ?>

                    <div class="form-row">
                        <div class="form-group col-lg-6">

                            <?= $form->field($model, 'name')->textInput(['placeholder'=>Yii::t('main','name')]) ?>

                        </div>
                        <div class="form-group col-lg-6">
                            <?= $form->field($model, 'phone')->textInput(['placeholder'=>Yii::t('main','phone')]) ?>

                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col">

                            <?= $form->field($model, 'body')->textarea(['rows'=>3,'placeholder'=>Yii::t('main','body')]) ?>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">

                            <?= Html::submitButton( Yii::t('main', 'send'), ['class' => 'btn btn-primary']) ?>

                        </div>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
            <div class="col-lg-6">

                <div class="appear-animation animated fadeIn appear-animation-visible" data-appear-animation="fadeIn" data-appear-animation-delay="800" style="animation-delay: 800ms;">
                    <h4 class="mt-2 mb-1"><?=Yii::t('main','our-address')?></h4>
                    <ul class="list list-icons list-icons-style-2 mt-2">
                        <li><i class="fas fa-map-marker-alt top-6"></i> <strong class="text-dark"><?=Yii::t('main','address')?>:</strong> <?=\common\models\Settings::findOne('address')->getLang('val');?></li>
                        <li><i class="fas fa-phone top-6"></i> <strong class="text-dark"><?=Yii::t('main','our-phone')?>:</strong> <?=\common\models\Settings::findOne('phone')->getLang('val');?></li>
                        <li><i class="fas fa-envelope top-6"></i> <strong class="text-dark"><?=Yii::t('main','email')?>:</strong> <a href="mailto:<?=\common\models\Settings::findOne('email')->getLang('val');?>"><?=\common\models\Settings::findOne('email')->getLang('val');?></a></li>
                    </ul>
                </div>

                <div class="map">
                    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A7a7ebde7b937594396b5416bc596b57d589e5a258f49d6d0ec78f7836cb29d9d&amp;source=constructor" width="100%" height="300" frameborder="0"></iframe>
                </div>

            </div>

        </div>

    </div>

</section>
