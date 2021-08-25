<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use App\Models\ListaPdf;
use App\Models\Images;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\PropertyWrite;
use Maatwebsite\Excel\Excel;
use App\Exports\PropiertiesExport;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use PDF;

class PropertyController extends Controller
{
	public $message     = "";
	public $result         = false;
	public $records     = array();
	public $statusCode     = 200;
	
	public function ver_propiedad($id){
		$data = Property::find($id);
		return view('ver_propiedad', compact('data'));
	}

	public function pdf($id){
		try{
			$data       = Property::where('propiertiy_id',$id)->first(); 
			$pdf        = PDF::loadView('pdf_propiedad',compact('data'));
			//return view('pdf_propiedad',compact('data'));
			//dd($pdf);
			$nombre     = 'Propiedad '.$id.".pdf";
			return $pdf->setPaper('letter')->download($nombre);
		}catch(\Exception $e){
			return response()->json(['result' => false, 'message' => 'Error subiendo. '.$e->getMessage(), 'records' => []]);
		}
	}

	public function tour($id){
		try{
			$data       = Property::where('propiertiy_id',$id)->first(); 
			//dd($data);
			$pdf        = PDF::loadView('pdf_tour',compact('data'));
			//return view('pdf_propiedad',compact('data'));
			//dd($pdf);
			$nombre     = 'Informacion para tour '.$id.".pdf";
			return $pdf->setPaper('letter','landscape')->stream($nombre);
		}catch(\Exception $e){
			return response()->json(['result' => false, 'message' => 'Error subiendo. '.$e->getMessage(), 'records' => []]);
		}
	}

	public function pdf_total($usuario_id){
		try{
			$name = \Session::get('user');
			$usuario = User::where('name',$name)->first();
			$data       = ListaPdf::where('usuario_id',$usuario->user_id)->get(); 
			$pdf        = PDF::loadView('pdf_propiedad_list',compact('data'));
			$nombre     = 'Propiedades.pdf';
			return $pdf->setPaper('letter')->download($nombre);
		}catch(\Exception $e){
			return response()->json(['result' => false, 'message' => 'Error subiendo. '.$e->getMessage(), 'records' => []]);
		}
	}

	public function tour_total($usuario_id){
		try{
			$name = \Session::get('user');
			$usuario = User::where('name',$name)->first();
			$data       = ListaPdf::where('usuario_id',$usuario->user_id)->get(); 
			$pdf        = PDF::loadView('tour_propiedad_list',compact('data'));
			$nombre     = 'Propiedades.pdf';
			return $pdf->setPaper('letter')->download($nombre);
		}catch(\Exception $e){
			return response()->json(['result' => false, 'message' => 'Error subiendo. '.$e->getMessage(), 'records' => []]);
		}
	}


	public function propiedades(){
		return view('propiedades');
	}

	public function propiedades_post(Request $request){
		$tipo_venta = $request->input('tipo_venta');
		$tipo_inmueble = $request->input('tipo_inmueble');
		$precio_maximo = $request->input('precio_maximo');

		$departamento = $request->input('departamento');
		$municipio = $request->input('municipio');
		$zona = $request->input('zona');
		return view('propiedades',compact('tipo_venta','tipo_inmueble','precio_maximo','departamento','municipio','zona'));
	}

