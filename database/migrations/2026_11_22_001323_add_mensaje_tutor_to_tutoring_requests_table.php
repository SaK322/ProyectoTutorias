<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tutoring_requests', function (Blueprint $table) {
            $table->text('mensaje_tutor')->nullable()->after('motivo_rechazo');
        });
    }

    public function down(): void
    {
        Schema::table('tutoring_requests', function (Blueprint $table) {
            $table->dropColumn('mensaje_tutor');
        });
    }
};