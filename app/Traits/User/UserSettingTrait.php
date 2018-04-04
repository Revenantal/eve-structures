<?php

namespace App\Traits\User;

use App\Models\Setting;
use Cache;

trait UserSettingTrait {

    // get setting value
    public function getSetting($name)
    {
        $settings = $this->getCache();
        $value = array_get($settings, $name);
        return ($value !== '') ? $value : NULL;
    }

    // create-update setting
    public function setSetting($name, $value)
    {
        $this->storeSetting($name, $value);
        $this->setCache();
    }

    // create-update multiple settings at once
    public function setSettings($data = [])
    {
        foreach($data as $name => $value)
        {
            $this->storeSetting($name, $value);
        }
        $this->setCache();
    }

    private function storeSetting($name, $value)
    {
        $record = Setting::where(['user_id' => $this->id, 'name' => $name])->first();

        if ($record && $value == null) {
            $record->delete();
        } else if ($record) {
            $record->value = $value;
            $record->save();
        } else if ($value != null) {
            $data = new Setting(['name' => $name, 'value' => $value]);
            $this->setting()->save($data);
        }
    }

    private function getCache()
    {
        if (Cache::has('user_settings_' . $this->id))
        {
            return Cache::get('user_settings_' . $this->id);
        }
        return $this->setCache();
    }

    private function setCache()
    {
        if (Cache::has('user_settings_' . $this->id))
        {
            Cache::forget('user_settings_' . $this->id);
        }
        $settings = $this->setting->pluck('value','name');
        Cache::forever('user_settings_' . $this->id, $settings);
        return $this->getCache();
    }

}