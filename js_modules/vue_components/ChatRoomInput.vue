<template>
    <div class="row">
        <div class="col-10">
            <input v-model="message" type="text" class="col-12" @keyup.enter="sendMessage">
        </div>

        <div class="col-2">
            <span class="btn btn-primary" @click="sendMessage">
                Отправить
            </span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ChatRoomInput',
    data() {
        return {
            message: ''
        };
    },
    methods: {
        sendMessage() {
            if (this.message !== '') {
                this.$emit('send-message', this.message);
                this.message = '';
            }
        }
    }
};
</script>
