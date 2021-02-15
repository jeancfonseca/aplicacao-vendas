$("#salvar_vendedor").click(function (e) {
    e.preventDefault();
    e.stopPropagation();

    var form = $("#form_cadastro_vendedor");

    var vendedor = {
        nome: form.find("#form_vendedor_nome").val(),
        email: form.find("#form_vendedor_email").val()
    };

    $.ajax({
        url: "/vendedor",
        dataType: "json",
        type: "post",
        data: vendedor,
        error: function () {
            alert("Erro ao cadastrar vendedor !!!")
        },
        success: function (data) {
            alert("Vendedor " + data.nome + " cadastrado com sucesso !!!")
            window.location = "/";
        }
    })
});