<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AllTables extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {

        // tipo_user
        Schema::create('tipo_users', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->timestamps();
        });

        // turma
        Schema::create('turmas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nivel');
            $table->unsignedBigInteger('prof_id');
            $table->timestamps();
            // $table->foreign('prof_id')->references('id')->on('users');
        });

        // user
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('turma_id')->nullable();
            $table->string('nome');
            $table->date('data_nasc');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('endereco');
            $table->rememberToken();
            $table->string('cpf')->unique();
            $table->string('rg')->unique();
            $table->string('tel');
            $table->string('nome_pai');
            $table->string('nome_mae');
            $table->string('matricula')->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('tipo_id')->references('id')->on('tipo_users');
            // $table->foreign('turma_id')->references('id')->on('turmas');
        });

        // eventos
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->dateTime('data_inicio');
            $table->dateTime('data_fim');
            $table->timestamps();
        });

        // posts
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('autor_id');
            $table->string('titulo');
            $table->string('slug')->unique();
            $table->string('subtitulo');
            $table->text('descricao');
            $table->string('img_destaque');
            $table->longText('corpo');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('tipo_id')->references('id')->on('tipo_posts');
            // $table->foreign('autor_id')->references('id')->on('users');
        });

        // tipo_post
        Schema::create('tipo_posts', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descricao');
            $table->timestamps();
        });

        // settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->string('valor');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // permissoes
        Schema::create('permissoes', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->timestamps();
        });

        // relacionamento_permissoes
        Schema::create('relacionamento_permissoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->unsignedBigInteger('permissao_id');
            $table->timestamps();
            // $table->foreign('tipo_id')->references('id')->on('tipo_users');
            // $table->foreign('permissao_id')->references('id')->on('permissoes');
        });

        // exercicios
        Schema::create('exercicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turma_id');
            $table->integer('prof_id');
            $table->string('titulo');
            $table->text('decricao');
            $table->date('data_entrega');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
        Schema::dropIfExists('tipo_user');
        Schema::dropIfExists('turma');
        Schema::dropIfExists('eventos');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('tipo_post');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('permissoes');
        Schema::dropIfExists('relacionamento_permissoes');
        Schema::dropIfExists('exercicios');
    }
}
