CREATE TABLE departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(45) NOT NULL UNIQUE,
    superior_id INT,
    nivel INT UNSIGNED NOT NULL,
    employees_quantity INT UNSIGNED NOT NULL,
    ambassador_name VARCHAR(255),
    FOREIGN KEY (superior_id) REFERENCES departments(id)
);



SELECT
    d.id AS department_id,
    d.name AS department_name,
    d.superior_id,
    d.nivel,
    d.employees_quantity,
    a.name AS ambassador_name,
    COUNT(sd.id) AS sub_departments_count
FROM
    departments d
JOIN
    ambassadors a ON d.ambassador_id = a.id
LEFT JOIN
    departments sd ON d.id = sd.superior_id
GROUP BY
    d.id, d.name, d.superior_id, d.nivel, d.employees_quantity, a.name
ORDER BY
    d."asc" "department_id"  -- Reemplaza order_by_column y order_direction según los valores recibidos
LIMIT
    10 OFFSET 10  -- Reemplaza itemsPerPage y offset según los valores recibidos
