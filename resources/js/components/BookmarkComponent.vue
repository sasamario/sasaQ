<template>
    <div>
        <button class="bookmark-button" v-on:click="addOrDelete">
            {{ bookmark }}
            <i :class="[isActiveTrue === true ? 'fas fa-bookmark' : 'far fa-bookmark']"></i>
        </button>
    </div>
</template>

<script>
export default {
    name: "BookmarkComponent",

    props: {
        articleId: {
            type: Number,
            required: true,
        },
        isBookmark: {
            type: Boolean,
            required: true,
        }
    },
    data() {
        return {
            isActiveTrue: this.isActiveTrue = this.isBookmark
        };
    },
    computed: {
      bookmark() {
          return this.isActiveTrue ? 'ブックマーク済み' : 'ブックマーク'
      }
    },
    methods: {
        //真偽値の反転
        change() {
            this.isActiveTrue = !this.isActiveTrue;
        },
        add() {
            axios
                .post("/addBookmark", {
                    articleId: this.articleId,
                })
        },
        delete() {
            axios
                .post("/deleteBookmark", {
                    articleId: this.articleId,
                })
        },
        addOrDelete() {
            const isTrue = this.isActiveTrue
            if (isTrue == true) {
                this.delete();
                this.change();
            } else {
                this.add();
                this.change();
            }
        }
    }
}
</script>

<style scoped>

</style>
