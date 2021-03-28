<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'propierties';
    protected $primaryKey= 'propiertiy_id';
    protected $fillable = [
        'title','type','user_id','owner_id','country_id','departament_id','municipality_id','zone_id','region_id','adress',
        'partner','sale_usd','sale_gtq','rent_usd','rent_gtq','fee_rent','fee_sale','finance','exchange','engage_usd',
        'engage_gtq','rate','fee_usd','fee_gtq','term','term_text','maintenance','fee_maintenance_gtq','fee_maintenance_usd',
        'include_maintenance','water_service','security_service','electricy_service','trash_service','clean_service','name_contact',
        'phone_contact','telephone_contact','email_contact','name_contact_2','phone_contact_2','telephone_contact_2','email_contact_2',
        'social_media','exclusivity','share','partner_share','company_share','rate_share','land_vrs','build_mts','front_mts','bottom_mts',
        'build_year','levels','rooms','service_rooms','bathrooms','bathrooms_service','parking','parking_roof','offices','cellars','places',
        'door','front_door','cupboard','white_closet','gardeen_front','pantry','tub','bathroom_visit','laundry','bidet','room_visit','yard',
        'jetina','study','jacuzzi','pergola','living_room','winery','sauna','chimeny','garden_winery','balcony','dining_room','walkin_closet',
        'grill','family_room','roof_room','dining','kitchen_room','closet','another_details','build','floors','doors','roofs','windows',
        'another_finished','fridge','lamps','air','kitchen','curtain','alarm','electricy_kitchen','blackouts','camera_security','dishwater',
        'bathroom_curtain','solar_panel','bell','water_heater','cistern','washing_machine','bathroom_mirros','trash_deposit','dryer',
        'another_include','cabin','gym','kids_area','daycare','sauna_shared','floor_shared','social_area','spa','wheelchair','pet_area',
        'beauty_salon','phone_plant','parking_visit','court','ribbon','bussines_center','another_pleasantness','picture_pleasantness',
        'registry_usd','registry_gtq','iusi_usd','iusi_gtq','sheet','property','book','society','name_society','mortgage','mortgage_usd',
        'mortgage_gtq','bank_id','appraisal','appraisal_usd','appraisal_gtq','aprraisal_type','iva','rings','description','youtube','code','internal_note','status'
    ];
}
