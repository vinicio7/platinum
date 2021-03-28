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
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('owner_id');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('country_id')->on('countries');
            $table->unsignedBigInteger('departament_id');
            $table->foreign('departament_id')->references('departament_id')->on('departaments');
            $table->unsignedBigInteger('municipality_id');
            $table->foreign('municipality_id')->references('municipality_id')->on('municipalities');
            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')->references('zone_id')->on('zones');
            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('region_id')->on('regions');
            $table->string('adress');
            $table->string('partner');
            $table->double('sale_usd', 8, 2);
            $table->double('sale_gtq', 8, 2);
            $table->double('rent_usd', 8, 2);
            $table->double('rent_gtq', 8, 2);
            $table->string('fee_rent');
            $table->string('finance');
            $table->string('exchange');
            $table->string('engage_usd');
            $table->string('engage_gtq');
            $table->string('term');
            $table->string('term_text');
            $table->string('maintenace');
            $table->string('fee_maintenance_gtq');
            $table->string('fee_maintenance_usd');
            $table->string('include_maintenance');
            $table->string('water_service');
            $table->string('segurity_service');
            $table->string('electricy_service');
            $table->string('trash_service');
            $table->string('clean_service');
            $table->string('name_contact');
            $table->string('phone_contact');
            $table->string('telephone_contact');
            $table->string('email_contact');
            $table->string('name_contact_2');
            $table->string('phone_contact_2');
            $table->string('telephone_contact_2');
            $table->string('email_contact_2');
            $table->string('socila_media');
            $table->string('exclusivity');
            $table->string('share');
            $table->string('parther_share');
            $table->string('company_share');
            $table->string('rate_share');
            $table->string('land_vrs');
            $table->string('build_mts');
            $table->string('front_mts');
            $table->string('bottom_mts');
            $table->string('build_mts');
            $table->string('levels');
            $table->string('rooms');
            $table->sting('service_rooms');
            $table->sting('bathrooms');
            $table->sting('bathrooms_service');
            $table->sting('parking');
            $table->sting('parking_roof');
            $table->sting('offices');
            $table->sting('cellars');
            $table->sting('placer');
            $table->sting('door');
            $table->sting('front_door');
            $table->sting('cupboard');
            $table->sting('white_closet');
            $table->sting('gardeen_front');
            $table->sting('pantry');
            $table->sting('tub');
            $table->sting('bathroom_visit');
            $table->sting('laundry');
            $table->sting('bidet');
            $table->sting('room_visit');
            $table->sting('yard');
            $table->sting('jetina');
            $table->sting('study');
            $table->sting('jacuzzi');
            $table->sting('pergola');
            $table->sting('living_room');
            $table->sting('winery');
            $table->sting('sauna');
            $table->sting('chimeny');
            $table->sting('garden_winery');
            $table->sting('balcony');
            $table->sting('dinig_room');
            $table->sting('dining');
            $table->sting('kitchen_room');
            $table->sting('closet');
            $table->sting('another_details');
            $table->sting('build');
            $table->string('floors');
            $table->string('doors');
            $table->string('roofs');
            $table->string('windows');
            $table->string('another_finished');
            $table->string('fridge');
            $table->string('lamps');
            $table->string('air');
            $table->string('kitchen');
            $table->string('curtains');
            $table->string('alarm');
            $table->string('eletricy_kitchen');
            $table->string('blackouts');
            $table->string('camera_segurity');
            $table->string('dishwater');
            $table->string('bathroom_curtain');
            $table->string('solar_panel');
            $table->string('bell');
            $table->string('water_heater');
            $table->string('cistern');
            $table->string('washing_machine');
            $table->string('bathroom_mirros');
            $table->string('trash_deposit');
            $table->string('dryer');
            $table->string('another_include');
            $table->string('cabin');
            $table->string('gym');
            $table->string('kids_area');
            $table->string('daycare');
            $table->string('sauna_shared');
            $table->string('floor_shared');
            $table->string('social_area');
            $table->string('spa');
            $table->string('wheelchair');
            $table->string('pet_area');
            $table->string('bauty_salon');
            $table->string('phone_plant');
            $table->string('parking_visit');
            $table->string('court');
            $table->string('ribbon');
            $table->string('bussines_center');
            $table->string('another_pleasantness');
            $table->string('picture_pleasantness');
            $table->string('registry_usd');
            $table->string('registry_gtq');
            $table->string('sheet');
            $table->string('property');
            $table->string('book');
            $table->string('society');
            $table->string('name_society');
            $table->string('mortgage_usd');
            $table->string('mortgage_gtq');
            $table->string('bank_id');
            $table->string('appraisal');
            $table->string('appraisal_usd');
            $table->string('appraisal_gtq');
            $table->string('appraisal_type');
            $table->string('iva');
            $table->string('rings');
            $table->string('description');
            $table->string('youtube');
            $table->string('code');
            $table->string('internal_note');
            $table->string('status');

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