	public function index()
	{
		$name = \Session::get('user');
		$usuario = User::where('name',$name)->first();
		$usuario_id = $usuario->user_id;
		$titulo     = 'propierty';
		$dt_route   = route('propierty.show');
		$dt_order   = [[0, 'desc']];
		$dt_columns = [
			['data' => 'id','title'=>'ID'],
			['data' => 'imagen', 'title'=>'IMAGEN'],
			['data' => 'title', 'title'=>'TITULO'],
			['data' => 'subtitle', 'title'=>'SUB TITULO'],
			['data' => 'tipo', 'type'=>'TIPO'],
			['data' => 'propietario', 'title'=>'PROPIETARIO'],
			['data' => 'adress', 'title'=>'DIRECCION'],
			['data' => 'rent_gtq', 'title'=>'RENTA Q.'],
			['data' => 'rent_usd', 'title'=>'RENTA $.'],
			['data' => 'sale_gtq', 'title'=>'VENTA Q.'],
			['data' => 'sale_usd', 'title'=>'VENTA $.'],
			['data' => 'estado', 'title'=>'ESTADO'],
			['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false],
			['data' => 'pdf',"title"=>"PDF", 'orderable'=> false, 'searchable' => false],
			//['data' => 'tour',"title"=>"TOUR", 'orderable'=> false, 'searchable' => false],
			['data' => 'generar',"title"=>"Generar", 'orderable'=> false, 'searchable' => false]
		]; 
		return view('propierty', compact('dt_route', 'dt_columns','dt_order','usuario_id' ));
	}

	public function pdf_list()
	{
		$name = \Session::get('user');
		$usuario = User::where('name',$name)->first();
		$usuario_id = $usuario->user_id;
		$titulo     = 'propierty';
		$dt_route   = route('propierty.show_list');
		$dt_order   = [[0, 'desc']];
		$dt_columns = [
			['data' => 'codigo_propiedad','title'=>'ID'],
			['data' => 'imagen', 'title'=>'IMAGEN'],
			['data' => 'title', 'title'=>'TITULO'],
			['data' => 'subtitle', 'title'=>'SUB TITULO'],
			['data' => 'tipo', 'type'=>'TIPO'],
			['data' => 'propietario', 'title'=>'PROPIETARIO'],
			['data' => 'adress', 'title'=>'DIRECCION'],
			['data' => 'eliminar',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false],
			['data' => 'generar',"title"=>"GENERAR", 'orderable'=> false, 'searchable' => false],
			['data' => 'tour',"title"=>"TOUR", 'orderable'=> false, 'searchable' => false]
		]; 
		return view('property_list', compact('dt_route', 'dt_columns','dt_order','usuario_id' ));
	}

	public function image(Request $request){
		$archivo = $request->archivo;
		$respuesta = [];
		if ($archivo) {
			try {
				$path = $archivo->store('storage/uploads');
				$fileName = collect(explode('/', $path))->last();
				$image = Image::make(Storage::get($path));
				Storage::disk('local')->put($path, (string) $image->encode($archivo->extension()));
				$imagen = Images::create([
					'path'          => env('RAIZ','https://platinum.mavis.com.gt/').$path,
					'extension'    => $archivo->extension()
				]);
				$records = $imagen;
			} catch(\Exception $e){
				return response()->json(['result' => false, 'message' => 'Error subiendo. '.$e->getMessage(), 'records' => []]);
			}
			return response()->json(['result' => true, 'message' => "Archivo subido completamente.", 'records' => $records]);
		} else {
			return response()->json(['result' => false, 'message' => 'El archivo es obligatorio', 'records' => []]);
		}
	}

	public function create(Request $request)
	{
		try { 
			$properties = Property::create([
				'title'                     => $request->input('title'),
				'subtitle'                  => $request->input('subtitle'),
				'type'                      => $request->input('type') ,
				'user_id'                   => $request->input('user_id'),
				'owner_id'                  => $request->input('owner_id'),
				'country_id'                => $request->input('country_id'),
				'departament_id'            => $request->input('departament_id'),
				'municipality_id'           => $request->input('municipality_id'),
				'zone_id'                   => $request->input('zone_id'),
				'region_id'                 => $request->input('region_id'),
				'adress'                    => $request->input('adress'),
				'partner'                   => $request->input('partner'),
				'sale_usd'                  => $request->input('sale_usd'),
				'sale_gtq'                  => $request->input('sale_gtq'),
				'rent_usd'                  => $request->input('rent_usd'),
				'rent_gtq'                  => $request->input('rent_gtq'),
				'fee_rent'                  => $request->input('fee_rent'),
				'fee_sale'                  => $request->input('fee_sale'),
				'finance'                   => $request->input('finance'),
				'exchange'                  => $request->input('exchange'),
				'engage_usd'                => $request->input('engage_usd'),
				'engage_gtq'                => $request->input('engage_gtq'),
				'rate'                      => $request->input('rate'),
				'fee_usd'                   => $request->input('fee_usd'),
				'fee_gtq'                   => $request->input('fee_gtq'),
				'term'                      => $request->input('term'),
				'term_text'                 => $request->input('term_text'),
				'maintenance'               => $request->input('maintenance'),
				'fee_maintenance_gtq'       => $request->input('fee_maintenance_gtq'),
				'fee_maintenance_usd'       => $request->input('fee_maintenance_usd'),
				'include_maintenance'       => $request->input('include_maintenance'),
				'water_service'             => $request->input('water_service'),
				'security_service'          => $request->input('security_service'),
				'electricy_service'         => $request->input('electricy_service'),
				'trash_service'             => $request->input('trash_service'),
				'clean_service'             => $request->input('clean_service'),
				'name_contact'              => $request->input('name_contact'), 
				'phone_contact'             => $request->input('phone_contact'),
				'telephone_contact'         => $request->input('telephone_contact'),
				'email_contact'             => $request->input('email_contact'),
				'name_contact_2'            => $request->input('name_contact_2'),
				'phone_contact_2'           => $request->input('phone_contact_2'), 
				'telephone_contact_2'       => $request->input('telephone_contact_2'),
				'email_contact_2'           => $request->input('email_contact_2'),
				'social_media'              => $request->input('social_media'),
				'exclusivity'               => $request->input('exclusivity'),
				'share'                     => $request->input('share'),
				'partner_share'             => $request->input('partner_share'),
				'company_share'             => $request->input('company_share'),
				'rate_share'                => $request->input('rate_share'),
				'land_vrs'                  => $request->input('land_vrs'),
				'build_mts'                 => $request->input('build_mts'),
				'front_mts'                 => $request->input('front_mts'),
				'bottom_mts'                => $request->input('bottom_mts'),
				'build_year'                => $request->input('build_year'),
				'levels'                    => $request->input('levels'),
				'rooms'                     => $request->input('rooms'),
				'service_rooms'             => $request->input('service_rooms'),
				'bathrooms'                 => $request->input('bathrooms'),
				'bathrooms_service'         => $request->input('bathrooms_service'),
				'parking'                   => $request->input('parking'),
				'parking_roof'              => $request->input('parking_roof'),
				'offices'                   => $request->input('offices'),
				'cellars'                   => $request->input('cellars'),
				'places'                    => $request->input('places'),
				'door'                      => $request->input('door'),
				'front_door'                => $request->input('front_door'),
				'cupboard'                  => $request->input('cupboard'),
				'white_closet'              => $request->input('white_closet'),
				'gardeen_front'             => $request->input('gardeen_front'),
				'pantry'                    => $request->input('pantry'),
				'tub'                       => $request->input('tub'),
				'bathroom_visit'            => $request->input('bathroom_visit'),
				'laundry'                   => $request->input('laundry'),
				'bidet'                     => $request->input('bidet'),
				'room_visit'                => $request->input('room_visit'),
				'yard'                      => $request->input('yard'),
				'jetina'                    => $request->input('jetina'),
				'study'                     => $request->input('study'),
				'jacuzzi'                   => $request->input('jacuzzi'),
				'pergola'                   => $request->input('pergola'),
				'living_room'               => $request->input('living_room'),
				'winery'                    => $request->input('winery'),
				'sauna'                     => $request->input('sauna'),
				'chimeny'                   => $request->input('chimeny'),
				'garden_winery'             => $request->input('garden_winery'),
				'balcony'                   => $request->input('balcony'),
				'dining_room'               => $request->input('dining_room'),
				'walkin_closet'             => $request->input('walkin_closet'),
				'grill'                     => $request->input('grill'),
				'family_room'               => $request->input('family_room'),
				'roof_room'                 => $request->input('roof_room'),
				'dining'                    => $request->input('dining'),
				'kitchen_room'              => $request->input('kitchen_room'),
				'closet'                    => $request->input('closet'),
				'another_details'           => $request->input('another_details'),
				'build'                     => $request->input('build'),
				'floors'                    => $request->input('floors'),
				'doors'                     => $request->input('doors'),
				'roofs'                     => $request->input('roofs'),
				'windows'                   => $request->input('windows'),
				'another_finished'          => $request->input('another_finished'),
				'fridge'                    => $request->input('fridge'),
				'lamps'                     => $request->input('lamps'),
				'air'                       => $request->input('air'),
				'kitchen'                   => $request->input('kitchen'),
				'curtain'                   => $request->input('curtain'),
				'alarm'                     => $request->input('alarm'),
				'electricy_kitchen'         => $request->input('electricy_kitchen'),
				'blackouts'                 => $request->input('blackouts'),
				'camera_security'           => $request->input('camera_security'),
				'dishwater'                 => $request->input('dishwater'),
				'bathroom_curtain'          => $request->input('bathroom_curtain'),
				'solar_panel'               => $request->input('solar_panel'),
				'bell'                      => $request->input('bell'),
				'water_heater'              => $request->input('water_heater'),
				'cistern'                   => $request->input('cistern'),
				'washing_machine'           => $request->input('washing_machine'),
				'bathroom_mirros'           => $request->input('bathroom_mirros'),
				'trash_deposit'             => $request->input('trash_deposit'),
				'dryer'                     => $request->input('dryer'),
				'another_include'           => $request->input('another_include'),
				'cabin'                     => $request->input('cabin'),
				'gym'                       => $request->input('gym'),
				'kids_area'                 => $request->input('kids_area'),
				'daycare'                   => $request->input('daycare'),
				'sauna_shared'              => $request->input('sauna_shared'),
				'floor_shared'              => $request->input('floor_shared'),
				'social_area'               => $request->input('social_area'),
				'spa'                       => $request->input('spa'),
				'pet_area'                  => $request->input('pet_area'),
				'beauty_salon'              => $request->input('beauty_salon'),
				'phone_plant'               => $request->input('phone_plant'),
				'parking_visit'             => $request->input('parking_visit'),
				'court'                     => $request->input('court'),
				'ribbon'                    => $request->input('ribbon'),
				'bussines_center'           => $request->input('bussines_center'),
				'another_pleasantness'      => $request->input('another_pleasantness'),
				'picture_pleasantness'      => $request->input('picture_pleasantness'),
				'registry_usd'              => $request->input('registry_usd'),
				'registry_gtq'              => $request->input('registry_gtq'),
				'iusi_usd'                  => $request->input('iusi_usd'),
				'iusi_gtq'                  => $request->input('iusi_gtq'),
				'sheet'                     => $request->input('sheet'),
				'property'                  => $request->input('property'),
				'book'                      => $request->input('book'),
				'society'                   => $request->input('society'),
				'name_society'              => $request->input('name_society'),
				'mortgage'                  => $request->input('mortgage'),
				'mortgage_usd'              => $request->input('mortgage_usd'),
				'mortgage_gtq'              => $request->input('mortgage_gtq'),
				'bank_id'                   => $request->input('bank_id'),
				'appraisal'                 => $request->input('appraisal'),
				'appraisal_usd'             => $request->input('appraisal_usd'),
				'appraisal_gtq'             => $request->input('appraisal_gtq'),
				'appraisal_type'            => $request->input('appraisal_type'),
				'iva'                       => $request->input('iva'),
				'rings'                     => $request->input('rings'),
				'description'               => $request->input('description'),
				'youtube'                   => $request->input('youtube'),
				'code'                      => $request->input('code'),
				'internal_note'             => $request->input('internal_note'),
				'jardin_trasero'            => $request->input('jardin_trasero'),
				'desayunador'             	=> $request->input('desayunador'),
				'status'                    => 1
			]);
			if($properties){
				if($request->input('imagenes')){
					$imagenes = explode(',',$request->input('imagenes'));
					if(count($imagenes)>0){
						foreach ($imagenes as $imagen) {
							$buscar = Images::find($imagen);
							if($buscar){
								$buscar->propierty_id = $properties->propiertiy_id;
								$buscar->save();
							}
						}
					}
				}
			}
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
					"<div style='display:inline-block'><ul style='list-style:none'><li style='display:inline'><a class='btn2 btn-warning btn-rounded m-1 text-white btn-renta' id='".$record->propiertiy_id."'>Rentar</a></li>".
					"<a class='btn2 btn-info btn-rounded rounded m-1 text-white btn-venta' id='".$record->propiertiy_id."'>Vender</a></ul></div>".
					"<a class='btn2 btn-dark btn-rounded m-1 text-white btn-edit' id='".$record->propiertiy_id."'>Editar</a>".
					"<a class='btn2 btn-danger btn-rounded rounded m-1 text-white btn-delete' id='".$record->propiertiy_id."'>Eliminar</a>";  
			})
			->addColumn('pdf', function ($record) {
				return
					"<a class='btn2 btn-success btn-rounded rounded m-1 text-white btn-delete' id='".$record->propiertiy_id."'>Añadir</a>";  
			})
			->addColumn('id', function ($record) {
				return
					"<a href='/propierty/view/".$record->propiertiy_id."' target='_blank'>".$record->propiertiy_id."</a>";  
			})
			->addColumn('generar', function ($record) {
				return
					"<a class='btn2 btn-danger btn-rounded rounded m-1 text-white btn-genera' id='".$record->propiertiy_id."'>PDF</a>";  
			})
			->addColumn('tour', function ($record) {
				return
					"<a class='btn2 btn-info btn-rounded rounded m-1 text-white btn-tour' id='".$record->propiertiy_id."'>TOUR</a>";  
			})
			->addColumn('imagen', function ($record) {
				$buscar = Images::where('propierty_id',$record->propiertiy_id)->first();
				if($buscar){
					return "<img src='".$buscar->path."' style='width:80px;height:100px;'>";
				}else{
					$imagen = 'https://platinum.mavis.com.gt/includes/propiedades/'.$record->propiertiy_id.'/1.jpg'; 
					return "<img src='".$imagen."' style='width:80px;height:100px;'>";
				}
			})
			->addColumn('tipo', function ($record) {
				if($record->type == 1){
					$tipo = 'Casa';
				}
				if($record->type == 2){
					$tipo = 'Apartamento';
				}
				if($record->type == 3){
					$tipo = 'Oficina';
				}
				if($record->type == 4){
					$tipo = 'Bodega';
				}
				if($record->type == 5){
					$tipo = 'Terreno';
				}
				if($record->type == 6){
					$tipo = 'Finca';
				}
				if($record->type == 7){
					$tipo = 'Clinica';
				}
				if($record->type == 8){
					$tipo = 'Casa de playa';
				}
				if($record->type == 9){
					$tipo = 'Granja';
				}
				if($record->type == 10){
					$tipo = 'Edificio';
				}
				if($record->type == 11){
					$tipo = 'Locales';
				}
				if(!isset($tipo)){
					$tipo = "Sin tipo";
				}
				return $tipo;
			})
			->addColumn('propietario', function ($record) {
				$buscar = User::find($record->owner_id);
				if($buscar){
					return $buscar->name;
				}else{
					return "Sin propietario";
				}
			})
			->addColumn('title', function ($record) {
				return strip_tags($record->title);
			})
			->addColumn('subtitle', function ($record) {
				return strip_tags($record->subtitle);
			})
			->addColumn('estado', function ($record){
				if ($record->status == 0) {
					$class       = 'badge-secondary';
					$descripcion = 'Inactivo';
				} else if($record->status == 1) {
					$class       = 'badge-success';
					$descripcion = 'Activo';
				} else if($record->status == 2) {
					$class       = 'badge-warning';
					$descripcion = 'Rentada';
				} else if($record->status == 3) {
					$class       = 'badge-info';
					$descripcion = 'Vendida';
				}
				return "<center><span class='badge text-white {$class}'>{$descripcion}</span></center>";
			})->rawColumns(['estado','acciones','propietario','tipo','imagen','pdf','generar','id','tour'])
			->toJson();
	}

