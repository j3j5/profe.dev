<script type="text/x-template" id="megusta-modal-template">
    <modal :show="show">
        <div slot="modal-stuff">
            <div class="modal-header-1">
                <h2>Nuevo Me Gusta</h2>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="titulo" class="control-label">Título</label>
                    <input class="form-control" v-model="titulo" name="titulo" type="text" id="nombre" :value="titulo">
                </div>

                <div class="form-group">
                    <label for="autor" class="control-label">Autor</label>
                    <input class="form-control" v-model="autor" name="autor" type="text" id="autor" :value="autor">
                </div>

                <div class="form-group">
                    <label for="curso" class="control-label">Curso</label>
                    <select v-model="curso" class="form-control">
                        <option v-for="n in 3" :value="n">@{{ n | parseCurso }}</option>
                    </select>
                </div>

                <div class="form-group">
                    {{-- Imagen --}}
                    <label for="imagen" class="control-label">Imagen</label>
                    <input class="form-control" v-model="imagen" name="imagen" type="text" id="imagen" :value="imagen" disabled>
                    <form id="files-dropzone" action="{{ route("uploadRoute", [$model]) }}" class="dropzone" v-bind:style="formBgStyle">
                        {{ csrf_field() }}
                        <input hidden name="curso" value="1">
                        <div class="dz-message" v-bind:style="formMsg">
                            <span><i class="fa fa-cloud-upload"></i>Pincha o arrastra y suelta una imagen aquí</span>
                        </div>
                    </form>
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
