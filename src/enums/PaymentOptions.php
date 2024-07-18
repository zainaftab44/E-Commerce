<?php
namespace Enums;

enum PaymentOptions {
    case CASH_ON_DELIVERY;
    case PAYPAL;
    case STRIPE;
    case CREDITCARD;
}