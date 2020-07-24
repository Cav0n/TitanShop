<?php

namespace App\Models;

use App\Models\Utils\CustomString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\CategoryI18n');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id')->where('isDeleted', 0);
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Category', 'parent_id')->where('isDeleted', 0);
    }

    public function visibleParent()
    {
        return $this->parent()->where('isVisible', 1);
    }

    public function visibleChilds()
    {
        return $this->childs()->where('isVisible', 1);
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'category_image')->withPivot('position');;
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function i18nValue($valueName, $lang = null)
    {
        if (!$this->i18ns()->exists()) {
            return '[Aucun texte n\'existe]';
        }

        if (!isset($lang)) {
            $lang = App::getLocale();
        }

        if (null === $i18n = $this->i18ns()->where('lang', $lang)->first()) {
            $i18n = $this->i18ns()->where('lang', App::getLocale())->first();
        }

        if (null === $i18n) {
            return $this->i18ns()->first()->$valueName;
        }

        return $i18n->$valueName;
    }

    public function generateBreadcrumb()
    {
        $breadcrumb = [];
        $parents = [];
        $parent = $this->visibleParent;

        // Get all parent of the category
        while ($parent !== null) {
            $parents[] = [
                'title' => $parent->i18nValue('title'),
                'link'  => route('category.show', ['category' => $parent->code])
            ];

            $parent = $parent->visibleParent;
        }

        // Add parent to breadcrumb
        $breadcrumb = array_reverse($parents);

        // Add current category
        $breadcrumb[] = [
            'title' => $this->i18nValue('title'),
            'link'  => route('category.show', ['category' => $this->code])
        ];

        // Prepend "home" link to breadcrumb
        array_unshift($breadcrumb, [
            'title' => 'Accueil',
            'link'  => route('homepage')
        ]);

        return $breadcrumb;
    }
}
