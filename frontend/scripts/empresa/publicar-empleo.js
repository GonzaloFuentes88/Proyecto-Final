document.addEventListener('DOMContentLoaded', async function() {
    const select = document.getElementById('modalidad');
    let response = await fetch('http://localhost/Proyecto-Final-Back/controllers/EmpresaController.php?modalidades')
    response = await response.json()
    console.log(response)
    response.body.forEach(option => {
        const newOption = document.createElement('option')
        newOption.value = option.id
        newOption.textContent = option.descripcionModalidad
        select.appendChild(newOption)
    });
})