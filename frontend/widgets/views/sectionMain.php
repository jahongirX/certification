<?php

use yii\widgets\ActiveForm;
if(Yii::$app->session->hasFlash('refresh')){

    $url = \yii\helpers\Url::to(['site/download-pdf']);

    $this->registerMetaTag([
        'http-equiv' => 'refresh',
        'content' => "0;$url"
    ]);
}
?>
<section class="mb-3">
    <div class="container">
        <div class="card-box portal-info">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-9">
                    <h3 class="text-center">
                        Система выдачи онлайн сертификатов участникам конференции «Менять мышление: МВА или стандарты ISO по системам управления?»
                    </h3>
                </div>
            </div>
        </div>

        <div class="card-box" id="offerta">
            <div class="row">
                <div class="col-md-12">

                    <div class="entry-content">

                        Уважаемые участники конференции «Менять мышление: МВА или стандарты ISO по системам управления?»
                        Для получения электронного сертификата об участии на конференции, пожалуйста внесите свое <em>имя и фамилию на кириллице</em>,
                        а также ваше <em> электронную почту </em>, которую указали во время регистрации и нажмите кнопку «Скачать сертификат».

                        Заказать оригинал сертификата вы сможете в разделе <a href="https://certgroup.org/kursi-i-sertifikati/" target="_blank">«Курсы и сертификаты»</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="card-box">
            <div class="row">
                <div class="col-md-12">

                    <div class="entry-content">

                        <?php
                        $form = ActiveForm::begin([
                                'action' => \yii\helpers\Url::to(['/site/check-for-pdf']),
                                'id' => 'reception-form',
                                'enableAjaxValidation' => false,
                                'enableClientValidation' => true,
                        ]); ?>

                        <div class="row">

                            <?php if(Yii::$app->session->hasFlash('error')): ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger">
                                        <?= Yii::$app->session->getFlash('error'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(Yii::$app->session->hasFlash('success')): ?>
                                <div class="col-md-12">
                                    <div class="alert alert-success mb-3">
                                        <?= Yii::$app->session->getFlash('success'); ?>
                                    </div>
                                    <div class="row justify-content-center no-gutters mb-3">
                                        <div class="col-md-3">
                                            <a href="<?=\yii\helpers\Url::to(['site/download-pdf'])?>" class="btn btn-block btn-info"><i class="mdi-file-pdf"></i> Скачать Сертификат</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-12"></div>


                            <div class="col-md-6">

                                <?= $form->field($model, 'fio')->textInput() ?>

                            </div>

                            <div class="col-md-6">

                                <?= $form->field($model, 'email')->textInput() ?>

                            </div>

                            <div class="col-md-12">

                                <button class="btn btn-success btn-wave btn-block btn-lg"><?=Yii::t('main','Получить сертификат')?></button>

                            </div>

                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>

                </div>
            </div>
        </div>

    </div>
</section>