<?php

namespace app\controllers;

use Yii;
use app\models\Messages;
use app\models\MessagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * MessagesController implements the CRUD actions for Messages model.
 */
class MessagesController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','update','delete','create','changestatus'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Messages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Messages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
        $id = Messages::find()->max('id');
        $message = Null;
        $result = array();
        if ($id) {
            $message = $this->findModel($id);    
        }
        if($message) {
            $result['status'] = 'success';
            $result['type'] = $message->type;
            $result['attachement'] = $message->attachement;
            $result['message'] = $message->message;
            $result['createdAt'] = $message->created_at;
        } else {
            $result['status'] = 'fail';
        }
        return json_encode($result);
    }

    /**
     * Creates a new Messages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Messages();

        if ($model->load(Yii::$app->request->post())) {
            if (UploadedFile::getInstance($model, 'attachement') && ($model->type == 2 || $model->type == 3 || $model->type == 4)) {
                // get the uploaded file instance. for multiple file uploads
                // the following data will return an array
                $image = UploadedFile::getInstance($model, 'attachement');
     
                // store the source file name
                $model->attachement = $image->name;
                $ext = end((explode(".", $image->name)));
                if($model->type == 4 && $ext != "jpg" && $ext != 'png' && $ext != 'jpeg') {
                    $model->attachement = Null;
                    $model->addError('attachement', 'You have uploaded wrong file. Only .jpg, .jpeg and .png are supported.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);    
                }else if($model->type == 6 && $ext != 'pdf' && $ext != 'wav' && $ext != 'pdf') {
                    $model->attachement = Null;
                    $model->addError('attachement', 'You have uploaded wrong file. Only .pdf, are supported.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
				else if($model->type == 3 && $ext != 'mp3' && $ext != 'wav' && $ext != 'ogg') {
                    $model->attachement = Null;
                    $model->addError('attachement', 'You have uploaded wrong file. Only .mp3, .wav and .ogg are supported.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
							
				else if($model->type == 2 && $ext != 'webm' && $ext != 'mp4' && $ext != '3gp') {
                    $model->attachement = Null;
                    $model->addError('attachement', 'You have uploaded wrong file. Only .webm, .mp4 with H.264 profile and .3gp are supported.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
                    // generate a unique file name
                    $model->attachement = Yii::$app->security->generateRandomString().".{$ext}";
         
                    // the path to save file, you can set an uploadPath
                    // in Yii::$app->params (as used in example below)
                    $path = Yii::$app->params['uploadPathDir'] . $model->attachement;
                    $image->saveAs($path);
                
            }else if (UploadedFile::getInstance($model, 'attachement') && ($model->type == 1 || $model->type == 5)) {
                $model->addError('attachement', 'You have uploaded some file for text message. It wont be shown even if you upload.');
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->created_at = date('U');
 
            if($model->save()){
                return $this->goHome();
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Messages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Messages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Messages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Messages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Messages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
