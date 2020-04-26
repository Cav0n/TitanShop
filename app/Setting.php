<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @var array TYPES
     * The differents possibles types of settings
     * The is useful in backoffice to display settings form.
     *
     * Ex: string setting will be displayed in an input type="text"
     * Another Ex: text setting will be displayed in a textarea
     * */
    const TYPES = [
        'string', 'text', 'bool', 'number', 'price'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'type', 'value', 'password',
    ];

    /**
     * Get setting i18ns
     */
    public function i18ns()
    {
        return $this->hasMany('App\SettingI18n');
    }

    /**
     * Return setting title i18n
     */
    public function getTitleAttribute($lang = 'FR')
    {
        $lang = (isset($lang)) ? $lang : 'FR';

        return $this->i18ns->where('lang', $lang)->first() ? $this->i18ns->where('lang', $lang)->first()->title : null;
    }

    /**
     * Return setting help i18n
     */
    public function getHelpAttribute($lang = 'FR')
    {
        $lang = (isset($lang)) ? $lang : 'FR';

        return $this->i18ns->where('lang', $lang)->first() ? $this->i18ns->where('lang', $lang)->first()->help : null ;
    }

    public static function valueOrNull(string $code, $formatted = false)
    {
        $setting = \App\Setting::where('code', $code)->first();

        if (null === $setting || ! \in_array($setting->type, self::TYPES)) {
            return null;
        }

        if ("price" === $setting->type) {
            if ($formatted) {
                return number_format($setting->value / 100.0, 2, ',', ' ');
            }

            return $setting->value / 100.0;
        }

        if ("number" === $setting->type) {
            return (null !== $setting->value) ? $setting->value : 0;
        }

        return $setting->value;
    }
}