	public function show_list(ListaPdf $data)
	{
		$name = \Session::get('user');
		$usuario = User::where('name',$name)->first();
		return datatables()->of( ListaPdf::where('usuario_id',$usuario->user_id)->get())
			->addColumn('eliminar', function ($record) {
				return  "<a class='btn2 btn-danger btn-rounded rounded m-1 text-white btn-delete' id='".$record->codigo_propiedad."'>Eliminar</a>";  
			})
			->addColumn('generar', function ($record) {
				return
					"<a class='btn2 btn-info btn-rounded rounded m-1 text-white btn-genera' id='".$record->codigo_propiedad."'>PDF</a>";  
			})
			->addColumn('tour', function ($record) {
				return
					"<a class='btn2 btn-info btn-rounded rounded m-1 text-white btn-tour' id='".$record->codigo_propiedad."'>TOUR</a>";  
			})
			->addColumn('imagen', function ($record) {
				$buscar = Images::where('propierty_id',$record->codigo_propiedad)->first();
				if($buscar){
					return "<img src='".$buscar->path."' style='width:80px;height:100px;'>";
				}else{
					$imagen = 'https://platinum.mavis.com.gt/includes/propiedades/'.$record->codigo_propiedad.'/1.jpg'; 
					return "<img src='".$imagen."' style='width:80px;height:100px;'>";
				}
			})
			->addColumn('tipo', function ($record) {
				$record = Property::where('propiertiy_id',$record->codigo_propiedad)->first();
				if($record->type == 1){
					$tipo = 'Casa';
				}
				if($record->type == 2){
					$tipo = 'Apartamento';
				}
				if($record->type == 3){
					$tipo = 'Oficina';
				}
				if($record->type == 4){
					$tipo = 'Bodega';
				}
				if($record->type == 5){
					$tipo = 'Terreno';
				}
				if($record->type == 6){
					$tipo = 'Finca';
				}
				if($record->type == 7){
					$tipo = 'Clinica';
				}
				if($record->type == 8){
					$tipo = 'Casa de playa';
				}
				if($record->type == 9){
					$tipo = 'Granja';
				}
				if($record->type == 10){
					$tipo = 'Edificio';
				}
				if($record->type == 11){
					$tipo = 'Locales';
				}
				if(!isset($tipo)){
					$tipo = "Sin tipo";
				}
				return $tipo;
			})
			->addColumn('propietario', function ($record) {
				$record = Property::where('propiertiy_id',$record->codigo_propiedad)->first();
				$buscar = User::find($record->owner_id);
				if($buscar){
					return $buscar->name;
				}else{
					return "Sin propietario";
				}
			})
			->addColumn('title', function ($record) {
				$record = Property::where('propiertiy_id',$record->codigo_propiedad)->first();
				return $record->title;
			})
			->addColumn('subtitle', function ($record) {
				$record = Property::where('propiertiy_id',$record->codigo_propiedad)->first();
				return $record->subtitle;
			})
			->addColumn('adress', function ($record) {
				$record = Property::where('propiertiy_id',$record->codigo_propiedad)->first();
				return $record->adress;
			})
			->addColumn('estado', function ($record){
				$record = Property::where('propiertiy_id',$record->codigo_propiedad)->first();
				if ($record->status == 0) {
					$class       = 'badge-secondary';
					$descripcion = 'Inactivo';
				} else if($record->status == 1) {
					$class       = 'badge-success';
					$descripcion = 'Activo';
				} else if($record->status == 2) {
					$class       = 'badge-warning';
					$descripcion = 'Rentada';
				} else if($record->status == 3) {
					$class       = 'badge-info';
					$descripcion = 'Vendida';
				}
				return "<center><span class='badge text-white {$class}'>{$descripcion}</span></center>";
			})->rawColumns(['estado','eliminar','propietario','tipo','imagen','pdf','generar','tour'])
			->toJson();
	}

