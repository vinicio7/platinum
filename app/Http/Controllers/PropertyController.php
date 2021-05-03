<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyWrite;
use Maatwebsite\Excel\Excel;
use App\Exports\PropiertiesExport;


class PropertyController extends Controller
{
    public $message     = "";
    public $result         = false;
    public $records     = array();
    public $statusCode     = 200;
    
    public function index()
    {
        $titulo     = 'propierty';
        $dt_route   = route('propierty.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'propierty_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('propierty', compact('dt_route', 'dt_columns','dt_order' ));
    }

    public function create(Request $request)
    {
         try { 

            $validate = $request->validate([
                'title' => 'required',
                'type' => 'required' ,
                'user_id' => 'required',
                'owner_id' => 'required',
                'country_id' => 'required',
                'departament_id' => 'required',
                'municipality_id' => 'required',
                'zone_id' => 'required',
                'region_id' => 'required',
                'adress' => 'required',
                'partner' => 'required',
                'sale_usd' => 'required',
                'sale_gtq' => 'required',
                'rent_usd' => 'required',
                'rent_gtq' => 'required',
                'fee_rent' => 'required',
                'fee_sale' => 'required',
                'finance' => 'required',
                'exchange' => 'required',
                'engage_usd' => 'required',
                'engage_gtq' => 'required',
                'rate' => 'required',
                'fee_usd' => 'required',
                'fee_gtq' => 'required',
                'term' => 'required',
                'term_text' => 'required',
                'maintenance' => 'required',
                'fee_maintenance_gtq' => 'required',
                'fee_maintenance_usd' => 'required',
                'include_maintenance' => 'required',
                'water_service' => 'required',
                'security_service' => 'required',
                'electricy_service' => 'required',
                'trash_service' => 'required',
                'clean_service' => 'required',
                'name_contact' => 'required',
                'phone_contact' => 'required',
                'telephone_contact' => 'required',
                'email_contact' => 'required',
                'name_contact_2' => 'required',
                'phone_contact_2' => 'required', 
                'telephone_contact_2' => 'required',
                'email_contact_2' => 'required',
                'social_media' => 'required',
                'exclusivity' => 'required',
                'share' => 'required',
                'partner_share' => 'required',
                'company_share' => 'required',
                'rate_share' => 'required',
                'land_vrs' => 'required',
                'build_mts' => 'required',
                'front_mts' => 'required',
                'bottom_mts' => 'required',
                'build_year' => 'required',
                'levels' => 'required',
                'rooms' => 'required',
                'service_rooms' => 'required',
                'bathrooms' => 'required',
                'bathrooms_service' => 'required',
                'parking' => 'required',
                'parking_roof' => 'required',
                'offices' => 'required',
                'cellars' => 'required',
                'places' => 'required',
                'door' => 'required',
                'front_door' => 'required',
                'cupboard' => 'required',
                'white_closet' => 'required',
                'gardeen_front' => 'required',
                'pantry' => 'required',
                'tub' => 'required',
                'bathroom_visit' => 'required',
                'laundry'=> 'required',
                'bidet' => 'required',
                'room_visit' => 'required',
                'yard' => 'required',
                'jetina' => 'required',
                'study' => 'required',
                'jacuzzi' => 'required',
                'pergola' => 'required',
                'living_room' => 'required',
                'winery' => 'required',
                'sauna' => 'required',
                'chimeny' => 'required',
                'garden_winery' => 'required',
                'balcony' => 'required',
                'dining_room' => 'required',
                'walkin_closet' => 'required',
                'grill' => 'required',
                'family_room' => 'required',
                'roof_room' => 'required',
                'dining' => 'required',
                'kitchen_room' => 'required',
                'closet' => 'required',
                'another_details' => 'required',
                'build' => 'required',
                'floors' => 'required',
                'doors' => 'required',
                'roofs' => 'required',
                'windows' => 'required',
                'another_finished' => 'required',
                'fridge' => 'required',
                'lamps' => 'required',
                'air' => 'required',
                'kitchen' => 'required',
                'curtain' => 'required',
                'alarm' => 'required',
                'electricy_kitchen' => 'required',
                'blackouts' => 'required',
                'camera_security' => 'required',
                'dishwater' => 'required',
                'bathroom_curtain' => 'required',
                'solar_panel' => 'required',
                'bell' => 'required',
                'water_heater' => 'required',
                'cistern' => 'required',
                'washing_machine' => 'required',
                'bathroom_mirros' => 'required',
                'trash_deposit' => 'required',
                'dryer' => 'required',
                'another_include' => 'required',
                'cabin' => 'required',
                'gym' => 'required',
                'kids_area' => 'required',
                'daycare' => 'required',
                'sauna_shared' => 'required',
                'floor_shared' => 'required',
                'social_area' => 'required',
                'spa' => 'required',
                'pet_area' => 'required',
                'beauty_salon' => 'required',
                'phone_plant' => 'required',
                'parking_visit' => 'required',
                'court' => 'required',
                'ribbon' => 'required',
                'bussines_center' => 'required',
                'another_pleasantness' => 'required',
                'picture_pleasantness' => 'required',
                'registry_usd' => 'required',
                'registry_gtq' => 'required',
                'iusi_usd' => 'required',
                'iusi_gtq' => 'required',
                'sheet' => 'required',
                'property' => 'required',
                'book' => 'required',
                'society' => 'required',
                'name_society' => 'required',
                'mortgage' => 'required',
                'mortgage_usd' => 'required',
                'mortgage_gtq' => 'required',
                'bank_id' => 'required',
                'appraisal' => 'required',
                'appraisal_usd' => 'required',
                'appraisal_gtq' => 'required',
                'appraisal_type' => 'required',
                'iva' => 'required',
                'rings' => 'required',
                'description' => 'required',
                'youtube' => 'required',
                'code' => 'required',
                'internal_note' => 'required',
                'status' => 'required' 
            ]);
            $properties = Property::create([
                'title'                     => $validate['title'],
                'type'                      => $validate['type'] ,
                'user_id'                   => $validate['user_id'],
                'owner_id'                  => $validate['owner_id'],
                'country_id'                => $validate['country_id'],
                'departament_id'            => $validate['departament_id'],
                'municipality_id'           => $validate['municipality_id'],
                'zone_id'                   => $validate['zone_id'],
                'region_id'                 => $validate['region_id'],
                'adress'                    => $validate['adress'],
                'partner'                   => $validate['partner'],
                'sale_usd'                  => $validate['sale_usd'],
                'sale_gtq'                  => $validate['sale_gtq'],
                'rent_usd'                  => $validate['rent_usd'],
                'rent_gtq'                  => $validate['rent_gtq'],
                'fee_rent'                  => $validate['fee_rent'],
                'fee_sale'                  => $validate['fee_sale'],
                'finance'                   => $validate['finance'],
                'exchange'                  => $validate['exchange'],
                'engage_usd'                => $validate['engage_usd'],
                'engage_gtq'                => $validate['engage_gtq'],
                'rate'                      => $validate['rate'],
                'fee_usd'                   => $validate['fee_usd'],
                'fee_gtq'                   => $validate['fee_gtq'],
                'term'                      => $validate['term'],
                'term_text'                 => $validate['term_text'],
                'maintenance'               => $validate['maintenance'],
                'fee_maintenance_gtq'       => $validate['fee_maintenance_gtq'],
                'fee_maintenance_usd'       => $validate['fee_maintenance_usd'],
                'include_maintenance'       => $validate['include_maintenance'],
                'water_service'             => $validate['water_service'],
                'security_service'          => $validate['security_service'],
                'electricy_service'         => $validate['electricy_service'],
                'trash_service'             => $validate['trash_service'],
                'clean_service'             => $validate['clean_service'],
                'name_contact'              => $validate['name_contact'], 
                'phone_contact'             => $validate['phone_contact'],
                'telephone_contact'         => $validate['telephone_contact'],
                'email_contact'             => $validate['email_contact'],
                'name_contact_2'            => $validate['name_contact_2'],
                'phone_contact_2'           => $validate['phone_contact_2'], 
                'telephone_contact_2'       => $validate['telephone_contact_2'],
                'email_contact_2'           => $validate['email_contact_2'],
                'social_media'              => $validate['social_media'],
                'exclusivity'               => $validate['exclusivity'],
                'share'                     => $validate['share'],
                'partner_share'             => $validate['partner_share'],
                'company_share'             => $validate['company_share'],
                'rate_share'                => $validate['rate_share'],
                'land_vrs'                  => $validate['land_vrs'],
                'build_mts'                 => $validate['build_mts'],
                'front_mts'                 => $validate['front_mts'],
                'bottom_mts'                => $validate['bottom_mts'],
                'build_year'                => $validate['build_year'],
                'levels'                    => $validate['levels'],
                'rooms'                     => $validate['rooms'],
                'service_rooms'             => $validate['service_rooms'],
                'bathrooms'                 => $validate['bathrooms'],
                'bathrooms_service'         => $validate['bathrooms_service'],
                'parking'                   => $validate['parking'],
                'parking_roof'              => $validate['parking_roof'],
                'offices'                   => $validate['offices'],
                'cellars'                   => $validate['cellars'],
                'places'                    => $validate['places'],
                'door'                      => $validate['door'],
                'front_door'                => $validate['front_door'],
                'cupboard'                  => $validate['cupboard'],
                'white_closet'              => $validate['white_closet'],
                'gardeen_front'             => $validate['gardeen_front'],
                'pantry'                    => $validate['pantry'],
                'tub'                       => $validate['tub'],
                'bathroom_visit'            => $validate['bathroom_visit'],
                'laundry'                   => $validate['laundry'],
                'bidet'                     => $validate['bidet'],
                'room_visit'                => $validate['room_visit'],
                'yard'                      => $validate['yard'],
                'jetina'                    => $validate['jetina'],
                'study'                     => $validate['study'],
                'jacuzzi'                   => $validate['jacuzzi'],
                'pergola'                   => $validate['pergola'],
                'living_room'               => $validate['living_room'],
                'winery'                    => $validate['winery'],
                'sauna'                     => $validate['sauna'],
                'chimeny'                   => $validate['chimeny'],
                'garden_winery'             => $validate['garden_winery'],
                'balcony'                   => $validate['balcony'],
                'dining_room'               => $validate['dining_room'],
                'walkin_closet'             => $validate['walkin_closet'],
                'grill'                     => $validate['grill'],
                'family_room'               => $validate['family_room'],
                'roof_room'                 => $validate['roof_room'],
                'dining'                    => $validate['dining'],
                'kitchen_room'              => $validate['kitchen_room'],
                'closet'                    => $validate['closet'],
                'another_details'           => $validate['another_details'],
                'build'                     => $validate['build'],
                'floors'                    => $validate['floors'],
                'doors'                     => $validate['doors'],
                'roofs'                     => $validate['roofs'],
                'windows'                   => $validate['windows'],
                'another_finished'          => $validate['another_finished'],
                'fridge'                    => $validate['fridge'],
                'lamps'                     => $validate['lamps'],
                'air'                       => $validate['air'],
                'kitchen'                   => $validate['kitchen'],
                'curtain'                   => $validate['curtain'],
                'alarm'                     => $validate['alarm'],
                'electricy_kitchen'         => $validate['electricy_kitchen'],
                'blackouts'                 => $validate['blackouts'],
                'camera_security'           => $validate['camera_security'],
                'dishwater'                 => $validate['dishwater'],
                'bathroom_curtain'          => $validate['bathroom_curtain'],
                'solar_panel'               => $validate['solar_panel'],
                'bell'                      => $validate['bell'],
                'water_heater'              => $validate['water_heater'],
                'cistern'                   => $validate['cistern'],
                'washing_machine'           => $validate['washing_machine'],
                'bathroom_mirros'           => $validate['bathroom_mirros'],
                'trash_deposit'             => $validate['trash_deposit'],
                'dryer'                     => $validate['dryer'],
                'another_include'           => $validate['another_include'],
                'cabin'                     => $validate['cabin'],
                'gym'                       => $validate['gym'],
                'kids_area'                 => $validate['kids_area'],
                'daycare'                   => $validate['daycare'],
                'sauna_shared'              => $validate['sauna_shared'],
                'floor_shared'              => $validate['floor_shared'],
                'social_area'               => $validate['social_area'],
                'spa'                       => $validate['spa'],
                'pet_area'                  => $validate['pet_area'],
                'beauty_salon'              => $validate['beauty_salon'],
                'phone_plant'               => $validate['phone_plant'],
                'parking_visit'             => $validate['parking_visit'],
                'court'                     => $validate['court'],
                'ribbon'                    => $validate['ribbon'],
                'bussines_center'           => $validate['bussines_center'],
                'another_pleasantness'      => $validate['another_pleasantness'],
                'picture_pleasantness'      => $validate['picture_pleasantness'],
                'registry_usd'              => $validate['registry_usd'],
                'registry_gtq'              => $validate['registry_gtq'],
                'iusi_usd'                  => $validate['iusi_usd'],
                'iusi_gtq'                  => $validate['iusi_gtq'],
                'sheet'                     => $validate['sheet'],
                'property'                  => $validate['property'],
                'book'                      => $validate['book'],
                'society'                   => $validate['society'],
                'name_society'              => $validate['name_society'],
                'mortgage'                  => $validate['mortgage'],
                'mortgage_usd'              => $validate['mortgage_usd'],
                'mortgage_gtq'              => $validate['mortgage_gtq'],
                'bank_id'                   => $validate['bank_id'],
                'appraisal'                 => $validate['appraisal'],
                'appraisal_usd'             => $validate['appraisal_usd'],
                'appraisal_gtq'             => $validate['appraisal_gtq'],
                'appraisal_type'            => $validate['appraisal_type'],
                'iva'                       => $validate['iva'],
                'rings'                     => $validate['rings'],
                'description'               => $validate['description'],
                'youtube'                   => $validate['youtube'],
                'code'                      => $validate['code'],
                'internal_note'             => $validate['internal_note'],
                'status'                    => $validate['status']
            ]);
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $properties;
         } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al consultar los datos';
        } finally {
            $response =
                [
                    'message'   => $this->message,
                    'result'    => $this->result,
                    'records'   => $this->records,
                ];
            return response()->json($response, $this->statusCode);
        } 
    }

