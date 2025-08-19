-- Create Database
USE ravenhill;

-- Drop and Recreate Tables for Clean Setup
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS categories;

-- Create Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Create Items Table
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(5,2) NOT NULL,
    image_url VARCHAR(255),
    category_id INT,
    stock INT DEFAULT 0,
    inherent_allergens VARCHAR(255) DEFAULT '',
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Insert Categories (added Kids and Promotions)
INSERT IGNORE INTO categories (name) VALUES 
('Coffee'), 
('Drinks'), 
('Breakfast'), 
('Lunch'), 
('Sides'), 
('Pastries'),
('Kids'),
('Promotions');

-- Insert Expanded Items (original plus new for Kids and Promotions)
-- Items are ordered by category name and item name in the query later
INSERT IGNORE INTO items (name, description, price, image_url, category_id, stock, inherent_allergens) VALUES
-- Coffee (category_id 1)
('Affogato', 'Espresso over vanilla ice cream.', 6.50, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 45, 'Dairy'),
('Babycino', 'Frothy milk for kids.', 3.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 40, 'Dairy'),
('Cappuccino', 'Espresso with equal parts milk and foam.', 5.50, 'https://images.unsplash.com/photo-1572442388796-11668a67eaf3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 85, 'Dairy'),
('Flat White', 'Iconic Aussie coffee: espresso with microfoam milk.', 5.50, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 100, 'Dairy'),
('Iced Coffee', 'Chilled coffee with milk and ice cream.', 7.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 55, 'Dairy'),
('Latte', 'Smooth espresso with steamed milk.', 5.50, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 75, 'Dairy'),
('Long Black', 'Espresso over hot water, strong and bold.', 5.00, 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 80, 'None'),
('Magic', 'Melbourne specialty: double ristretto in 3/4 milk.', 6.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 50, 'Dairy'),
('Mocha', 'Espresso with chocolate and milk.', 6.50, 'https://images.unsplash.com/photo-1510590337768-859d3a7c7a5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 65, 'Dairy'),
('Piccolo Latte', 'Small latte with strong espresso.', 5.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 60, 'Dairy'),
('Ristretto', 'Short, intense espresso shot.', 4.50, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 1, 70, 'None'),
('Short Black', 'Single shot of espresso.', 4.50, 'Images/es.jpeg', 1, 90, 'None'),

-- Drinks (category_id 2)
('Chai Latte', 'Spiced tea with milk.', 5.50, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 2, 60, 'Dairy'),
('Hot Chocolate', 'Creamy hot chocolate.', 5.50, 'https://images.unsplash.com/photo-1542990253-369dd4e91843?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 2, 55, 'Dairy'),
('Iced Tea', 'Refreshing brewed iced tea.', 4.50, 'https://images.unsplash.com/photo-1558642790-676bb3b166f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 2, 70, 'None'),
('Lemonade', 'Fresh squeezed lemonade.', 5.00, 'https://images.unsplash.com/photo-1621265649800-0c05aa31ceab?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 2, 65, 'None'),
('Matcha Latte', 'Green tea latte.', 6.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 2, 50, 'Dairy'),
('Smoothie', 'Berry blend smoothie.', 7.00, 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 2, 50, 'Dairy'),
('Turmeric Latte', 'Golden milk with spices.', 6.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 2, 45, 'Dairy'),

-- Breakfast (category_id 3)
('Big Brekkie', 'Eggs, bacon, sausage, toast, mushrooms, tomato.', 22.00, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 35, 'Gluten,Eggs'),
('Chilli Labneh Eggs', 'Eggs with labneh and chilli oil.', 17.50, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 25, 'Dairy,Eggs'),
('Chorizo & Eggs', 'Spicy chorizo with scrambled eggs and greens.', 19.00, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 30, 'Eggs'),
('Coconut Chia Pudding', 'Chia with coconut milk and fruits.', 14.00, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 35, 'None'),
('Eggs Benedict', 'Poached eggs with hollandaise on muffin.', 20.00, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 30, 'Dairy,Gluten,Eggs'),
('Omelette', 'Cheese, ham, and veggie omelette.', 16.00, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 40, 'Dairy,Eggs'),
('Pancakes', 'Fluffy stack with maple syrup and berries.', 18.50, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 45, 'Dairy,Gluten,Eggs'),
('Smashed Avocado Toast', 'Iconic Aussie brekkie: avo on sourdough with poached egg.', 18.00, 'https://images.unsplash.com/photo-1482049016688-2d3e1ac02b8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 3, 40, 'Gluten,Eggs'),

-- Lunch (category_id 4)
('Burger', 'Beef burger with beetroot (Aussie style).', 20.00, 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 30, 'Gluten,Dairy'),
('Chicken Caesar Salad', 'Grilled chicken with Caesar dressing.', 18.00, 'https://images.unsplash.com/photo-1550305062-29b4c46a9254?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 40, 'Dairy,Eggs'),
('Club Sandwich', 'Turkey, bacon, and salad layers.', 16.50, 'https://images.unsplash.com/photo-1521305916504-4a11211852fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 35, 'Gluten'),
('Fish and Chips', 'Battered fish with chips.', 22.00, 'https://images.unsplash.com/photo-1573088694543-1f19a28c42d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 25, 'Gluten'),
('Meat Pie', 'Classic Aussie pie with gravy.', 12.00, 'https://images.unsplash.com/photo-1521305916504-4a11211852fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 50, 'Gluten'),
('Sausage Roll', 'Flaky pastry with sausage.', 8.00, 'https://images.unsplash.com/photo-1521305916504-4a11211852fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 50, 'Gluten'),
('Vegemite Toastie', 'Vegemite and cheese grilled sandwich.', 10.00, 'https://images.unsplash.com/photo-1521305916504-4a11211852fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 45, 'Gluten,Dairy'),
('Veggie Wrap', 'Hummus and veggies in a wrap.', 14.00, 'https://images.unsplash.com/photo-1610890716324-2b86e1492e31?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 4, 40, 'Gluten'),

-- Sides (category_id 5)
('Fries', 'Crispy french fries.', 6.00, 'https://images.unsplash.com/photo-1573088694543-1f19a28c42d6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 5, 60, 'None'),
('Garlic Bread', 'Toasted garlic bread.', 6.50, 'https://images.unsplash.com/photo-1521305916504-4a11211852fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 5, 45, 'Gluten,Dairy'),
('Hash Browns', 'Crispy potato hash browns.', 5.00, 'https://images.unsplash.com/photo-1521305916504-4a11211852fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 5, 50, 'None'),
('Onion Rings', 'Battered onion rings.', 7.00, 'https://images.unsplash.com/photo-1615486364740-4a9c742d9b0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 5, 50, 'Gluten'),
('Side Salad', 'Mixed greens with dressing.', 5.50, 'https://images.unsplash.com/photo-1512621770439-720e57f8c09b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 5, 55, 'None'),

-- Pastries (category_id 6)
('ANZAC Biscuit', 'Oat and coconut biscuit.', 3.50, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 6, 65, 'Gluten'),
('Croissant', 'Flaky butter croissant.', 4.50, 'Images/cross.jpeg', 6, 70, 'Dairy,Gluten'),
('Danish', 'Apple danish pastry.', 5.00, 'https://images.unsplash.com/photo-1541782017295-98b2d536f5e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 6, 50, 'Dairy,Gluten'),
('Lamington', 'Chocolate-coated sponge with coconut.', 5.00, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 6, 60, 'Gluten,Dairy'),
('Muffin', 'Blueberry muffin.', 4.50, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 6, 55, 'Dairy,Gluten,Eggs'),
('Scone', 'Fresh scone with jam and cream.', 4.00, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 6, 60, 'Dairy,Gluten'),
('Tim Tam', 'Chocolate biscuit (pack of 2).', 3.00, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 6, 70, 'Gluten,Dairy'),
('Vanilla Slice', 'Custard-filled pastry slice.', 5.50, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 6, 45, 'Dairy,Gluten,Eggs'),

-- Kids (new category_id 7)
('Kids Babycino', 'Frothy milk with sprinkles.', 3.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 7, 50, 'Dairy'),
('Kids Cheese Toastie', 'Grilled cheese sandwich.', 6.00, 'https://images.unsplash.com/photo-1521305916504-4a11211852fe?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 7, 50, 'Gluten,Dairy'),
('Kids Fruit Cup', 'Fresh fruit pieces.', 4.50, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 7, 60, 'None'),
('Kids Hot Chocolate', 'Small hot chocolate with marshmallows.', 4.00, 'https://images.unsplash.com/photo-1542990253-369dd4e91843?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 7, 45, 'Dairy'),
('Kids Pancakes', 'Mini pancakes with syrup.', 8.00, 'https://images.unsplash.com/photo-1528207776459-edd2c0f1e23a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 7, 35, 'Dairy,Gluten,Eggs'),
('Kids Smoothie', 'Strawberry banana smoothie.', 5.00, 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 7, 40, 'None'),

-- Promotions (new category_id 8) - Sample combos and promos
('Breakfast Combo', 'Flat White + Smashed Avocado Toast. Save $3!', 20.50, 'https://images.unsplash.com/photo-1482049016688-2d3e1ac02b8f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 8, 30, 'Dairy,Gluten,Eggs'),
('Buy 1 Get 1 Half Price Coffee', 'Two coffees for the price of 1.5!', 7.50, 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 8, 50, 'Dairy'),
('Coffee & Pastry Deal', 'Any Coffee + Croissant. Save $2!', 8.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 8, 40, 'Dairy,Gluten'),
('Family Combo', '2 Adult Coffees + 2 Kids Items. Save $5!', 18.00, 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 8, 20, 'Dairy'),
('Lunch Special', 'Burger + Fries + Soft Drink. Save $4!', 22.00, 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 8, 25, 'Gluten,Dairy'),
('Pastry Bundle', '3 Pastries of your choice. Save $2!', 11.00, 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80', 8, 35, 'Dairy,Gluten');