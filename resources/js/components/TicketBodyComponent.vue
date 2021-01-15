<template>
    <p class="p-2 staff-reply">
        <input type="text" v-model="editForm.reply" class="form-control row" v-if="edit">
        <span v-else>{{ body.body }}</span>
        <span class="float-right">
        <a v-on:click="editReply" type="button" v-if="!edit">Edit</a>
        <a v-on:click="cancelEdit" type="button" v-if="edit">Cancel</a>
        </span>
    </p>
</template>

<script>
    export default {
        props:['body'],
        data() {
            return {
                edit: false,
                editForm: {
                    reply: ''
                }
            }
        },
        methods: {
            editReply() {
                this.edit=true;
                this.editForm.reply = this.reply.reply;
            },

            cancelEdit() {
                this.edit=false;
                this.editForm.reply='';
            }
        }
    }
</script>