	public function showid(Request $request)
	{
		try {
			$properties = Property::find($request->propierty_id);
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
			$properties = Property::find($request->propiedad_id);
			$properties->title                     = $request->input('title');
			$properties->subtitle                    = $request->input('subtitle');
			$properties->type                      = $request->input('type') ;
			$properties->user_id                   = $request->input('user_id');
			$properties->owner_id                  = $request->input('owner_id');
			$properties->country_id                = $request->input('country_id');
			$properties->departament_id            = $request->input('departament_id');
			$properties->municipality_id           = $request->input('municipality_id');
			$properties->zone_id                   = $request->input('zone_id');
			$properties->region_id                 = $request->input('region_id');
			$properties->adress                    = $request->input('adress');
			$properties->partner                   = $request->input('partner');
			$properties->sale_usd                  = $request->input('sale_usd');
			$properties->sale_gtq                  = $request->input('sale_gtq');
			$properties->rent_usd                  = $request->input('rent_usd');
			$properties->rent_gtq                  = $request->input('rent_gtq');
			$properties->fee_rent                  = $request->input('fee_rent');
			$properties->fee_sale                  = $request->input('fee_sale');
			$properties->finance                   = $request->input('finance');
			$properties->exchange                  = $request->input('exchange');
			$properties->engage_usd                = $request->input('engage_usd');
			$properties->engage_gtq                = $request->input('engage_gtq');
			$properties->rate_share                = $request->input('rate');
			$properties->fee_usd                   = $request->input('fee_usd');
			$properties->fee_gtq                   = $request->input('fee_gtq');
			$properties->term                      = $request->input('term');
			$properties->term_text                 = $request->input('term_text');
			$properties->maintenance               = $request->input('maintenance');
			$properties->fee_maintenance_gtq       = $request->input('fee_maintenance_gtq');
			$properties->fee_maintenance_usd       = $request->input('fee_maintenance_usd');
			$properties->include_maintenance       = $request->input('include_maintenance');
			$properties->water_service             = $request->input('water_service');
			$properties->security_service          = $request->input('security_service');
			$properties->electricy_service         = $request->input('electricy_service');
			$properties->trash_service             = $request->input('trash_service');
			$properties->clean_service             = $request->input('clean_service');
			$properties->name_contact              = $request->input('name_contact'); 
			$properties->phone_contact             = $request->input('phone_contact');
			$properties->telephone_contact         = $request->input('telephone_contact');
			$properties->email_contact             = $request->input('email_contact');
			$properties->name_contact_2            = $request->input('name_contact_2');
			$properties->phone_contact_2           = $request->input('phone_contact_2'); 
			$properties->telephone_contact_2       = $request->input('telephone_contact_2');
			$properties->email_contact_2           = $request->input('email_contact_2');
			$properties->social_media              = $request->input('social_media');
			$properties->exclusivity               = $request->input('exclusivity');
			$properties->share                     = $request->input('share');
			$properties->partner_share             = $request->input('partner_share');
			$properties->company_share             = $request->input('company_share');
			$properties->rate_share                = $request->input('rate_share');
			$properties->land_vrs                  = $request->input('land_vrs');
			$properties->build_mts                 = $request->input('build_mts');
			$properties->front_mts                 = $request->input('front_mts');
			$properties->bottom_mts                = $request->input('bottom_mts');
			$properties->build_year                = $request->input('build_year');
			$properties->levels                    = $request->input('levels');
			$properties->rooms                     = $request->input('rooms');
			$properties->service_rooms             = $request->input('service_rooms');
			$properties->bathrooms                 = $request->input('bathrooms');
			$properties->bathrooms_service         = $request->input('bathrooms_service');
			$properties->parking                   = $request->input('parking');
			$properties->parking_roof              = $request->input('parking_roof');
			$properties->offices                   = $request->input('offices');
			$properties->cellars                   = $request->input('cellars');
			$properties->places                    = $request->input('places');
			$properties->door                      = $request->input('door');
			$properties->front_door                = $request->input('front_door');
			$properties->cupboard                  = $request->input('cupboard');
			$properties->white_closet              = $request->input('white_closet');
			$properties->gardeen_front             = $request->input('gardeen_front');
			$properties->pantry                    = $request->input('pantry');
			$properties->tub                       = $request->input('tub');
			$properties->bathroom_visit            = $request->input('bathroom_visit');
			$properties->laundry                   = $request->input('laundry');
			$properties->bidet                     = $request->input('bidet');
			$properties->room_visit                = $request->input('room_visit');
			$properties->yard                      = $request->input('yard');
			$properties->jetina                    = $request->input('jetina');
			$properties->study                     = $request->input('study');
			$properties->jacuzzi                   = $request->input('jacuzzi');
			$properties->pergola                   = $request->input('pergola');
			$properties->living_room               = $request->input('living_room');
			$properties->winery                    = $request->input('winery');
			$properties->sauna                     = $request->input('sauna');
			$properties->chimeny                   = $request->input('chimeny');
			$properties->garden_winery             = $request->input('garden_winery');
			$properties->balcony                   = $request->input('balcony');
			$properties->dining_room               = $request->input('dining_room');
			$properties->walkin_closet             = $request->input('walkin_closet');
			$properties->grill                     = $request->input('grill');
			$properties->family_room               = $request->input('family_room');
			$properties->roof_room                 = $request->input('roof_room');
			$properties->dining                    = $request->input('dining');
			$properties->kitchen_room              = $request->input('kitchen_room');
			$properties->closet                    = $request->input('closet');
			$properties->another_details           = $request->input('another_details');
			$properties->build                     = $request->input('build');
			$properties->floors                    = $request->input('floors');
			$properties->doors                     = $request->input('doors');
			$properties->roofs                     = $request->input('roofs');
			$properties->windows                   = $request->input('windows');
			$properties->another_finished          = $request->input('another_finished');
			$properties->fridge                    = $request->input('fridge');
			$properties->lamps                     = $request->input('lamps');
			$properties->air                       = $request->input('air');
			$properties->kitchen                   = $request->input('kitchen');
			$properties->curtain                   = $request->input('curtain');
			$properties->alarm                     = $request->input('alarm');
			$properties->electricy_kitchen         = $request->input('electricy_kitchen');
			$properties->blackouts                 = $request->input('blackouts');
			$properties->camera_security           = $request->input('camera_security');
			$properties->dishwater                 = $request->input('dishwater');
			$properties->bathroom_curtain          = $request->input('bathroom_curtain');
			$properties->solar_panel               = $request->input('solar_panel');
			$properties->bell                      = $request->input('bell');
			$properties->water_heater              = $request->input('water_heater');
			$properties->cistern                   = $request->input('cistern');
			$properties->washing_machine           = $request->input('washing_machine');
			$properties->bathroom_mirros           = $request->input('bathroom_mirros');
			$properties->trash_deposit             = $request->input('trash_deposit');
			$properties->dryer                     = $request->input('dryer');
			$properties->another_include           = $request->input('another_include');
			$properties->cabin                     = $request->input('cabin');
			$properties->gym                       = $request->input('gym');
			$properties->kids_area                 = $request->input('kids_area');
			$properties->daycare                   = $request->input('daycare');
			$properties->sauna_shared              = $request->input('sauna_shared');
			$properties->floor_shared              = $request->input('floor_shared');
			$properties->social_area               = $request->input('social_area');
			$properties->spa                       = $request->input('spa');
			$properties->pet_area                  = $request->input('pet_area');
			$properties->beauty_salon              = $request->input('beauty_salon');
			$properties->phone_plant               = $request->input('phone_plant');
			$properties->parking_visit             = $request->input('parking_visit');
			$properties->court                     = $request->input('court');
			$properties->ribbon                    = $request->input('ribbon');
			$properties->bussines_center           = $request->input('bussines_center');
			$properties->another_pleasantness      = $request->input('another_pleasantness');
			$properties->picture_pleasantness      = $request->input('picture_pleasantness');
			$properties->registry_usd              = $request->input('registry_usd');
			$properties->registry_gtq              = $request->input('registry_gtq');
			$properties->iusi_usd                  = $request->input('iusi_usd');
			$properties->iusi_gtq                  = $request->input('iusi_gtq');
			$properties->sheet                     = $request->input('sheet');
			$properties->property                  = $request->input('property');
			$properties->book                      = $request->input('book');
			$properties->society                   = $request->input('society');
			$properties->name_society              = $request->input('name_society');
			$properties->mortgage                  = $request->input('mortgage');
			$properties->mortgage_usd              = $request->input('mortgage_usd');
			$properties->mortgage_gtq              = $request->input('mortgage_gtq');
			$properties->bank_id                   = $request->input('bank_id');
			$properties->appraisal                 = $request->input('appraisal');
			$properties->appraisal_usd             = $request->input('appraisal_usd');
			$properties->appraisal_gtq             = $request->input('appraisal_gtq');
			$properties->appraisal_type            = $request->input('appraisal_type');
			$properties->iva                       = $request->input('iva');
			$properties->rings                     = $request->input('rings');
			$properties->description               = $request->input('description');
			$properties->youtube                   = $request->input('youtube');
			$properties->code                      = $request->input('code');
			$properties->internal_note             = $request->input('internal_note');
			$properties->jardin_trasero            = $request->input('jardin_trasero');
			$properties->desayunador               = $request->input('desayunador');
			$properties->status                    = $request->input('status');
			if($request->input('imagenes')){
				$imagenes = explode(',',$request->input('imagenes'));
				if(count($imagenes)>0){
					foreach ($imagenes as $imagen) {
						$buscar = Images::find($imagen);
						if($buscar){
							$buscar->propierty_id = $properties->propiertiy_id;
							$buscar->save();
						}
					}
				}
			}
			
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

	public function rent(Request $request)
	{
		try {
			$propierty = Property::find($request->propiedad_id);
			$propierty->status = 2;
			$propierty->save();
			$this->message  = "Registro eliminado correctamente";
			$this->result   = true;
			$this->records  = $propierty;
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

	public function sale(Request $request)
	{
		try {
			$propierty = Property::find($request->propiedad_id);
			$propierty->status = 3;
			$propierty->save();
			$this->message  = "Registro eliminado correctamente";
			$this->result   = true;
			$this->records  = $propierty;
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
			$properties = Property::destroy($request->propierty_id);
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

	public function add_pdf(Request $request)
	{
		try {
			$name = \Session::get('user');
			$usuario = User::where('name',$name)->first();
			$lista = ListaPdf::create([
				'codigo_propiedad'  =>  $request->input('propierty_id'), 
				'usuario_id'        =>  $usuario->user_id
			]);
			$this->message = "Registro creado correctamente";
			$this->result = true;
			$this->records = $lista;
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

	public function limpiar($usuario_id)
	{
		try {
			$name = \Session::get('user');
			$usuario = User::where('name',$name)->first();
			$lista = ListaPdf::where('usuario_id',$usuario->user_id)->get();
			foreach ($lista as $item) {
				ListaPdf::destroy($item->id);
			}
			$this->message = "Limpieza realizada correctamente";
			$this->result = true;
			$this->records = $lista;
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

	public function remove_pdf(Request $request)
	{
		try {
			$name = \Session::get('user');
			$usuario = User::where('name',$name)->first();
			$lista = ListaPdf::where('usuario_id',$user->usuario_id)->where('codigo_propiedad',$request->input('propierty_id'))->get();
			foreach ($lista as $item) {
				ListaPdf::destroy($item->id);
			}
			$this->message = "Eliminado correctamente";
			$this->result = true;
			$this->records = $lista;
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
	public function export(Excel $excel)
	{
		return $excel->download(new PropiertiesExport, 'propierties.xlsx');
	}
}