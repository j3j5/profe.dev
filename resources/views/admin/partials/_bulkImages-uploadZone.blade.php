        <div class="col-md-9 col-md-offset-2 uploadZone">
            <div id="thumbnails-upload" class="col-md-offset-2 col-md-6">
                <label class="control-label">Imágen[es]</label>
                <form id="images-dropzone" action="{{ route("uploadBulkImages") }}" class="dropzone">
                    {!! Form::select('curso', ['1' => 'Primero', '2'=> 'Segundo',  '3'=> 'Tercero',], ['class'=>'form-control']) !!}
                    {!! csrf_field() !!}
                    <div class="dz-message"><span><i class="fa fa-cloud-upload"></i>{{ packageTranslation('vivify.uploadDropZone') }}</span></div>
                </form>
            </div>
        </div>
