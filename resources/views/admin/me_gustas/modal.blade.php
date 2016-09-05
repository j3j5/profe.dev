<add-image-modal
    name="{{ $model }}"
    :show="showModal"
    :action="modalAction"
    :model="selectedModel"
></add-image-modal>


<template id="image-modal-template">
    <modal :show="show">
        <div class="modal-header-1">
            <h2>Nueva Imagen</h2>
        </div>

        <div class="modal-body">
            <div class="form-group">
                <label for="titulo" class="control-label">Título</label>
                <input class="form-control" v-model="titulo" name="titulo" type="text" id="nombre" value="@{{ titulo }}">
            </div>

            <div class="form-group">
                <label for="artista" class="control-label">Artista</label>
                <input class="form-control" v-model="artista" name="artista" type="text" id="artista" value="@{{ artista }}">
            </div>

            <div class="form-group">
                <label for="anho" class="control-label">Año</label>
                <input class="form-control" v-model="anho" name="anho" type="number" id="anho" value="@{{ anho }}">
            </div>

            <div class="form-group">
                {{-- Imagen --}}
                <label for="image" class="control-label">Archivo</label>
                <input class="form-control" v-model="image" name="image" type="text" id="image" value="@{{ image }}" disabled>
                <form id="files-dropzone" action="{{ route("galleryUpload") }}" class="dropzone" v-bind:style="formBgStyle">
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
    </modal>
</template>
