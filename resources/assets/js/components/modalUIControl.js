ModalCreateShow = function () {
    $('#createModal').modal({
        backdrop: 'static',
        keyboard: false,
        show: true
    });
};

ModalErrorShow = function () {
    $('#errorModal').modal('show');
    setTimeout(function () {
        $('#createModal').modal('hide');
    }, 10000);
};

ModalSuccessShow = function () {
    $('#successModal').modal('show');
    setTimeout(function () {
        $('#successModal').modal('hide');
    }, 2000);
};

