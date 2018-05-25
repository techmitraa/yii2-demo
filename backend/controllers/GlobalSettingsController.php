<?php

namespace backend\controllers;

use Yii;
use common\models\GlobalSettings;
use common\models\GlobalSettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\ParentController;
use app\models\UploadForm;
use yii\web\UploadedFile;
use common\components\Common;

/**
 * GlobalSettingsController implements the CRUD actions for GlobalSettings model.
 */
class GlobalSettingsController extends ParentController
{
    /**
     * Lists all GlobalSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GlobalSettingsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GlobalSettings model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GlobalSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GlobalSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GlobalSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GlobalSettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GlobalSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GlobalSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GlobalSettings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
    *   GET/SET MAINTENANCE MODE
    */
    function actionMaintenanceMode(){
        //GET SAVE DATA
        $globalSettingsModel = GlobalSettings::find()->where(['slug'=> Yii::$app->controller->action->id])->one();
        $globalSettingsModel->scenario = GlobalSettings::SCENARIO_MAINTENANCE_MODE;
        //SAVE ON AJAX REQUEST
        if(Yii::$app->request->isAjax)
        {
            $data= ['is_active'=> Yii::$app->request->post('is_active')];
            $globalSettingsModel->data = json_encode($data, true);
            $globalSettingsModel->save(false);
        }
        else
        {
            $data = json_decode($globalSettingsModel->data);
            return $this->render('maintenance-mode', compact('data'));    
        }
        //NO RESPONSE FOR AJAX
        exit;
    }

    /**
    *  GET/SET EMAIL NOTIFICATIONS
    */
    function actionEmailNotifications(){
        //GET SAVE DATA
        $globalSettingsModel = GlobalSettings::find()->where(['slug'=> Yii::$app->controller->action->id])->one();
        $globalSettingsModel->scenario = GlobalSettings::SCENARIO_EMAIL_NOTIFICATIONS;
        //SAVE ON POST REQUEST
        if(Yii::$app->request->post())
        {
            $globalSettingsModel->data = json_encode(Yii::$app->request->post('GlobalSettings'), true);
            Yii::$app->session->setFlash('success', Yii::getAlias('@email_notifications_update_message'));
            $globalSettingsModel->save(false);
        }
        //GET AND DECODE DATA FOR POPULATE FORM
        $data = json_decode($globalSettingsModel->data);
        return $this->render('email-notifications', compact('globalSettingsModel', 'data'));    
    }

    /**
    *   GET/SET ANALYTICS CODE
    */
    function actionAnalyticsCode(){
        //GET SAVE DATA
        $globalSettingsModel = GlobalSettings::find()->where(['slug'=> Yii::$app->controller->action->id])->one();
        $globalSettingsModel->scenario = GlobalSettings::SCENARIO_ANALYTICS_CODE;
        //SAVE ON POST REQUEST
        if(Yii::$app->request->post())
        {
            $globalSettingsModel->data = json_encode(Yii::$app->request->post('GlobalSettings'), true);
            Yii::$app->session->setFlash('success', Yii::getAlias('@analytics_code_update_message'));
            $globalSettingsModel->save(false);
        }

        //GET AND DECODE DATA FOR POPULATE FORM
        $data = json_decode($globalSettingsModel->data);
        return $this->render('analytics-code', compact('globalSettingsModel', 'data'));       
    }

    /**
    *   GET/SET SITE LOGOS
    */
    function actionSiteLogos(){
        //GET SAVE DATA
        $globalSettingsModel = GlobalSettings::find()->where(['slug'=> Yii::$app->controller->action->id])->one();
        $globalSettingsModel->scenario = GlobalSettings::SCENARIO_SITE_LOGOS;
        //GET AND DECODE DATA FOR POPULATE FORM
        $data = (array)json_decode($globalSettingsModel->data);
        //SAVE ON POST REQUEST
        if(Yii::$app->request->post())
        {

            //HEADER LOGO
            $globalSettingsModel->header_logo = UploadedFile::getInstance($globalSettingsModel, 'header_logo');
            if(!empty($globalSettingsModel->header_logo))
            {
                $actualName = Common::setFileName($globalSettingsModel->header_logo->baseName . time(). '.' . $globalSettingsModel->header_logo->extension);
                $path = Yii::getAlias('@commonFileUploadPath') .'/'. $actualName;
                $data['header_logo'] = $actualName;
                $globalSettingsModel->header_logo->saveAs($path);
            }

            //FOOTER LOGO
            $globalSettingsModel->footer_logo = UploadedFile::getInstance($globalSettingsModel, 'footer_logo');
            if(!empty($globalSettingsModel->footer_logo))
            {
                $actualName = Common::setFileName($globalSettingsModel->footer_logo->baseName .time() . '.' . $globalSettingsModel->footer_logo->extension);
                $path = Yii::getAlias('@commonFileUploadPath') .'/'. $actualName; 
                $data['footer_logo'] = $actualName;
                $globalSettingsModel->footer_logo->saveAs($path);
            }

            //FAVICON ICON
            $globalSettingsModel->favicon_icon = UploadedFile::getInstance($globalSettingsModel, 'favicon_icon');
            if(!empty($globalSettingsModel->favicon_icon))
            {
                $actualName = Common::setFileName($globalSettingsModel->favicon_icon->baseName . '.' . $globalSettingsModel->favicon_icon->extension);
                $path = Yii::getAlias('@commonFileUploadPath') .'/'. $actualName; 
                $data['favicon_icon'] = $actualName;
                $globalSettingsModel->favicon_icon->saveAs($path);
            }

            $globalSettingsModel->data = json_encode($data, true);
            Yii::$app->session->setFlash('success', Yii::getAlias('@site_logos_update_message'));
            $globalSettingsModel->save(false);
        }
        return $this->render('site-logos', compact('globalSettingsModel', 'data'));       
    }
}