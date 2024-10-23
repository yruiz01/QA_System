// Cargar actividades desde el servidor
fetch('../ajax/get_calendario.php')
    .then(response => response.json())
    .then(activities => {
        activities.forEach(activity => {
            // Crear un elemento de lista para cada actividad
            const listItem = document.createElement('li');
            listItem.className = 'list-group-item';
            listItem.textContent = activity.title + ' (Fecha: ' + activity.start + ')';
            listItem.style.cursor = 'pointer';
            
            // Mostrar detalles al hacer clic
            listItem.onclick = function() {
                document.getElementById('activityDetails').textContent = activity.details || 'No hay detalles disponibles';
                $('#modalActivityDetails').modal('show');
            };

            activityList.appendChild(listItem);
        });

        // Inicializar el calendario después de cargar las actividades
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: activities.map(activity => {
                return { title: activity.title, start: activity.start };
            }),
            eventDidMount: function(info) {
                const today = new Date();
                const eventDate = new Date(info.event.start);
                const diffTime = eventDate - today;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                // Cambiar color según la diferencia de días
                if (info.event.start < today) {
                    info.el.style.backgroundColor = 'green';
                    info.el.style.color = 'white';
                } else if (diffDays <= 7 && diffDays >= 0) {
                    info.el.style.backgroundColor = 'yellow';
                    info.el.style.color = 'black';
                } else {
                    info.el.style.backgroundColor = 'red';
                    info.el.style.color = 'white';
                }
            }
        });

        calendar.render();
    })
    .catch(error => {
        console.error('Error cargando las actividades:', error);
    });
