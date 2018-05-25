<?php
namespace backend\controllers;

use Yii;
use common\models\Users;
use common\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\ParentController;
use common\models\ChangePasswordForm;
use common\models\ForgotPasswordForm;
use common\models\ResetPasswordForm;
use common\components\Common;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends ParentController
{
    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param string $id
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
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_add_message'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_update_message'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', Yii::getAlias('@user_delete_message'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * CHANGE PASSWORD
     */
    public function actionChangePassword() {
        $model = new ChangePasswordForm();

        //ajax validation code start
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        // set data into model and validate model
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Get user details
            $usermodel = Users::findOne(Yii::$app->user->id);
            //set password
            $usermodel->password = md5($model->newPassword);
            //save password
            $usermodel->save(false);

            Yii::$app->session->setFlash('success', Yii::getAlias('@user_change_password_message'));
            return $this->refresh();
        } else {
            return $this->render('change_password', compact('model'));
        }
    }

    //FORGOT PASSWORD
    public function actionForgotPassword(){
        $this->layout = 'login';
        $model = new ForgotPasswordForm();

        //ajax validation code start
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        // set data into model and validate model
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            //GET USER'S DATA
            $usersData = Users::findOne(['email'=> $model->email]);
            //CREATE UNIQUE RESET TOKEN
            $usersData->reset_token = Common::getResetToken($usersData['id']);
            //GET EMAIL DATA
            $emailData = $this->setForgotPasswordEmailData($usersData);
            //SEND EMAIL
            Common::sendEmail('forgot-password', $emailData, $emailData['email']);
            //SAVE USERS RESET TOKEN
            $usersData->save();
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_forgot_password_email_message'));
            return $this->refresh();
        }
        
        return $this->render('forgot-password', ['model' => $model]);
    }

    //SET FORGOT PASSWORD EMAIL DATA
    function setForgotPasswordEmailData($data){
        //GET COMMON DATA
        $emailData = Common::setCommonEmailData();
        $emailData['email'] = $data['email'];
        $emailData['reset_password_url'] = Yii::$app->request->hostInfo. Yii::$app->urlManager->createUrl(['users/reset-password', 'token'=>  json_decode($data['reset_token'])->token]);
        return $emailData;
    }

    //RESET PASSWORD
    function actionResetPassword($token){
        $this->layout = 'login';
        $model = new ResetPasswordForm();
        //VERIFY TOKEN
        if(Yii::$app->request->post()['ResetPasswordForm']){
            $postData = Yii::$app->request->post()['ResetPasswordForm'];
            //GET USER'S DATA
            $usersData = ResetPasswordForm::getUsersDataByToken($postData['token']);
            //SAVE NEW PASSWORD
            $usersData->password = md5($postData['password']);
            //NEW PASSWORD SAVE
            $usersData->save();
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_reset_password_message'));
            return $this->redirect(['site/login']);
        }
        else if($model->isResetTokenValid($token)){
            //IF TOKEN IS VALID
            return $this->render('reset-password', compact('model', 'token'));
        }
        else
        {
            //IF USER TRYING TO ACCESS WRONG TOKEN
            Yii::$app->session->setFlash('danger', Yii::getAlias('@user_reset_password_wrong_reset_token_message'));
            return $this->redirect(['site/login']);
        }
    }
}
