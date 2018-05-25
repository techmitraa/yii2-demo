<?php

namespace backend\components;

use common\models\UserRules;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Users;
use common\models\UserRulesMenu;
use common\models\UserRoles;
use common\components\Common;
use common\models\SmtpSettings;

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ParentController extends Controller {
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    //INIT FUNCTION
    public function init(){
        $userGlobalSessionData=[];
        //GET GLOBAL SETTINGS BY SLUG
        $userGlobalSessionData['globalSettings'] = Common::getGlobalSettingsBySlug('email-notifications');
        //GET CURRENT SMTP DETAILS
        $userGlobalSessionData['currentSMTP'] = SmtpSettings::getSMTPDetailsById($userGlobalSessionData['globalSettings']['current_SMTP']);
        //SET SMTP PASSWORD FROM DB
        $GLOBALS['params']['SPARKPOST_API_KEY'] = $userGlobalSessionData['currentSMTP']['password'];
        //p($GLOBALS['params']);
        return Parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors() {

        $amAccessRules = array(
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'forgot-password', 'reset-password', 'logout'],
                        'allow'   => true,
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                //'logout' => ['post'],
                ],
            ],
        );

        //CHECK USER ALLOWED RULES
        if (!\Yii::$app->user->isGuest) {
            //CALL FUNCTION TO CHECK AND VERIFY USER RULES
            $amAccessRules['access']['rules'][] = [
                    'actions' => explode(',', $this->actionGetVerifyUserRules()),
                    'allow'   => true,
                    'roles'   => ['@'],
                ];
        }
        //p($amAccessRules);
        return $amAccessRules;
    }

    //GET AND VERIFY USER RULES AND IT'S ACTIONS
    protected function actionGetVerifyUserRules(){
        //GET CURRENT CONTROLLER
        $currentController = Yii::$app->controller->id . "Controller";
        //GET USER ROLE
        $userRoleId = Yii::$app->user->identity->user_role_id;
        //GET ALLOWED RULES FROM DB 
        $allowRules = UserRules::getAccessibleRulesByRole(Yii::$app->user->identity->user_role_id);
        //FIND OUT THE CURRENT CONTROLLER - ALLOWED ACTIONS
        $isPermitted = array_search($currentController, array_column($allowRules, 'controller'));
        $allowActions = [];
        //IF CONTROLLER IS PERMITTED THEN GIVE ACTIONS
        if(is_int($isPermitted))
        {
            return $allowRules[$isPermitted]['actions'];
        }
        //RETURN BLANK STRING FOR EXPLODE FUNCTION
        return '';
    }
}
?>