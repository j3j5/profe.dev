        <div class="col-md-8 col-md-offset-2 uploadZone">
            <div id="thumbnails-upload" class="col-md-6">
                <label class="control-label">Thumbnail</label>
                <form id="images-dropzone" action="{{ route("uploadImage") }}" class="dropzone">
                    {!! csrf_field() !!}
                    <div class="dz-message"><span><i class="fa fa-cloud-upload"></i>{{ trans('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
            <div id="files-upload" class="col-md-6">
                <label class="control-label">Archivo</label>
                <form id="files-dropzone" action="{{ route($uploadRoute) }}" class="dropzone">
                    {!! csrf_field() !!}
                    <div class="dz-message"><span><i class="fa fa-cloud-upload"></i>{{ trans('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
        </div>
