<template>
    <div class="media mt-3">
        <img src="http://placekitten.com/64/64" class="mr-3" alt="">
        <div class="media-body">
            <h5><small>{{comment.updated_at}}</small></h5>
            {{comment.text}}
            <br>
            <a href="#" v-on:click.prevent="replyComment">Reply</a>
            <a href="#" v-on:click.prevent="editComment">Edit</a>
            <a href="#" v-on:click.prevent="deleteComment">Delete</a>
            <CommentForm
                    v-bind:form-id="comment.id"
                    v-bind:btn-txt="btnTxt"
                    v-bind:action="action"
                    v-bind:edit-text="editText"
                    v-bind:key="comment.id"

            />
            <Comment
                    v-if="comment.replies"
                    v-for="(reply, index) in comment.replies"
                    v-bind:comment="reply"
                    v-bind:index="index"
                    v-bind:key="reply.id"
            />
        </div>
    </div>

</template>

<script>
    import CommentForm from './CommentForm';
    export default {
        name: 'Comment',
        components: {
            CommentForm
        },
        data: function () {
            return {
                btnTxt: '',
                action: '',
                editText: ''
            }
        },
        props: ['comment'],
        methods: {
            replyComment: function () {
                this.btnTxt = 'Reply';
                this.action = 'addComment';
                this.editText = '';
                this.$store.state.formId = this.comment.id;
            },
            editComment: function () {
                this.btnTxt = 'Edit';
                this.action = 'editComment';
                this.editText = this.comment.text;
                this.$store.state.formId = this.comment.id;
            },
            deleteComment: function () {
                this.$store.dispatch('deleteComment', this.comment.id)
            }
        },
    }
</script>
