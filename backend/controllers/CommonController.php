<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use common\models\Countries;
use common\models\States;
use common\models\Cities;
use backend\components\ParentController;

/**
 * Site controller
 */
class CommonController extends ParentController
{
    //SWITCH THE STATUS - IS_ACTIVE
    public function actionIsActiveStatusChange($id, $modelname, $url, $message){
        $model = $modelname::findOne($id);
        if (isset($model)) {
            $model->is_active = $model->is_active == Yii::$app->params['IS_ACTIVE']['ACTIVE'] ? $model->is_active = Yii::$app->params['IS_ACTIVE']['IN_ACTIVE']: Yii::$app->params['IS_ACTIVE']['ACTIVE'];
            $model->save(false);
            Yii::$app->session->setFlash('success', $message);
            if (!empty($model->parent_id)) {
                return $this->redirect(Yii::$app->urlManager->createUrl([$url, 'id' => $model->parent_id]));
            } else {
                return $this->redirect([$url]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


   /*
   *  GET LIST OF COUNTRIES
   */
   public static function actionGetCountries(){
        return ArrayHelper::map(Countries::find()->all(), 'id', 'name');
   }

   /*
   *  GET LIST OF STATES
   */
   public static function actionGetStates(){
        return ArrayHelper::map(States::find()->all(), 'id', 'name');
   }

   /*
   *  GET LIST OF STATES BY COUNTRY
   */
   public static function actionGetStatesByCountry(){
        $statesArr = ArrayHelper::map(States::find()->where(['country_id'=> Yii::$app->request->post('country_id')])->all(), 'id', 'name');
        return self::getDynamicSelectOptionsHTML($statesArr);
   }

   /*
   *  GET LIST OF CITIES BY STATE
   */
   public static function actionGetCitiesByState(){
        $citiesArr = ArrayHelper::map(Cities::find()->where(['state_id'=> Yii::$app->request->post('state_id')])->all(), 'id', 'name');
        return self::getDynamicSelectOptionsHTML($citiesArr);
   }

   /*
   * GENERATE DYNAMIC DROPDOWN OPTIONS WITH DATA
   */
   public static function getDynamicSelectOptionsHTML($data){
        $returnStr = "";
        foreach ($data as $key => $value) {
            $returnStr .= "<option value='".$key."'>".$value."</option>";
        }
        return json_encode($returnStr);
   }
}