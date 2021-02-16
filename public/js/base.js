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
            alert("Erro ao cadastrar vendedor !!!");
        },
        success: function (data) {
            alert("Vendedor " + data.nome + " cadastrado com sucesso !!!");
            window.location = "/listar/vendedores";
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
            alert("Erro ao cadastrar venda !!!");
        },
        success: function () {
            alert("Venda cadastrada com sucesso !!!");
            window.location = "/listar/vendas/vendedores/" + form.find("#form_venda_vendedor").val();
        }
    })
});

$("#enviar_relatorio_vendas_dia").click(function (e) {
    e.preventDefault();
    e.stopPropagation();

    $.ajax({
        url: "/venda/relatorio",
        type: "post",
        error: function () {
            alert("Erro ao enviar relatório de vendas do dia !!!");
        },
        success: function () {
            alert("Relatório de vendas do dia enviado com sucesso !!!");
        }
    })
});

$("#atualizar_email_empresa").click(function (e) {
    e.preventDefault();
    e.stopPropagation();

    var form = $("#form_alterar_email_empresa");

    var email = {
        email_empresa: form.find("#form_alterar_email_empresa_email").val()
    };

    $.ajax({
        url: "/email/empresa",
        dataType: "json",
        type: "put",
        data: email,
        error: function () {
            alert("Erro ao atualizar email !!!");
        },
        success: function () {
            alert("Email atualizado com sucesso !!!");
            window.location = "/";
        }
    })
});

$(".visualizar_vendas_vendedor").click(function (e) {
    e.preventDefault();
    e.stopPropagation();

    var idVendedor = $(this).data("id-vendedor");

    window.location = "/listar/vendas/vendedores/" + idVendedor;
});