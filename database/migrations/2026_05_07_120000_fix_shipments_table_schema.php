<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('shipments')) {
            return;
        }

        if (Schema::hasColumn('shipments', 'no_invoice')) {
            DB::statement("ALTER TABLE shipments CHANGE no_invoice invoice_number VARCHAR(255) NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'no_resi')) {
            DB::statement("ALTER TABLE shipments CHANGE no_resi receipt_number VARCHAR(255) NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'tanggal')) {
            DB::statement("ALTER TABLE shipments CHANGE tanggal pickup_date DATE NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'nama_pengirim')) {
            DB::statement("ALTER TABLE shipments CHANGE nama_pengirim sender_name VARCHAR(255) NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'nama_penerima')) {
            DB::statement("ALTER TABLE shipments CHANGE nama_penerima receiver_name VARCHAR(255) NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'alamat_kirim')) {
            DB::statement("ALTER TABLE shipments CHANGE alamat_kirim pickup_address TEXT NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'tujuan')) {
            DB::statement("ALTER TABLE shipments CHANGE tujuan destination_city VARCHAR(255) NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'jenis_barang')) {
            DB::statement("ALTER TABLE shipments CHANGE jenis_barang item_type VARCHAR(255) NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'berat')) {
            DB::statement("ALTER TABLE shipments CHANGE berat total_weight DECIMAL(10,2) NOT NULL");
        }
        if (Schema::hasColumn('shipments', 'harga_per_kg')) {
            DB::statement("ALTER TABLE shipments CHANGE harga_per_kg price_per_kg DECIMAL(10,2) NOT NULL");
        }

        Schema::table('shipments', function (Blueprint $table) {
            if (!Schema::hasColumn('shipments', 'shipment_status')) {
                $table->string('shipment_status')->default('Pending Pickup')->after('pickup_date');
            }
            if (!Schema::hasColumn('shipments', 'subtotal')) {
                $table->decimal('subtotal', 15, 2)->default(0)->after('price_per_kg');
            }
            if (!Schema::hasColumn('shipments', 'ppn')) {
                $table->decimal('ppn', 15, 2)->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('shipments', 'pph')) {
                $table->decimal('pph', 15, 2)->default(0)->after('ppn');
            }
            if (!Schema::hasColumn('shipments', 'grand_total')) {
                $table->decimal('grand_total', 15, 2)->default(0)->after('pph');
            }
            if (!Schema::hasColumn('shipments', 'notes')) {
                $table->text('notes')->nullable()->after('shipment_status');
            }
            if (!Schema::hasColumn('shipments', 'customer_sender_id')) {
                $table->unsignedBigInteger('customer_sender_id')->nullable()->after('receipt_number');
            }
            if (!Schema::hasColumn('shipments', 'customer_receiver_id')) {
                $table->unsignedBigInteger('customer_receiver_id')->nullable()->after('customer_sender_id');
            }
            if (!Schema::hasColumn('shipments', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('notes');
            }
        });

        DB::table('shipments')
            ->where('shipment_status', 'menunggu')
            ->update(['shipment_status' => 'Pending Pickup']);

        DB::table('shipments')
            ->whereNull('shipment_status')
            ->update(['shipment_status' => 'Pending Pickup']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('shipments')) {
            return;
        }

        Schema::table('shipments', function (Blueprint $table) {
            if (Schema::hasColumn('shipments', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }
            if (Schema::hasColumn('shipments', 'customer_receiver_id')) {
                $table->dropColumn('customer_receiver_id');
            }
            if (Schema::hasColumn('shipments', 'customer_sender_id')) {
                $table->dropColumn('customer_sender_id');
            }
            if (Schema::hasColumn('shipments', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('shipments', 'grand_total')) {
                $table->dropColumn('grand_total');
            }
            if (Schema::hasColumn('shipments', 'pph')) {
                $table->dropColumn('pph');
            }
            if (Schema::hasColumn('shipments', 'ppn')) {
                $table->dropColumn('ppn');
            }
            if (Schema::hasColumn('shipments', 'subtotal')) {
                $table->dropColumn('subtotal');
            }
            if (!Schema::hasColumn('shipments', 'no_invoice')) {
                $table->renameColumn('invoice_number', 'no_invoice');
            }
            if (!Schema::hasColumn('shipments', 'no_resi')) {
                $table->renameColumn('receipt_number', 'no_resi');
            }
            if (!Schema::hasColumn('shipments', 'tanggal')) {
                $table->renameColumn('pickup_date', 'tanggal');
            }
            if (!Schema::hasColumn('shipments', 'nama_pengirim')) {
                $table->renameColumn('sender_name', 'nama_pengirim');
            }
            if (!Schema::hasColumn('shipments', 'nama_penerima')) {
                $table->renameColumn('receiver_name', 'nama_penerima');
            }
            if (!Schema::hasColumn('shipments', 'alamat_kirim')) {
                $table->renameColumn('pickup_address', 'alamat_kirim');
            }
            if (!Schema::hasColumn('shipments', 'tujuan')) {
                $table->renameColumn('destination_city', 'tujuan');
            }
            if (!Schema::hasColumn('shipments', 'jenis_barang')) {
                $table->renameColumn('item_type', 'jenis_barang');
            }
            if (!Schema::hasColumn('shipments', 'berat')) {
                $table->renameColumn('total_weight', 'berat');
            }
            if (!Schema::hasColumn('shipments', 'status')) {
                $table->renameColumn('shipment_status', 'status');
            }
        });
    }
};
