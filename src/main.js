import Vue from 'vue'
import App from './App.vue'
import { Button, Dialog, Paper, TextField, Grid } from 'muse-ui';
import 'muse-ui/lib/styles/base.less';
import 'muse-ui/lib/styles/theme.less';

Vue.use(Button);
Vue.use(Dialog);
Vue.use(Paper);
Vue.use(TextField);
Vue.use(Grid);
Vue.config.productionTip = false;

new Vue({
  el: '#app',
  render: h => h(App),
  mounted: () => document.dispatchEvent(new Event("x-app-rendered")),
});
