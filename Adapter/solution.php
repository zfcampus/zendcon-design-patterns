<?php
namespace MyCompanyShop {

    class PayPal
    {
        private $email;
        private $password;

        public function __construct($email, $password)
        {
            $this->email = $email;
            $this->password = $password;
        }

        public function transfer($email, $amount)
        {
            return true;
        }

    }

    class CreditCard
    {
        private $number;
        private $expiration;

        public function __construct($number, $expiration)
        {
            $this->number = $number;
            $this->expiration = $expiration;
        }

        public function authorizeTransaction($amount)
        {
            return true;
        }
    }

    interface PaymentAdapterInterface
    {
        public function collectMoney($amount);
    }

    class CrediCardAdapter implements PaymentAdapterInterface
    {
        private $creditCard;

        public function __construct($creditCard)
        {
            $this->creditCard = $creditCard;
        }

        public function collectMoney($amount)
        {
            $this->creditCard->authorizeTransaction($amount);
        }
    }

    class PayPalAdapter implements PaymentAdapterInterface
    {
        private $paypal;

        public function __construct($paypal)
        {
            $this->paypal = $paypal;
        }

        public function collectMoney($amount)
        {
            $this->paypal->transfer('payments@myshop.com', $amount);
        }
    }
}

namespace {
    use MyCompanyShop\PayPal,
        MyCompanyShop\PayPalAdapter,
        MyCompanyShop\PaymentAdapterInterface,
        MyCompanyShop\CrediCardAdapter,
        MyCompanyShop\CreditCard;



}