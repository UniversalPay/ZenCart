<?php

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_TITLE', 'Universalpay');

if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_DESCRIPTION', '<strong>Universalpay</strong><br />');
}

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_DESCRIPTION', 'Universalpay');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_TITLE', 'Universalpay');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_ERROR', 'No se puede anular la transacción.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_ERROR', 'No se puede reembolsar el monto de la transacción especificado.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUNDFULL_ERROR', 'Universalpay ha rechazado su solicitud de reembolso.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_REFUND_AMOUNT', 'Has solicitado un reembolso parcial pero no has especificado una cantidad.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_ERROR', 'Has solicitado un reembolso completo pero no has marcado la casilla Confirmar para verificar su intención.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_AUTH_AMOUNT', 'Has solicitado una autorización pero no has especificado una cantidad.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_CAPTURE_AMOUNT', 'Has solicitado una captura pero no has especificado una cantidad.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_CHECK', 'Confirmar');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_CONFIRM_ERROR', 'Has solicitado anular una transacción, pero no has marcado la casilla Confirmar para verificar su intención.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_FULL_CONFIRM_CHECK', 'Confirmar');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_AUTH_CONFIRM_ERROR', 'Has solicitado una autorización pero no has marcado la casilla Confirmar para verificar su intención.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CAPTURE_FULL_CONFIRM_ERROR', 'Has solicitado la captura de fondos pero no has marcado la casilla Confirmar para verificar su intención.');

define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_INITIATED', 'Reembolso de Universalpay para% s iniciado. ID de transacción:% s. Actualice la pantalla para ver los detalles de la confirmación actualizados en la sección Historial de estado del pedido / Comentarios.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_VOID_INITIATED', 'Solicitud de anulación de Universalpay iniciada. ID de transacción:% s. Actualice la pantalla para ver los detalles de la confirmación actualizados en la sección Historial de estado del pedido / Comentarios.');


// These are used for displaying raw transaction details in the Admin area:
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EMAIL_ADDRESS', 'Correo electrónico del pagador:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_TYPE', 'Tipo de pago:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_STATUS', 'Estado de pago:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_DATE', 'Fecha de pago:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CURRENCY', 'Moneda:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_GROSS_AMOUNT', 'Cantidad bruta:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_FEE', 'Cuota de pago:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EXCHANGE_RATE', 'Tipo de cambio:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CART_ITEMS', 'Elementos del carrito:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_TYPE', 'Tipo de transacción:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_ID', 'ID de transacción:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TITLE', '<strong>Reembolsos de pedidos</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_FULL', 'Si desea reembolsar este pedido en su totalidad, haga clic aquí:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT', 'Hacer anulación');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_FULL', 'Hacer reembolso completo');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_PARTIAL', 'Hacer reembolso parcial');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_FULL_OR', '<br />... o ingrese el parcial');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PAYFLOW_TEXT', 'Introducir ');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PARTIAL_TEXT', 'el monto del reembolso aquí y haga clic en Reembolso parcial');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_SUFFIX', '*Es posible que no se emita un reembolso completo después de que se haya aplicado un reembolso parcial. <br /> * Se permiten reembolsos parciales múltiples hasta el saldo restante no reembolsado.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_COMMENTS', '<strong>Nota para mostrar al cliente:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_DEFAULT_MESSAGE', 'Reembolsado por el administrador de la tienda.');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_CHECK', 'Confirmar: ');
define('MODULE_PAYMENT_UNIVERSALPAY_TEXT_CONFIRM_CHECK_ALERT', 'Solicitó un reembolso pero no marcó la casilla Confirmar para verificar su intención.');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_BUTTON_TEXT_FULL', 'Capturar');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_SUCCESS', 'La transacción se ha capturado correctamente.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_ERROR', 'No se puede capturar la transacción.');

define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TITLE', '<strong>Cancelación de autorizaciones de pedidos</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID', 'Si desea anular una autorización, ingrese el ID de autorización aquí y confirme:');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_TEXT_COMMENTS', '<strong>Nota para mostrar al cliente:</strong>');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_DEFAULT_MESSAGE', 'Gracias por su patrocinio. Por favor ven de nuevo.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT_FULL', 'Hacer anulación');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUFFIX', '');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUCCESS', 'La transacción se anuló con éxito.');
define('MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_ERROR', 'No s puede anular la transacción.');

