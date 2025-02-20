CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(45) NOT NULL UNIQUE,
    superior_id INT,
    nivel INT UNSIGNED NOT NULL,
    employees_quantity INT UNSIGNED NOT NULL,
    ambassador_name VARCHAR(255),
    FOREIGN KEY (superior_id) REFERENCES departments(id)
);
