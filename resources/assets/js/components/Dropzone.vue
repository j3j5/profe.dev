<template>
    <div ref="dropzone">
        <slot name="dropzone-container">
            <slot name="dropzone-message">Drop files here to upload</slot>
        </slot>
    </div>
</template>

<script>

export default {

    props : {

            multiple : {
                default : false
            },

            path : {
                required: true,
            },
            file : {
                default : ''
            },
            files : {
                default : function() {
                    return {};
                }
            },
            target : {
                default : 'dropzone'
            },
            clickable : {
                default : false
            },
            previewTemplate : {
                default : '<div style="display:none"></div>'
            },
            createImageThumbnails : {
                default : true
            }
    },
    computed: {
        multipleUploads() {
            return this.multiple ? true : false;
        }
    },
    mounted: {
        Dropzone.autoDiscover = false;
        let params = {
            url: this.path,
            paramName: this.file,
            createImageThumbnails: this.createImageThumbnails,
            clickable: this.clickable,
            previewTemplate: this.previewTemplate
        };
        // let dz = new Dropzone(this.target, params);
        let dz = new Dropzone(this.$els.dropzone, params);

        dz.on("sending", (file) => {
            this.$dispatch('file-sending', file);
        });

        dz.on("addedfile", (file) => {
            this.$dispatch('file-added', file);
        });

        dz.on("success", (file, response) => {
            this.$dispatch('file-upload-success', response);
            if (!this.files) this.files = [];

            if (typeof response === 'string') {
                response = JSON.parse(response);
            }

            this.files.push(response);
        });

        dz.on("error", (file, errorMessage, xhr) => {
            this.$dispatch('file-upload-error', {
                file: file,
                response: response,
                xhr: xhr
            });
        });

        dz.on("queuecomplete", (file) => {
            this.$dispatch('file-upload-queue-completed', file);

        });
    }
}

</script>
