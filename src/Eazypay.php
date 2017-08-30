<?php
namespace Bhavinjr\Eazypay;

class Eazypay
{
    public $merchant_id;
    public $encryption_key;
    public $sub_merchant_id;
    public $reference_no;
    public $paymode;
    public $return_url;

    const DEFAULT_BASE_URL = 'https://eazypay.icicibank.com/EazyPG?';

    public function __construct()
    {
        $this->merchant_id              =    config('eazypay.merchant_id');
        $this->encryption_key           =    config('eazypay.encryption_key');
        $this->sub_merchant_id          =    config('eazypay.sub_merchant_id');
        $this->merchant_reference_no    =    config('eazypay.merchant_reference_no');
        $this->paymode                  =    config('eazypay.paymode');
        $this->return_url               =    config('eazypay.return_url');
    }

    public function getPaymentUrl($amount, $reference_no, $optionalField=null)
    {
        $mandatoryField   =    $this->getMandatoryField($amount, $reference_no);
        $optionalField    =    $this->getOptionalField($optionalField);
        $amount           =    $this->getAmount($amount);

        $paymentUrl = $this->generatePaymentUrl($mandatoryField, $optionalField, $amount);
        return $paymentUrl;
        // return redirect()->to($paymentUrl);
    }

    protected function generatePaymentUrl($mandatoryField, $optionalField, $amount)
    {
        $encryptedUrl = self::DEFAULT_BASE_URL."merchantid=".$this->merchant_id."&mandatory fields=".$mandatoryField."&optional fields=".$optionalField."&returnurl=".$this->getReturnUrl()."&Reference No=".$this->getReferenceNo()."&submerchantid=".$this->getSubMerchantId()."&transaction amount=".$amount."&paymode=".$this->getPaymode();

        return $encryptedUrl;
    }

    protected function getMandatoryField($amount, $reference_no)
    {
        return $this->getEncryptValue($reference_no.'|'.$this->sub_merchant_id.'|'.$amount);
    }

    // optional field must be seperated with | eg. (20|20|20|20)
    protected function getOptionalField($optionalField=null)
    {
        if (!is_null($optionalField)) {
            return $this->getEncryptValue($optionalField);
        }
        return null;
    }

    protected function getAmount($amount)
    {
        return $this->getEncryptValue($amount);
    }

    protected function getReturnUrl()
    {
        return $this->getEncryptValue($this->return_url);
    }

    protected function getReferenceNo()
    {
        return $this->getEncryptValue($this->merchant_reference_no);
    }

    protected function getSubMerchantId()
    {
        return $this->getEncryptValue($this->sub_merchant_id);
    }

    protected function getPaymode()
    {
        return $this->getEncryptValue($this->paymode);
    }

    // use @ to avoid php warning php throw warning while using mcrypt functions
    protected function getEncryptValue($str)
    {
        $block = @mcrypt_get_block_size('rijndael_128', 'ecb');
        $pad = $block - (strlen($str) % $block);
        $str .= str_repeat(chr($pad), $pad);
        return base64_encode(@mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->encryption_key, $str, MCRYPT_MODE_ECB));
    }
}
