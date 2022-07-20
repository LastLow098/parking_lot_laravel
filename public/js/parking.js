$(document).ready(function() {
    localStorage.clear()
    $.get('/get-clients', (data) => {
        getClients()
        getAutos(data[0].id)
    })
});

$('#client').change(function () {
    getAutos($('option:selected', this).val());
});

function getClients() {
    $.get('/get-clients', (data) => {
        $("#client").empty();
        $.each(data, (key, value) => {
            $('#client').append('<option value="' + value.id + '">' + value.name + '</option>');
        })
    })
}

async function getAutos(id) {
    let autos;
    if (localStorage.getItem(id)) {
        autos = JSON.parse(localStorage.getItem(id))
    }else {
        await $.get('/get-auto-parking', {'id': id}, (data) => {
            localStorage.setItem(id, JSON.stringify(data));
            autos = data
        })
    }

    $("#auto").empty();
    $.each(autos, (key, value) => {
        $('#auto').append('<option value="' + value.id + '">' + value.model + '</option>');
    })
}
