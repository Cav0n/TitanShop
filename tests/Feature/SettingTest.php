<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\SettingI18n;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    const DEFAULT_CODE = "TEST_SETTING";
    const DEFAULT_TYPE = "text";
    const DEFAULT_LANG = "fr";
    const DEFAULT_TITLE = "Un paramètre de test";
    const DEFAULT_HELP = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

    public function testCompleteCreation()
    {
        // Test simple setting creation
        $setting = self::create();
        $setting->save();
        $this->assertNotNull($setting);

        // Test i18n creation
        $settingI18n = self::createI18n($setting->id);
        $settingI18n->save();
        $this->assertNotNull($settingI18n);

        // Test relation between i18n and setting
        $this->assertEquals(self::DEFAULT_TITLE, $setting->i18nValue('title'));
        $this->assertEquals(self::DEFAULT_HELP, $setting->i18nValue('help'));
    }

    public static function create(
        $code = null,
        $type = null,
        $value = null,
        $isEditable = null
    ) {
        $setting = new Setting();
        $setting->code = $code ?? self::DEFAULT_CODE;
        $setting->value = $value;
        $setting->type = $type ?? self::DEFAULT_TYPE;
        $setting->isEditable = $isEditable;

        return $setting;
    }

    public static function createI18n(
        $setting_id,
        $title = null,
        $help = null,
        $lang = null
    ) {
        $settingI18n = new SettingI18n();
        $settingI18n->setting_id = $setting_id;
        $settingI18n->title = $title ?? self::DEFAULT_TITLE;
        $settingI18n->help = $help ?? self::DEFAULT_HELP;
        $settingI18n->lang = $lang ?? self::DEFAULT_LANG;

        return $settingI18n;
    }
}
