<?php

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_TITLE', 'Universalpay');

if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_DESCRIPTION', '<strong>Universalpay</strong><br />');
}

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_DESCRIPTION', 'Universalpay');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_TITLE', 'Universalpay');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_ERROR', 'There was a problem voiding the transaction. ');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_ERROR', 'There was a problem refunding the transaction amount specified. ');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUNDFULL_ERROR', 'Your Refund Request was rejected by Universalpay.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_REFUND_AMOUNT', 'You requested a partial refund but did not specify an amount.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_ERROR', 'You requested a full refund but did not check the Confirm box to verify your intent.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_AUTH_AMOUNT', 'You requested an authorization but did not specify an amount.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_CAPTURE_AMOUNT', 'You requested a capture but did not specify an amount.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_CHECK', 'Confirm');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_ERROR', 'You requested to void a transaction but did not check the Confirm box to verify your intent.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Confirm');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_CONFIRM_ERROR', 'You requested an authorization but did not check the Confirm box to verify your intent.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CAPTURE_FULL_CONFIRM_ERROR', 'You requested funds-Capture but did not check the Confirm box to verify your intent.');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_INITIATED', 'Universalpay refund for %s initiated. Transaction ID: %s. Refresh the screen to see confirmation details updated in the Order Status History/Comments section.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_INITIATED', 'Universalpay Void request initiated. Transaction ID: %s. Refresh the screen to see confirmation details updated in the Order Status History/Comments section.');


// These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EMAIL_ADDRESS', 'Payer Email:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_TYPE', 'Payment Type:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_STATUS', 'Payment Status:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_DATE', 'Payment Date:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CURRENCY', 'Currency:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_GROSS_AMOUNT', 'Gross Amount:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_FEE', 'Payment Fee:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EXCHANGE_RATE', 'Exchange Rate:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CART_ITEMS', 'Cart items:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_TYPE', 'Trans. Type:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_ID', 'Trans. ID:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TITLE', '<strong>Order Refunds</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_FULL', 'If you wish to refund this order in its entirety, click here:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT', 'Do Void');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Do Full Refund');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Do Partial Refund');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_FULL_OR', '<br />... or enter the partial ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PAYFLOW_TEXT', 'Enter the ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PARTIAL_TEXT', 'refund amount here and click on Partial Refund');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_SUFFIX', '*A Full refund may not be issued after a Partial refund has been applied.<br />*Multiple Partial refunds are permitted up to the remaining unrefunded balance.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Note to display to customer:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_DEFAULT_MESSAGE', 'Refunded by store administrator.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_CHECK', 'Confirm: ');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CONFIRM_CHECK_ALERT', 'You requested a refund but did not check the Confirm box to verify your intent.');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Do Capture');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_SUCCESS', 'The transaction has been captured successfully.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_ERROR', 'There was a problem capturing the transaction.');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TITLE', '<strong>Voiding Order Authorizations</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID', 'If you wish to void an authorization, enter the authorization ID here, and confirm:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TEXT_COMMENTS', '<strong>Note to display to customer:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_DEFAULT_MESSAGE', 'Thank you for your patronage. Please come again.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT_FULL', 'Do Void');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUFFIX', '');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUCCESS', 'The transaction has been voided successfully.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_ERROR', 'There was a problem voiding the transaction.');

