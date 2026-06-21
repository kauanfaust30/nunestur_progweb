import * as bootstrap from 'bootstrap';

let formParaExcluir = null;

window.confirmDelete = function (form, mensagem) {
    formParaExcluir = form;
    document.getElementById('confirmModalText').textContent =
        mensagem || 'Tem certeza que deseja excluir este item? Essa ação não pode ser desfeita.';
    document.getElementById('confirmModal').classList.add('active');
    return false;
};

window.closeConfirmModal = function () {
    formParaExcluir = null;
    document.getElementById('confirmModal').classList.remove('active');
};

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('confirmModalBtn').addEventListener('click', function () {
        if (formParaExcluir) {
            formParaExcluir.submit();
        }
    });

    document.getElementById('confirmModal').addEventListener('click', function (e) {
        if (e.target === this) closeConfirmModal();
    });
});