<?php

return [

    'merchant_id'       =>  env('EAZYPAY_MERCHANT_ID'),

    'encryption_key'    =>  env('EAZYPAY_ENCRYPTION_KEY'),

    'return_url'        =>  env('EAZYPAY_RETURN_URL'),

    // sub merchant id is always same as merchant id change value in case need
    'sub_merchant_id'   =>  env('EAZYPAY_MERCHANT_ID'),

    /*
    |------------------------------------------------------------------------------------
    | Reference No
    |------------------------------------------------------------------------------------
    |
    | Don't confused with Reference No (merchant_reference_no)
    |   - one reference_no is used in mandatory field in url that stands for order_id or any 
    |     other refence no(id)
    |   - in url there is field of Reference No which means we used our encrpted 
    |     merchant_reference_no which stands for our merchant_id which is used in config file
    |
    */

    // in url encryption (Reference No) is same as merchant id change value in case need
    'merchant_reference_no'      =>  env('EAZYPAY_MERCHANT_ID'),     

    // paymode value must be 9 according to icici payment integration document
    'paymode'           =>  env('EAZYPAY_PAYMODE',9),

];
