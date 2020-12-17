<?php

$this->title = Yii::t('main','search-result'). " : " .  $model->text . '"';




?>

<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
    <div class="container">
        <div class="row">

            <div class="col-md-12 align-self-center p-static order-2 text-center">

                <h1 class="text-dark font-weight-bold text-8"><?=$this->title?></h1>
                <h3><?=Yii::t('main','result-count')?> : <?=$count?></h3>

            </div>

            <div class="col-md-12 align-self-center order-1">

                <ul class="breadcrumb d-block text-center">
                    <li><a href="<?=\yii\helpers\Url::home()?>"><?=Yii::t('main','home')?></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="single_news_view search-results">
    <div class="container py-4">

        <div class="row">
            <div class="col-lg-3 order-lg-2">
                <?= \frontend\widgets\Sidebar::widget();?>
            </div>
            <div class="col-lg-9 order-lg-1">
                <div class="blog-posts">
                    <?php if(!empty($results)): ?>

                        <?php foreach ($results as $model): ?>

                            <?php if(!empty($model->getLang('id'))):?>

                                <?php
                                if($model->main_image && file_exists(Yii::getAlias('@frontend') . '/web' . Yii::$app->params['uploads_url'] . 'news/' . $model->id . '/l_' . $model->getLang('main_image') )) {

                                    $image = Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . 'news/' . $model->id . '/l_' .  $model->getLang('main_image');

                                } else {

                                    $image = '/images/default/m_post.jpg';

                                }
                                ?>

                                <article class="post post-medium">
                                    <div class="row mb-3">
                                        <div class="col-lg-5">
                                            <div class="post-image">
                                                <a href="<?=\yii\helpers\Url::to(['news/view','id'=>$model->id])?>">
                                                    <img src="<?=$image?>" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="post-content">
                                                <h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2"><a href="blog-post.html"><?=$model->getLang('title')?></a></h2>
                                                <p class="mb-0"><?=$model->getLang('anons')?> [...]</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="post-meta">
                                                <span><i class="far fa-calendar-alt"></i> <?=date('M, d Y', strtotime($model->event_date))?> </span>
                                                <span><i class="far fa-folder"></i> <a href="<?=\yii\helpers\Url::to(['news/by-cat','id'=>$model->category])?>"><?=\common\models\NewsCategory::findOne($model->category)->getLang('name')?></a> </span>
                                                <span class="d-block d-sm-inline-block float-sm-right mt-3 mt-sm-0"><a href="<?=\yii\helpers\Url::to(['news/view','id'=>$model->id])?>" class="btn btn-xs btn-light text-1 text-uppercase"><?=Yii::t('main','read-more')?></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </article>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>
</section>

<?= \frontend\widgets\SectionAnimation::widget();?>
