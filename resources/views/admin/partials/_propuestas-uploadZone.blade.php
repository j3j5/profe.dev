        <div class="uploadZone">
            <div id="thumbnails-upload" class="col-md-6">
                <label class="control-label">Thumbnail</label>
                <form id="images-dropzone" action="{{ route("uploadImage") }}" class="dropzone">
                    {!! csrf_field() !!}
                    <div class="dz-message"><span><i class="fa fa-cloud-upload"></i>{{ trans('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
            <div id="files-upload" class="col-md-6">
                <label class="control-label">Archivo</label>
                <form id="files-dropzone" action="{{ route("uploadRoute", $model) }}" class="dropzone">
                    {!! csrf_field() !!}
                    <div class="dz-message"><span><i class="fa fa-cloud-upload"></i>{{ trans('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
        </div>
