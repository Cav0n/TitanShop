<a class="category-small-container col-lg-4 text-center" href="{{route('category.show', ['category' => $category->code])}}">
    <div class="category-small rounded transition noselect">
        <p class="p-3 text-dark">
            {{$category->i18nValue('title')}}
        </p>
    </div>
</a>
