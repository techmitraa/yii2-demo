<?php

namespace common\models;

class GlobalSettings extends \common\models\base\GlobalSettingsBase
{
	public $from_name, $from_email, $current_SMTP;
	public $company_name, $street_address, $city, $state, $zip, $country;
	public $google_analytics;
	public $header_logo, $footer_logo, $favicon_icon;
    const SCENARIO_MAINTENANCE_MODE = 'maintenance-mode';
	const SCENARIO_EMAIL_NOTIFICATIONS='email-notifications';
	const SCENARIO_ANALYTICS_CODE= 'analytics-code';
	const SCENARIO_SITE_LOGOS = 'site-logos';

	//BEFORE SAVE ACTION
	public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {
            $this->created_at = date('Y-m-d H:i:s'); 
        }
        else
        {
        	$this->updated_at = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }
	/**
	* @inheritdoc
	*/
	public function rules()
	{
        return [
            [['slug', 'type', 'data'], 'required'],
            [['data'], 'required', 'on'=> self::SCENARIO_MAINTENANCE_MODE],
            [['from_name', 'from_email', 'company_name', 'street_address', 'city', 'state', 'zip', 'country'], 'required', 'on'=> self::SCENARIO_EMAIL_NOTIFICATIONS],
            ['from_email', 'email'],
            [['google_analytics'], 'required', 'on'=> self::SCENARIO_ANALYTICS_CODE],
            /*[['header_logo', 'footer_logo', 'favicon_icon'], 'required', 'on'=> self::SCENARIO_SITE_LOGOS],*/
            [['header_logo', 'footer_logo', 'favicon_icon'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'on'=> self::SCENARIO_SITE_LOGOS],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['slug', 'type'], 'string', 'max' => 255],
        ];
	}    
}