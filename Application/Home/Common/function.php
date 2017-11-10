<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function braintree($allmoney,$nonce){
    //Vendor('braintree.lib.Braintree');
    require_once "/braintree/lib/Braintree.php";
    Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('84t4kgdbjnqzzyhx');
Braintree_Configuration::publicKey('ndy43d3k4k667gdt');
Braintree_Configuration::privateKey('8f51f406c69039ba5ae2492be94f26bc');
$resultback = Braintree_Transaction::sale([
                'amount' => $allmoney,
                'paymentMethodNonce' => $nonce,
                'options' => [ 'submitForSettlement' => true ]
            ]);
            if ($resultback->success) {
                return ("success!: " . $resultback->transaction->id);
            } else if ($resultback->transaction) {
                return ("Error processing transaction:");
                return ("\n  code: " . $resultback->transaction->processorResponseCode);
                return ("\n  text: " . $resultback->transaction->processorResponseText);
            } else {
                return ("Validation errors: \n");
                return ($resultback->errors->deepAll());
            }
}
function braintoken(){
    require_once "/braintree/lib/Braintree.php";
    Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('84t4kgdbjnqzzyhx');
Braintree_Configuration::publicKey('ndy43d3k4k667gdt');
Braintree_Configuration::privateKey('8f51f406c69039ba5ae2492be94f26bc');
    $clientToken = Braintree_ClientToken::generate();
    return $clientToken;
}

