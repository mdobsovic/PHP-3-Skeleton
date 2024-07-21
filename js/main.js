function showError(message) {
    alert(message);
}

function deleteRow(type, id, btn) {
    $.getJSON(
        "ajax.php",
        {
            action: type + "-delete",
            id: id,
        },
        function (data) {
            if (data.status == "OK") {
                btn.closest("tr").fadeOut();
            } else {
                showError(data.status);
            }
        }
    );
}

$(function () {
    $(".zamestnanci-delete").on("click", function () {
        const potvrdenie = window.confirm("Naozaj chcete zmazať tohto zamestnanca?");
        if (!potvrdenie) {
            return false;
        }
        const $this = $(this);
        deleteRow("zamestnanci", $this.data("id"), $this);
    });
    $(".oddelenia-delete").on("click", function () {
        const potvrdenie = window.confirm("Naozaj chcete zmazať toto oddelenie?");
        if (!potvrdenie) {
            return false;
        }
        const $this = $(this);
        deleteRow("oddelenia", $this.data("id"), $this);
    });
    $(".pouzivatelia-delete").on("click", function () {
        const potvrdenie = window.confirm("Naozaj chcete zmazať tohto používateľa?");
        if (!potvrdenie) {
            return false;
        }
        const $this = $(this);
        deleteRow("pouzivatelia", $this.data("id"), $this);
    });
});
