<add-propuesta-modal
    name="{{ $model }}"
    :show="showModal"
    :action="modalAction"
    :model="selectedModel"
></add-propuesta-modal>

<script type="text/x-template" id="propuesta-modal-template">
    <modal :show="show" >
        <div slot="modal-stuff">
        <div class="modal-header-1">
            <h2>Nueva Propuesta</h2>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="nombre" class="control-label">Nombre</label>
                <input class="form-control" v-model="nombre" name="nombre" type="text" id="nombre" :value="nombre">
            </div>

            <div class="form-group">
                <label for="contenidos" class="control-label">Contenidos</label>
                <input class="form-control" v-model="contenidos" name="contenidos" type="text" id="contenidos" :value="contenidos">
            </div>

            <div class="form-group">
                <label for="curso" class="control-label">Curso</label>
                <select v-model="curso" class="form-control">
                    <option v-for="n in 3" :value="n"></option>
                </select>
            </div>
            <div class="container">
                {{-- THUMBNAIL --}}
                <div class="col-sm-6">
                    <label for="thumbnail" class="control-label">Thumbnail</label>
                    <input class="form-control" v-model="thumbnail" name="thumbnail" type="text" id="thumbnail" :value="thumbnail" disabled>
                    <form id="images-dropzone" action="{{ route("thumbUpload") }}" class="dropzone" v-bind:style="thumbBgStyle">
                        {{ csrf_field() }}
                        <div class="dz-message" v-bind:style="formMsg">
                            <span><i class="fa fa-cloud-upload"></i>Pincha o arrastra y suelta un archivo aquí</span>
                        </div>
                    </form>
                </div>
                {{-- ARCHIVO --}}
                <div class="col-sm-6">
                    <label for="archivo" class="control-label">Archivo</label>
                    <input class="form-control" v-model="archivo" name="archivo" type="text" id="archivo" :value="archivo" disabled>
                    <form id="files-dropzone" action="{{ route("uploadRoute", $model) }}" class="dropzone">
                        {{ csrf_field() }}
                        <div class="dz-message" v-bind:style="formMsg">
                            <span><i class="fa fa-cloud-upload"></i>Pincha o arrastra y suelta un archivo aquí</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer-1 text-right">
            <button @click="submitForm" class="btn btn-info">
                Guardar
            </button>
            <button class="btn btn-danger"
                @click.stop.prevent="close">
                Cancelar
            </button>
        </div>
        </div>
    </modal>
</script>
