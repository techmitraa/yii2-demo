<?php

namespace common\components;

use Yii;
use yii\helpers\Html;
use common\models\GlobalSettings;

class Common {
	
	/*
     * UPDATE BUTTON TEMPLATE
     */
	public static function templateUpdateButton($url, $model, $customTitle = '') {
        $title = 'Edit';
        //TO CHECK USER IS THE SAME WHO IS LOGGED IN
        $disabledFlag = self::isItMe($model);
        if ($customTitle != '') {
            $title = $customTitle;
        }
        return Html::a('<i class="fa fa-edit"></i> ' . $title, $url, [
                    'title' => $title,
                    'class' => "btn btn-primary waves-effect waves-light $disabledFlag"
        ]);
    }

    /*
    *	DELETE BUTTON TEMPLATE
    */
    public static function templateDeleteButton($url, $model, $confirmmessage = false) {
        //TO CHECK USER IS THE SAME WHO IS LOGGED IN
        $disabledFlag = self::isItMe($model);

        $confirmmessage = $confirmmessage ?: "Are you sure you want to delete it?";
        return Html::a('<i class="fa fa-trash-o"></i> Delete', $url, [
                    'title' => Yii::t('yii', 'Delete'),
                    'class' => "btn btn-danger waves-effect waves-light deleteGlobalButton $disabledFlag",
                    'data-confirm' => $confirmmessage,
                    "data-method" => "post",
                    "data-pjax" => "0"
        ]);
    }

    /*
     * TEMPLATE FOR ACTIVE OR IN-ACTIVE
    */
    public static function templateIsActiveButton($model, $message) {
        $id = $model->id;
        //TO CHECK USER IS THE SAME WHO IS LOGGED IN
        $disabledFlag = self::isItMe($model);
        $modelname = $model->className();
        $url = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
        if ($model->is_active == '1') {
            $confirmmessage = "Are you sure you want to make it In-Active ?";
            return Html::a('<i class="fa fa-times"></i> In-Active', Yii::$app->urlManager->createUrl(['common/is-active-status-change', 'id' => $id, 'modelname' => $modelname, 'url' => $url, 'message' => $message]), [
                        'title' => Yii::t('yii', 'In-Active'),
                        'data-confirm' => $confirmmessage,
                        "data-method" => "post",
                        "data-pjax" => "0",
                        'class' => "btn waves-effect waves-light btn-info confirmOkButton $disabledFlag"
            ]);
        } else {
            $confirmmessage = "Are you sure you want to make it Active ?";
            return Html::a('<i class="fa fa-check"></i> Active', Yii::$app->urlManager->createUrl(['common/is-active-status-change', 'id' => $id, 'modelname' => $modelname, 'url' => $url, 'message' => $message]), [
                        'title' => Yii::t('yii', 'Active'),
                        'data-confirm' => $confirmmessage,
                        "data-method" => "post",
                        "data-pjax" => "0",
                        'class' => "btn waves-effect waves-light btn-info confirmOkButton $disabledFlag"
            ]);
        }
    }
    /*
    *  BULK INSERT 
    */
    public static function bulkInsert($tableName, $columnArray, $valueArray){
        Yii::$app->db->createCommand()
               ->batchInsert(
                     $tableName, $columnArray, $valueArray
                 )
               ->execute();
   }

   /*
   * GET IDENTITY CHECK AND GET USER NAME
   */
   public static function getLoginName(){
        if (!\Yii::$app->user->isGuest) {
            return Yii::$app->user->identity->first_name .' '.Yii::$app->user->identity->last_name;
        }
   }

   /*
   *   IS IT ME OR NOT
   */
   public static function isItMe($model){
        //LOGGED IN USER CAN'T TAKE ACTIONS ON HIS RECORDS
        if(in_array(Yii::$app->controller->id, Yii::$app->params['OWN_RESTRICTIONS'])){
            
            return (($model->id === Yii::$app->user->identity->id) || ($model->id === Yii::$app->user->identity->user_role_id)) ? "inactiveLink" : "";
        }
   }

   /*
   *    SET FILE NAMES - REMOVE SPACE AND SMALLER
   */
   static function setFileName($file)
   {
        return str_replace(' ', "", strtolower($file)); 
   }

   /*
   *  EMAIL SENDING FUNCTION
   */
  static function sendEmail($templateId, $substituteData, $toEmail){
    //EMAIL SEND
    $emailStatus = Yii::$app->mailer->compose()
          ->setTemplateId($templateId)
          ->setSubstitutionData($substituteData)
          ->setTo($toEmail)
          ->send();
  }

  /*
  * GET RESET TOKEN FOR FORGOT PASSWORD
  */
  static function getResetToken($userId){
    return json_encode(['token'=> base64_encode($userId .'#'. time()), 'expire-time'=> date("Y-m-d H:i:s", strtotime('+24 hours'))]);
  }

  /*
  * GET GLOBAL SETTINGS BY SLUG
  */
  static function getGlobalSettingsBySlug($slug){
    //GET DATA BY SLUG
    $globalSettings = GlobalSettings::find()
                      ->asArray()
                      ->all();

    if($slug == 'all')                      
    {
      return $globalSettings;
    }
    else
    {
      //FILTER BY SLUG
      foreach ($globalSettings as $key => $value) {
            if($value['slug'] == $slug)
              return (array)json_decode($value['data']);                        
          }              
    }
  }

  /*
  * SET COMMON EMAIL DATA
  */
  static function setCommonEmailData(){
    //GET USER GLOBAL DATA
    $usersGlobaSessionData = Yii::$app->session->get('userGlobalSessionData')['globalSettings'];
    //SET WEBSITE URL
    $emailData['website_url'] = Yii::$app->request->hostInfo. Yii::$app->homeUrl;
    //LOGO URL
    //$emailData['website_logo'] = Yii::$app->request->hostInfo. Yii::$app->homeUrl;
    $emailData['company_name'] = $usersGlobaSessionData['company_name'];
    $emailData['street_address'] = $usersGlobaSessionData['street_address'];
    $emailData['city'] = $usersGlobaSessionData['city'];
    $emailData['state'] = $usersGlobaSessionData['state'];
    $emailData['zip'] = $usersGlobaSessionData['zip'];
    $emailData['country'] = $usersGlobaSessionData['country'];
    return $emailData;
  }

  //GET SITE LOGOS
  static function getSiteLogos($type)
  {
    $siteLogos = Common::getGlobalSettingsBySlug('site-logos');
    return Yii::getAlias('@commonWeb').'/img/'.$siteLogos[$type];
  }
}