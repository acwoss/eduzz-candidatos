$(function() {
    "use strict";

    if( $('.no-results').is(':visible') ) {
        $('.tap-target').tapTarget('open');
    }

    $('form').on('submit', function (event) {
        event.preventDefault();

        const uri = this.getAttribute('action');

        const data = new FormData(this);
        data.append('avatar', $('input[type=file]')[0].files[0]);

        const request = $.ajax(uri, {
            method: 'post',
            data: data,
            processData: false,
            contentType: false,
            dataType: 'json'
        });

        request.then(function (response) {
            window.location = response.redirect;
        });

        request.catch(function (error) {
            console.error(error);
        });
    });

    $('.delete').on('click', function (event) {
        const id = this.dataset.id;

        if (confirm("Deseja mesmo excluir o candidato? Cuidado, esta operação não poderá ser desfeita.")) {
            const request = $.ajax('/candidate/'+id, {
                method: 'delete',
                dataType: 'json'
            });

            request.then(function (response) {
                window.location = response.redirect;
            });

            request.catch(function (error) {
                console.error(error);
            });
        }

    });
});