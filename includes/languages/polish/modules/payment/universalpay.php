<?php

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_TITLE', 'Universalpay');

if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_DESCRIPTION', '<strong>Universalpay</strong><br />');
}

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_DESCRIPTION', 'Universalpay');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_TITLE', 'Universalpay');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_ERROR', 'Wystąpił problem z unieważnieniem transakcji.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_ERROR', 'Wystąpił problem ze zwrotem określonej kwoty transakcji.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUNDFULL_ERROR', 'Żądanie zwrotu zostało odrzucone przez Universalpay.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_REFUND_AMOUNT', 'Zażądano częściowego zwrotu, ale nie podano kwoty.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_ERROR', 'Zażądano całkowitego zwrotu środków, ale nie zaznaczono pola "Potwierdź".');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_AUTH_AMOUNT', 'Zażądano autoryzacji bez określonej kwoty transakcji.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_CAPTURE_AMOUNT', 'Zażądano przechwycenia środków bez określonej kwoty transakcji.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_CHECK', 'Potwierdź');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_ERROR', 'Zażądano unieważnienia transakcji, ale nie zaznaczono pola "Potwierdź".');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Potwierdź');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_CONFIRM_ERROR', 'Zażądano autoryzacji, ale nie zaznaczono pola "Potwierdź".');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CAPTURE_FULL_CONFIRM_ERROR', 'Zażądano przechwycenia środków, ale nie zaznaczono pola "Potwierdź".');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_INITIATED', 'Zwrot transakcji na kwotę %s rozpoczęte. Transaction ID: %s. Odśwież ekran, aby zobaczyć potwierdzenie zaktualizowane w Historii Statusu Zamówienia/ sekcji Komentarze.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_INITIATED', 'Unieważnienie transakcji na kwotę %s rozpoczęte. ID Transakcji: %s. Odśwież ekran, aby zobaczyć potwierdzenie zaktualizowane w Historii Statusu Zamówienia/ sekcji Komentarze.');


// These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EMAIL_ADDRESS', 'Email płatnika:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_TYPE', 'Typ płatności:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_STATUS', 'Status płatności:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_DATE', 'Data płatności:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CURRENCY', 'Waluta:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_GROSS_AMOUNT', 'Kwota brutto:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_FEE', 'Opłata manipulacyjna:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EXCHANGE_RATE', 'Kurs wymiany:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CART_ITEMS', 'Artykuły w koszyku:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_TYPE', 'Typ transakcji:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_ID', 'ID Transakcji:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TITLE', '<strong>Żądanie zwrotu środków</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_FULL', 'Jeśli chcesz zwrócić środki za to zamówienie, kliknij tutaj:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT', 'Unieważnij');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Zwróć całość środków');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Zwróć część środków');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_FULL_OR', '<br />...lub wprowadź część ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PAYFLOW_TEXT', 'Wprowadź ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PARTIAL_TEXT', 'kwotę do zwrotu tutaj i kliknij na "Częściowy Zwrot"');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_SUFFIX', '*Całkowity zwrot nie może zostać wydany po zainicjowaniu częściowego zwrotu. <br/>*Wielokrotny częściowy zwrot jest możliwy do wykonania do wysokości całkowitej kwoty transakcji.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Komentarz dla klienta:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_DEFAULT_MESSAGE', 'Zwrócono przez administratora.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_CHECK', 'Potwierdź: ');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CONFIRM_CHECK_ALERT', 'Zażądano zwrotu, ale nie zaznaczono pola "Potwierdź".');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Przechwyć');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_SUCCESS', 'Transakcja została przechwycona.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_ERROR', 'Wystąpił problem podczas przechwytywania transakcji.');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TITLE', '<strong>Unieważnienie Autoryzacji Zamówienia</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID', 'Jeśli chcesz unieważnić autoryzację, wprowadź ID autoryzacji i potwierdź:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TEXT_COMMENTS', '<strong>Komentarz dla klienta:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_DEFAULT_MESSAGE', 'Dziękujemy za skorzystanie z naszych usług. Zapraszamy ponownie.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT_FULL', 'Unieważnij');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUFFIX', '');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUCCESS', 'Transakcja została pomyślnie unieważniona.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_ERROR', 'Wystąpił problem przy unieważnianiu transakcji.');

