<?php

namespace App\Database\Migrations;

use App\Libraries\Eloquent;
use CodeIgniter\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class InitMigration extends Migration
{
    public function up()
    {
        Eloquent::schema()->create("auth_jwt", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid('user_id')
                ->constrained("users")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->text("access_token");
            $table->string("refresh_token");
            $table->timestamps();
        });

        Eloquent::schema()->create("sig_puskesmas", function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("alamat")->nullable();
            $table->double("latitude")->nullable();
            $table->double("longitude")->nullable();
            $table->timestamps();
        });

        Eloquent::schema()->create("sig_pasien", function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_puskesmas")
                ->constrained("sig_puskesmas")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string("nama");
            $table->string("ortu")->nullable();
            $table->text("alamat")->nullable();
            $table->double("latitude")->nullable();
            $table->double("longitude")->nullable();
            $table->enum("jk", ["L", "P"])->default("L");
            $table->date("tgl_lahir")->nullable();
            $table->integer("usia")->default(0);
            $table->double("bb")->default(0);
            $table->double("tb")->default(0);
            $table->string("bb_u")->nullable();
            $table->string("tb_u")->nullable();
            $table->string("bb_tb")->nullable();
            $table->timestamps();
        });

        Eloquent::schema()->create("sig_model", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->double("epsilon");
            $table->integer("minpts");
            $table->double("score")->nullable();
            $table->timestamps();
        });

        Eloquent::schema()->create("sig_result", function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('id_model')
                ->constrained("sig_model")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('id_pasien')
                ->constrained("sig_pasien")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedInteger("cluster");
            $table->double("score")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Eloquent::schema()->dropIfExists('auth_jwt');
        Eloquent::schema()->dropIfExists('sig_puskesmas');
        Eloquent::schema()->dropIfExists('sig_pasien');
        Eloquent::schema()->dropIfExists('sig_model');
        Eloquent::schema()->dropIfExists('sig_result');
    }
}