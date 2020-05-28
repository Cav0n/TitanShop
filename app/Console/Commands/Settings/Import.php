<?php

namespace App\Console\Commands\Settings;

use Illuminate\Console\Command;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =
        'titanshop:settings:import
            {--all : Import all settings}
            {--missing : Import only missing settings}
            {--show : Show all success and errors message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import TitanShop settings.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->info('All settings are gonna be imported.');
            $settings = $this->importAllSettings();
            return;
        }

        if ($this->option('missing')) {
            $this->info('Only missing settings are gonna be imported.');
            $settings = $this->importMissingSettings();
            return;
        }

        $this->info('Only missing settings are gonna be imported (by default).');
        $settings = $this->importMissingSettings();
    }

    protected function importAllSettings(): bool
    {
        $path = \base_path() . "/config/json/settings.json";

        $json = json_decode(file_get_contents($path), true);

        foreach ($json['settings'] as $setting) {
            $this->saveSetting($setting);
        }

        $this->info('Every settings imported successfully. ✅');

        return 1;
    }

    protected function importMissingSettings(): bool
    {
        $path = \base_path() . "/config/json/settings.json";

        $json = json_decode(file_get_contents($path), true);

        foreach ($json['settings'] as $setting) {
            if (! \App\Setting::where('code', $setting['code'])->exists()) {
                $this->saveSetting($setting);
            }
        }

        $this->info('Every missing settings imported successfully. ✅');

        return 1;
    }

    protected function saveSetting(array $setting): bool
    {
        $settingToAdd = new \App\Setting();
        $settingToAdd->code = $setting['code'];
        $settingToAdd->type = $setting['type'];
        $settingToAdd->isEditable = $setting['isEditable'];

        if (isset($setting['value'])) {
            $settingToAdd->value = $setting['value'];
        }

        try {
            $settingToAdd->save();

            if ($this->option('show')) {
                $this->info('Setting "'. $setting['code'] .'" added successfully. ✅');
            }
        } catch (\Exception $e) {
            $this->error('An error has been thrown when saving "' . $setting['code'] . '" setting. ❌');
            if ($this->option('show')) {
                $this->error('ERROR : ' . $e->getMessage());
            }

            return 0;
        }

        if (isset($setting['i18n'])) {
            foreach ($setting['i18n'] as $settingI18n) {
                $settingToAddI18n = new \App\SettingI18n();
                $settingToAddI18n->setting_id = $settingToAdd->id;
                $settingToAddI18n->lang = $settingI18n['lang'];
                $settingToAddI18n->title = $settingI18n['title'];

                if (isset($settingI18n['help'])) {
                    $settingToAddI18n->help = $settingI18n['help'];
                }

                try {
                    $settingToAddI18n->save();

                    if ($this->option('show')) {
                        $this->info('Setting translation for "'. $setting['code'] .'" [' . $settingI18n['lang'] . '] added successfully. ✅');
                    }
                } catch (\Exception $e) {
                    $this->error('An error has been thrown when saving i18n for "' . $setting['code'] . '" setting. ❌');
                    if ($this->option('show')) {
                        $this->error('ERROR : ' . $e->getMessage());
                    }
                }
            }
        }

        return 1;
    }
}
