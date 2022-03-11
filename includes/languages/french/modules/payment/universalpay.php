<?php

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_TITLE', 'Universalpay');

if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_DESCRIPTION', '<strong>Universalpay</strong><br />');
}

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_DESCRIPTION', 'Universalpay');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_TITLE', 'Universalpay');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_ERROR', "Un problème est survenu lors de l'annulation de la transaction.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_ERROR', 'Un problème est survenu lors du remboursement du montant de transaction spécifié.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUNDFULL_ERROR', 'Votre demande de remboursement a été rejetée par Universalpay.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_REFUND_AMOUNT', "Vous avez demandé un remboursement partiel mais n'avez pas précisé de montant.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_ERROR', "Vous avez demandé un remboursement complet, mais vous n'avez pas coché la case Confirmer pour vérifier votre intention.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_AUTH_AMOUNT', "Vous avez demandé une autorisation, mais vous n'avez pas précisé de montant.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_CAPTURE_AMOUNT', "Vous avez demandé une capture mais vous n'avez pas spécifié de montant.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_CHECK', 'Confirmer');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_ERROR', "Vous avez demandé l'annulation d'une transaction, mais vous n'avez pas coché la case Confirmer pour vérifier votre intention.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Confirmer');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_CONFIRM_ERROR', "Vous avez demandé une autorisation, mais vous n'avez pas coché la case Confirmer pour vérifier votre intention.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CAPTURE_FULL_CONFIRM_ERROR', "Vous avez demandé une capture de fonds, mais vous n'avez pas coché la case Confirmer pour vérifier votre intention.");

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_INITIATED', "Remboursement Universalpay pour% s lancé. ID de transaction:% s. Actualisez l'écran pour voir les détails de confirmation mis à jour dans la section Historique / Commentaires de l'état de la commande.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_INITIATED', "Universalpay Void demande lancée. ID de transaction:% s. Actualisez l'écran pour voir les détails de confirmation mis à jour dans la section Historique / Commentaires de l'état de la commande.");


// These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EMAIL_ADDRESS', 'Email du payeur:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_TYPE', 'Type de paiement:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_STATUS', 'Statut de paiement:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_DATE', 'Date de paiement:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CURRENCY', 'Devise:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_GROSS_AMOUNT', 'Montant brut:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_FEE', 'Frais de paiement:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EXCHANGE_RATE', 'Taux de change:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CART_ITEMS', 'Type de transaction:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_TYPE', 'Tipo di transazione:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_ID', 'Identifiant de transaction:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TITLE', '<strong>Remboursements de commande</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_FULL', 'Si vous souhaitez rembourser cette commande dans son intégralité, cliquez ici:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT', 'Annuler');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Faire un remboursement complet');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Faire un remboursement partiel');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_FULL_OR', '<br />... ou entrez le partiel ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PAYFLOW_TEXT', 'Entrer le ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PARTIAL_TEXT', 'montant du remboursement ici et cliquez sur Remboursement partiel');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_SUFFIX', "*Un remboursement complet peut ne pas être émis après qu'un remboursement partiel a été appliqué. <br /> * Plusieurs remboursements partiels sont autorisés jusqu'à concurrence du solde non remboursé.");
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Remarque à afficher au client:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_DEFAULT_MESSAGE', "Remboursé par l'administrateur du magasin.");
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_CHECK', 'Confirmer: ');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CONFIRM_CHECK_ALERT', "Vous avez demandé un remboursement, mais vous n'avez pas coché la case Confirmer pour vérifier votre intention.");

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Faire de la capture');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_SUCCESS', 'La transaction a été capturée avec succès.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_ERROR', 'Un problème est survenu lors de la capture de la transaction.');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TITLE', '<strong>Annulation des autorisations de commande</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID', "Si vous souhaitez annuler une autorisation, saisissez ici l'ID d'autorisation et confirmez:");
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TEXT_COMMENTS', '<strong>Remarque à afficher au client:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_DEFAULT_MESSAGE', "Merci pour votre parrainage. Reviens s'il te plait.");
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT_FULL', 'Annuler');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUFFIX', '');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUCCESS', 'La transaction a été annulée avec succès.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_ERROR', "Un problème est survenu lors de l'annulation de la transaction.");

