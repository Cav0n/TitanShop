<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class OrderStatus extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\OrderStatusI18n');
    }

    public function i18nValue($valueName, $lang = null)
    {
        if (!isset($lang)) {
            $lang = App::getLocale();
        }

        if (null === $i18n = $this->i18ns()->where('lang', $lang)->first()) {
            return '[Aucun texte n\'existe]';
        }

        return $i18n->$valueName;
    }

    public function generateBadge()
    {
        $color = $this->color;
        $title = $this->i18nValue('title');

        return "<span class=\"badge\" style=\"background-color: $color\">$title</span>";
    }
}
