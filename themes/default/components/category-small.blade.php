<a class="category-small-container col-lg-4 mb-3 text-center" href="{{route('category.show', ['category' => $category->code])}}">
    <div class="category-small rounded transition noselect" {!! $category->firstImage != null ? 'style="background-image: url(\'' . $category->firstImage->path . '\')"' : null !!}>
        <p class="p-3 rounded">
            {{$category->i18nValue('title')}}
        </p>
    </div>
</a>
