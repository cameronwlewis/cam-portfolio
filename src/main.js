import Vue from 'vue'
import App from './App.vue'
import

Vue.use(require('vue-moment'));

library.add(faPaperclip);
library.add(faSmile);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.config.productionTip = false;

new Vue({
    render: h => h(App)
}).$mount('#app');