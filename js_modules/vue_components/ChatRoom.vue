<template>
    <div class="col-12">
        <div class="row">
            <div ref="messagesDiv" class="col-12 messages mb-3">
                <messages-item v-for="(mess, index) in messages" :key="index" :message="mess" />
            </div>
        </div>
        <chat-room-input @send-message="sendMessage" />
    </div>
</template>

<style lang="less">
div.messages {
    min-height: 350px;
    max-height: 350px;
    padding: 18px;
    border: solid 1px #d3d3d3;
    border-radius: 10px;
    overflow-x: hidden;
    overflow-y: scroll;
}
</style>


<script>
import axios from 'axios';
import ChatRoomInput from './ChatRoomInput.vue';
import MessagesItem from './MessagesItem.vue';

export default {
    name: 'ChatRoom',
    components: {
        ChatRoomInput,
        MessagesItem
    },
    data() {
        return {
            message: '',
            messages: [],
            interval: null,
            lastId: null,
            prefix: '/test'
        };
    },
    mounted() {
        this.getMessages();
    },
    methods: {
        getMessages() {
            axios.get(`${this.prefix}/get_messages.php`).then((response) => {
                const messages = response.data.reverse();
                this.lastId = messages[messages.length - 1].id;
                this.$set(this, 'messages', messages);

                this.$nextTick(() => {
                    this.scrollMessages();
                    this.interval = setInterval(this.getLatestMessages, 1000);
                });
            }).catch((error) => {
                console.log(error);
            });
        },
        getLatestMessages() {
            axios.get(`${this.prefix}/get_messages.php?last_id=${this.lastId}`).then((response) => {
                if (response.data.length > 0) {
                    console.log(response);

                    const messages = response.data.reverse();
                    this.lastId = messages[messages.length - 1].id;
                    this.$set(this, 'messages', this.messages.concat(messages));

                    this.$nextTick(() => {
                        this.scrollMessages();
                    });
                }
            }).catch((error) => {
                console.log(error);
            });
        },
        sendMessage(message) {
            if (message.length >= 2) {
                axios.post('/test/add_message.php', {
                    message
                }).then((response) => {
                    console.log(response);

                    this.getLatestMessages();
                }).catch((error) => {
                    console.log(error);
                });
            }
        },
        scrollMessages() {
            const height = this.$refs.messagesDiv.scrollHeight;
            this.$refs.messagesDiv.scrollTop = height + 100;
        }
    }
};
</script>
