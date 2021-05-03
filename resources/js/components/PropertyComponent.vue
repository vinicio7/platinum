<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-center modal-xl" role="document" align="center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update == 0">Crear propiedad</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update != 0">Actualizar propiedad</h5>
                        <br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <form-wizard title=""subtitle="" @on-complete="onCompleteWizard" shape="tab" color="#20a0ff" error-color="#ff4949" back-button-text="Atrás" next-button-text="Siguiente" finish-button-text="Finalizar">
                            <tab-content :key="0" :title="titulo_1" >
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <label>Titulo</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Tipo</label>
                                            <select v-model="tipo" class="form-control">
                                              <option disabled value="0">Seleccione una opcion</option>
                                              <option value="1">Casas</option>
                                              <option value="2">Apartamentos</option>
                                              <option value="3">Oficinas</option>
                                              <option value="4">Bodegas</option>
                                              <option value="5">Terrenos</option>
                                              <option value="6">Fincas</option>
                                              <option value="7">Clinicas</option>
                                              <option value="8">Casas de playa</option>
                                              <option value="9">Granjas</option>
                                              <option value="10">Edificio</option>
                                              <option value="11">Locales</option>
                                            </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Propietario</label>
                                        <select class="form-control" v-model="propietario" v-on:change="selectTipo()">
                                            <option disabled value="0">Seleccione una opcion</option>
                                            <option v-for="propietario in propietarios" :value="propietario.user_id" >{{ propietario.name }}</option>
                                        </select>
                                    </div>
                                     <div class="col-sm-3" >
                                        <label>Pais</label>
                                        <select v-model="pais" class="form-control">
                                              <option disabled value="0">Seleccione una opcion</option>
                                              <option value="1">Guatemala</option>
                                              <option value="2">El Salvador</option>
                                              <option value="3">Honduras</option>
                                              <option value="4">Nicaragua</option>
                                              <option value="5">Costa Rica</option>
                                              <option value="6">Panama</option>
                                              <option value="7">Belice</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Departamento</label>
                                         <select class="form-control" v-model="departamento" v-on:change="selectTipo()">
                                            <option disabled value="0">Seleccione una opcion</option>
                                            <option v-for="departamento in departamentos" :value="departamento.departament_id" >{{ departamento.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Municipio</label>
                                        <select class="form-control" v-model="municipio" v-on:change="selectTipo()">
                                            <option disabled value="0">Seleccione una opcion</option>
                                            <option v-for="municipio in municipios" :value="municipio.municipality_id" >{{ municipio.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Zona</label>
                                         <select class="form-control" v-model="zona" v-on:change="selectTipo()">
                                            <option disabled value="0">Seleccione una opcion</option>
                                            <option v-for="zona in zonas" :value="zona.zone_id" >{{ zona.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Region</label>
                                         <select class="form-control" v-model="region" v-on:change="selectTipo()">
                                            <option disabled value="0">Seleccione una opcion</option>
                                            <option v-for="region in regiones" :value="region.regions_id" >{{ region.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Direccion</label>
                                        <input type="text" class="form-control" v-model="direccion" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Financiamiento</label>
                                        <select v-model="financiamiento" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Canje</label>
                                        <select v-model="canje" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                     <div class="col-sm-3" v-if="canje == 1">
                                        <label>Especifique</label>
                                        <input type="text" class="form-control" v-model="especifique_canje" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Datos de contacto para visita</label>
                                        <select v-model="contacto_visita" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Cuota de mantenimiento</label>
                                        <select v-model="cuota_mantenimiento" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Servicios</label>
                                        <select v-model="servicios" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Publicacion en redes</label>
                                        <select v-model="publicacion_redes" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Exclusividad</label>
                                        <select v-model="exclusividad" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Compartida</label>
                                        <select v-model="compartida" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;"  v-if="contacto_visita == 1">
                                    <div class="col-sm-12"><h2>Datos de Contacto para Visita</h2></div>
                                    <div class="col-sm-3">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" v-model="nombre_visita" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Celular</label>
                                        <input type="number" class="form-control" v-model="celular_visita" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Telefono</label>
                                        <input type="number" class="form-control" v-model="telefono_visita" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Email</label>
                                        <input type="text" class="form-control" v-model="email_visita" />
                                    </div>
                                </div>
                                <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;"  v-if="financiamiento == 1">
                                    <div class="col-sm-12"><h2>Datos de Financimiento</h2></div>
                                    <div class="col-sm-3">
                                        <label>Enganche ($)</label>
                                        <input type="number" class="form-control" v-model="enganche_dolares" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Enganche (Q.)</label>
                                        <input type="number" class="form-control" v-model="enganche_quetzales" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Tasa</label>
                                        <input type="number" class="form-control" v-model="enganche_tasa" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Cuotas niveladas ($.)</label>
                                        <input type="number" class="form-control" v-model="enganche_cuota" />
                                    </div>
                                     <div class="col-sm-3">
                                        <label>Cuotas niveladas (Q.)</label>
                                        <input type="number" class="form-control" v-model="enganche_nivelado" />
                                    </div>
                                     <div class="col-sm-3">
                                        <label>Plazo en meses</label>
                                        <input type="number" class="form-control" v-model="enganche_plazo" />
                                    </div>
                                </div>
                                <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;"  v-if="cuota_mantenimiento == 1">
                                    <div class="col-sm-12"><h2>Datos de Mantenimiento</h2></div>
                                    <div class="col-sm-3">
                                        <label>Cuota($.)</label>
                                        <input type="number" class="form-control" v-model="mantenimiento_dolares" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Cuota(Q.)</label>
                                        <input type="number" class="form-control" v-model="mantenimiento_quetzales" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Incluido en cuota mensual</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;"  v-if="servicios == 1">
                                    <div class="col-sm-12"><h2>Datos de Servicios</h2></div>
                                    <div class="col-sm-3">
                                        <label>Agua</label>
                                        <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Seguridad</label>
                                        <select v-model="seguridad" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Limpieza areas comunes</label>
                                        <select v-model="limpieza_areas" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Luz</label>
                                        <select v-model="luz" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Extraccion de basura</label>
                                        <select v-model="extraccion" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;"  v-if="servicios == 1">
                                    <div class="col-sm-12"><h2>Datos de propiedad Compartida</h2></div>
                                    <div class="col-sm-3">
                                        <label>Asesor externo</label>
                                        <input type="text" class="form-control" v-model="compartida_asesor" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Empresa</label>
                                        <input type="text" class="form-control" v-model="compartida_empresa" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Porcentaje</label>
                                        <input type="text" class="form-control" v-model="compartida_porcentaje" />
                                    </div>
                                </div>
                            </tab-content>
                            <tab-content :key="1" :title="titulo_2" >
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <label>Terreno</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Construccion</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Frente</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Fondo</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Año de construccion</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Niveles</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Dormitorios</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Dormitorios de servicio</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Baños</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Baños de servicio</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Parqueos techados</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Parqueos no techados</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Oficinas</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Bodegas</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Locales</label>
                                        <input type="text" class="form-control" v-model="titulo" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Porton</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Alacena</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Closet de Blancos</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Jardin Frontal</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Despensa</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Tina</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Jardin trasero</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Desayunador</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Ducha</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Baño de visita</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Lavanderia</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Bidet</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Dormitorio de visitas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Patio</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Jetina</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Estudio</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Pergola</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Jacuzzi</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Sala</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Bodega</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Sauna</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Chimenea</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Bodega de Jardin</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Balcon</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Sala/Comedor</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Sala Familiar</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Terraza</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Comedor</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Walkin Closet</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Churrasquera</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Cocina con gabinetes</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Closet</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Otros detalles</label>
                                        <editor :init="{branding:false, plugins: [
                                                       'advlist autolink lists link image charmap print preview anchor',
                                                       'searchreplace visualblocks code fullscreen',
                                                       'insertdatetime media table paste code help wordcount'
                                                     ],
                                                     toolbar:
                                                       'undo redo | formatselect | bold italic backcolor | \
                                                       alignleft aligncenter alignright alignjustify | \
                                                       bullist numlist outdent indent | removeformat | help',
                                                     paste_as_text: true,
                                                     toolbar_mode: 'sliding',
                                                     language:'es'}"
                                             type="text"  class="form-control" v-model="titulo"/>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-3">
                                        <label>Refrigeradora</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Lamparas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Aire acondicionado</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Estufa</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Cortinas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Alarma</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Estufa electrica</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Blackouts</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Camaras de seguridad</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Lavavajillas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Cortinas de baño</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Paneles solares</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Campana</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Calentador de agua</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Bomba y cisterna</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Lavadora</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Espejos de baño</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Depositos de basura</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Secadora</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Otros detalles</label>
                                        <editor :init="{branding:false, plugins: [
                                                       'advlist autolink lists link image charmap print preview anchor',
                                                       'searchreplace visualblocks code fullscreen',
                                                       'insertdatetime media table paste code help wordcount'
                                                     ],
                                                     toolbar:
                                                       'undo redo | formatselect | bold italic backcolor | \
                                                       alignleft aligncenter alignright alignjustify | \
                                                       bullist numlist outdent indent | removeformat | help',
                                                     paste_as_text: true,
                                                     toolbar_mode: 'sliding',
                                                     language:'es'}"
                                             type="text"  class="form-control" v-model="titulo"/>
                                    </div>
                                </div>
                            </tab-content>
                            <tab-content :key="2" :title="titulo_3" >
                               <div class="row">
                                 <div class="col-sm-3">
                                        <label>Garita</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Gimnasio</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Juegos infantiles</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Guardiania</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Sauna</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Psicina</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Area Social</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>SPA</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Acceso silla de ruedas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Area para mascotas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Salon de belleza</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Planta telefonica</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Parqueo visitas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Canchas deportivas</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Razor ribbon</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Bussines center</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                               </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Otras amenidades</label>
                                        <editor :init="{branding:false, plugins: [
                                                       'advlist autolink lists link image charmap print preview anchor',
                                                       'searchreplace visualblocks code fullscreen',
                                                       'insertdatetime media table paste code help wordcount'
                                                     ],
                                                     toolbar:
                                                       'undo redo | formatselect | bold italic backcolor | \
                                                       alignleft aligncenter alignright alignjustify | \
                                                       bullist numlist outdent indent | removeformat | help',
                                                     paste_as_text: true,
                                                     toolbar_mode: 'sliding',
                                                     language:'es'}"
                                             type="text"  class="form-control" v-model="titulo"/>
                                    </div>
                                </div>
                                <div class="row">
                                  <label>Imagenes de propiedad</label>
                                </div>
                                <div class="row">
                                   <vue-dropzone
                                      v-on:vdropzone-file-added="selectDropzone(flujo,indexFlujo)"
                                      v-on:vdropzone-success="uploadExitoso"
                                      ref="vueDropzoneArchivos"
                                      id="dropzone"
                                      :options="dropzoneOptions" style="width:1200px">
                                  </vue-dropzone>
                                </div>
                            </tab-content>
                            <tab-content :key="3" :title="titulo_4" >
                               <div class="row">
                                 <div class="col-sm-3">
                                    <label>Valor del registro ($.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del registro (Q.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IUSI Trimestral ($.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IUSI Trimestral (Q.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Folio</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Finca</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Libro</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Inscrito en sociedad anonima</label>
                                    <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Sociedad anonima</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Gravamen Hipotecario</label>
                                    <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Gravamen ($.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Gravamen (Q.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Nombre del banco</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Avaluo reciente</label>
                                    <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del avaluo ($.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del avaluo (Q.)</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                  <div class="col-sm-3">
                                    <label>Tipo de avaluo</label>
                                    <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Comercial</option>
                                              <option value="0">Bancario</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Timbres</label>
                                    <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Comercial</option>
                                              <option value="0">Bancario</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IVA</label>
                                    <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Comercial</option>
                                              <option value="0">Bancario</option>
                                        </select>
                                 </div>
                               </div>
                               <div class="row">
                                    <div class="col-sm-6">
                                        <label>Descripcion de la propiedad</label>
                                        <editor :init="{branding:false, plugins: [
                                                       'advlist autolink lists link image charmap print preview anchor',
                                                       'searchreplace visualblocks code fullscreen',
                                                       'insertdatetime media table paste code help wordcount'
                                                     ],
                                                     toolbar:
                                                       'undo redo | formatselect | bold italic backcolor | \
                                                       alignleft aligncenter alignright alignjustify | \
                                                       bullist numlist outdent indent | removeformat | help',
                                                     paste_as_text: true,
                                                     toolbar_mode: 'sliding',
                                                     language:'es'}"
                                             type="text"  class="form-control" v-model="titulo"/>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-sm-3">
                                    <label>Link del tour de la propiedad</label>
                                    <input type="text" class="form-control" v-model="compartida_asesor" />
                                 </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Notas internas</label>
                                        <editor :init="{branding:false, plugins: [
                                                       'advlist autolink lists link image charmap print preview anchor',
                                                       'searchreplace visualblocks code fullscreen',
                                                       'insertdatetime media table paste code help wordcount'
                                                     ],
                                                     toolbar:
                                                       'undo redo | formatselect | bold italic backcolor | \
                                                       alignleft aligncenter alignright alignjustify | \
                                                       bullist numlist outdent indent | removeformat | help',
                                                     paste_as_text: true,
                                                     toolbar_mode: 'sliding',
                                                     language:'es'}"
                                             type="text"  class="form-control" v-model="titulo"/>
                                    </div>
                                </div>
                            </tab-content>
                        </form-wizard>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="background-color: #12264d;border-color: #12264d;">
          + Crear propiedad
        </button>
        <div class="row" style="margin-top: 10px">
            
        </div>
    </div>
</template>
<script>
    import Editor from '@tinymce/tinymce-vue'
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'
    import {FormWizard, TabContent, WizardStep } from 'vue-form-wizard'
    import $ from 'jquery';
    //const token = document.head.querySelector('meta[name="csrf-token"]').content
    export default {
        components:{
            'editor': Editor,
            vueDropzone: vue2Dropzone,
            FormWizard,
            TabContent,
            WizardStep,
        },
        data() {
            return {
                tipo:0,
                titulo:"",
                propietario:0,
                pais:0,
                departamento:0,
                municipio:0,
                zona:0,
                region:0,
                direccion:'',
                financiamiento:0,
                canje:0,
                especifique_canje:'',
                contacto_visita:0,
                cuota_mantenimiento:0,
                servicios:0,
                publicacion_redes:0,
                exclusividad:0,
                compartida:0,
                nombre_visita:'',
                telefono_visita:'',
                celular_visita:'',
                email_visita:'',
                enganche_plazo:0,
                enganche_nivelado:0,
                enganche_cuota:0,
                enganche_tasa:0,
                enganche_quetzales:0,
                enganche_dolares:0,
                mantenimiento_dolares:0,
                mantenimiento_quetzales:0,
                compartida_porcentaje:0,
                compartida_empresa:'',
                compartida_asesor:'',
                agua:0,
                luz:0,
                seguridad:0,
                extraccion:0,
                limpieza_areas:0,
                propietarios:[],
                departamentos:[],
                municipios:[],
                zonas:[],
                regiones:[],
                titulo_1:"INMUEBLE",
                titulo_2:"DETALLES",
                titulo_3:"AMENIDADES",
                titulo_4:"ARBITRIOS",
                propierty_id:"",
                incluid_mensual:0,
                files:null,
                arrayData:[],
                update:0,
                dropzoneOptions: {
                    url: '/api/propierty',
                    method:'post',
                    paramName:'archivo',
                    uploadMultiple: false,
                    thumbnailWidth: 100,
                    thumbnailHeight: 100,
                    maxFilesize: 20,
                    addRemoveLinks: true,
                    //headers: { 'X-CSRF-TOKEN': token },
                    dictDefaultMessage: "Arrastre los archivos acá",
                    dictFallbackMessage: "Tu navegador no soporta arrastrar archivos.",
                    dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
                    dictFileTooBig: "El archivo es demasiado grande ({{filesize}} MB). Maximo permitido: {{maxFilesize}} MB.",
                    dictInvalidFileType: "No puedes subir este tipo de archivo.",
                    dictResponseError: "Problema en el server codigo: {{statusCode}}",
                    dictCancelUpload: "Cancelar",
                    dictCancelUploadConfirmation: "¿Deseas cancelar?",
                    dictRemoveFile: "Eliminar",
                    dictMaxFilesExceeded:'El máximo de archivos fue superado' ,
                },
                indexFlujoActual: null,
                isLoading: false
            }
        },
        mounted: function() {
            let me = this;
            let url = '/api/propietarios' 
            axios.get(url,{}).then(function (response) {
                console.log(response.data.records);
                me.propietarios = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  
            
            let url2 = '/api/departaments' 
            axios.get(url2,{}).then(function (response) {
                console.log(response.data.records);
                me.departamentos = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  
            let url3 = '/api/municipalities' 
            axios.get(url3,{}).then(function (response) {
                console.log(response.data.records);
                me.municipios = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  

            let url4 = '/api/zones' 
            axios.get(url4,{}).then(function (response) {
                console.log(response.data.records);
                me.zonas = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  

            let url5 = '/api/regions' 
            axios.get(url5,{}).then(function (response) {
                console.log(response.data.records);
                me.regiones = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  

            $('.table-responsive').on('click', (evt) => {
                evt.stopImmediatePropagation();
               if ($(evt.target)[0].innerText == 'Editar') {
                 this.loadFieldsUpdate($(evt.target)[0].id); 
               }
               if($(evt.target)[0].innerText == 'Eliminar'){
                    let url = '/api/propierty/delete' 
                    let Data_id = event.target.id
                    console.log(Data_id);
                    if (confirm('¿Seguro que deseas eliminar este registro?')) {
                        axios.post(url,{ 
                        'propierty_id': Data_id,
                        }).then(function (response) {
                            console.log(response);
                            location.reload();
                        })
                        .catch(function (error) {
                            console.log(error);
                        }); 
                    }
               }
            });
        },
        methods:{
            saveData(){
                let me =this;
                let url = '/api/propierty/create' 
                const formData  = new FormData()
                if(this.files){
                    formData.append('file', this.files, this.files.name)
                }
                formData.append('title',this.name)
                axios.post(url,formData,{}).then(function (response) {
                    console.log(response.data.records);
                    if (response.data.result == false) {
                        location.reload();
                    }else{
                        me.clearFields();
                        $('#exampleModal').modal('hide');
                        location.reload();
                    }
                })
                .catch(function (error) {
                    alert(error);
                    console.log(error);
                });   
            },
            selectDropzone(flujo, indexFlujo){
                this.indexFlujoActual = indexFlujo;
            },
            onCompleteWizard: async function() {
                console.log("test");
            },
            uploadExitoso(file, response ) {
                const { indexFlujoActual } = this;
                if (indexFlujoActual != null) {
                    const nombres = response.records;//response.records.map(i => i.path);
                    if(typeof(this.detalle_flujo[indexFlujoActual].objeto) === 'undefined'){
                        this.detalle_flujo[indexFlujoActual].objeto = [];
                    }
                    this.detalle_flujo[indexFlujoActual].objeto = [...this.detalle_flujo[indexFlujoActual].objeto, ...nombres];
                    //this.indexFlujoActual = null;
                    //console.log(    this.detalle_flujo[indexFlujoActual].objeto)
                }else{
                    //console.log("es null")
                }
            },
            /*
            updateData(){
                console.log(this.update);
                let me  = this;
                let url = '/api/propierty/edit' 
                const formData  = new FormData()
                console.log(this.files)
                if(this.files){
                   formData.append('file', this.files, this.files.name) 
               }
                formData.append('propierty_id',this.update)
                formData.append('name',this.name)
                formData.append('user',this.user)
                formData.append('password',this.password)
                formData.append('email',this.email)
                formData.append('phone',this.phone)
                formData.append('adress',this.adress)
                formData.append('gender',this.gender)
                formData.append('document_id',this.document_id)
                formData.append('birthdate',this.birthdate)
                formData.append('marital_status',this.marital_status)
                formData.append('title',this.title)
                formData.append('facebook',this.facebook)
                formData.append('instagram',this.instagram)
                formData.append('whatsapp',this.whatsapp)
                formData.append('twitter',this.twitter)
                formData.append('status',this.status)
                axios.post(url,formData,{}).then(function (response) {
                    $('#exampleModal').modal('hide');
                    me.clearFields();
                    location.reload();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(id){ 
                $('#exampleModal').modal('show');
                this.update = id
                let me =this;
                let url = '/api/propierty/showid/';
                axios.post(url,{ 
                    'propierty_id': this.update,
                }).then(function (response) {
                    me.propierty_id          = response.data.records.propierty_id;
                    me.name             = response.data.records.name;
                    me.user             = response.data.records.username;
                    me.password         = response.data.records.password;
                    me.email            = response.data.records.email;
                    me.phone            = response.data.records.phone;
                    me.adress           = response.data.records.adress;
                    me.gender           = response.data.records.gender;
                    me.document_id      = response.data.records.document_id;
                    me.birthdate        = response.data.records.birthdate;
                    me.marital_status   = response.data.records.marital_status;
                    me.title            = response.data.records.title;
                    me.facebook         = response.data.records.facebook;
                    me.twitter          = response.data.records.twitter;
                    me.whatsapp         = response.data.records.whatsapp;
                    me.instagram        = response.data.records.instagram;
                    me.status           = response.data.records.status;

                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteData(data){
                let url = '/api/propierty/delete' 
                let me = this;
                let Data_id = data.propierty_id
                console.log(Data_id);
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.post(url,{ 
                    'propierty_id': Data_id,
                    }).then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            */
            selectTipo(tipo){
                this.titulos = [];
                this.valores = [];
                this.formulario = [];
            },
            clearFields(){
                this.propierty_id = "";
                this.name = "";
                this.account = "";
                this.status = "";
                this.update = 0;
                $('#exampleModal').modal('hide');
            },
            previewFiles(event) {
                this.files = this.$refs.myFiles.files[0];
           },
        }
    };
</script>