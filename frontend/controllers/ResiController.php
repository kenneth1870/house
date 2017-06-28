<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Resi;
use frontend\models\ResiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ResiController implements the CRUD actions for Resi model.
 */
class ResiController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Resi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Displays a single Resi model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            ]);
    }

    /**
     * Creates a new Resi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resi();

        if ($model->load(Yii::$app->request->post()) ) {

            //$imageName = time();
            $model->file = UploadedFile::getInstances($model, 'file');
            //  if ($model->upload()) {
            //     // file is uploaded successfully
            //     echo json_encode(['success' => 'file is uploaded successfully']);
            //     return;
            // }
            $path = Yii::getAlias('@web/uploads/');
            // if(!empty($model->file)){
            foreach($model->file as $key => $file) {
                $file->saveAs('uploads/'. $file->baseName . '.' . $file->extension);//Upload files to server
                $model->img .= $path.$file->baseName . '.' . $file->extension.',';//Save file names in database- '**' is for 
            }
        // }

            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                ]);
        }
    }

    public function actionUpload(){

        if (empty($_FILES['file'])) {
            echo json_encode(['error'=>'No files found for upload.']); 
            return; // terminate
        }

// get the files posted
        $file = $_FILES['file'];

// get user id posted
        $userid = empty($_POST['userid']) ? '' : $_POST['userid'];

// get user name posted
        $username = empty($_POST['username']) ? '' : $_POST['username'];

// a flag to see if everything is ok
        $success = null;

// file paths to store
        $paths= [];

// get file names
        $filenames = $file['name'];

// loop and process files
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $target = "uploads" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            if(move_uploaded_file($file['tmp_name'][$i], $target)) {
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }

// check and process based on successful status 
        if ($success === true) {
    // call the function to save all data to database
    // code for the following function `save_data` is not 
    // mentioned in this example
            save_data($userid, $username, $paths);

    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
            $output = [];
    // for example you can get the list of files uploaded this way
    // $output = ['uploaded' => $paths];
        } elseif ($success === false) {
            $output = ['error'=>'Error while uploading file. Contact the system administrator'];
    // delete any uploaded files
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No files were processed.'];
        }

// return a json encoded response for plugin to process successfully
        echo json_encode($output);
    }
    /**
     * Updates an existing Resi model.
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
     * Deletes an existing Resi model.
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
     * Finds the Resi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
