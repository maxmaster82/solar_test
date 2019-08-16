<template>
    <form class="pt-4" v-if="showForm">
        <div class="form-group">
            <textarea v-model="text"  class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" v-on:click.prevent="formAction">{{btnTxt}}</button>
    </form>
</template>

<script>
    export default {
        name: 'CommentForm',
        props: ['formId','btnTxt','action', 'editText'],
        data: function () {
            return {
                text: ''
            }
        },
        methods: {
            formAction: function () {
                switch (this.action) {
                    case 'addComment':
                        this.$store.dispatch('addComment', {
                            text: this.text,
                            parent: this.formId,
                        });
                        this.text = '';
                        if (this.formId > 0) {
                            this.$store.state.formId = 0;
                        }
                        break;
                    case 'editComment':
                        this.$store.dispatch('editComment', {
                            id: this.formId,
                            text: this.text,
                        });
                        this.$store.state.formId = 0;
                        break;
                }
            },
        },
        computed: {
            showForm: function () {
                return this.formId === this.$store.state.formId;
            },
        },
        watch: {
            editText: function(newVal, oldVal) {
                this.text = newVal;
            }
        }
    }
</script>
