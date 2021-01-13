<?php

require_once 'vendor/autoload.php';

use ValdeirPsr\PagSeguro\Constants\Shipping\Type as ShippingTypes;
use ValdeirPsr\PagSeguro\Request\Sale;
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
    PaymentMethod\DebitCard
};

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

/**
 * Define o nome do banco
 */
$debitCard = new DebitCard();
$debitCard->setBank($bank_name);

/**
 * Define os dados de pagamento
 */
$payment = new Payment();
$payment->setMode('default');
$payment->setSender($sender);
$payment->setCurrency('BRL');
$payment->setReference('Comentário do cliente / Referência do Pedido');
$payment->setCartItems($items);
// Defina a URL que receberá os alertas do WebHook
$payment->setNotificationUrl('https://example.com/callback?order_id=123');
// Define um valor de desconto (valor negativo) ou acréscimo (valor positivo)
$payment->setExtraAmount(-9.91);

/**
 * Define que o pagamento será via boleto
 */
$payment->setPayment($debitCard);

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

/*
 * Realiza a requisição para criação do pagamento
 */
$sale = new Sale($env);
$response = $sale->create($payment);

echo implode(PHP_EOL, [
    'ID Transaction: ' . $response->getCode(),
    'Payment Link: ' . $response->getPayment()->getPaymentLink(), // O usúario deverá ser redirecionado para o site do banco
    'Payment Code: ' . $response->getCode()
]);
