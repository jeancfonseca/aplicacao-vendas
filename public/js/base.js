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

$("#salvar_venda").click(function (e) {
    e.preventDefault();
    e.stopPropagation();

    var form = $("#form_cadastro_venda");

    var venda = {
        id_vendedor: form.find("#form_venda_vendedor").val(),
        valor_venda: form.find("#form_venda_valor").val()
    };

    $.ajax({
        url: "/venda",
        dataType: "json",
        type: "post",
        data: venda,
        error: function () {
            alert("Erro ao cadastrar venda !!!")
        },
        success: function () {
            alert("Venda cadastrada com sucesso !!!")
            window.location = "/";
        }
    })
});