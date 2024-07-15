CREATE TABLE users {
    id INT PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    role INT NOT NULL,
    disabled BOOLEAN NOT NULL DEFAULT(0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
}

CREATE TABLE products {
    id INT PRIMARY KEY AUTO_INCREMENT,
    name TEXT NOT NULL,
    description TEXT NOT NULL, 
    images TEXT NOT NULL,
    price FLOAT NOT NULL,
    stock INT NOT NULL,
    discount INT NOT NULL,
    sku TEXT NOT NULL,
    disabled BOOLEAN NOT NULL DEFAULT(0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
}

CREATE TABLE carts {
    id INT PRIMARY KEY, 
    products TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
}

CREATE TABLE orders {
    id INT PRIMARY KEY, 
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    current_status INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`), 
}

CREATE TABLE order_products{
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    discount INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`), 
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`), 
}

CREATE TABLE reviews {
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    rating INT NOT NULL,
    comment TEXT NOT NULL,
    images TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`), 
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`), 
}

CREATE TABLE coupons {
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    discount_code TEXT NOT NULL,
    expiry DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`id`), 
}

CREATE TABLE permissions {
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    permissions TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
}