<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBase extends Model
{
    /**
     * Get category translations
     */
    public function i18ns()
    {
        return $this->hasMany('App\CategoryI18n');
    }

    /**
     * Get images of the category
     */
    public function images()
    {
        return $this->belongsToMany('App\Image')->withPivot(['rank']);
    }

    /**
     * Get childs of the category
     */
    public function parent()
    {
        return $this->belongsTo('App\CategoryBase', 'parent_id');
    }

    /**
     * Get childs of the category
     */
    public function childs()
    {
        return $this->hasMany('App\CategoryBase', 'parent_id');
    }

    /**
     * Get products of the category
     */
    public function products()
    {
        return $this->hasMany('App\ProductBase', 'category_product', 'category_id', 'product_id');
    }

    /**
     * Return true if category is available
     * True if isAvailable = true and isDeleted = false
     */
    public function getIsAvailableAttribute()
    {
        return ($this->isVisible) && (! $this->isDeleted);
    }

    /**
     * Return category title i18n
     */
    public function getTitleAttribute($lang = 'FR')
    {
        $lang = (isset($lang)) ? $lang : 'FR';

        return $this->i18ns->where('lang', $lang)->first()->title;
    }

    /**
     * Return category description i18n
     */
    public function getDescriptionAttribute($lang = 'FR')
    {
        $lang = (isset($lang)) ? $lang : 'FR';

        return nl2br($this->i18ns->where('lang', $lang)->first()->description);
    }

    /**
     * Return breadcrumb of the category
     */
    public function getBreadcrumbAttribute()
    {
        $breadcrumb = '';

        $categoryRoute = route('category.show', ['category' => $this]);
        $categoryTitle = $this->title;
        $breadcrumb = "/ <a href=\"$categoryRoute\">$categoryTitle</a>";

        $parent = $this->parent;

        while (null !== $parent) {
            $parentRoute = route('category.show', ['category' => $parent]);
            $parentTitle = $parent->title;
            $breadcrumb = "/ <a href=\"$parentRoute\">$parentTitle</a> " . $breadcrumb;

            $parent = $parent->parent;
        }

        $routeToHomepage = route('index');
        $homepageTitle = "Accueil";
        $breadcrumb = "/ <a href=\"$routeToHomepage\">$homepageTitle</a> " . $breadcrumb;

        $breadcrumb = "<p>$breadcrumb</p>";

        return $breadcrumb;
    }
}
