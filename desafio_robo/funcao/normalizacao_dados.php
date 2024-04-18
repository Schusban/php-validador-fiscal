<?php
//Funcao valida CNPJ 
function ValidaCnpj($CNPJ) {
    if(preg_match('/CNPJ\s+[0-9]{2}.[0-9*]{3}.[0-9*]{3}\/[0-9*]{4}-[0-9*]{2}/', $CNPJ, $matches)) {
        $CNPJ = preg_replace("/CNPJ/", '', $matches[0]);
        return $CNPJ;
    }
    elseif(preg_match('/CNPJ:\s[0-9.\/\*\-]{14,}/', $CNPJ, $matches)) {
        $CNPJ = reset($matches);
        $CNPJ = preg_replace('/[^0-9*]+/', '', (string)$CNPJ);
        return $CNPJ;
    }
}

function ValidaChaveAcessoQr($data) {
    $Chave_de_acesso_qr = ""; 
    if (preg_match("/[0-9\s]+/i", $Chave_de_acesso_qr)) {
        var_dump($Chave_de_acesso_qr);
        // Se houver correspondência, atualiza o campo 'chave_acesso' no array
        $Chave_de_acesso_qr  = trim($Chave_de_acesso_qr);
    }
    
    return $Chave_de_acesso_qr;
}

//Funcao valida o Fisco
function validaFisco($fisco) {
    $fisco = str_replace([' ', '-'], '', $fisco);
    if (preg_match("/\b([A-z0-9]{4}\.){7}[A-z0-9]{4}\b/", $fisco)) {
        $fisco = str_replace('.', ' ', $fisco);
        return strtoupper($fisco);
    }
    elseif($fisco == ''){
        $array_fisco['fisco'] = $fisco;
    }
    elseif (!empty($fisco)) {
        $array_fisco['fisco'] = "";
    }
    else{
        $array_fisco['fisco'] = 'Verificar fisco da fatura';
        $array_fisco['fisco_verificado'] = false;
    }
}

//Funcao retorna base calculo, aliquota e valor do PIS
function validaPis($data) {
    $base_pis = $aliquota_pis = $valor_pis = "";
    if(isset($data[12])) {
        $exploded = explode(" ", $data[12]);
        if(count($exploded) >= 3) {
            $base_pis = $exploded[0];
            $aliquota_pis = str_replace('%','',$exploded[1]);
            $valor_pis = $exploded[2];
        }
    }
    return [$base_pis, $aliquota_pis, $valor_pis];
}

//Funcao retorna base calculo, aliquota e valor do COFINS
function validaCofins($data) {
    $base_cofins = $aliquota_cofins = $valor_cofins = "";
    if(isset($data[13])) {
        $exploded = explode(" ", $data[13]);
        if(count($exploded) >= 3) {
            $base_cofins = $exploded[0];
            $aliquota_cofins = str_replace('%','',$exploded[1]);
            $valor_cofins = $exploded[2];
        }
    }
    return [$base_cofins, $aliquota_cofins, $valor_cofins];
}

//Funcao retorna base calculo, aliquota e valor do ICMS
function validaIcms($data) {
    $base_icms = $aliquota_icms = $valor_icms = "";
    if(isset($data[14])) {
        $exploded = explode(" ", $data[14]);
        if(count($exploded) >= 3) {
            $base_icms = $exploded[0];
            $aliquota_icms = str_replace('%','',$exploded[1]);
            $valor_icms = $exploded[2];
        }
    }
    return [$base_icms, $aliquota_icms, $valor_icms];
}
?>
