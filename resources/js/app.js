import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';

// Leaflet CSS
import 'leaflet/dist/leaflet.css';

// Vue Leaflet
import * as L from 'leaflet';
import { LMap, LTileLayer, LMarker, LPopup, LIcon } from '@vue-leaflet/vue-leaflet';

// Popravak ikonica za Leaflet
delete L.Icon.Default.prototype._getIconUrl;
L.Icon.Default.mergeOptions({
  iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
  iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
  shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
});

// Inicijalizacija Vue aplikacije
const app = createApp(App);

// Registracija Vue Leaflet komponenti
app.component('LMap', LMap);
app.component('LTileLayer', LTileLayer);
app.component('LMarker', LMarker);
app.component('LPopup', LPopup);
app.component('LIcon', LIcon);

app.mount('#app');
