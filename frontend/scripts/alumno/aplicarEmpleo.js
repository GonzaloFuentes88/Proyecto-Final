document.addEventListener("DOMContentLoaded", function() {
    const botonesAplicar = document.querySelectorAll('.aplicar-empleo');

    botonesAplicar.forEach(button => {
        const empleoId = button.getAttribute('data-empleo-id');

        checkPostulacion(empleoId).then(data => {
            if (data) {
                button.disabled = true;
                button.innerText = "Postulado";
            }
        });

        button.addEventListener('click', function() {
            const postulacionData = {
                empleoId: empleoId
            };
            const BASEURL = "localhost:80/Proyecto-Final-Back";  
            fetch(`http://${BASEURL}/controllers/AlumnoController.php?aplicarEmpleo`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postulacionData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.disabled = true;
                    button.innerText = "Postulado";
                } else {
                    alert('Error al postularte: ' + data.message);
                }
            });
        });
    });

    async function checkPostulacion(empleoId) {
        const response = await fetch(`http://localhost:80/Proyecto-Final-Back/controllers/AlumnoController.php?checkPostulacion`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ empleoId })
        });

        const data = await response.json();
        return data;
    }
});
