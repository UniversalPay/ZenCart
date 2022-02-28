<?php
// evopayments.php payment module admin display component
$outputStartBlock = '';
$outputUNIVERSALPAY = '';
$outputRefund = '';
$outputEndBlock = '';
$output = '';

$outputStartBlock .= '<td><table class="table">' . "\n";
$outputStartBlock .= '<tr style="background-color : #cccccc; border-style : dotted;">' . "\n";
$outputEndBlock .= '</tr>' . "\n";
$outputEndBlock .= '</table></td>' . "\n";

$outputUNIVERSALPAY .= '<td valign="top"><table>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EMAIL_ADDRESS . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['payer_email'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_TXN_ID . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['merchantTxId'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_DATE . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['payment_date'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '</table></td>' . "\n";

$outputUNIVERSALPAY .= '<td valign="top"><table>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_TYPE . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['payment_type'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_PAYMENT_STATUS . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['payment_status'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CART_ITEMS . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['cart_items'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '</table></td>' . "\n";

$outputUNIVERSALPAY .= '<td valign="top"><table>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CURRENCY . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['settle_currency'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_GROSS_AMOUNT . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['settle_amount'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '<tr><td class="main">' . "\n";
$outputUNIVERSALPAY .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_EXCHANGE_RATE . "\n";
$outputUNIVERSALPAY .= '</td><td class="main">' . "\n";
$outputUNIVERSALPAY .= $response['exchange_rate'] . "\n";
$outputUNIVERSALPAY .= '</td></tr>' . "\n";

$outputUNIVERSALPAY .= '</table></td>' . "\n";

if ($response['refundable_amount'] > 0&&!in_array($response['payment_status'], $this->finalStatus)) {
    try {
        $voidStatus = ['NOT_SET_FOR_CAPTURE', 'SET_FOR_CAPTURE'];
        $outputRefund .= '<td><table class="table">' . "\n";
        $outputRefund .= '<tr>' . "\n";
        $outputRefund .= '<td>' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TITLE . '<br/>' . "\n";
        $confirmJs = "onsubmit='return checkConfirm()' class='ipgform'";
        if (in_array($response['payment_status'], $voidStatus)) {
            $outputRefund .= zen_draw_form('epvoid', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doVoid', 'post', $confirmJs, true) . zen_hide_session_id();
        } else {
            $outputRefund .= zen_draw_form('eprefund', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doRefund', 'post', $confirmJs, true) . zen_hide_session_id();
        }
        $outputRefund .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PAYFLOW_TEXT;

        // full refund
        $outputRefund .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_FULL;

        //void
        if (in_array($response['payment_status'], $voidStatus)) {
            $outputRefund .= '<br/><input type="submit" name="void" value="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT . '" title="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_VOID_BUTTON_TEXT . '" />' . ' <br/>';
        }else{
            //partial refund - input field
            $outputRefund .= '<br/><input type="submit" name="full_refund" value="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_FULL . '" title="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_FULL . '" /><br/>';
            $outputRefund .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_TEXT_FULL_OR;
            $outputRefund .= MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_PARTIAL_TEXT . '<br/>';
            $outputRefund .= zen_draw_input_field('refund_amount', $response['refundable_amount'], 'length="5"') . '<br/>';
            $outputRefund .= '<input type="submit" name="partial_refund" value="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_PARTIAL . '" title="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_BUTTON_TEXT_PARTIAL . '" /><br/>';
            $outputRefund .= MODULE_PAYMENT_UNIVERSALPAY_TEXT_REFUND_FULL_CONFIRM_CHECK . zen_draw_checkbox_field('isRefund', '', false) . '<br/>';
        }
        $outputRefund .= '</form>';
        //show capture action
        if($response['payment_status']=='NOT_SET_FOR_CAPTURE'){
            $outputRefund .= zen_draw_form('epcapture', FILENAME_ORDERS, zen_get_all_get_params(array('action')) . 'action=doCapture', 'post', '', true) . zen_hide_session_id();
            $outputRefund .= '<br/><input type="submit" name="full_capture" value="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_BUTTON_TEXT_FULL . '" title="' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_CAPTURE_BUTTON_TEXT_FULL . '" />' . ' <br/>';
            $outputRefund .= '</form>';
        }
        //message text
        $outputRefund .= '<br/>' . MODULE_PAYMENT_UNIVERSALPAY_ENTRY_REFUND_SUFFIX;
        $outputRefund .= '</td></tr></table></td>' . "\n";
        $outputRefund .= '
        <style>
        .ipgform > input{
            margin-top: 10px;
        }
        </style>
        ';
        $outputRefund .= '<script>
        checkConfirm = function (){
            let item=document.getElementsByName(\'isRefund\')[0];
            
            if(!item.checked){
                alert("' . MODULE_PAYMENT_UNIVERSALPAY_TEXT_CONFIRM_CHECK_ALERT . '");
            }
            return item.checked;
        }
        </script>';

    } catch (Exception $e) {
        // Error is already reported so we don't need to report it again
    }

}

// prepare output based on suitable content components
$output = '<!-- BOF: pp admin transaction processing tools -->';
$output .= $outputStartBlock;

//debug
//$output .= '<pre>' . print_r($response, true) . '</pre>';

$output .= $outputUNIVERSALPAY;

if (defined('MODULE_PAYMENT_UNIVERSALPAY_STATUS')) {
    $output .= $outputEndBlock;
    $output .= '</tr><tr>' . "\n";
    $output .= $outputStartBlock;
    if (method_exists($this, '_doRefund')) $output .= $outputRefund;
}

$output .= $outputEndBlock;
$output .= '<!-- EOF: pp admin transaction processing tools -->';