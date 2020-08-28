<div id="{{ $containerId ?? 'dropzone-container' }}" class="dropzone-container col-12 px-0">
    <div id="{{ $dropzoneId ?? 'dropzone' }}" class="dropzone">

    </div>
</div>

<script>
    Dropzone.autoDiscover = false;
    let imagePath = '';
    let mockfiles = [];

    @isset($objectWithImage) @foreach($objectWithImage->images as $image)
    mockfiles.push({ name: "{{ $objectWithImage->i18nValue('title') }}", size: {{ $image->size }}, path: "{{ $image->url }}" });
    @endforeach @endisset

    let dropzone = $(".dropzone").dropzone({
        url: "{{ route('admin.images.upload') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        maxFilesize: {{ $maxFileSize ?? 10 }},
        init: function () {
            mockfiles.forEach(function(mockfile) {
                this.displayExistingFile(mockfile, mockfile.path);
                $('#{{ $containerId ?? 'dropzone-container' }}').append('<input type="hidden" id="imagePaths" name="imagePaths[]" value="'+ mockfile.path +'">');
            }, this);
        },
        success: function (data, response) {
            imagePath = response.path;
            $('#{{ $containerId ?? 'dropzone-container' }}').append('<input type="hidden" id="imagePaths" name="imagePaths[]" value="'+ imagePath +'">');
        }
    });
</script>
