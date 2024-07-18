<?php
namespace Enums;

enum OrderStatus {
    case PAYMENT_PROCESSING;
    case DELAYED;
    case PACKING;
    case IN_DELIVERY;
    case DELIVERED;
}