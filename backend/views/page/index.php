<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('main', 'Pages');

$this->params['breadcrumbs']['title'] = $this->title;

?>

<div class="container-fluid container-fixed-lg m-t-20">

    <div class="panel panel-transparent">

        <div class="panel-body no-padding">

            <div class="panel panel-default">

                <div class="panel-body page-header-block">

                    <h2><?= Html::encode($this->title) ?></h2>

                    <?= Html::a(Yii::t('main', 'Create Page'), ['/page/create'], ['class' => 'btn btn-success']) ?>

                </div>
            </div>
        </div>

        <div class="panel-body no-padding">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive">

                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'layout' => '{items}',
                            'tableOptions' => [
                                'class' => 'table table-hover table-striped table-bordered gridview-table'
                            ],
                            'columns' => [
                                [
                                    'headerOptions' => ['style' => 'min-width:55px;max-width:55px;width:55px'],
                                    'contentOptions' => ['class' => 'v-align-middle'],
                                    'content' => function( $model ){
                                        return '<div class="checkbox check-success"><input class="post-check" type="checkbox" name="' . $model->id . '" id="checkbox' . $model->id . '"><label for="checkbox' . $model->id . '"></label></div>';
                                    }
                                ],
                                [
                                    'attribute' => 'title',
                                    'contentOptions' => ['class' => 'v-align-middle'],
                                ],
                                [
                                    'label' => Yii::t('main', 'Image'),
                                    'headerOptions' => ['style' => 'min-width:120px;max-width:120px;width:120px'],
                                    'content' => function($model)
                                    {
                                        if($model->main_image && file_exists(Yii::getAlias('@frontend') . '/web' . Yii::$app->params['uploads_url'] . Yii::$app->controller->id . '/' . $model->id . '/s_' . $model->main_image ))
                                        {

                                            return '<img class="img-responsive postImage" data-title="' . $model->title . '" data-img="' . Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . Yii::$app->controller->id . '/' . $model->id . '/l_' . $model->main_image . '" src="' . Yii::$app->params['frontend'] . Yii::$app->params['uploads_url'] . Yii::$app->controller->id . '/' . $model->id . '/s_' . $model->main_image . '"/>';

                                        } else {

                                            return '<img class="img-responsive"src="' . Yii::$app->params['frontend'] . '/images/default/s_post.jpg"/>';

                                        }
                                    },
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => Yii::t('main', 'Actions'),
                                    'headerOptions' => ['style' => 'text-align:center'],
                                    'template' => '{buttons}',
                                    'contentOptions' => ['style' => 'min-width:150px;max-width:150px;width:150px', 'class' => 'v-align-middle'],
                                    'buttons' => [
                                        'buttons' => function ($url, $model) {
                                            $controller = Yii::$app->controller->id;
                                            $code = <<<BUTTONS
	                                                <div class="btn-group flex-center">
	                                                    <a href="/page/update/{$model->id}" class="btn btn-complete"><i class="fa fa-pencil"></i></a>
	                                                    <a id="page{$model->id}" data-postID="{$model->id}" data-postType="{$controller}" class="btn btn-danger postRemove"><i class="fa fa-trash"></i></a>
	                                                </div>
BUTTONS;
                                            return $code;
                                        }

                                    ],
                                ],
                            ],
                        ]); ?>

                    </div>

                </div>

                <div class="row index-footer">
                    <div class="col-md-6">

                        <?php \yii\widgets\ActiveForm::begin(['action' => '/page/index']);?>
                        <input type="hidden" id="rm-input" name="rm-input">
                        <input type="submit" id="rm-checked-btn" class="btn" style="float:left" disabled value="Удалить выбранные">
                        <?php \yii\widgets\ActiveForm::end(); ?>

                    </div>
                    <div class="col-md-6">

                        <?=\yii\widgets\LinkPager::widget(['pagination' => $dataProvider->pagination])?>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>