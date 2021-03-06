<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHtmlViewContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('html_view_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('html_view_menu_id')->unsigned();
            $table->longtext('content_html')->comment('HTML view content.');
            $table->boolean('is_menu')->default(false)->comment('If the content view is a menu.');

            $table->softDeletes()->comment('If we want to keep track of deletion without actually deleting a record');
            $table->timestamps();
            $table->index(['id', 'html_view_menu_id', 'created_at'], 'html_view_contents_index');
            $table->foreign('html_view_menu_id')
                    ->references('id')->on('html_view_menus')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('html_view_contents');
    }
}
