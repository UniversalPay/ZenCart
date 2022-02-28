<?php
/**
 * Universalpay payments class
 */
require_once(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/universalpay/turnkey_sdk/payments.php');

use UniversalpayPayments\Payments;

if (!defined('TABLE_UNIVERSALPAY'))
    define('TABLE_UNIVERSALPAY', DB_PREFIX . 'universalpay');
if (!defined('TABLE_UNIVERSALPAY_TRANSACTION'))
    define('TABLE_UNIVERSALPAY_TRANSACTION', DB_PREFIX . 'universalpay_transaction');

/**
 * @property string version
 */
class universalpay extends base
{
    public $code;
    public $title;
    public $description;
    public $enabled;
    public $zone;
    public $enableDebugging = false;
    public $sort_order = 0;
    public $order_pending_status = 1;
    public $order_status = DEFAULT_ORDERS_STATUS_ID;
    public $_logLevel = 0;
    public $devMode = true;
    public $payments;

    /**
     * this module collects card-info onsite
     */
    public $collectsCardDataOnsite = false;
    public $form_action_url;
    /**
     * @var string
     */
    public $codeVersion;
    /**
     * @var bool
     */
    public $emailAlerts;
    /**
     * @var string[]
     */
    private $finalStatus = ['ERROR', 'VOID', 'DECLINED', 'COMPLETED_REFUND'];

    /**
     * class constructor
     */
    function __construct()
    {
        include_once(zen_get_file_directory(DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/', 'universalpay.php', 'false'));
        global $order;

        $this->code = 'universalpay';
        $this->title = MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_TITLE;
        $this->codeVersion = '1.0.0';
        $this->enabled = (MODULE_PAYMENT_UNIVERSALPAY_STATUS == 'True');
        if (MODULE_PAYMENT_UNIVERSALPAY_MODE != 'sandbox') {
            $this->devMode = false;
        }

        // Set the title & description text based on the mode we're in
        if (IS_ADMIN_FLAG === true) {
            $this->description = sprintf(MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_DESCRIPTION, ' (rev' . $this->codeVersion . ')');
            $this->title = MODULE_PAYMENT_UNIVERSALPAY_TEXT_ADMIN_TITLE;

            if ($this->enabled) {
                if ($this->devMode)
                    $this->title .= '<strong><span class="alert"> (sandbox active)</span></strong>';
                if (MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING == 'Log File' || MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING == 'Log and Email')
                    $this->title .= '<strong> (Debug)</strong>';
                if (!function_exists('curl_init'))
                    $this->title .= '<strong><span class="alert"> CURL NOT FOUND. Cannot Use.</span></strong>';
            }
        } else {
            $this->description = MODULE_PAYMENT_UNIVERSALPAY_TEXT_DESCRIPTION;
            $this->title = MODULE_PAYMENT_UNIVERSALPAY_TEXT_TITLE; //cc
        }

        if ((!defined('UNIVERSALPAY_OVERRIDE_CURL_WARNING') || (defined('UNIVERSALPAY_OVERRIDE_CURL_WARNING') && UNIVERSALPAY_OVERRIDE_CURL_WARNING != 'True')) && !function_exists('curl_init'))
            $this->enabled = false;

        $this->enableDebugging = (MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING == 'Log File' || MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING == 'Log and Email');
        $this->emailAlerts = (MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING == 'Log and Email');
        $this->sort_order = MODULE_PAYMENT_UNIVERSALPAY_SORT_ORDER;
        $this->order_pending_status = MODULE_PAYMENT_UNIVERSALPAY_ORDER_PENDING_STATUS_ID;

        if ((int)MODULE_PAYMENT_UNIVERSALPAY_ORDER_STATUS_ID > 0) {
            $this->order_status = MODULE_PAYMENT_UNIVERSALPAY_ORDER_STATUS_ID;
        }

        $this->zone = (int)MODULE_PAYMENT_UNIVERSALPAY_ZONE;

        if (is_object($order))
            $this->update_status();

        if (!(PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5)))
            $this->enabled = false;

        // debug setup
        if (!defined('DIR_FS_LOGS')) {
            $log_dir = 'cache/';
        } else {
            $log_dir = DIR_FS_LOGS;
        }

        if (!@is_writable($log_dir))
            $log_dir = DIR_FS_CATALOG . $log_dir;
        if (!@is_writable($log_dir))
            $log_dir = DIR_FS_SQL_CACHE;
        // Regular mode:
        if ($this->enableDebugging)
            $this->_logLevel = 2;
        // DEV MODE:
        if (defined('UNIVERSALPAY_DEV_MODE') && UNIVERSALPAY_DEV_MODE == 'true')
            $this->_logLevel = 3;
        if ($this->devMode) {
            $this->payments = (new Payments())->environmentUrls([
                "merchantId" => MODULE_PAYMENT_UNIVERSALPAY_MERCHANT_ID,
                "password" => MODULE_PAYMENT_UNIVERSALPAY_PASSWORD,
                "tokenURL" => 'https://api.test.universalpay.es/token',
                "paymentsURL" => 'https://api.test.universalpay.es/payments',
                "baseUrl" => 'https://cashierui.test.universalpay.es/ui/cashier',
                "jsApiUrl" => 'https://cashierui.test.universalpay.es/js/api.js',
            ]);
        } else {
            $this->payments = (new Payments())->environmentUrls([
                "merchantId" => MODULE_PAYMENT_UNIVERSALPAY_MERCHANT_ID,
                "password" => MODULE_PAYMENT_UNIVERSALPAY_PASSWORD,
                "tokenURL" => 'https://api.universalpay.es/token',
                "paymentsURL" => 'https://api.universalpay.es/payments',
                "baseUrl" => 'https://cashierui.universalpay.es/ui/cashier',
                "jsApiUrl" => 'https://cashierui.universalpay.es/js/api.js',
            ]);
        }
        if ((MODULE_PAYMENT_UNIVERSALPAY_DISPLAY == 'hostedPayPage') || (MODULE_PAYMENT_UNIVERSALPAY_DISPLAY == 'standalone')) {
            $this->form_action_url = $this->payments->baseUrl();
        } else {
            $this->form_action_url = '';
        }
    }

    /**
     *  Sets payment module status based on zone restrictions etc
     */
    function update_status()
    {
        return true;
    }

    /**
     *  Validate the credit card information via javascript (Number, Owner, and CVV Lengths)
     */
    function javascript_validation()
    {
        return false;
    }

    /**
     * Display Credit Card Information Submission Fields on the Checkout Payment Page
     * If it is iframe type, need to update the page display
     */
    function selection()
    {
        return [
            'id' => $this->code,
            'module' => MODULE_PAYMENT_UNIVERSALPAY_TEXT_TITLE,
        ];
    }

    /**
     * This is the universalpay check done between checkout_payment and
     * checkout_confirmation (called from checkout_confirmation).
     */
    function pre_confirmation_check()
    {
        return false;
    }

    /**
     * Display Credit Card Information for review on the Checkout Confirmation Page
     */
    function confirmation()
    {
        return false;
    }

    /**
     * Prepare the hidden fields comprising the parameters for the Submit button on the checkout confirmation page
     */
    function process_button()
    {
        global $db, $order, $currencies, $currency;

        //calculator order amount
        $orderAmount = $this->calc_order_amount($order->info['total'], MODULE_PAYMENT_UNIVERSALPAY_CURRENCY);

        $merchantTxId = time() . session_id();
        if(strtolower(MODULE_PAYMENT_UNIVERSALPAY_AUTH_TYPE)=='authorize'){
            $purchase = $this->payments->auth();
        }else{
            $purchase = $this->payments->purchase();
        }

        $customer = $order->customer;
        $billing = $order->billing;

        $purchase->allowOriginUrl($this->fullDomain())->
        merchantNotificationUrl(zen_href_link('universalpay_main_handler.php', '', 'SSL', false, false, true))->
        merchantLandingPageUrl(zen_href_link(FILENAME_CHECKOUT_PROCESS, 'referer=universalpay', 'SSL'))->
        merchantTxId($merchantTxId)->
        customerId($order->customer['format_id'])->
        channel(Payments::CHANNEL_ECOM)->
        userDevice(Payments::USER_DEVICE_DESKTOP)->
        amount($orderAmount)->
        country(MODULE_PAYMENT_UNIVERSALPAY_COUNTRY)->
        currency(MODULE_PAYMENT_UNIVERSALPAY_CURRENCY)->
        customerFirstName($customer['firstname'])->
        customerLastName($customer['lastname'])->
        customerBillingAddressPostalCode($billing['postcode'])->
        customerBillingAddressCity($billing['city'])->
        customerBillingAddressCountry($billing['country']['iso_code_2'])->
        customerBillingAddressStreet($billing['street_address'])->
        customerEmail($customer['email_address'])->
        customerPhone($customer['telephone'])->
        customerAddressCountry($customer['country']['iso_code_2']) ->
        customerAddressCity($customer['city']) ->
        customerAddressStreet($customer['street_address']) ->
        customerAddressPostalCode($customer['postcode']) ->
        paymentSolutionId("500")->
        userAgent($_SERVER["HTTP_USER_AGENT"])->
        customerIPAddress(zen_get_ip_address())->
        customerAddressPhone($customer['telephone'])->
        merchantChallengeInd('01')->
        merchantDecReqInd('N')->
        merchantLandingPageRedirectMethod('GET');

        $token = $purchase->token();
        $fields = [
            'token' => $token->token,
            'merchantId' => $token->merchantId,
            'integrationMode' => MODULE_PAYMENT_UNIVERSALPAY_DISPLAY,
            'paymentSolutionId' => $token->paymentSolutionId,
        ];
        if (MODULE_PAYMENT_UNIVERSALPAY_DISPLAY == 'iframe') {
            $process_button_string = "<script type=\"text/javascript\" src='" . $purchase->javaScriptUrl() . "'></script>";
            $process_button_string .= "<div id=\"ipgCashierDiv\" style='width: 95%;height: 400px;margin: 10px;'></div>";
            $process_button_string .= "<script type=\"text/javascript\">
                const cashier = com.myriadpayments.api.cashier();
                cashier.init({baseUrl: '" . $purchase->BaseUrl() . "'});
                handleResult = function(data,res) {}
                window.onload = function (){
                    document.getElementById('btn_submit').style.display='none';
                    cashier.show(
                    {
                        containerId: \"ipgCashierDiv\",
                        merchantId: '" . $token->merchantId . "',
                        token: '" . $token->token . "',
                        successCallback: handleResult,
                        failureCallback: handleResult,
                        cancelCallback: handleResult
                    });
                }
            </script>";
        } else {
            foreach ($fields as $name => $value) {
                // remove quotation marks
                $value = str_replace('"', '', $value);
                $buttonArray[] = zen_draw_hidden_field($name, $value);
            }
            $process_button_string = "\n" . implode("\n", $buttonArray) . "\n";
        }

        //log into transaction database
        $sql_data_array = [
            'merchantId' => $token->merchantId,
            'integrationMode' => MODULE_PAYMENT_UNIVERSALPAY_DISPLAY,
            'token' => $token->token,
            'action' => Payments::ACTION_PURCHASE,
            'merchantTxId' => $merchantTxId,
            'custom_id' => $order->customer['format_id'],
            'amount' => $orderAmount,
            'currency' => $order->info['currency'],
            'cart_id' => $_SESSION['cart']->cartID,
            'request_time' => 'now()',
        ];
        zen_db_perform(TABLE_UNIVERSALPAY_TRANSACTION, $sql_data_array);

        return $process_button_string;
    }

    /**
     * Prepare the hidden fields comprising the parameters for the Submit button
     * on the checkout confirmation page
     */
    function process_button_ajax()
    {
        return [];
    }

    /**
     * Prepare and submit the final authorization to UNIVERSALPAY via the appropriate means as configured
     * redirect the illegal result
     */
    function before_process()
    {
        global $db;
        //check return status
        if ($_REQUEST['result'] != 'success' && $_SESSION['payResultType'] != 'server') {
            $this->notify('NOTIFY_PAYMENT_UNIVERSALPAY_CANCELLED_DURING_CHECKOUT', $_GET);
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
        //check weather the merchantTxId exist
        $sql = "select id from " . TABLE_UNIVERSALPAY_TRANSACTION . " where merchantTxId='{$_REQUEST['merchantTxId']}'";
        $transactionInfo = $db->Execute($sql);
        if ($transactionInfo->RecordCount() == 0) {
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        }
        //check if payments record exist
        $sql = "select id from " . TABLE_UNIVERSALPAY . " where merchantTxId='{$_REQUEST['merchantTxId']}'";
        $transactionInfo = $db->Execute($sql);
        if ($transactionInfo->RecordCount() > 0) {
            zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
        }
    }

    /**
     * When the order returns from the processor, this stores the results in order-status-history and logs data for subsequent use
     */
    public function after_process()
    {
        global $insert_id, $order, $currencies, $db;
        $remoteStatus = $this->remoteStatus($_REQUEST['merchantTxId']);

        //store the universalpay order meta data -- used for later matching and back-end processing activities
        $metaData = ['order_id' => $insert_id,
            'merchantTxId' => $_REQUEST['merchantTxId'],
            'payment_type' => MODULE_PAYMENT_UNIVERSALPAY_DISPLAY,
            'payment_status' => $remoteStatus->status,
            'payment_date' => 'now()',
            'payer_email' => $order->customer['email_address'],
            'custom_id' => $order->customer['format_id'],
            'cart_items' => sizeof($order->products),
            'settle_amount' => (float)$_REQUEST['amount'],
            'settle_currency' => $_REQUEST['currency'],
            'refundable_amount' => (float)$_REQUEST['amount'],
            'response_type' => array_key_exists('payResultType', $_SESSION) ? 2 : 1,
            'exchange_rate' => $currencies->get_value($_REQUEST['currency']),
            'created' => 'now()',
            'updated' => 'now()'
        ];
        zen_db_perform(TABLE_UNIVERSALPAY, $metaData);
    }

    /**
     * @param $order_id
     * @return string admin-page components
     */
    function admin_notification($order_id)
    {
        if (!defined('MODULE_PAYMENT_UNIVERSALPAY_STATUS'))
            return '';
        $response = $this->getPaymentDetails($order_id, false);
        $output = '';
        if (count($response) > 0 && file_exists(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/universalpay/universalpay_admin_notification.php'))
            include_once(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/universalpay/universalpay_admin_notification.php');
        return $output;
    }

    /**
     * retrieve payment info
     * @param $orderId
     * @param bool $fetchRemote
     * @return array
     */
    private function getPaymentDetails($orderId, $fetchRemote = true)
    {
        global $db;
        $sql = "SELECT * FROM " . TABLE_UNIVERSALPAY . " WHERE order_id = {$orderId}  LIMIT 1";
        $dbObject = $db->Execute($sql);
        if ($dbObject->RecordCount() > 0) {
            $response = $dbObject->fields;
            if ($response['payment_status'] == 'SET_FOR_REFUND') {
                $transactionDetails = $this->getTransactionDetails(['originalMerchantTxId' => $dbObject->fields['merchantTxId']]);
                $remoteDetails = $this->remoteStatus($transactionDetails['merchantTxId']);
                if ($remoteDetails->status != $response['payment_status']) {
                    $this->updatePayments($orderId, ['payment_status' => $remoteDetails->status]);
                }
            } elseif (($fetchRemote||$response['payment_status']=='SET_FOR_CAPTURE') && !in_array($response['status'], $this->finalStatus)) {
                $remoteDetails = $this->remoteStatus($dbObject->fields['merchantTxId']);
                if ($remoteDetails->status != $response['payment_status']) {
                    $this->updatePayments($orderId, ['payment_status' => $remoteDetails->status]);
                }
            }

            return $dbObject->fields;
        }
        return [];
    }


    /**
     * update payments status
     * @param $orderId
     * @param $data
     * @return queryFactoryResult
     */
    private function updatePayments($orderId, $data)
    {
        return zen_db_perform(TABLE_UNIVERSALPAY, array_merge($data, ['updated' => 'now()']), 'update', 'order_id=' . $orderId);
    }

    /**
     * Used to read details of an existing transaction.
     * @param array $condition
     * @return array
     */
    private function getTransactionDetails($condition)
    {
        global $db;
        if (!is_array($condition) || count($condition) == 0) {
            return [];
        }
        $where = '';
        foreach ($condition as $field => $value) {
            $where .= "{$field} = '{$value}'";
        }
        $sql = "SELECT * FROM " . TABLE_UNIVERSALPAY_TRANSACTION . " WHERE {$where}  LIMIT 1";
        $dbObject = $db->Execute($sql);
        if ($dbObject->RecordCount() > 0) {
            return $dbObject->fields;
        } else {
            return [];
        }
    }

    /**
     * retrieve payment api status by merchantTxId
     * @param $merchantTxId
     * @return mixed
     */
    private function remoteStatus($merchantTxId)
    {
        $statusApi = $this->payments->status_check();
        return $statusApi->merchantTxId($merchantTxId)
            ->allowOriginUrl($this->fullDomain())
            ->execute();
    }

    /**
     * Evaluate installation status of this module. Returns true if the status key is found.
     */
    public function check()
    {
        global $db, $messageStack;

        if (!isset($this->_check)) {
            $check_query = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MODULE_PAYMENT_UNIVERSALPAY_STATUS'");
            $this->_check = !$check_query->EOF;
            if ($this->_check && defined('MODULE_PAYMENT_UNIVERSALPAY_VERSION')) {
                $this->version = MODULE_PAYMENT_UNIVERSALPAY_VERSION;
            }
        }

        return $this->_check;
    }

    /**
     * Installs all the configuration keys for this module
     */
    function install()
    {
        global $db, $messageStack;

        if (defined('MODULE_PAYMENT_UNIVERSALPAY_STATUS')) {
            $messageStack->add_session('UNIVERSALPAY module already installed.', 'error');
            zen_redirect(zen_href_link(FILENAME_MODULES, 'set=payment&module=universalpay', 'NONSSL'));
            return 'failed';
        }

        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable this Payment Module', 'MODULE_PAYMENT_UNIVERSALPAY_STATUS', 'True', 'Do you want to enable this payment module?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Version', 'MODULE_PAYMENT_UNIVERSALPAY_VERSION', '1.0.0', 'Version installed', '6', '2', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Id', 'MODULE_PAYMENT_UNIVERSALPAY_MERCHANT_ID', '', 'Your Merchant ID provided under the API Keys section.', '6', '3', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Password', 'MODULE_PAYMENT_UNIVERSALPAY_PASSWORD', '', 'Your Merchant Password provided under the API Keys section.', '6', '4', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Brand Id', 'MODULE_PAYMENT_UNIVERSALPAY_BRAND_ID', '', 'Your Merchant Brand ID.<br>Example: 1670000', '6', '6', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Production or Sandbox', 'MODULE_PAYMENT_UNIVERSALPAY_MODE', 'sandbox', '<strong>Production: </strong> Used to process Live transactions<br><strong>Sandbox: </strong>For developers and testing', '6', '7', 'zen_cfg_select_option(array(\'production\', \'sandbox\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Account Default Currency', 'MODULE_PAYMENT_UNIVERSALPAY_CURRENCY', 'USD', 'Your Merchant Account Settlement Currency, must be the same as currency code in your Merchant Account Name.<br> Example: USD, CAD, AUD - You can see your store currencies from the <a target=\"_blank\" href=\"currencies.php\">Localization/Currency</a>(Opens New Window).', '6', '8', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant Account Default Country', 'MODULE_PAYMENT_UNIVERSALPAY_COUNTRY', 'US', 'Your Merchant Account Settlement country.<br> Example: US, PL.', '6', '9', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_UNIVERSALPAY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '10', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_UNIVERSALPAY_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '11', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_UNIVERSALPAY_ORDER_STATUS_ID', '2', 'Set the status of orders paid with this payment module to this value. <br /><strong>Recommended: Processing[2]</strong>', '6', '12', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Unpaid Order Status', 'MODULE_PAYMENT_UNIVERSALPAY_ORDER_PENDING_STATUS_ID', '1', 'Set the status of unpaid orders made with this payment module to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '13', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Refund Order Status', 'MODULE_PAYMENT_UNIVERSALPAY_REFUNDED_STATUS_ID', '1', 'Set the status of refunded orders to this value. <br /><strong>Recommended: Pending[1]</strong>', '6', '14', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Mode', 'MODULE_PAYMENT_UNIVERSALPAY_DISPLAY', 'hostedPayPage', 'payments display type', '6', '15', 'zen_cfg_select_option(array(\'iframe\',\'standalone\',\'hostedPayPage\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING', 'Alerts Only', 'Would you like to enable debug mode?  A complete detailed log of failed transactions will be emailed to the store owner if Log and Email is selected.', '6', '16', 'zen_cfg_select_option(array(\'Alerts Only\', \'Log File\', \'Log and Email\'), ', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Authorization Type', 'MODULE_PAYMENT_UNIVERSALPAY_AUTH_TYPE', 'Capture', 'Do you want submitted credit card transactions to be authorized only, or captured immediately?', '6', '17', 'zen_cfg_select_option(array(\'Authorize\', \'Capture\'), ', now())");
        //payments transaction log table
        $db->Execute("create table IF NOT EXISTS " . TABLE_UNIVERSALPAY_TRANSACTION . "
        (
            id int auto_increment primary key,
            merchantId int null,
            action varchar(32) null,
            merchantTxId varchar(255) null,
            originalMerchantTxId varchar(255) null,
            custom_id varchar(32) null,
            amount decimal(10,2) null,
            currency varchar(255) null,
            integrationMode varchar(32) null,
            token varchar(255) null,
            status varchar(32) null,
            order_id int null,
            cart_id int null,
            txId varchar(32) null,
            response_type int default 1 null comment '1 server 2 client',
            request_time datetime null,
            response_time datetime null
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
        //payments info table
        $db->Execute("CREATE TABLE IF NOT EXISTS " . TABLE_UNIVERSALPAY . " 
        (
            `id` int(11) auto_increment primary key,
            `order_id` int(11),
            `merchantTxId` varchar(255) NOT NULL,
            `payment_type` varchar(256) NOT NULL,
            `payment_status` varchar(256) NOT NULL,
            `payer_email` text NOT NULL,
            `payment_date` datetime NOT NULL,
            `custom_id` varchar(32) NOT NULL,
            `cart_items` int(11) NOT NULL,
            `settle_amount` decimal(10,2) NOT NULL,
            `settle_currency` varchar(256) NOT NULL,
            `refundable_amount` decimal(10,2),
            `exchange_rate` decimal(10,2),
            `response_type` int default 1 null comment '1 server 2 client',
            `created` datetime NOT NULL,
            `updated` datetime NULL
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");

        $this->notify('NOTIFY_PAYMENT_UNIVERSALPAY_INSTALLED');
    }

    function keys()
    {
        return [
            'MODULE_PAYMENT_UNIVERSALPAY_STATUS',
            'MODULE_PAYMENT_UNIVERSALPAY_VERSION',
            'MODULE_PAYMENT_UNIVERSALPAY_MERCHANT_ID',
            'MODULE_PAYMENT_UNIVERSALPAY_PASSWORD',
            'MODULE_PAYMENT_UNIVERSALPAY_BRAND_ID',
            'MODULE_PAYMENT_UNIVERSALPAY_CURRENCY',
            'MODULE_PAYMENT_UNIVERSALPAY_COUNTRY',
            'MODULE_PAYMENT_UNIVERSALPAY_SORT_ORDER',
            'MODULE_PAYMENT_UNIVERSALPAY_ZONE',
            'MODULE_PAYMENT_UNIVERSALPAY_ORDER_STATUS_ID',
            'MODULE_PAYMENT_UNIVERSALPAY_ORDER_PENDING_STATUS_ID',
            'MODULE_PAYMENT_UNIVERSALPAY_REFUNDED_STATUS_ID',
            'MODULE_PAYMENT_UNIVERSALPAY_MODE',
            'MODULE_PAYMENT_UNIVERSALPAY_DISPLAY',
            'MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING',
            'MODULE_PAYMENT_UNIVERSALPAY_AUTH_TYPE',
        ];
    }

    /**
     * Uninstall this module
     */
    public function remove()
    {
        global $db;
        $db->Execute("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE 'MODULE\_PAYMENT\_UNIVERSALPAY\_%'");
        $this->notify('NOTIFY_PAYMENT_UNIVERSALPAY_UNINSTALLED');
    }

    /**
     * Debug Logging support
     * each log file for one day
     * @param $stage
     * @param $message
     * @param bool $useSession
     */
    public function zcLog($stage, $message, $useSession = true)
    {
        if (MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING == 'Log and Email' || MODULE_PAYMENT_UNIVERSALPAY_DEBUGGING == 'Log File') {
            $token = date('m-d-Y');
            if (!defined('DIR_FS_LOGS')) {
                $log_dir = 'cache/';
            } else {
                $log_dir = DIR_FS_LOGS;
            }
            $file = $log_dir . '/' . $this->code . '_Action_' . $token . '.log';
            $fp = @fopen($file, 'a');
            @fwrite($fp, date('M-d-Y H:i:s') . ' (' . time() . ')' . "\n" . $stage . "\n" . $message . "\n=================================\n\n");
            @fclose($fp);
        }
        if (MODULE_PAYMENT_BRAINTREE_DEBUGGING == 'Log and Email') {
            $data = urldecode($message) . "\n\n";
            if ($useSession)
                $data .= "\nSession data: " . print_r($_SESSION, true);
            zen_mail(STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, 'Evopayments debug data',
                $this->code . "\n" . $data, STORE_OWNER,
                STORE_OWNER_EMAIL_ADDRESS,
                array('EMAIL_MESSAGE_HTML' => nl2br($this->code . "\n" . $data)), 'debug');
        }
    }

    /**
     * Used to submit a refund for a given transaction.
     * @param $orderId
     * @return bool
     */
    function _doRefund($orderId)
    {
        global $messageStack, $db;
        $new_order_status = (int)MODULE_PAYMENT_UNIVERSALPAY_REFUNDED_STATUS_ID;
        $new_order_status = ($new_order_status > 0 ? $new_order_status : 1);
        //retrieve payment detail
        $paymentsDetail = $this->getPaymentDetails($orderId);
        if (isset($_REQUEST['full_refund']) || isset($_REQUEST['partial_refund'])) {
            $refundAmount = $paymentsDetail['refundable_amount'];
            $refundType = 'Full refund';
            if ($refundAmount <= 0) {
                $messageStack->add_session(MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_ERROR, 'error');
                return false;
            }
            if ($_REQUEST['partial_refund']) {
                $refundType = 'Partial refund';
                if ((int)$_REQUEST['refund_amount'] > $refundAmount) {
                    $messageStack->add_session(MODULE_PAYMENT_UNIVERSALPAY_TEXT_INVALID_REFUND_AMOUNT, 'error');
                    return false;
                }
                $refundAmount = (int)$_REQUEST['refund_amount'];
            }
            $refund = $this->payments->refund();
            $result = $refund->originalMerchantTxId($paymentsDetail['merchantTxId'])
                ->allowOriginUrl($this->fullDomain())
                ->amount($refundAmount)
                ->execute();
            //execute result
            if ($result['result'] == 'success') {
                //create transaction log
                $transactionSql = [
                    'merchantId' => $result['merchantId'],
                    'action' => $result['action'],
                    'merchantTxId' => $result['merchantTxId'],
                    'originalMerchantTxId' => $result['originalMerchantTxId'],
                    'custom_id' => $result['customerId'],
                    'currency' => $result['currency'],
                    'amount' => $result['amount'],
                    'status' => $result['status'],
                    'token' => $result['token'],
                ];
                zen_db_perform(TABLE_UNIVERSALPAY_TRANSACTION, $transactionSql);
                //update order status
                if ($result['status'] == 'SET_FOR_REFUND') {
                    //change order status
                    $this->updateOrderStatus($orderId, $new_order_status, $refundType);
                    //update payments status
                    $paymentSql = [
                        'payment_status' => 'SET_FOR_REFUND',
                        'refundable_amount' => $paymentsDetail['refundable_amount'] - $result['amount'],
                    ];
                    $this->updatePayments($orderId, $paymentSql);
                    $messageStack->add_session(sprintf(MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_INITIATED, $result['amount'], $result['merchantTxId']), 'success');
                    return true;
                }
            }
        }
    }

    /**
     * void transaction
     * @param $orderId
     */
    function _doVoid($orderId)
    {
        global $messageStack;
        $new_order_status = (int)MODULE_PAYMENT_UNIVERSALPAY_REFUNDED_STATUS_ID;
        $new_order_status = ($new_order_status > 0 ? $new_order_status : 1);
        $paymentsDetail = $this->getPaymentDetails($orderId);
        if (isset($_REQUEST['void'])) {
            $void = $this->payments->void();
            $result = $void->originalMerchantTxId($paymentsDetail['merchantTxId'])
                ->allowOriginUrl($this->fullDomain())
                ->execute();
            if ($result['result'] == 'success') {
                $transactionSql = [
                    'action' => 'VOID',
                    'merchantId' => $result['merchantId'],
                    'merchantTxId' => $result['originalMerchantTxId'],
                    'originalMerchantTxId' => $result['originalMerchantTxId'],
                    'status' => $result['status'],
                    'custom_id' => $result['customerId'],
                    'amount' => $result['amount'],
                    'currency' => $result['currency'],
                    'request_time' => 'now()',
                ];
                //add transaction log
                zen_db_perform(TABLE_UNIVERSALPAY_TRANSACTION, $transactionSql);
                if ($result['status'] == 'VOID') {
                    //change order status
                    $this->updateOrderStatus($orderId, $new_order_status, 'void payments');
                    //update payments status
                    $this->updatePayments($orderId, [
                        'payment_status' => 'VOID',
                        'refundable_amount'=>0
                    ]);
                    $messageStack->add_session(MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_SUCCESS, 'success');
                }
            }else{
                $messageStack->add_session(MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_ERROR, 'error');
            }

        }
    }

    public function _doCapt($orderId, $order_status, $order_info, $currency)
    {
        global $messageStack;
        $new_order_status = (int)(MODULE_PAYMENT_UNIVERSALPAY_ORDER_PENDING_STATUS_ID > 0 ? MODULE_PAYMENT_UNIVERSALPAY_ORDER_PENDING_STATUS_ID : 1);
        //transaction details
        $payment = $this->getPaymentDetails($orderId, false);
        $void = $this->payments->capture();
        $result = $void->originalMerchantTxId($payment['merchantTxId'])
            ->allowOriginUrl($this->fullDomain())
            ->amount((float)$order_info)
            ->execute();
        if($result['result']=='success'){
            $transactionSql = [
                'action' => $result['action'],
                'merchantId' => $result['merchantId'],
                'merchantTxId' => $result['originalMerchantTxId'],
                'originalMerchantTxId' => $result['originalMerchantTxId'],
                'status' => $result['status'],
                'custom_id' => $result['customerId'],
                'amount' => $result['amount'],
                'currency' => $result['currency'],
                'request_time' => 'now()',
            ];
            //add transaction log
            zen_db_perform(TABLE_UNIVERSALPAY_TRANSACTION, $transactionSql);
            if ($result['status'] == 'SET_FOR_CAPTURE') {
                //change order status
                $this->updateOrderStatus($orderId, $new_order_status, 'capture payments');
                //update payments status
                $this->updatePayments($orderId, ['payment_status' => $result['status']]);
                $messageStack->add_session(MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_SUCCESS, 'success');
            }
        }else{
            $messageStack->add_session(MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_ERROR, 'error');
        }
    }

    /**
     * update order status
     * @param $orderId
     * @param $newStatus
     * @param string $comments
     */
    private function updateOrderStatus($orderId, $newStatus, $comments = '')
    {
        $sql_data_array = ['orders_id' => $orderId,
            'orders_status_id' => (int)$newStatus,
            'date_added' => 'now()',
            'comments' => $comments,
            'customer_notified' => 0
        ];
        zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
        zen_db_perform(TABLE_ORDERS, ['orders_status' => $newStatus], 'update', "orders_id = '" . (int)$orderId . "'");
    }

    /**
     * Calculate the amount based on acceptable currencies
     * @param $amount
     * @param $currency
     * @param bool $formatting
     * @return false|float|string
     */
    private function calc_order_amount($amount, $currency, $formatting = false)
    {
        global $currencies;
        $amount = ($amount * $currencies->get_value($currency));
        $amount = round($amount, 2);
        return ($formatting ? number_format($amount, $currencies->get_decimal_places($currency)) : $amount);
    }

    /**
     * get full shopping cart full domain
     * @return string
     */
    private function fullDomain()
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        return $protocol . $_SERVER['HTTP_HOST'];
    }

}
