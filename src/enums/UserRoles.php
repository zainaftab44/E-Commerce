<?php

namespace Enums;
/**
 * This class is to be used for managing permission to handle access to various 
 * features of the application
 */
enum UserRoles
{
    // Admin account for back office
    case Admin;
    // buyer
    case User;
    // Role for 
    case Anonymous;
    // Later used for multi-tennant sites 
    case SiteOwner;
    // Role for only permissions to CRUD products 
    case ProductsManager;
    // Role to be later used for management of multitennant sites administration and seller onboarding
    case SuperAdmin;

}