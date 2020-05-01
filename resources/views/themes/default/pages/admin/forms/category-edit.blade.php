<form action="{{ route('admin.category.update', ['categoryBase' => $category]) }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ $category->title }}">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows=4>{{ $category->description }}</textarea>
    </div>

    <div class="form-group mb-3">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="isVisible" id="isVisible" value="isVisible" @if($category->isVisible) checked=checked @endif>
                    La catégorie est visible
            </label>
        </div>
    </div>

    <input type="hidden" name="lang" value="FR">
    <input type="hidden" name="parent_id" value="{{ $parent ? $parent->id : null }}">

    <button type="submit" class="btn btn-primary">Sauvegarder</button>
</form>
