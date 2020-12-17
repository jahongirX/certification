<?php

namespace backend\controllers;

use common\components\StaticFunctions;
use Yii;
use common\models\Reception;
use common\models\ReceptionSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\components\Controller;
use yii\web\UploadedFile;

class ReceptionController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        if(Yii::$app->request->post()){
            $items = Yii::$app->request->post()['rm-input'];
            $items = explode(',', $items);
            for($i = 0; $i < count($items) - 1;$i++){
                if($items[$i] != null)
                Reception::findOne($items[$i])->delete();
            }
        }

        $searchModel = new ReceptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['created_date'=>SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $model = Reception::findOne($id);
        if(!empty($model) && $model->status == 0){
            $model->status = 1;
            $model->save();
        }
        return $this->render('view', [
            'model' => $model
        ]);
    }




    protected function findModel($id)
    {
        if (($model = Reception::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAnswer($id){
        $model = $this->findModel($id);
        $file_old = $model->reply_file;
        if(!empty($model)){

            if($model->load(Yii::$app->request->post())){
                $file =  UploadedFile::getInstance($model, 'reply_file');
                $model->status = 2;
                date_default_timezone_set('Asia/Tashkent');
                $model->reply_date = date("Y-m-d H:i:s");
                if($file){
                    $model->reply_file = StaticFunctions::saveFile($file, $model->id, 'reception');
                    StaticFunctions::deleteFile($file_old, $model->id,'reception');
                }else{
                    $model->reply_file = $file_old;
                }

                if($model->save()){
                    return $this->redirect(['view','id'=>$model->id]);
                }else{
                    return print_r($model->errors);
                }
            }

            return $this->render('answer',[
                'model' => $model
            ]);
        }
    }

    public function actionDecline($id){
        $model = $this->findModel($id);
        $file_old = $model->reply_file;
        if(!empty($model)){

            if($model->load(Yii::$app->request->post())){
                $file =  UploadedFile::getInstance($model, 'reply_file');
                $model->status = 3;
                date_default_timezone_set('Asia/Tashkent');
                $model->reply_date = date("Y-m-d H:i:s");
                if($file){
                    $model->reply_file = StaticFunctions::saveFile($file, $model->id, 'reception');
                    StaticFunctions::deleteFile($file_old, $model->id,'reception');
                }else{
                    $model->reply_file = $file_old;
                }

                if($model->save()){
                    return $this->redirect(['view','id'=>$model->id]);
                }else{
                    return print_r($model->errors);
                }
            }

            return $this->render('decline',[
                'model' => $model
            ]);
        }
    }
}
