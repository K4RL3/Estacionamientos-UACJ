// 1. Datos que se mostrarán en la tarjeta
const CAMPUS_DATA = {
    iit_iada: { 
        lat: 31.742285605733223, lng:-106.43430739535914, 
        nombre: "IIT / IADA (Ingeniería y Diseño)",
        detalles: "Ubicado en Av. del Charro. Acceso principal para estudiantes de Ingeniería y Arquitectura. Cuenta con vigilancia 24/7.",
        cajones: "450"
    },
    icsa: { 
        lat: 31.75783056382174, lng: -106.45024298962583, 
        nombre: "ICSA (Ciencias Sociales)",
        detalles: "Ubicado en Heroico Colegio Militar. Acceso controlado para alumnos de Administración, Derecho y Psicología.",
        cajones: "600"
    },
    icb: {
        lat: 31.74625111226689, lng: -106.44108258085889, 
        nombre: "ICB (Biomédicas)",
        detalles: "Zona de estacionamiento cercana a los laboratorios y clínicas de salud. Acceso por calle Estocolmo.",
        cajones: "320"
    },
    cu: {
        lat: 31.492603330807146, lng: -106.41322194203546, 
        nombre: "CU (Ciudad Universitaria)",
        detalles: "Amplio complejo de estacionamientos que da servicio a todos los institutos del campus sur.",
        cajones: "1,200"
    }
};

let map, marker;

function initMap() {
    const inicio = CAMPUS_DATA.iit_iada;
    map = L.map('map').setView([inicio.lat, inicio.lng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    marker = L.marker([inicio.lat, inicio.lng]).addTo(map);
    
    // Mostramos la info de IIT por defecto al cargar
    actualizarInterfaz("iit_iada");
}

// 3. EVENTO DE CAMBIO: Esta es la clave
document.getElementById('campus-selector').addEventListener('change', (e) => {
    const seleccion = e.target.value;
    const data = CAMPUS_DATA[seleccion];

    // Mueve el marcador y el mapa
    map.flyTo([data.lat, data.lng], 17);
    marker.setLatLng([data.lat, data.lng]);
    
    // Actualiza la tarjeta informativa
    actualizarInterfaz(seleccion);
});

// 4. FUNCIÓN QUE LLENA LA TARJETA
function actualizarInterfaz(clave) {
    const info = CAMPUS_DATA[clave];
    
    // Buscamos los elementos por su ID y les inyectamos el texto
    document.getElementById('nombre-campus').innerText = info.nombre;
    document.getElementById('detalles-campus').innerText = info.detalles;
    document.getElementById('capacidad-campus').innerText = info.cajones + " cajones";
}

initMap();