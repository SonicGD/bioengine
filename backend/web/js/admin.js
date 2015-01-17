$(function () {
    //$('.form-control').phoenix();
    $('form').on('beforeSubmit', function (e) {
        $('.form-control').phoenix('remove');
    });

    $('#dialog').click(function () {
        var fm = $('<div/>').dialogelfinder({
            url: 'php/connector.php',
            lang: 'ru',
            width: 840,
            destroyOnClose: true,
            getFileCallback: function (files, fm) {
                console.log(files);
            },
            commandsOptions: {
                getfile: {
                    oncomplete: 'close',
                    folders: true
                }
            }
        }).dialogelfinder('instance');
    });
});

