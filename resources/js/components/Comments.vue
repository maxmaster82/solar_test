<template>
    <div class="comments pb-5">
        <h3>Comments</h3>
        <hr class="pt-4"/>
        <Comment
            v-for="(comment, index) in comments"
            v-bind:comment="comment"
            v-bind:index="index"
            v-bind:key="comment.id"
        />
        <hr/>
        <a href="#" v-if="sowFormLink" v-on:click.prevent="showForm"><h4>Leave a comment</h4></a>

        <CommentForm
            v-bind:btn-txt="btnTxt"
            v-bind:form-id="formId"
            v-bind:action="action"
            v-bind:key="formId"
        />
    </div>
</template>

<script>
    import Comment from './Comment';
    import CommentForm from './CommentForm';

    export default {
        name: 'Comments',
        components: {
            Comment,
            CommentForm,
        },
        data: function () {
            return {
                formId: 0,
                btnTxt: 'Submit',
                action: 'addComment',
            }
        },
        mounted: function () {
            this.$store.dispatch('fetch');
        },
        computed: {
            comments: function () {
                return this.$store.state.comments;
            },
            sowFormLink: function () {
                return this.$store.state.formId
            }
        },
        methods: {
            showForm: function () {
                this.$store.state.formId = 0;
            }
        }
    }
</script>
