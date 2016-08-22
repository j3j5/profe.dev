<add-propuesta-modal
    name="{{ $model }}"
    :show.sync="showModal"
    :action="modalAction"
    :model="selectedModel"
></add-propuesta-modal>


<template id="propuesta-modal-template">
    <modal :show.sync="show" v-on:modal-closed="close">
        <div class="modal-header-1">
            <h2>Nueva Propuesta</h2>
        </div>
        <form @submit.prevent.stop="submitForm" method="POST" action="{{ route('createModel', $model) }}">
            <div class="form-group">
                <label for="nombre" class="control-label">Nombre</label>
                <input class="form-control" v-model="nombre" name="nombre" type="text" id="nombre" value="@{{ nombre }}">
            </div>

            <div class="form-group">
                <label for="contenidos" class="control-label">Contenidos</label>
                <input class="form-control" v-model="contenidos" name="contenidos" type="text" id="contenidos" value="@{{ contenidos }}">
            </div>

            <div class="form-group">
                <label for="curso" class="control-label">Curso</label>
                <input min=1 max=3 class="form-control" v-model="curso" name="curso" type="number" id="curso" value="@{{ curso }}">
            </div>

            <div class="form-group">
                <div class="col-sm-6">
                    <label for="thumbnail" class="control-label">Thumbnail</label>
                    <input class="form-control" v-model="thumbnail" name="thumbnail" type="text" id="thumbnail" value="@{{ thumbnail }}">
                </div>
                <div class="col-sm-6">
                    <label for="archivo" class="control-label">Archivo</label>
                    <input class="form-control" v-model="archivo" name="archivo" type="text" id="archivo" value="@{{ archivo }}">
                </div>
            </div>

            <div class="modal-footer-1 text-right">
                <button type='submit' class="btn btn-info">
                    Guardar
                </button>
                <button class="btn btn-danger"
                    @click.stop.prevent="close">
                    Cancelar
                </button>
            </div>
        </form>
    </modal>
</template>
