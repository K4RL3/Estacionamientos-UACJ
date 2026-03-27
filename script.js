const SUPABASE_URL = 'https://bzgxzktqzgiybvertkkv.supabase.co';
const SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImJ6Z3h6a3RxemdpeWJ2ZXJ0a2t2Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NzQ0NTEwNjMsImV4cCI6MjA5MDAyNzA2M30.Bw-TtNyQGeTZI6z_17UbT_E4SD9NwEltGu6nN_hejNA';

// --- 2. CARGAR DATOS ---
async function cargarCajones(nivel) {
    try {
        const response = await fetch(`${SUPABASE_URL}/rest/v1/estacionamiento?nivel=eq.${nivel}&select=*&order=nombre_cajon.asc`, {
            headers: { 
                'apikey': SUPABASE_KEY, 
                'Authorization': `Bearer ${SUPABASE_KEY}` 
            }
        });
        
        const datos = await response.json();
        dibujarMapa(datos, nivel);
        
    } catch (error) {
        console.error("Error al cargar cajones:", error);
    }
}

// --- 3. DIBUJAR MAPA (Sin duplicados) ---
function dibujarMapa(datosCajones, nivelActual) {
    const contenedor = document.getElementById('mapa-interactivo');
    
    // IMPORTANTE: Limpiar el contenedor antes de agregar cajones
    contenedor.innerHTML = ''; 

    datosCajones.forEach(cajon => {
        const div = document.createElement('div');
        div.className = `cajon ${cajon.esta_ocupado ? 'ocupado' : 'libre'}`;
        div.innerHTML = `<span>${cajon.nombre_cajon}</span>`;

        // Solo permitir clic si está libre
        if (!cajon.esta_ocupado) {
            div.onclick = () => seleccionarLugar(cajon.id, cajon.nombre_cajon, nivelActual);
        }

        contenedor.appendChild(div);
    });
}

// --- 4. SELECCIONAR LUGAR (Límite de 1 reserva y Redirección) ---
async function seleccionarLugar(idCajon, nombre, nivel) {
    // Verificación de sesión
    if (typeof USUARIO_ACTUAL_ID === 'undefined' || !USUARIO_ACTUAL_ID || USUARIO_ACTUAL_ID === 0) {
        alert("Error: No se detectó tu sesión de usuario.");
        return;
    }

    try {
        // A. VALIDAR SI YA TIENE RESERVA
        const checkReserva = await fetch(`${SUPABASE_URL}/rest/v1/reservas?usuario_id=eq.${USUARIO_ACTUAL_ID}&select=*`, {
            headers: { 'apikey': SUPABASE_KEY, 'Authorization': `Bearer ${SUPABASE_KEY}` }
        });
        const reservasExistentes = await checkReserva.json();

        if (reservasExistentes.length > 0) {
            alert("¡Ya tienes un lugar reservado! No puedes elegir más de uno.");
            return; 
        }

        // B. CONFIRMACIÓN
        const confirmar = confirm(`¿Confirmas la reserva del lugar ${nombre}?`);
        if(!confirmar) return;

        // C. CREAR REGISTRO EN RESERVAS
        const resReserva = await fetch(`${SUPABASE_URL}/rest/v1/reservas`, {
            method: 'POST',
            headers: {
                'apikey': SUPABASE_KEY,
                'Authorization': `Bearer ${SUPABASE_KEY}`,
                'Content-Type': 'application/json',
                'Prefer': 'return=minimal'
            },
            body: JSON.stringify({
                usuario_id: USUARIO_ACTUAL_ID,
                cajon_id: idCajon,
                fecha_reserva: new Date().toISOString()
            })
        });

        if (!resReserva.ok) throw new Error("No se pudo crear la reserva en la base de datos.");

        // D. ACTUALIZAR ESTADO DEL CAJÓN A OCUPADO
        const resCajon = await fetch(`${SUPABASE_URL}/rest/v1/estacionamiento?id=eq.${idCajon}`, {
            method: 'PATCH',
            headers: {
                'apikey': SUPABASE_KEY,
                'Authorization': `Bearer ${SUPABASE_KEY}`,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ esta_ocupado: true })
        });

        if (!resCajon.ok) throw new Error("No se pudo actualizar el estado del cajón.");

        // --- E. ÉXITO Y REDIRECCIÓN ---
        // En lugar de alert, mandamos al usuario a su ticket digital
        window.location.href = `confirmacion.php?cajon=${encodeURIComponent(nombre)}`;

    } catch (error) {
        console.error("Error:", error);
        alert("Hubo un problema: " + error.message);
    }
}