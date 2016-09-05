function showError(message) {
    alert(message);
}

function deleteRow(type, id, btn) {
    $.getJSON('ajax.php', {
        action: type + '-delete',
        id: id
    }, function(data) {
        if (data.status == 'OK') {
            btn.closest('tr').fadeOut();
        } else {
            showError(data.status);
        }
    });
}

$(function() {
    $('.btn-zamestnanci').on('click', function() {
        var $this = $(this);
        if ($this.data('action') == 'edit') {
            window.location.href = 'index.php?page=zamestnanci-edit&id=' + $this.data('id');
            return true;
        }
        if ($this.data('action') == 'delete') {
            deleteRow('zamestnanci', $this.data('id'), $this);
        }
    });
    $('.btn-oddelenia').on('click', function() {
        var $this = $(this);
        if ($this.data('action') == 'edit') {
            window.location.href = 'index.php?page=oddelenia-edit&id=' + $this.data('id');
            return true;
        }
        if ($this.data('action') == 'delete') {
            deleteRow('oddelenia', $this.data('id'), $this);
        }
    });
});