<?php

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_TITLE', 'Universalpay');

if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_DESCRIPTION', '<strong>Universalpay</strong><br />');
}

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_DESCRIPTION', 'Universalpay');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_TITLE', 'Universalpay');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_ERROR', "Si è verificato un problema durante l'annullamento della transazione.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_ERROR', "Si è verificato un problema durante il rimborso dell'importo della transazione specificato.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUNDFULL_ERROR', 'La tua richiesta di rimborso è stata rifiutata da Universalpay.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_REFUND_AMOUNT', 'Hai richiesto un rimborso parziale ma non hai specificato un importo.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_ERROR', 'Hai richiesto un rimborso completo ma non hai selezionato la casella Conferma per verificare la tua intenzione.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_AUTH_AMOUNT', "Hai richiesto un'autorizzazione ma non hai specificato un importo.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_CAPTURE_AMOUNT', "Hai richiesto un'acquisizione ma non hai specificato un importo.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_CHECK', 'Confermare');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_ERROR', 'Hai richiesto di annullare una transazione ma non hai selezionato la casella Conferma per verificare la tua intenzione.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Confermare');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_CONFIRM_ERROR', "Hai richiesto un'autorizzazione ma non hai selezionato la casella Conferma per verificare la tua intenzione.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CAPTURE_FULL_CONFIRM_ERROR', "Hai richiesto l'acquisizione di fondi ma non hai selezionato la casella Conferma per verificare la tua intenzione.");

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_INITIATED', "Rimborso di Universalpay per% s avviato. ID transazione:% s. Aggiorna la schermata per vedere i dettagli della conferma aggiornati nella sezione Cronologia stato dell'ordine / Commenti.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_INITIATED', "Richiesta di Universalpay Void avviata. ID transazione:% s. Aggiorna la schermata per vedere i dettagli della conferma aggiornati nella sezione Cronologia stato dell'ordine / Commenti.");


// These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EMAIL_ADDRESS', 'Email del pagatore:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_TYPE', 'Modalità di pagamento:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_STATUS', 'Stato del pagamento:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_DATE', 'Data di pagamento:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CURRENCY', 'Moneta:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_GROSS_AMOUNT', 'Importo lordo:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_FEE', 'Commissione di pagamento:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EXCHANGE_RATE', 'Tasso di cambio:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CART_ITEMS', 'Articoli nel carrello:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_TYPE', 'Tipo di transazione:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_ID', 'ID transazione:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TITLE', '<strong>Rimborsi degli ordini</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_FULL', "Se desideri rimborsare l'intero ordine, fai clic qui:");
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT', 'Annulla');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Effettua il rimborso completo');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Effettua un rimborso parziale');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_FULL_OR', '<br />... oppure inserisci il parziale ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PAYFLOW_TEXT', 'Inserisci il ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PARTIAL_TEXT', 'importo del rimborso qui e fare clic su Rimborso parziale');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_SUFFIX', '*Non è possibile emettere un rimborso completo dopo che è stato applicato un rimborso parziale. <br /> * Sono consentiti più rimborsi parziali fino al saldo non rimborsato rimanente.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Nota da mostrare al cliente:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_DEFAULT_MESSAGE', "Rimborsato dall'amministratore del negozio.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_CHECK', 'Confermare: ');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CONFIRM_CHECK_ALERT', 'Hai richiesto un rimborso ma non hai selezionato la casella Conferma per verificare la tua intenzione.');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Cattura');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_SUCCESS', 'La transazione è stata acquisita con successo.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_ERROR', "Si è verificato un problema durante l'acquisizione della transazione.");

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TITLE', '<strong>Annullamento delle autorizzazioni degli ordini</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID', "Se desideri annullare un'autorizzazione, inserisci qui l'ID autorizzazione e conferma:");
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TEXT_COMMENTS', '<strong>Nota da mostrare al cliente:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_DEFAULT_MESSAGE', 'Grazie per il vostro patrocinio. Per favore ritorna.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT_FULL', 'Annulla');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUFFIX', '');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUCCESS', 'La transazione è stata annullata con successo.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_ERROR', "Si è verificato un problema durante l'annullamento della transazione.");

