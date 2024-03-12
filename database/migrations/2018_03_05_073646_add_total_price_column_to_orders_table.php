<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddTotalPriceColumnToOrdersTable extends Migration
{
    public function up()
    {
        // Create a stored function to calculate the total price based on the items associated with each order
        DB::unprepared('
CREATE FUNCTION calculate_total_price(order_id INT) RETURNS DECIMAL(10, 2)
READS SQL DATA
BEGIN
    DECLARE total DECIMAL(10, 2);
    SELECT SUM(items.item.price * item_order.item.quantity)
    INTO total
    FROM item_order
    JOIN items ON item_order.item_id = items.id
    WHERE item_order.order_id = order_id;
    RETURN total;
END

        ');

        // Alter the orders table to add a computed column for total price
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2)->generated()->stored();
        });
    }

    public function down()
    {
        // Drop the stored function
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_total_price');

        // Drop the total_price column
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('total_price');
        });
    }
}
