
        <div class="col-md-8 col-md-offset-2 uploadZone">
            <div id="thumbnails-upload" class="col-md-offset-2 col-md-6">
                <label class="control-label">Imagen</label>
                <form id="images-dropzone" action="{{ route("uploadImage") }}" class="dropzone">
                    {!! csrf_field() !!}
                    <div class="dz-message"><span><i class="fa fa-cloud-upload"></i>{{ packageTranslation('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
        </div>
