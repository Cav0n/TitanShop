<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @var array TYPES
     * The differents possibles types of settings
     * This is useful in backoffice to display settings form.
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

    public function getValueAttribute($value)
    {
        if ("price" === $this->type) {
            return $value / 100;
        }

        return $value;
    }

    public function setValueAttribute($value)
    {
        if ("price" === $this->type) {
            $value = $value * 100;
        }

        $this->attributes['value'] = $value;
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

    public function getInputAttribute()
    {
        return \App\Utils::input(
            $this->type,
            'settings[' . $this->code . ']',
            $this->value,
            $this->help,
            null,
            null,
            null,
            null
        );
    }

    public static function valueOrNull(string $code, $formatted = false)
    {
        $setting = \App\Setting::where('code', $code)->first();

        if (null === $setting || ! \in_array($setting->type, self::TYPES)) {
            return null;
        }

        if ("price" === $setting->type && $formatted) {
            return number_format($setting->value, 2, ',', ' ');
        }

        if ("number" === $setting->type) {
            return (null !== $setting->value) ? $setting->value : 0;
        }

        return $setting->value;
    }
}
