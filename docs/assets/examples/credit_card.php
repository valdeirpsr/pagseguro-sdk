<?php

require_once "vendor/autoload.php";

use ValdeirPsr\PagSeguro\Constants\Shipping\Type as ShippingTypes;
use ValdeirPsr\PagSeguro\Exception\{
    Auth as AuthException,
    PagSeguroRequest as PagSeguroRequestException
};
use ValdeirPsr\PagSeguro\Domains\{
    Payment,
    CartItem,
    Shipping,
    Address,
    Document,
    User\Factory as FactoryUser,
    PaymentMethod\CreditCard
};
use ValdeirPsr\PagSeguro\Request\Sale;

/**
 * Gera a sessão para autorização da requisição
 */
$sessionHash = $this->model_extension_payment_pagseguro->generateSession();

/**
 * Informa os dados do cliente
 */
$sender = FactoryUser::sender(
    'Valdeir Psr',
    'teste@valdeir.dev',
    '71912345678',
    Document::cpf('000.000.000-00'),
    $sessionHash
);

/**
 * Define os produtos que o cliente comprou
 */
$products = [];

foreach ($this->cart->getProducts() as $product) {
    $product = new CartItem();
    $product->setId('123');
    // Limite de 80 caracteres
    $product->setDescription('Teatro Completo de Ariano Suassuna');
    $product->setQuantity(1);
    $product->setAmount(349.91);
    $products[] = $item;
}

$payment = new Payment();
$payment->setMode('default');
$payment->setSender($sender);
$payment->setCurrency('BRL');
$payment->setReference('Comentário do cliente / Referência do Pedido');
$payment->setCartItems($products);
// Defina a URL que receberá os alertas do WebHook
$payment->setNotificationUrl('https://example.com/callback?order_id=123');
// Define um valor de desconto (valor negativo) ou acréscimo (valor positivo)
$payment->setExtraAmount(-9.91);

/**
 * Define os dados de endereço
 */
$address = new Address();
$address->setStreet('Avenida Brasil');
$address->setNumber('44878');
$address->setDistrict('Campo Grande');
$address->setCity('Rio de Janeiro');
$address->setState('RJ');
$address->setPostalCode('23078001');
$address->setComplement('Mar Mil');

/**
 * Dados do titular do cartão
 */
$holder = FactoryUser::holder(
    'Titular do cartão',
    'customer@example.com',
    '71912345678',
    Document::cpf('000.000.000-00')
);
$holder->setBirthdate(DateTime::createFromFormat('Y-m-d', '1993-07-13'));

/**
 * Define os dados do cartão de crédito
 */
$creditCard = new CreditCard();
$creditCard->setToken('token gerado pelo JavaScript do PagSeguro');
$creditCard->setInstallmentQuantity(7); // Número de parcelas
$creditCard->setInstallmentValue(69.98); // Valor gerado pelo JavaScript
$creditCard->setBillingAddress($address); //
$creditCard->setHolder($holder);

/**
 * Caso tenha definido juros, utilize o método abaixo para informar
 * o número de parcelas sem juros; caso contrário, deixa-a comentada.
 */
//$creditCard->setNoInterestInstallmentQuantity(1);

/**
 * Define os dados de entrega
 */
$shipping = new Shipping();
$shipping->setAddressRequired(true);
$shipping->setType(ShippingTypes::UNKNOWN); // Utilize UNKNOWN, PAC ou SEDEX
$shipping->setCost(10.00);
$shipping->setAddress($address);

/**
 * Define o ambiente. Caso esteja usando em produção, utilize
 * ```Environment::production```
 */
$env = Environment::sandbox('seu e-mail', 'seu token');

/**
 * Realiza a requisição e obtém o ID da transação
 */
$sale = new Sale($env);
$response = $sale->create($payment);

echo $response->getCode(); // Imprime o código de identificação da transação
