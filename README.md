# Validador Fiscal para Faturas de Energia (PHP)

Este repositório contém um conjunto de funções PHP para validar e extrair informações fiscais de faturas de energia elétrica no Brasil. Os dados são extraídos de PDFs por meio de ferramentas como APDF, e as funções ajudam a interpretar e formatar os campos mais importantes da fatura.

## Contexto

Faturas de energia geralmente possuem dados fiscais como CNPJ do fornecedor, chave de acesso, informações do Fisco, e tributos como PIS, COFINS e ICMS. Estes dados, extraídos diretamente do PDF, precisam ser tratados para uso em sistemas de análise ou contabilidade.

## Funcionalidades

- **Validação e extração do CNPJ** presente na fatura, mesmo em formatos variados.  
- **Validação da chave de acesso do QR Code** da nota fiscal eletrônica vinculada à fatura.  
- **Verificação e formatação dos dados do Fisco** constantes na fatura.  
- **Extração dos valores de base de cálculo, alíquota e valor dos tributos PIS, COFINS e ICMS**, conforme apresentados na fatura.  

## Como usar

1. Extraia os dados da fatura de energia no formato texto (ex: usando APDF).  
2. Passe os dados extraídos para as funções para validação e extração.  

Exemplo básico:

```php
require 'validador-fiscal.php';

// Suponha que $texto contem o texto extraído da fatura
$cnpj = ValidaCnpj($texto);

$dadosTributos = explode("\n", $texto);
list($basePis, $aliquotaPis, $valorPis) = validaPis($dadosTributos);
list($baseCofins, $aliquotaCofins, $valorCofins) = validaCofins($dadosTributos);
list($baseIcms, $aliquotaIcms, $valorIcms) = validaIcms($dadosTributos);
```

## Requisitos
- PHP 7.0 ou superior
- Ferramenta para extração de texto de PDF (ex: APDF)
