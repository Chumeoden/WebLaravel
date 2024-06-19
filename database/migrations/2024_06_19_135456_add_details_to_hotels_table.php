<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToHotelsTable extends Migration
{
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'room_count')) {
                $table->integer('room_count')->after('address');
            }
            if (!Schema::hasColumn('hotels', 'room_types')) {
                $table->json('room_types')->after('room_count');
            }
            if (!Schema::hasColumn('hotels', 'image')) {
                $table->string('image')->nullable()->after('room_types');
            }
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('room_count');
            $table->dropColumn('room_types');
            $table->dropColumn('image');
        });
    }
}