    public function show(Property $data)
    {
        return datatables()->of( Property::get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a class='btn btn-info btn-rounded m-1 text-white btn-edit' id='".$record->regions_id."'>Editar</a>".
                    "<a class='btn btn-danger btn-danger rounded m-1 text-white btn-delete' id='".$record->regions_id."'>Eliminar</a>";  
            })
            ->addColumn('estado', function ($record){
                if ($record->status == 0) {
                    $class       = 'badge-secondary';
                    $descripcion = 'Inactivo';
                } else {
                    $class       = 'badge-success';
                    $descripcion = 'Activo';
                }
                return "<span class='badge text-white {$class}'>{$descripcion}</span>";
            })->rawColumns(['estado','acciones'])
            ->toJson();
    }

    public function showid(Request $request)
    {
        try {

            $properties = Property::find($request->propiety_id);
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $properties;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al consultar los datos';
        } finally {
            $response =
                [
                    'message'   => $this->message,
                    'result'    => $this->result,
                    'records'   => $this->records,
                ];
            return response()->json($response, $this->statusCode);
        }
    }

    public function edit(Request $request)
    {
        
         try { 
            $validate = $request->validate([
                'title' => 'required',
                'type' => 'required' ,
                'user_id' => 'required',
                'owner_id' => 'required',
                'country_id' => 'required',
                'departament_id' => 'required',
                'municipality_id' => 'required',
                'zone_id' => 'required',
                'region_id' => 'required',
                'adress' => 'required',
                'partner' => 'required',
                'sale_usd' => 'required',
                'sale_gtq' => 'required',
                'rent_usd' => 'required',
                'rent_gtq' => 'required',
                'fee_rent' => 'required',
                'fee_sale' => 'required',
                'finance' => 'required',
                'exchange' => 'required',
                'engage_usd' => 'required',
                'engage_gtq' => 'required',
                'rate' => 'required',
                'fee_usd' => 'required',
                'fee_gtq' => 'required',
                'term' => 'required',
                'term_text' => 'required',
                'maintenance' => 'required',
                'fee_maintenance_gtq' => 'required',
                'fee_maintenance_usd' => 'required',
                'include_maintenance' => 'required',
                'water_service' => 'required',
                'security_service' => 'required',
                'electricy_service' => 'required',
                'trash_service' => 'required',
                'clean_service' => 'required',
                'name_contact' => 'required',
                'phone_contact' => 'required',
                'telephone_contact' => 'required',
                'email_contact' => 'required',
                'name_contact_2' => 'required',
                'phone_contact_2' => 'required', 
                'telephone_contact_2' => 'required',
                'email_contact_2' => 'required',
                'social_media' => 'required',
                'exclusivity' => 'required',
                'share' => 'required',
                'partner_share' => 'required',
                'company_share' => 'required',
                'rate_share' => 'required',
                'land_vrs' => 'required',
                'build_mts' => 'required',
                'front_mts' => 'required',
                'bottom_mts' => 'required',
                'build_year' => 'required',
                'levels' => 'required',
                'rooms' => 'required',
                'service_rooms' => 'required',
                'bathrooms' => 'required',
                'bathrooms_service' => 'required',
                'parking' => 'required',
                'parking_roof' => 'required',
                'offices' => 'required',
                'cellars' => 'required',
                'places' => 'required',
                'door' => 'required',
                'front_door' => 'required',
                'cupboard' => 'required',
                'white_closet' => 'required',
                'gardeen_front' => 'required',
                'pantry' => 'required',
                'tub' => 'required',
                'bathroom_visit' => 'required',
                'laundry'=> 'required',
                'bidet' => 'required',
                'room_visit' => 'required',
                'yard' => 'required',
                'jetina' => 'required',
                'study' => 'required',
                'jacuzzi' => 'required',
                'pergola' => 'required',
                'living_room' => 'required',
                'winery' => 'required',
                'sauna' => 'required',
                'chimeny' => 'required',
                'garden_winery' => 'required',
                'balcony' => 'required',
                'dining_room' => 'required',
                'walkin_closet' => 'required',
                'grill' => 'required',
                'family_room' => 'required',
                'roof_room' => 'required',
                'dining' => 'required',
                'kitchen_room' => 'required',
                'closet' => 'required',
                'another_details' => 'required',
                'build' => 'required',
                'floors' => 'required',
                'doors' => 'required',
                'roofs' => 'required',
                'windows' => 'required',
                'another_finished' => 'required',
                'fridge' => 'required',
                'lamps' => 'required',
                'air' => 'required',
                'kitchen' => 'required',
                'curtain' => 'required',
                'alarm' => 'required',
                'electricy_kitchen' => 'required',
                'blackouts' => 'required',
                'camera_security' => 'required',
                'dishwater' => 'required',
                'bathroom_curtain' => 'required',
                'solar_panel' => 'required',
                'bell' => 'required',
                'water_heater' => 'required',
                'cistern' => 'required',
                'washing_machine' => 'required',
                'bathroom_mirros' => 'required',
                'trash_deposit' => 'required',
                'dryer' => 'required',
                'another_include' => 'required',
                'cabin' => 'required',
                'gym' => 'required',
                'kids_area' => 'required',
                'daycare' => 'required',
                'sauna_shared' => 'required',
                'floor_shared' => 'required',
                'social_area' => 'required',
                'spa' => 'required',
                'pet_area' => 'required',
                'beauty_salon' => 'required',
                'phone_plant' => 'required',
                'parking_visit' => 'required',
                'court' => 'required',
                'ribbon' => 'required',
                'bussines_center' => 'required',
                'another_pleasantness' => 'required',
                'picture_pleasantness' => 'required',
                'registry_usd' => 'required',
                'registry_gtq' => 'required',
                'iusi_usd' => 'required',
                'iusi_gtq' => 'required',
                'sheet' => 'required',
                'property' => 'required',
                'book' => 'required',
                'society' => 'required',
                'name_society' => 'required',
                'mortgage' => 'required',
                'mortgage_usd' => 'required',
                'mortgage_gtq' => 'required',
                'bank_id' => 'required',
                'appraisal' => 'required',
                'appraisal_usd' => 'required',
                'appraisal_gtq' => 'required',
                'appraisal_type' => 'required',
                'iva' => 'required',
                'rings' => 'required',
                'description' => 'required',
                'youtube' => 'required',
                'code' => 'required',
                'internal_note' => 'required',
                'status' => 'required' 
            ]);

            $properties = Property::find($request->propiety_id);
            $properties->title                     = $validate['title'];
            $properties->type                      = $validate['type'] ;
            $properties->user_id                   = $validate['user_id'];
            $properties->owner_id                  = $validate['owner_id'];
            $properties->country_id                = $validate['country_id'];
            $properties->departament_id            = $validate['departament_id'];
            $properties->municipality_id           = $validate['municipality_id'];
            $properties->zone_id                   = $validate['zone_id'];
            $properties->region_id                 = $validate['region_id'];
            $properties->adress                    = $validate['adress'];
            $properties->partner                   = $validate['partner'];
            $properties->sale_usd                  = $validate['sale_usd'];
            $properties->sale_gtq                  = $validate['sale_gtq'];
            $properties->rent_usd                  = $validate['rent_usd'];
            $properties->rent_gtq                  = $validate['rent_gtq'];
            $properties->fee_rent                  = $validate['fee_rent'];
            $properties->fee_sale                  = $validate['fee_sale'];
            $properties->finance                   = $validate['finance'];
            $properties->exchange                  = $validate['exchange'];
            $properties->engage_usd                = $validate['engage_usd'];
            $properties->engage_gtq                = $validate['engage_gtq'];
            $properties->rate_share                = $validate['rate'];
            $properties->fee_usd                   = $validate['fee_usd'];
            $properties->fee_gtq                   = $validate['fee_gtq'];
            $properties->term                      = $validate['term'];
            $properties->term_text                 = $validate['term_text'];
            $properties->maintenance               = $validate['maintenance'];
            $properties->fee_maintenance_gtq       = $validate['fee_maintenance_gtq'];
            $properties->fee_maintenance_usd       = $validate['fee_maintenance_usd'];
            $properties->include_maintenance       = $validate['include_maintenance'];
            $properties->water_service             = $validate['water_service'];
            $properties->security_service          = $validate['security_service'];
            $properties->electricy_service         = $validate['electricy_service'];
            $properties->trash_service             = $validate['trash_service'];
            $properties->clean_service             = $validate['clean_service'];
            $properties->name_contact              = $validate['name_contact']; 
            $properties->phone_contact             = $validate['phone_contact'];
            $properties->telephone_contact         = $validate['telephone_contact'];
            $properties->email_contact             = $validate['email_contact'];
            $properties->name_contact_2            = $validate['name_contact_2'];
            $properties->phone_contact_2           = $validate['phone_contact_2']; 
            $properties->telephone_contact_2       = $validate['telephone_contact_2'];
            $properties->email_contact_2           = $validate['email_contact_2'];
            $properties->social_media              = $validate['social_media'];
            $properties->exclusivity               = $validate['exclusivity'];
            $properties->share                     = $validate['share'];
            $properties->partner_share             = $validate['partner_share'];
            $properties->company_share             = $validate['company_share'];
            $properties->rate_share                = $validate['rate_share'];
            $properties->land_vrs                  = $validate['land_vrs'];
            $properties->build_mts                 = $validate['build_mts'];
            $properties->front_mts                 = $validate['front_mts'];
            $properties->bottom_mts                = $validate['bottom_mts'];
            $properties->build_year                = $validate['build_year'];
            $properties->levels                    = $validate['levels'];
            $properties->rooms                     = $validate['rooms'];
            $properties->service_rooms             = $validate['service_rooms'];
            $properties->bathrooms                 = $validate['bathrooms'];
            $properties->bathrooms_service         = $validate['bathrooms_service'];
            $properties->parking                   = $validate['parking'];
            $properties->parking_roof              = $validate['parking_roof'];
            $properties->offices                   = $validate['offices'];
            $properties->cellars                   = $validate['cellars'];
            $properties->places                    = $validate['places'];
            $properties->door                      = $validate['door'];
            $properties->front_door                = $validate['front_door'];
            $properties->cupboard                  = $validate['cupboard'];
            $properties->white_closet              = $validate['white_closet'];
            $properties->gardeen_front             = $validate['gardeen_front'];
            $properties->pantry                    = $validate['pantry'];
            $properties->tub                       = $validate['tub'];
            $properties->bathroom_visit            = $validate['bathroom_visit'];
            $properties->laundry                   = $validate['laundry'];
            $properties->bidet                     = $validate['bidet'];
            $properties->room_visit                = $validate['room_visit'];
            $properties->yard                      = $validate['yard'];
            $properties->jetina                    = $validate['jetina'];
            $properties->study                     = $validate['study'];
            $properties->jacuzzi                   = $validate['jacuzzi'];
            $properties->pergola                   = $validate['pergola'];
            $properties->living_room               = $validate['living_room'];
            $properties->winery                    = $validate['winery'];
            $properties->sauna                     = $validate['sauna'];
            $properties->chimeny                   = $validate['chimeny'];
            $properties->garden_winery             = $validate['garden_winery'];
            $properties->balcony                   = $validate['balcony'];
            $properties->dining_room               = $validate['dining_room'];
            $properties->walkin_closet             = $validate['walkin_closet'];
            $properties->grill                     = $validate['grill'];
            $properties->family_room               = $validate['family_room'];
            $properties->roof_room                 = $validate['roof_room'];
            $properties->dining                    = $validate['dining'];
            $properties->kitchen_room              = $validate['kitchen_room'];
            $properties->closet                    = $validate['closet'];
            $properties->another_details           = $validate['another_details'];
            $properties->build                     = $validate['build'];
            $properties->floors                    = $validate['floors'];
            $properties->doors                     = $validate['doors'];
            $properties->roofs                     = $validate['roofs'];
            $properties->windows                   = $validate['windows'];
            $properties->another_finished          = $validate['another_finished'];
            $properties->fridge                    = $validate['fridge'];
            $properties->lamps                     = $validate['lamps'];
            $properties->air                       = $validate['air'];
            $properties->kitchen                   = $validate['kitchen'];
            $properties->curtain                   = $validate['curtain'];
            $properties->alarm                     = $validate['alarm'];
            $properties->electricy_kitchen         = $validate['electricy_kitchen'];
            $properties->blackouts                 = $validate['blackouts'];
            $properties->camera_security           = $validate['camera_security'];
            $properties->dishwater                 = $validate['dishwater'];
            $properties->bathroom_curtain          = $validate['bathroom_curtain'];
            $properties->solar_panel               = $validate['solar_panel'];
            $properties->bell                      = $validate['bell'];
            $properties->water_heater              = $validate['water_heater'];
            $properties->cistern                   = $validate['cistern'];
            $properties->washing_machine           = $validate['washing_machine'];
            $properties->bathroom_mirros           = $validate['bathroom_mirros'];
            $properties->trash_deposit             = $validate['trash_deposit'];
            $properties->dryer                     = $validate['dryer'];
            $properties->another_include           = $validate['another_include'];
            $properties->cabin                     = $validate['cabin'];
            $properties->gym                       = $validate['gym'];
            $properties->kids_area                 = $validate['kids_area'];
            $properties->daycare                   = $validate['daycare'];
            $properties->sauna_shared              = $validate['sauna_shared'];
            $properties->floor_shared              = $validate['floor_shared'];
            $properties->social_area               = $validate['social_area'];
            $properties->spa                       = $validate['spa'];
            $properties->pet_area                  = $validate['pet_area'];
            $properties->beauty_salon              = $validate['beauty_salon'];
            $properties->phone_plant               = $validate['phone_plant'];
            $properties->parking_visit             = $validate['parking_visit'];
            $properties->court                     = $validate['court'];
            $properties->ribbon                    = $validate['ribbon'];
            $properties->bussines_center           = $validate['bussines_center'];
            $properties->another_pleasantness      = $validate['another_pleasantness'];
            $properties->picture_pleasantness      = $validate['picture_pleasantness'];
            $properties->registry_usd              = $validate['registry_usd'];
            $properties->registry_gtq              = $validate['registry_gtq'];
            $properties->iusi_usd                  = $validate['iusi_usd'];
            $properties->iusi_gtq                  = $validate['iusi_gtq'];
            $properties->sheet                     = $validate['sheet'];
            $properties->property                  = $validate['property'];
            $properties->book                      = $validate['book'];
            $properties->society                   = $validate['society'];
            $properties->name_society              = $validate['name_society'];
            $properties->mortgage                  = $validate['mortgage'];
            $properties->mortgage_usd              = $validate['mortgage_usd'];
            $properties->mortgage_gtq              = $validate['mortgage_gtq'];
            $properties->bank_id                   = $validate['bank_id'];
            $properties->appraisal                 = $validate['appraisal'];
            $properties->appraisal_usd             = $validate['appraisal_usd'];
            $properties->appraisal_gtq             = $validate['appraisal_gtq'];
            $properties->appraisal_type            = $validate['appraisal_type'];
            $properties->iva                       = $validate['iva'];
            $properties->rings                     = $validate['rings'];
            $properties->description               = $validate['description'];
            $properties->youtube                   = $validate['youtube'];
            $properties->code                      = $validate['code'];
            $properties->internal_note             = $validate['internal_note'];
            $properties->status                    = $validate['status'];
            $properties->update();

            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $properties;
      } catch (\Exception $e) {
            $statusCode     = 400;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al consultar los datos';
        } finally { 
            $response =
                [
                    'message'   => $this->message,
                    'result'    => $this->result,
                    'records'   => $this->records,
                ];
            return response()->json($response, $this->statusCode);
         } 
    }

    public function delete(Request $request)
    {
        try {
            $properties = Property::destroy($request->propiety_id);
            $this->message = "Registro eliminado correctamente";
            $this->result = true;
            $this->records = $properties;
        } catch (\Exception $e) {
            $statusCode     = 400;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al consultar los datos';
        } finally {
            $response =
                [
                    'message'   => $this->message,
                    'result'    => $this->result,
                    'records'   => $this->records,
                ];
            return response()->json($response, $this->statusCode);
        }
    }

    // php artisan make:export BankExport --model=Bank generar el archivo para la exportacion
    public function exportExcel(Excel $excel)
    {
        return $excel->download(new PropiertiesExport, 'propierties.xlsx');
    }
}