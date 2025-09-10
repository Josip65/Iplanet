<template>
  <div class="container-fluid p-0">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <i class="bi bi-globe-europe-africa me-2" style="font-size: 1.5rem;"></i>
          <span class="fw-bold">@Planet</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
       
      </div>
    </nav>

    <!-- Jumbotron -->
    <div class="bg-light py-5 mb-4">
      <div class="container text-center">
        <h1 class="display-5 fw-bold text-primary mb-3">Pregled prirodnih događaja</h1>
        <p class="lead">Ažurirani prikaz aktualnih prirodnih pojava širom svijeta u zadnjih 7 dana</p>
        <div class="mt-3">
          <span class="badge bg-success me-2">Ažurirano: {{ lastUpdated || 'Učitavanje...' }}</span><br>
          <span class="badge bg-info text-dark">Izvor: NASA EONET</span>
        </div>
      </div>
    </div>

    <main>
      <!-- Controls -->
      <div class="mb-4">
        <div class="flex justify-between items-center mb-2">
          <div class="text-sm text-gray-500">
            Zadnje ažurirano: {{ lastUpdated || 'N/A' }}
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="container mb-5">
        <!-- Map -->
        <div class="card shadow-lg">
          <div class="card-header bg-white py-3">
          </div>
          <div class="card-body p-0" style="height: 70vh;">
            <l-map 
              ref="map" 
              :zoom="zoom" 
              :center="center"
              :options="{ zoomControl: false }"
              @ready="onMapReady"
            >
              <l-tile-layer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
                layer-type="base"
                name="OpenStreetMap"
              />

              <!-- Event markers -->
              <template v-for="event in events" :key="'event-' + event.id">
                <l-marker 
                  :lat-lng="[event.lat, event.lng]"
                  :icon="createIcon(event.icon)"
                >
                  <l-popup :options="{ maxWidth: 300, minWidth: 200 }">
                    <div v-html="getEventPopupContent(event)"></div>
                  </l-popup>
                </l-marker>
              </template>
            </l-map>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
          <p class="mb-0"> 2024 @Planet - Sva prava pridržana</p>
          <p class="small text-muted mt-2">Podaci se ažuriraju automatski iz NASA-inog EONET API-ja</p>
        </div>
      </footer>
    </main>
  </div>
</template>

<script>
import axios from 'axios';
import L from 'leaflet';

export default {
  name: 'App',
  data() {
    return {
      loadingEvents: true,
      events: [],
      map: null,
      zoom: 2,
      center: [45.1, 15.2],
      lastUpdated: null
    };
  },
  async created() {
    // Initialize the map first
    await this.$nextTick();
    
    // Then load events
    await this.fetchEvents();
    
    // Set up refresh interval
    setInterval(async () => {
      await this.fetchEvents();
    }, 15 * 60 * 1000);
  },
  mounted() {
  },
  methods: {
    createIcon(icon) {
      return L.divIcon({
        html: `<div style="font-size: 24px">${icon}</div>`,
        className: 'custom-icon',
        iconSize: [32, 32],
        iconAnchor: [16, 16],
        popupAnchor: [0, -16]
      });
    },
    
    async fetchEvents() {
      try {
        this.loadingEvents = true;
        console.log('Fetching events from API...');
        
        // Use the full URL to the Laravel backend
        const response = await axios.get('http://127.0.0.1:8000/api/nasa/events', {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          withCredentials: true
        });
        
        console.log('API Response status:', response.status);
        
        if (response.data) {
          console.log('First 3 events from API:', response.data.slice(0, 3));
          
          // Process events to ensure they have all required fields
          this.events = response.data.map(event => {
            // Ensure the event has all required fields
            const processedEvent = {
              ...event,
              lat: parseFloat(event.lat) || 0,
              lng: parseFloat(event.lng) || 0,
              icon: event.icon || '📍',
              title: event.title || 'Nepoznat događaj',
              category: event.category || 'default',
              date: event.date || new Date().toISOString()
            };
            
            console.log('Processed event:', processedEvent);
            return processedEvent;
          });
          
          this.updateLastUpdated();
          
          // Log the first event's details if available
          if (this.events.length > 0) {
            console.log('First processed event:', this.events[0]);
          } else {
            console.warn('No events received from the API');
          }
        }
      } catch (error) {
        console.error('Error fetching events data:', error);
        if (error.response) {
          console.error('Response data:', error.response.data);
          console.error('Response status:', error.response.status);
          console.error('Response headers:', error.response.headers);
        } else if (error.request) {
          console.error('No response received:', error.request);
        } else {
          console.error('Error message:', error.message);
        }
      } finally {
        this.loadingEvents = false;
      }
    },
    getEventPopupContent(event) {
      return `
        <div class="p-2">
          <div class="font-bold text-lg">${event.title}</div>
          <div class="text-sm text-gray-600">${event.description || 'Nema dodatnog opisa'}</div>
          <div class="mt-2 text-sm">
            <div>Kategorija: <span class="font-medium">${event.category}</span></div>
            <div>Datum: <span class="font-medium">${event.date}</span></div>
            <div>Status: <span class="font-medium">${event.status === 'open' ? 'Aktivan' : 'Zatvoren'}</span></div>
          </div>
        </div>
      `;
    },
    
    onMapReady(mapObject) {
      this.map = mapObject;
      // Dodajemo kontrole za zoom na dnu mape
      L.control.zoom({
        position: 'bottomright'
      }).addTo(this.map);
    },
    zoomToLocation(lat, lng) {
      if (this.map) {
        this.map.flyTo([lat, lng], 8);
      }
    },
    updateLastUpdated() {
      const now = new Date();
      const options = { 
        day: '2-digit', 
        month: '2-digit', 
        year: 'numeric', 
        hour: '2-digit', 
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      };
      this.lastUpdated = now.toLocaleString('hr-HR', options);
    },
  },
};
</script>

<style>
/* Osnovni stilovi za mapu */
.leaflet-container {
  font-family: 'Inter', sans-serif;
}

/* Stilovi za markere */
.leaflet-marker-icon {
  filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
  background: transparent !important;
  border: none !important;
}

/* Stilovi za custom ikone */
.custom-icon {
  display: flex !important;
  align-items: center;
  justify-content: center;
  text-align: center;
  line-height: 1;
}

/* Stilovi za popup */
.leaflet-popup-content-wrapper {
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.leaflet-popup-content {
  margin: 10px;
  line-height: 1.4;
}

/* Responsivnost */
@media (max-width: 768px) {
  .container {
    padding-left: 1rem;
    padding-right: 1rem;
  }
  
  h1 {
    font-size: 1.75rem;
  }
}
</style>
