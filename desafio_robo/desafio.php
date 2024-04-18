<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Implantação</title>
<style>
body {
  background-color: rgb(109, 128, 123);
  color: black;
}
table {
    width: 100%; /* Defina a largura da tabela como 100% */
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
}

th {
    background-color: rgb(255, 255, 255);
}
</style>
</head>
<body>
<table>
<thead>
<tr>
<th>Unidade</th>
<th>Conta Contrato</th>
<th>CNPJ</th>
<th>Nota Fiscal</th>
<th>Código de Barra</th>
<th>Fisco</th>
<th>Chave de Acesso QR</th>
<th>Constante</th>
<th>Leitura Anterior</th>
<th>Leitura Atual</th>
<th>Consumo</th>
<th>BASE PIS</th>
<th>ALIQ PIS</th>
<th>VALOR PIS</th>
<th>BASE COFINS</th>
<th>ALIQ COFINS</th>
<th>VALOR COFINS</th>
<th>BASE ICMS</th>
<th>ALIQ ICMS</th>
<th>VALOR ICMS</th>
<th>Total Fatura</th>
<th>CIP</th>
<th>Consumo Faturado</th>
<th>Consumo Injetado</th>
</tr>
</thead>
<tbody>
<?php

$localArquivos = 'C:\Users\bianca.schusarz\Downloads\desafio\faturas'; //MUDAR PARA A PASTA ONDE ESTA SEU CSV
$folder = $localArquivos;
$files = scandir($folder);
require_once './funcao/normalizacao_dados.php';

foreach ($files as $file) {  
    if (substr($file, -3) == "csv" && ($getfile = fopen($folder . "\\" . $file, "r")) !== false) {
        // Lê a primeira linha do arquivo CSV para obter os cabeçalhos
        $header = fgetcsv($getfile);
        // Loop para ler cada linha do arquivo
        while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
            $Unidade = $data[1];
            $Conta_contrato = $data[2];
            $CNPJ = ValidaCnpj($data[3]);
            $Nota_fiscal = $data[4];
            $Codigo_de_barra = $data[5];
            $Fisco = ValidaFisco($data[6]);
            $Chave_de_acesso_qr = $data[7];
            $Constante = $data[8];
            $Leitura_anterior = $data[9];
            $Leitura_atual = $data[10];
            $Consumo = $data[11];
            list($base_pis, $aliquota_pis, $valor_pis) = validaPis($data);
            list($base_cofins, $aliquota_cofins, $valor_cofins) = validaCofins($data);
            list($base_icms, $aliquota_icms, $valor_icms) = validaIcms($data);
            $Total_fatura = $data[15];
            $CIP = $data[16];
            $Consumo_faturado = $data[17];
            $Consumo_injetado = $data[18];

            echo "<tr>";
            echo "<td>$data[1]</td>";
            echo "<td>$data[2]</td>";
            echo "<td>$data[3]</td>";
            echo "<td>$data[4]</td>";
            echo "<td>$data[5]</td>";
            echo "<td>$Fisco</td>";
            echo "<td>$Chave_de_acesso_qr</td>";
            echo "<td>$data[8]</td>";
            echo "<td>$data[9]</td>";
            echo "<td>$data[10]</td>";
            echo "<td>$data[11]</td>";
            echo "<td>$base_pis</td>";
            echo "<td>$aliquota_pis</td>";
            echo "<td>$valor_pis</td>";
            echo "<td>$base_cofins</td>";
            echo "<td>$aliquota_cofins</td>";
            echo "<td>$valor_cofins</td>";
            echo "<td>$base_icms</td>";
            echo "<td>$aliquota_icms</td>";
            echo "<td>$valor_icms</td>";
            echo "<td>$data[15]</td>";
            echo "<td>$data[16]</td>";
            echo "<td>$data[17]</td>";
            echo "<td>$data[18]</td>";
            echo "</tr>";
        }
        
        // Fecha o arquivo CSV
        fclose($getfile);
    }
}

?>
</tbody>
</table>
</body>
</html>

<style>
body {
  background-color:rgb(109, 128, 123);
  color: 000;
}
</style>