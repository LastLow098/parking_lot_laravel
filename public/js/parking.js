$(document).ready(function() {
    localStorage.clear()
    $.get('/get-clients', (data) => {
        getClients(data)
        getAutos(data[0].id)
        // getParking()
    })
    $('#auto-in').prop("disabled", true);
});

$('#client').change(function () {
    getAutos($('option:selected', this).val());
});

$('#auto').change(function() {
    $('#auto-in').attr('value', $('option:selected', this).val())
})

function getClients(data) {
    if (data.length != 0) {
        $("#client").empty();
        $.each(data, (key, value) => {
            $('#client').append('<option value="' + value.id + '">' + value.name + '</option>');
        })
    }
}


async function getAutos(id) {
    let autos;
    if (localStorage.getItem(id)) {
        autos = JSON.parse(localStorage.getItem(id))
    }else {
        await $.get('/get-auto-no-parking', {'id': id}, (data) => {
            localStorage.setItem(id, JSON.stringify(data));
            autos = data
        })
    }

    $("#auto").empty();
    if (autos.length) {
        $.each(autos, (key, value) => {
            $('#auto').append('<option value="' + value.id + '">' + value.model + '</option>');
        })
        $('#auto-in').prop("disabled", false);
    }else {
        $('#auto').append('<option>Ничего нет</option>');
        $('#auto-in').prop("disabled", true);
    }

    $('#auto-in').attr('value', autos[0].id);
}
