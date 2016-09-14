<template>
    <div class="alert alert-{{type}} notification" role="alert">
        <button type="button" class="close" @click="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="" v-if="title">
            <h3>{{ title }}</h3>
        </div>
        {{ message }}
    </div>
</template>

<script>
import Vue from 'vue'

export default {

    props: {
        type: String,
        title: String,
        message: String,
        direction: {
            type: String,
            default: 'right'
        },
        duration: {
            type: Number,
            default: 4500
        },
        container: {
            type: String,
            default: '.notifications'
        }
    },

    data () {
        return {
            $_parent_: null
        }
    },

    created () {
        let $parent = this.$parent
        if (!$parent) {
            let parent = document.querySelector(this.container)
            if (!parent) {
            // Lazy creating `div.notifications` container.
            parent = document.createElement('div')
            parent.classList.add(this.container.replace('.', ''))
            const Notifications = Vue.extend()
            $parent = new Notifications({
                el: parent
            }).$appendTo(document.body)
        }
            // Hacked.
            this.$_parent_ = parent.__vue__
        }
    },

    compiled () {
        if (this.$_parent_) {
            this.$appendTo(this.$_parent_.$el)
            delete this.$_parent_
        }
    },

    ready () {
        if (this.duration > 0) {
            this.timer = setTimeout(() => this.close(), this.duration)
        }
    },

    computed: {
        transition () {
            return `bounce-${this.direction}`
        }
    },

    methods: {
        close () {
            clearTimeout(this.timer)
            this.$destroy(true)
        },
    },
}
</script>

<style>
.notifications {
    width: 85%;
    position: fixed;
    top: 40px;
    left: 10px;
    right: 10px;
    z-index: 1257;
    margin: 0 auto;
}

.notification {
    position: relative;
    padding: 5px 15px;
    pointer-events: all;
    min-height: 60px;
    font-size: 1.5em;
    color: black;
    opacity: 0.8;
    border-radius: 15px;
    padding-top: 15px;
    text-align: center;
}
</style>
