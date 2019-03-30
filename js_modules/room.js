import Vue from 'vue';
import ChatRoom from './vue_components/ChatRoom.vue';

Vue.config.productionTip = false;

new Vue({
    el: '#chatRoom',
    components: {
        ChatRoom
    }
});
