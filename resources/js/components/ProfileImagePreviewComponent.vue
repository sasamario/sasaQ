<template>
    <div>
        <div>
            <input type="file" name="avatar" ref="preview" v-on:change="show">
        </div>
        <div class="preview-box" v-if="url">
            <img class="image-preview" v-bind:src="url">
        </div>
    </div>
</template>

<script>
export default {
    name: "ProfileImagePreviewComponent",

    data() {
        return {
            url:""
        }
    },
    methods: {
        show() {
            const file = this.$refs.preview.files[0];
            this.url = URL.createObjectURL(file);
        }
    }
}
</script>

<style scoped>
    .preview-box {
        display: flex;
        justify-content: center;
    }
    .image-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }
</style>
