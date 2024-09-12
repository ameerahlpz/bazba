	
INSERT INTO complete_orders 
(complete_orders.order_id,
complete_orders.user_id, 
complete_orders.product_id, 
complete_orders.invoice_num, 
complete_orders.product_name, 
complete_orders.quantity, 
complete_orders.price, 
complete_orders.total, 
complete_orders.subtotal, 
complete_orders.order_date,
complete_orders.status) 
	SELECT user_orders.order_id, 
	$user_id, cart_details.product_id, cart_details.invoice_num, products.title, cart_details.quantity, 
	cart_details.price, cart_details.total, user_orders.amount_due, NOW(),'$status'
	FROM user_orders INNER JOIN 
	(cart_details INNER JOIN products ON cart_details.product_id=products.product_ID)
	ON user_orders.order_id='$order_id'";
	