<?php
namespace backend\controllers;

use Yii;
use common\models\UserRoles;
use common\models\UserRolesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\components\ParentController;
use common\components\Common;
use common\models\UserRules;
use common\models\SiteDefaultRules;
use common\models\UserRulesMenu;

/**
 * UserRolesController implements the CRUD actions for UserRoles model.
 */
class UserRolesController extends ParentController
{
    /**
     * Lists all UserRoles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserRolesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserRoles model.
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
     * Creates a new UserRoles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserRoles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //SAVE USER ROLES AND IT'S RULES
            $this->actionBulkSaveUserRules(Yii::$app->request->post('UserRoles')['site_default_rule_id'], $model);
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_role_add_message'));
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserRoles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //DELETE FIRST
            UserRules::deleteUserRulesByRole($model->id);
            //SAVE USER ROLES AND IT'S RULES
            $this->actionBulkSaveUserRules(Yii::$app->request->post('UserRoles')['site_default_rule_id'], $model);
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_role_update_message'));
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserRoles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', Yii::getAlias('@user_role_delete_message'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRoles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserRoles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserRoles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /*
    * Bulk add user roles function
    */
    public function actionBulkSaveUserRules($userRulesArr, $model){
        $columnArr=['user_role_id', 'user_rule_menu_id'];
        $valueArr=[];
        //ADD SELECTED RULES TO THE ROLE
        foreach ($userRulesArr as $key => $value) {
            $valueArr[] = [$model->id, $value];
            //FIND AND ADD SUB MENUS TO THE ROLE
            foreach (UserRulesMenu::getChildMenu($value)as $k => $val) {
                $valueArr[] = [$model->id, $val];
            }
        }
        //ADD COMMON RULES - STATIC AND IN ACTIVE
        $commonRules = SiteDefaultRules::getDefaultRules(Yii::$app->params['IS_ACTIVE']['IN_ACTIVE']);
        foreach ($commonRules as $key => $value) {
            $valueArr[] = [$model->id, $value];
        }
        Common::bulkInsert('user_rules', $columnArr, $valueArr);
    }
}
