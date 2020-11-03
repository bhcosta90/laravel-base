$(function () {
    $('.form-delete-confirmation').submit(function (e) {
        if (!confirm('Você tem certeza que deseja remover esse registro?')) {
            e.preventDefault();
        }
    });
})
