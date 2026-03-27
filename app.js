const map = L.map('map').setView([31.7421556, -106.4341617], 18);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: 'OpenStreetMap'
}).addTo(map);

const lugares = [
  { id: 1, lat: 31.6904, lng: -106.4245, disponible: true },
  { id: 2, lat: 31.6910, lng: -106.4250, disponible: false },
  { id: 3, lat: 31.6920, lng: -106.4230, disponible: true }
];

let seleccionado = null;

lugares.forEach(lugar => {
  const marker = L.circleMarker([lugar.lat, lugar.lng], {
    color: lugar.disponible ? 'green' : 'red',
    radius: 10
  }).addTo(map);

  marker.on('click', () => {
    if (!lugar.disponible) return;

    seleccionado = lugar;
    document.getElementById("seleccion").textContent =
      "Seleccionaste lugar " + lugar.id;
  });
});