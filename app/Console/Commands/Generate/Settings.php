<?php

namespace App\Console\Commands\Generate;

use App\Console\Commands\TitanshopCommand;
use App\Models\Setting;
use App\Models\SettingGroup;
use App\Models\SettingGroupI18n;
use App\Models\SettingI18n;
use Illuminate\Database\QueryException;

class Settings extends TitanshopCommand
{
    protected $jsonPath = '';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'titanshop:generate:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all basic settings from config/json/settings.json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->jsonPath = config_path('json/settings.json');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();

        $this->info('Starting importation of settings from JSON file. ['.$this->jsonPath.']');

        $json = json_decode(file_get_contents($this->jsonPath), true);

        $numberOfSettingGroups = 0;
        $numberOfSettings = 0;

        foreach ($json['groups'] as $group) {
            $numbers = $this->importSettingGroupFromJsonArray($group);
            $numberOfSettingGroups += $numbers['numberOfSettingGroups'];
            $numberOfSettings += $numbers['settings'];
        }

        $this->info($numberOfSettingGroups . 'setting groups have been generated.');
        $this->info($numberOfSettings . 'settings have been generated.');
    }

    public function importSettingGroupFromJsonArray(array $json)
    {
        $numberOfSettingGroups = 1;
        $settingGroup = new SettingGroup();
        $settingGroup->code = $json['code'];
        try {
            $settingGroup->save();
        } catch (QueryException $e) {
            $settingGroup = SettingGroup::where('code', $json['code'])->first();
            $numberOfSettingGroups = 0;
        }

        foreach ($json['i18n'] as $i18n) {
            $settingGroupI18n = new SettingGroupI18n();

            $settingGroupI18n->lang = $i18n['lang'];
            $settingGroupI18n->title = $i18n['title'];
            $settingGroupI18n->setting_group_id = $settingGroup->id;
            try {
                $settingGroupI18n->save();
            } catch (QueryException $e) {
                $this->info($i18n['title'] . ' already exists.');
            }
        }

        $numberOfSettings = 0;

        foreach ($json['settings'] as $setting) {
            $numberOfSettings += $this->importSettingFromJsonArray($setting, $settingGroup->id);
        }

        return ['settings' => $numberOfSettings, 'numberOfSettingGroups' => $numberOfSettingGroups];
    }

    public function importSettingFromJsonArray(array $json, string $groupId)
    {
        $numberOfSettings = 1;

        $setting = new Setting();
        $setting->code = $json['code'];
        $setting->type = $json['type'];
        $setting->isEditable = $json['isEditable'];
        $setting->value = $json['value'];
        $setting->setting_group_id = $groupId;
        try {
            $setting->save();
        } catch (QueryException $e) {
            $setting = Setting::where('code', $json['code'])->first();
            $numberOfSettings = 0;
        }

        foreach ($json['i18n'] as $i18n) {
            $settingI18n = new SettingI18n();

            $settingI18n->lang = $i18n['lang'];
            $settingI18n->title = $i18n['title'];
            $settingI18n->help = $i18n['help'];
            $settingI18n->setting_id = $setting->id;
            try {
                $settingI18n->save();
            } catch (QueryException $e) {
                $this->info($i18n['title'] . ' already exists.');
            }
        }

        return $numberOfSettings;
    }
}
