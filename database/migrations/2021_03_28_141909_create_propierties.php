<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropierties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propierties', function (Blueprint $table) {
            $table->id('propiertiy_id');
            $table->string('title');
            $table->string('type');
            $table->integer('user_id');
            $table->string('owner_id');
            $table->integer('country_id');
            
            $table->integer('departament_id');
            $table->integer('municipality_id');
            $table->integer('zone_id');
            $table->integer('region_id');
            $table->string('adress');
            $table->string('partner');
            $table->double('sale_usd', 8, 2);
            $table->double('sale_gtq', 8, 2);
            $table->double('rent_usd', 8, 2);
            $table->double('rent_gtq', 8, 2);
            $table->string('fee_rent');
            $table->string('fee_sale');
            $table->double('finance');
            $table->double('exchange');
            $table->double('engage_usd');
            $table->double('engage_gtq');
            $table->string('rate');
            $table->string('fee_usd');
            $table->string('fee_gtq');
            $table->string('term');
            $table->string('term_text');
            $table->string('maintenance');
            $table->double('fee_maintenance_gtq');
            $table->double('fee_maintenance_usd');
            $table->boolean('include_maintenance');
            $table->boolean('water_service');
            $table->boolean('security_service');
            $table->boolean('electricy_service');
            $table->boolean('trash_service');
            $table->boolean('clean_service');
            $table->string('name_contact');
            $table->string('phone_contact');
            $table->string('telephone_contact');
            $table->string('email_contact');
            $table->string('name_contact_2');
            $table->string('phone_contact_2');
            $table->string('telephone_contact_2');
            $table->string('email_contact_2');
            $table->string('social_media');
            $table->string('exclusivity');
            $table->string('share');
            $table->string('partner_share');
            $table->string('company_share');
            $table->string('rate_share');
            $table->double('land_vrs');
            $table->double('build_mts');
            $table->double('front_mts');
            $table->double('bottom_mts');
            $table->double('build_year');
            $table->unsignedBigInteger('levels');
            $table->unsignedBigInteger('rooms');
            $table->unsignedBigInteger('service_rooms');
            $table->unsignedBigInteger('bathrooms');
            $table->unsignedBigInteger('bathrooms_service');
            $table->unsignedBigInteger('parking');
            $table->unsignedBigInteger('parking_roof');
            $table->boolean('offices');
            $table->boolean('cellars');
            $table->boolean('places');
            $table->boolean('door');
            $table->boolean('front_door');
            $table->boolean('cupboard');
            $table->boolean('white_closet');
            $table->boolean('gardeen_front');
            $table->boolean('pantry');
            $table->boolean('tub');
            $table->boolean('bathroom_visit');
            $table->boolean('laundry');
            $table->boolean('bidet');
            $table->boolean('room_visit');
            $table->boolean('yard');
            $table->boolean('jetina');
            $table->boolean('study');
            $table->boolean('jacuzzi');
            $table->boolean('pergola');
            $table->boolean('living_room');
            $table->boolean('winery');
            $table->boolean('sauna');
            $table->boolean('chimeny');
            $table->boolean('garden_winery');
            $table->boolean('balcony');
            $table->boolean('dining_room');
            $table->boolean('walkin_closet');
            $table->boolean('grill');
            $table->boolean('family_room');
            $table->boolean('roof_room');
            $table->boolean('dining');
            $table->boolean('kitchen_room');
            $table->boolean('closet');
            $table->boolean('another_details');
            $table->string('build');
            $table->integer('floors');
            $table->integer('doors');
            $table->integer('roofs');
            $table->integer('windows');
            $table->string('another_finished');
            $table->boolean('fridge');
            $table->boolean('lamps');
            $table->boolean('air');
            $table->boolean('kitchen');
            $table->boolean('curtain');
            $table->boolean('alarm');
            $table->boolean('electricy_kitchen');
            $table->boolean('blackouts');
            $table->boolean('camera_security');
            $table->boolean('dishwater');
            $table->boolean('bathroom_curtain');
            $table->boolean('solar_panel');
            $table->boolean('bell');
            $table->boolean('water_heater');
            $table->boolean('cistern');
            $table->boolean('washing_machine');
            $table->boolean('bathroom_mirros');
            $table->boolean('trash_deposit');
            $table->boolean('dryer');
            $table->string('another_include');
            $table->boolean('cabin');
            $table->boolean('gym');
            $table->boolean('kids_area');
            $table->boolean('daycare');
            $table->boolean('sauna_shared');
            $table->boolean('floor_shared');
            $table->boolean('social_area');
            $table->boolean('spa');
            $table->boolean('pet_area');
            $table->boolean('beauty_salon');
            $table->boolean('phone_plant');
            $table->boolean('parking_visit');
            $table->boolean('court');
            $table->boolean('ribbon');
            $table->boolean('bussines_center');
            $table->string('another_pleasantness');
            $table->string('picture_pleasantness');
            $table->double('registry_usd');
            $table->double('registry_gtq');
            $table->double('iusi_usd');
            $table->double('iusi_gtq');
            $table->string('sheet');
            $table->string('property');
            $table->string('book');
            $table->string('society');
            $table->string('name_society');
            $table->double('mortgage');
            $table->double('mortgage_usd');
            $table->double('mortgage_gtq');
            $table->integer('bank_id');
            $table->double('appraisal');
            $table->double('appraisal_usd');
            $table->double('appraisal_gtq');
            $table->double('appraisal_type');
            $table->double('iva');
            $table->string('rings');
            $table->string('description');
            $table->string('youtube');
            $table->integer('code');
            $table->string('internal_note');
            $table->boolean('status');
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
        Schema::dropIfExists('propierties');
    }
}