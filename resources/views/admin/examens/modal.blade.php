<script type="text/x-template" id="examen-modal-template">
    <modal :show="show">
        <div slot="modal-stuff">
            <div class="modal-header-1">
                <h2>Nuevo Examen</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre" class="control-label">Nombre</label>
                    <input class="form-control" v-model="nombre" name="nombre" type="text" id="nombre" :value="nombre">
                </div>

                <div class="form-group">
                    <label for="trimestre" class="control-label">Trimestre</label>
                    <select v-model="trimestre" class="form-control">
                        <option v-for="n in 3" :value="n">@{{ n | parseCurso }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="curso" class="control-label">Curso</label>
                    <select v-model="curso" class="form-control">
                        <option v-for="n in 3" :value="n">@{{ n | parseCurso }}</option>
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
