<?php

require_once '/lib/Braintree.php';

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('84t4kgdbjnqzzyhx');
Braintree_Configuration::publicKey('ndy43d3k4k667gdt');
Braintree_Configuration::privateKey('8f51f406c69039ba5ae2492be94f26bc');

$result = Braintree_Transaction::sale([
    'amount' => '10',
    'paymentMethodNonce' => 'fake-valid-nonce',
    'options' => [ 'submitForSettlement' => true ]
]);

if ($result->success) {
    echo "<pre>";
    print_r("success!: " . $result->transaction->id);
} else if ($result->transaction) {
    echo "<pre>";
    print_r("Error processing transaction:");
    print_r("\n  code: " . $result->transaction->processorResponseCode);
    print_r("\n  text: " . $result->transaction->processorResponseText);
} else {
    echo "<pre>";
    print_r("Validation errors: \n");
    print_r($result->errors->deepAll());
}