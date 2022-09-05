<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( column: 'user_id'); // The following laravel included foreingIdFor method could also be used by passing the user class as follow: $table->foreignIdFor(User::class)
            $table->string( column: 'title');
            $table->string( column: 'slug');
            $table->string( column: 'company');
            $table->string( column: 'country');
            $table->string( column: 'state');
            $table->text( column: 'address');
            $table->text( column: 'description');
            $table->boolean(column: 'is_highlighted')->default(false);
            $table->decimal('min_amount', 9, 3);
            $table->decimal('max_amount', 9, 3);
            /*
             There could be other mechanisms such as is_active colum to check if a Gig is active; this feature will be handy if we want to eventually run a cron job or something regular to expire gigs/job listing over a certain amount of days
             and apply_link column where a visitor would be redirected to when clicking on apply link
            **/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
