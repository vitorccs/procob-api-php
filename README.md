# Procob API - SDK PHP
SDK em PHP para consulta a API RESTful da Procob S.A


## Descrição
SDK em PHP para consulta a API RESTful da Procob S.A
[Documentação da API da Procob S/A](https://api.procob.com/)


## Instalação
Via Composer
```bash
composer require vitorccs/procob-api-php
```


## Variáveis de ambiente
Os seguintes parâmetros devem ser informados:

Parâmetro | Obrigatório | Padrão | Comentário
------------ | ------------- | ------------- | -------------
PROCOB_API_USER | Não | sandbox@procob.com | Usuário da API para autenticar. Se omitido, será usuado o de teste.
PROCOB_API_PWD | Não | TesteApi | Senha da API para autenticar. Se omitido, será usuado o de teste.
PROCOB_API_TIMEOUT | Não | 30 | Timeout em segundos para estabelecer conexão com a API

## Como usar
Após definir as variáveis de ambiente acima, basta utilizar o comando abaixo passando os dados do boleto a registrar em formato `array`.
```php
$consulta = \Procob\Person::getByCpfCnpj($cpfCnpj);
```

## Normalização de dados
* Os dados de CPF e CNPJ podem ser passados no formato número ou texto, com ou sem máscaras.
* Os números de CPF e CNPJ sempre passam por validação de dados da própria SDK, evitando com isso consumir uma  requisição a API.
* A SDK reconhece automaticamente quando a API da Procob não teve sucesso (código diferente de "000") e nestes casos, lança uma exceção (Exception) com a mensagem de erro.

## Exemplo de implementação

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

putenv('PROCOB_API_TIMEOUT=30');
// comment both lines below below for sandbox mode
putenv('PROCOB_API_USER=user@company.com');
putenv('PROCOB_API_PWD=password');

try {
    $response = Procob\Person::getByCpfCnpj('06.116.543/0001-55');

    //$response = Procob\Person::getByName('Proc/ob');

    //$response = Procob\Person::getByPhone(11, 26794674);

    //$response = Procob\Person::getCpfCnpjStatus('06.116.543/0001-55');

    //$response = Procob\Person::getCompanyPartners('06.116.543/0001-55');

    //$response = Procob\Person::getNeighbors('06.116.543/0001-55');

    //$response = Procob\Person::getByEmail('procob@procob.com');

    //$response = Procob\Person::getNationalInsuranceStatus('14708280904');

    //$response = Procob\Person::getBasicData('06.116.543/0001-55');

    //$response = Procob\Person::getCompanyProfile('06.116.543/0001-55');

    print_r($response);
} catch (\Exception $e) {
    die("Error: ". $e->getMessage() ."\n");
}

die("Success \n");
```

## Testes
Caso queira contribuir, por favor, implementar testes de unidade em PHPUnit.

Para executar:
1) Faça uma cópia de phpunit.xml.dist em phpunit.xml na raíz do projeto
2) Altere os parâmtros ENV com os dados de seu acesso
3) Execute o comando abaixo no terminal dentro da pasta deste projeto:

```bash
composer test
```
