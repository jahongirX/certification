<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('main', 'Murojaatnomalar');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/plugins/bootstrap-select2/select2.min.js',['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="container-fluid container-fixed-lg m-t-20">

    <div class="panel panel-transparent">

        <div class="panel-body no-padding">

            <div class="panel panel-default">

                <div class="panel-body page-header-block">

                        <h2><?= Html::encode($this->title) ?></h2>

<!--                        --><?//= Html::a( Yii::t('main','Create Reception'), ['create'], ['class' => 'btn btn-success']) ?>


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
                                    'class' => 'yii\grid\SerialColumn',
                                    'contentOptions' => ['class' => 'v-align-middle'],
                                ],

[
                                                'attribute' => 'name',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],


[
                                                'attribute' => 'address',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],
/*[
                                                'attribute' => 'email',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'phone',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'gender',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'birth_date',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'reception_type',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'message',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'file',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'unique_id',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'password',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
[
                                                'attribute' => 'status',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                                'format' => 'html',
                                                'filter' => Html::activeDropDownList($searchModel, 'status', Yii::$app->params['reception_status']['uz'], ['class'=>'full-width', 'data-init-plugin' => 'select2','prompt' => Yii::t('main', 'Barchasi')]),
                                                'value' => function($data){

                                                    $lang = Yii::$app->session->get('lang');
                                                    if(empty($lang)){
                                                        $lang = 'uz';
                                                    }

                                                    $result = "";
                                                    switch ($data->status){
                                                        case 0: $result = "<div class='btn btn-warning btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                        case 1: $result = "<div class='btn btn-info btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                        case 2: $result = "<div class='btn btn-success btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                        case 3: $result = "<div class='btn btn-danger btn-xs'>" . Yii::$app->params['reception_status'][$lang][$data->status] . "</div>"; break;
                                                        default : $result = "<div class='btn btn-warning btn-xs'>" . Yii::t('main','went-wrong') . "</div>";
                                                    }
                                                    return $result;
                                                }
                                            ],
[
                                                'attribute' => 'created_date',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],
/*[
                                                'attribute' => 'reply_text',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'reply_date',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/
/*[
                                                'attribute' => 'reply_file',
                                                'contentOptions' => ['class' => 'v-align-middle'],
                                            ],*/

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
                                                    <a href="/{$controller}/view/{$model->id}" class="btn btn-complete"><i class="fa fa-eye"></i></a>
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

                        <?php  \yii\widgets\ActiveForm::begin(['action' => '/'.Yii::$app->controller->id.'/index']);?>
                        <input type="hidden" id="rm-input" name="rm-input">
                        <input type="submit" id="rm-checked-btn" class="btn" style="float:left" disabled value="Удалить выбранные">
                        <?php  \yii\widgets\ActiveForm::end(); ?>

                    </div>

                    <div class="col-md-6">

                        <?=  \yii\widgets\LinkPager::widget(['pagination' => $dataProvider->pagination])?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

