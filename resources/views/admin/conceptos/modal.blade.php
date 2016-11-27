<script type="text/x-template" id="concepto-modal-template">
    <modal :show="show">
        <div slot="modal-stuff">
            <div class="modal-header-1">
                <h2>Nuevo Concepto</h2>
            </div>

            <div class="modal-body">

                <div class="form-group form-group-lg">
                    <label for="grupoConceptos" class="control-label">Grupo de Conceptos</label>
                    <span class="">
                        <button class="btn btn-success btn-sm" @click="showGrupo = true" v-show="!showGrupo">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Crear Grupo Nuevo
                        </button>
                    </span>
                    <div v-show="showGrupo">
                        <input type="text" class="form-control" placeholder="Nuevo grupo de conceptos" v-model="grupoConcepto">
                        <button class="btn btn-success" @click="createNewGrupo"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>Guardar</button>
                        <button class="btn btn-warning" @click="showGrupo = false"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Cancelar</button>
                    </div>
                    <select v-show="!showGrupo" v-model="grupo_id"  class="form-control">
                        <option value="" disabled hidden>Selecciona un grupo de conceptos</option>
                        <option v-for="grupo in grupos"  :value="grupo.id">@{{ grupo.nombre }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="palabra" class="control-label">Palabra</label>
                    <input class="form-control" v-model="palabra" name="palabra" type="text" id="palabra" :value="palabra">
                </div>

                <div class="form-group">
                    <label for="definicion" class="control-label">Definición</label>
                    <input class="form-control" v-model="definicion" name="definicion" type="text" id="definicion" :value="definicion">
                </div>

                <div class="form-group">
                    <label for="curso" class="control-label">Curso</label>
                    <select v-model="curso" class="form-control">
                        <option v-for="n in 3" :value="n"></option>
                    </select>
                </div>

                <div class="form-group">
                    {{-- Imagen --}}
                    <label for="thumbnail" class="control-label">Imagen</label>
                    <input class="form-control" v-model="thumbnail" name="thumbnail" type="text" id="thumbnail" :value="thumbnail" disabled>
                    <form id="thumb-dropzone" action="{{ route("uploadRoute", $model) }}" class="dropzone" v-bind:style="formBgStyle">
                        {{ csrf_field() }}
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
