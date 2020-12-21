
<style>

    .borda{
        border: 1px solid #000000;
    }
    .titulo{
        background-color: #239c02;
        color: #FFFFFF;
        text-align: center;
        border: 1px solid #000000;
    }
    .sub-Titulo{
        background-color: #73b85c;
        color: #FFFFFF;
        text-align: center;
        border: 1px solid #000000;
    }

    .conteudo{
        text-align: center;
        border: 1px solid #000000;
    }
</style>

    <table class="borda">
        <tr class="borda">
            <b>
                <td colspan="4" class="titulo">Relatório - Quantidade de Cadastros</td>
            </b>
        </tr>

        <tr>
            <th class="sub-Titulo">Albúns</th>
            <th class="sub-Titulo">Estilos</th>
            <th class="sub-Titulo">Músicas</th>
            <th class="sub-Titulo">Usuários</th>
        </tr>
        <tr>
            <td class="conteudo">{{$albuns}}</td>
            <td class="conteudo">{{$estilos}}</td>
            <td class="conteudo">{{$musicas}}</td>
            <td class="conteudo">{{$usuarios}}</td>
        </tr>
    </table>

