<?php

namespace App\Models;

use App\Models\Utils\CustomString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Product extends Model
{
    public function i18ns()
    {
        return $this->hasMany('App\Models\ProductI18n');
    }

    public function images()
    {
        return $this->belongsToMany('App\Models\Image', 'product_image')->withPivot('position')->orderBy('product_image.position');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_product')->withPivot('position')->withPivot('isDefault');
    }

    public function getCategoriesForTagifyAttribute()
    {
        $categories = [];

        foreach ($this->categories as $index => $category) {
            $categories[$index]['id'] = "$category->id";
            $categories[$index]['value'] = $category->i18nValue('title');
        }

        return json_encode($categories);
    }

    public function getDefaultCategoryForTagifyAttribute()
    {
        $defaultCategoryArray = [];

        if (null === $defaultCategory = $this->categories()->wherePivot('isDefault', 1)->first()) {
            if (null === $defaultCategory = $this->categories->first()) {
                return null;
            }
        }

        $defaultCategoryArray['id'] = $defaultCategory->id;
        $defaultCategoryArray['value'] = $defaultCategory->i18nValue('title');

        return json_encode($defaultCategoryArray);
    }

    public function getFirstImageAttribute()
    {
        return $this->images()->orderBy('position')->first();
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    public function getFormattedPromoPriceAttribute()
    {
        return number_format($this->promoPrice, 2, ',', ' ') . ' €';
    }

    public function getDefaultCategoryAttribute()
    {
        if (null !== $category = $this->categories()->where('isDefault', 1)->first()) {
            return $category;
        }

        return $this->categories()->first();
    }

    public function setCodeAttribute($value)
    {
        if (null === $value) {
            $this->attributes['code'] = CustomString::prepareStringForURL($this->i18nValue('title'));
        } else {
            $this->attributes['code'] = CustomString::prepareStringForURL($value);
        }
    }

    public static function validator(array $data, Product $product = null)
    {
        if (null !== $product) {
            $uniqueRule = Rule::unique('products')->ignore($product->id);
        } else {
            $uniqueRule = Rule::unique('products');
        }

        return Validator::make($data, [
            'code' => ['nullable', $uniqueRule],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'isInPromo' => ['nullable'],
            'promoPrice' => ['nullable', 'required_with:isInPromo', 'lt:price'],
            'isVisible' => ['nullable'],
            'isDeleted' => ['nullable'],
        ]);
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

    public function generateBreadcrumb()
    {
        if (null !== $defaultCategory = $this->categories()->where('isDefault', 1)->first()) {
            $breadcrumb = $defaultCategory->generateBreadcrumb();
        } elseif (null !== $defaultCategory = $this->categories()->first()) {
            $breadcrumb = $defaultCategory->generateBreadcrumb();
        } else {
            $breadcrumb[] = [
                'title' => 'Accueil',
                'link'  => route('homepage')
            ];
        }

        // Add product to breadcrumb
        $breadcrumb[] = [
            'title' => $this->i18nValue('title'),
            'link'  => route('product.show', ['product' => $this->code])
        ];

        return $breadcrumb;
    }
}
