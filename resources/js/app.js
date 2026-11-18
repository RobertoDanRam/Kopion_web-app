import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';
import OrderTracking from './components/OrderTracking.vue';

app.component('example-component', ExampleComponent);
app.component('order-tracking', OrderTracking);

app.mount('#app');