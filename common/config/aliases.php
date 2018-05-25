<?php
//if(YII_ENV == 'dev')
//{
	Yii::setAlias('rootBase', '/yii2-demo');
	Yii::setAlias('rootBackendBase', Yii::getAlias('@rootBase').'/');
	Yii::setAlias('commonBase', Yii::getAlias('@rootBackendBase').'/common');
	Yii::setAlias('commonWeb', Yii::getAlias('@rootBackendBase').'/common/web');
	Yii::setAlias('commonImg', Yii::getAlias('@rootBackendBase').'/common/web/img');
	Yii::setAlias('commonFileUploadPath',realpath('../../'.Yii::$app->basePath).'/common/web/img');
//USER ROLES MESSAGES
Yii::setAlias('user_role_add_message', Yii::t('app', 'Role has been added successfully'));
Yii::setAlias('user_role_update_message', Yii::t('app', 'Role has been updated successfully'));
Yii::setAlias('user_role_delete_confirmation_message', Yii::t('app', 'Are you sure, you want to delete this Role?'));
Yii::setAlias('user_role_delete_message', Yii::t('app', 'Role has been deleted successfully'));
Yii::setAlias('user_role_update_status_message', Yii::t('app', 'Role status has been changed successfully'));
//USERS MESSAGES
Yii::setAlias('user_add_message', Yii::t('app', 'User has been added successfully'));
Yii::setAlias('user_update_message', Yii::t('app', 'User has been updated successfully'));
Yii::setAlias('user_delete_confirmation_message', Yii::t('app', 'Are you sure, you want to delete this User?'));
Yii::setAlias('user_delete_message', Yii::t('app', 'User has been deleted successfully'));
Yii::setAlias('user_update_status_message', Yii::t('app', 'User status has been changed successfully'));
Yii::setAlias('user_change_password_message', Yii::t('app', 'Your Password has been changed successfully'));
Yii::setAlias('user_forgot_password_email_message', Yii::t('app', 'Please check your email, it has details to reset your password'));
Yii::setAlias('user_reset_password_message', Yii::t('app', 'Your new password has been set successfully'));
Yii::setAlias('user_reset_password_wrong_reset_token_message', Yii::t('app', 'Your are trying something wrong, please login'));
//COUNTRIES MESSAGES
Yii::setAlias('country_add_message', Yii::t('app', 'Country has been added successfully'));
Yii::setAlias('country_update_message', Yii::t('app', 'Country has been updated successfully'));
Yii::setAlias('country_delete_confirmation_message', Yii::t('app', 'Are you sure, you want to delete this Country?'));
Yii::setAlias('country_delete_message', Yii::t('app', 'Country has been deleted successfully'));
Yii::setAlias('country_update_status_message', Yii::t('app', 'Country status has been changed successfully'));
//STATES MESSAGES
Yii::setAlias('state_add_message', Yii::t('app', 'State has been added successfully'));
Yii::setAlias('state_update_message', Yii::t('app', 'State has been updated successfully'));
Yii::setAlias('state_delete_confirmation_message', Yii::t('app', 'Are you sure, you want to delete this State?'));
Yii::setAlias('state_delete_message', Yii::t('app', 'State has been deleted successfully'));
Yii::setAlias('state_update_status_message', Yii::t('app', 'State status has been changed successfully'));
//CITIES MESSAGES
Yii::setAlias('city_add_message', Yii::t('app', 'City has been added successfully'));
Yii::setAlias('city_update_message', Yii::t('app', 'City has been updated successfully'));
Yii::setAlias('city_delete_confirmation_message', Yii::t('app', 'Are you sure, you want to delete this City?'));
Yii::setAlias('city_delete_message', Yii::t('app', 'City has been deleted successfully'));
Yii::setAlias('city_update_status_message', Yii::t('app', 'City status has been changed successfully'));
//SMTP MESSAGES
Yii::setAlias('smtp_add_message', Yii::t('app', 'SMTP has been added successfully'));
Yii::setAlias('smtp_update_message', Yii::t('app', 'SMTP has been updated successfully'));
Yii::setAlias('smtp_delete_confirmation_message', Yii::t('app', 'Are you sure, you want to delete this SMTP?'));
Yii::setAlias('smtp_delete_message', Yii::t('app', 'SMTP has been deleted successfully'));
Yii::setAlias('smtp_update_status_message', Yii::t('app', 'SMTP status has been changed successfully'));
//GLOBAL SETTINGS
Yii::setAlias('email_notifications_update_message', Yii::t('app', 'Email Notifications has been updated successfully'));
Yii::setAlias('analytics_code_update_message', Yii::t('app', 'Analytics Code has been updated successfully'));
Yii::setAlias('site_logos_update_message', Yii::t('app', 'Site Logos has been updated successfully'));