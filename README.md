# Procob API - SDK PHP
SDK em PHP para consulta a API RESTful da Procob S.A.


## Descrição
SDK em PHP para consulta a API RESTful da Procob S.A. [Documentação da API da Procob S/A](https://api.procob.com/)


## Instalação
Via Composer
```bash
composer require vitorccs/procob-api-php
```


## Parâmetros
Parâmetro | Obrigatório | Padrão | Comentário
------------ | ------------- | ------------- | -------------
PROCOB_API_USER | Sim | - | Usuário da API para autenticar.
PROCOB_API_PWD | Sim | - | Senha da API para autenticar. Se omitido, será usuado o de teste.
PROCOB_API_TIMEOUT | Não | 30 | Timeout em segundos para estabelecer conexão com a API


## Como usar
1) Os parâmetros podem ser definidos por váriaveis de ambiente:
```php
putenv('PROCOB_API_USER=sandbox@procob.com');
putenv('PROCOB_API_PWD=TesteApi');
putenv('PROCOB_API_TIMEOUT=30');
```

ou passados por `array`:
```php
\Procob\Http\Procob::setParams([
    'PROCOB_API_USER' => 'sandbox@procob.com',
    'PROCOB_API_PWD' => 'TesteApi',
    'PROCOB_API_TIMEOUT' => 30
]);
```
2) Em seguida, basta utilizar qualquer um dos métodos disponíveís:
```php
$consulta = \Procob\Person::getByCpfCnpj($cpfCnpj);
```
Você poderá usar o usuário e senha de testes da Procob (sandbox@procob.com | TesteApi), porém, os dados retornados pela API são todos fictícios s


## Métodos disponíveis
```php
// CPF/CNPJ Completo
Procob\Person::getByCpfCnpj($cpfCnpj)

// CPF/CNPJ pelo Nome
Procob\Person::getByName($cpfCnpj, $params = [])

// DDD + Telefone
Procob\Person::getByPhone($ddd, $number)

// Sintegra
Procob\Person::getCpfCnpjStatus($cpfCnpj, $params = [])

// Quadro Societário / Participação em Empresa(s)
Procob\Person::getCompanyPartners($cnpj)

// Vizinhos
Procob\Person::getNeighbors($params)

// CPF/CNPJ pelo E-mail
Procob\Person::getByEmail($email)

// Número do Benefício
Procob\Person::getNationalInsuranceStatus($cpf)

// Dados Gerais
Procob\Person::getBasicData($cpfCnpj)

// Perfil CNPJ
Procob\Person::getCompanyProfile($cnpj)
```


## Normalização de dados
* Os dados de CPF e CNPJ podem ser passados no formato número ou texto, com ou sem máscaras.
* Os números de CPF e CNPJ sempre passam por validação de dados da própria SDK, evitando com isso consumir uma  requisição a API.
* A SDK reconhece automaticamente quando a API da Procob não teve sucesso (código diferente de "000") e nestes casos, lança uma "exceção" (Exception) com a mensagem de erro.


## Exemplo de implementação

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

putenv('PROCOB_API_TIMEOUT=30');
putenv('PROCOB_API_USER=sandbox@procob.com');
putenv('PROCOB_API_PWD=TesteApi');

try {
    $response = Procob\Person::getByCpfCnpj('06.116.543/0001-55');
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
