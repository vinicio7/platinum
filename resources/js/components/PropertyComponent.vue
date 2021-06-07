<template>
    <div class="container container-Data" style="margin-left:0px;padding-left:0px;margin-bottom:10px">
            <div class="row">
              <div class="col-sm-3">
                 <span>Fecha inicial<input type="date" name="" v-model="fecha_inicial" class="form-control"></span>
              </div>
              <div class="col-sm-3">
                 <span>Fecha inicial<input type="date" name="" v-model="fecha_final" class="form-control"></span>
              </div>
               <div class="col-sm-3">
                <br>
                
              </div>
            </div>
            <br>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="background-color: #12264d;border-color: #12264d;">
              + Crear propiedad
            </button> 
             <button type="button" class="btn btn-success" @click="generarExcel()">
              -> Generar excel
                 </button>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
              -> Generar PDF
            </button> 
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
              -> Enviar PDF
            </button> 
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
              - Limpiar
            </button> 
        <div class="modal fade" id="modalrenta" tabindex="-1" role="dialog" aria-labelledby="modalrenta" aria-hidden="true" >
          <div class="modal-dialog modal-center modal-md" role="document" align="center">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalrenta">Rentar propiedad</h5>
                  <br>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-12" >
                        <label>Rentada por</label>
                        <v-select v-model="rentada_por"
                                :value.sync="propietarios.user_id"
                                :options="propietarios" :getOptionLabel="propietario => propietario.name">
                                <span slot="no-options"> No se encontro la busqueda</span>
                        </v-select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button @click="guardarRenta()" class="btn btn-success" style="background-color: #12264d;border-color: #12264d;">Guardar</button>
                  <button @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalventa" tabindex="-1" role="dialog" aria-labelledby="modalventa" aria-hidden="true" >
          <div class="modal-dialog modal-center modal-md" role="document" align="center">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalventa">Vender propiedad</h5>
                  <br>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-12" >
                        <label>Vendida por</label>
                        <v-select v-model="vendida_por"
                                :value.sync="propietarios.user_id"
                                :options="propietarios" :getOptionLabel="propietario => propietario.name">
                                <span slot="no-options"> No se encontro la busqueda</span>
                        </v-select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button  @click="guardarVenta()" class="btn btn-success" style="background-color: #12264d;border-color: #12264d;">Guardar</button>
                  <button  @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
          </div>
        </div>
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
                            <tab-content :key="0" :title="titulo_1" :icon="getIcon('formulario')">
                                <div class="row">
                                    <div class="col-sm-12" >
                                        <label>Titulo</label>
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
                                    <div class="col-sm-12" >
                                        <label>Subtitulo</label>
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
                                             type="text"  class="form-control" v-model="subtitulo"/>
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
                                        <v-select v-model="propietario_id"
                                                :value.sync="propietarios.user_id"
                                                :options="propietarios" :getOptionLabel="propietario => propietario.name">
                                                <span slot="no-options"> No se encontro la busqueda</span>
                                        </v-select>
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
                                        <v-select v-model="departamento"
                                                :value.sync="departamentos.departament_id"
                                                :options="departamentos" :getOptionLabel="departamento => departamento.name">
                                                <span slot="no-options"> No se encontro la busqueda</span>
                                        </v-select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Municipio</label>
                                        <v-select v-model="municipio"
                                                :value.sync="municipios.municipality_id"
                                                :options="municipios" :getOptionLabel="municipio => municipio.name">
                                                <span slot="no-options"> No se encontro la busqueda</span>
                                        </v-select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Zona</label>
                                        <v-select v-model="zona"
                                                :value.sync="zona.zone_id"
                                                :options="zonas" :getOptionLabel="zona => zona.name">
                                                <span slot="no-options"> No se encontro la busqueda</span>
                                        </v-select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Region</label>
                                        <v-select v-model="region"
                                                :value.sync="region.region_id"
                                                :options="regiones" :getOptionLabel="region => region.name">
                                                <span slot="no-options"> No se encontro la busqueda</span>
                                        </v-select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Direccion</label>
                                        <input type="text" class="form-control" v-model="direccion" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Precio de venta (Q.)</label>
                                        <input type="number" class="form-control" v-model="precio_venta_quetzales" v-on:keyup="cambio_venta_gtq"/>
                                    </div>
                                     <div class="col-sm-3" >
                                        <label>Precio de venta ($.)</label>
                                        <input type="number" class="form-control" v-model="precio_venta_dolares" v-on:keyup="cambio_venta_usd" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Honorarios venta (%)</label>
                                        <input type="number" class="form-control" v-model="honorarios_venta" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Precio de renta (Q.)</label>
                                        <input type="number" class="form-control" v-model="precio_renta_quetzales" v-on:keyup="cambio_renta_gtq" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Precio de renta ($/)</label>
                                        <input type="number" class="form-control" v-model="precio_renta_dolares" v-on:keyup="cambio_renta_usd"/>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Honorarios renta (%)</label>
                                        <input type="number" class="form-control" v-model="honorarios_renta" />
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
                            <tab-content :key="1" :title="titulo_2" :icon="getIcon('geoposicion')">
                              <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;">
                                <div class="col-sm-12"><h2>Descripcion</h2></div>
                                <div class="col-sm-3" >
                                        <label>Terreno</label>
                                        <input type="text" class="form-control" v-model="terreno" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Construccion</label>
                                        <input type="text" class="form-control" v-model="consturccion" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Frente</label>
                                        <input type="text" class="form-control" v-model="frente" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Fondo</label>
                                        <input type="text" class="form-control" v-model="fondo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Año de construccion</label>
                                        <input type="text" class="form-control" v-model="ano_construccion" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Niveles</label>
                                        <input type="text" class="form-control" v-model="niveles" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Dormitorios</label>
                                        <input type="text" class="form-control" v-model="dormitorios" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Dormitorios de servicio</label>
                                        <input type="text" class="form-control" v-model="dormitorios_servicio" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Baños</label>
                                        <input type="text" class="form-control" v-model="banos" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Baños de servicio</label>
                                        <input type="text" class="form-control" v-model="banos_servicio" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Parqueos techados</label>
                                        <input type="text" class="form-control" v-model="parqueos_techados" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Parqueos no techados</label>
                                        <input type="text" class="form-control" v-model="parqueos_notechados" />
                                    </div>
                              </div>
                              <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;">
                                <div class="col-sm-12"><h2>Ambientes</h2></div>
                                <div class="col-sm-3" >
                                    <label>Oficinas</label>
                                    <input type="text" class="form-control" v-model="ambientes" />
                                </div>
                                <div class="col-sm-3" >
                                    <label>Bodegas</label>
                                    <input type="text" class="form-control" v-model="bodegas" />
                                </div>
                                <div class="col-sm-3" >
                                    <label>Locales</label>
                                    <input type="text" class="form-control" v-model="locales" />
                                </div>
                              </div>
                              <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;">
                                <div class="col-sm-12"><h2>Detalle</h2></div>
                                <div class="col-sm-3">
                                      <label>Porton</label>
                                      <select v-model="porton" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Alacena</label>
                                      <select v-model="alacena" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Closet de Blancos</label>
                                      <select v-model="closet_blancos" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Jardin Frontal</label>
                                      <select v-model="jardin_frontal" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Despensa</label>
                                      <select v-model="despensa" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Tina</label>
                                      <select v-model="tina" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Jardin trasero</label>
                                      <select v-model="jardin_trasero" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Desayunador</label>
                                      <select v-model="desayunador" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Ducha</label>
                                      <select v-model="ducha" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Baño de visita</label>
                                      <select v-model="bano_visita" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-3">
                                      <label>Lavanderia</label>
                                      <select v-model="lavanderia" class="form-control">
                                            <option disabled value="">Seleccione una opcion</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Bidet</label>
                                    <select v-model="bidet" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Dormitorio de visitas</label>
                                    <select v-model="dormitorio_visita" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Patio</label>
                                    <select v-model="patio" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Jetina</label>
                                    <select v-model="jetina" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Estudio</label>
                                    <select v-model="estudio" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Pergola</label>
                                    <select v-model="pergola" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Jacuzzi</label>
                                    <select v-model="jacuzzi" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Sala</label>
                                    <select v-model="sala" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Bodega</label>
                                    <select v-model="bodega" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Sauna</label>
                                    <select v-model="sauna" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Chimenea</label>
                                    <select v-model="chimenea" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Bodega de Jardin</label>
                                    <select v-model="bodega_jardin" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Balcon</label>
                                    <select v-model="balcon" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Sala/Comedor</label>
                                    <select v-model="sala_comedor" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Sala Familiar</label>
                                    <select v-model="sala_familiar" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Terraza</label>
                                    <select v-model="terraza" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Comedor</label>
                                    <select v-model="comedor" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Walkin Closet</label>
                                    <select v-model="walkin_closet" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Churrasquera</label>
                                    <select v-model="churrasquera" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Cocina con gabinetes</label>
                                    <select v-model="cocina_gabinetes" class="form-control">
                                          <option disabled value="">Seleccione una opcion</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <label>Closet</label>
                                    <select v-model="closet" class="form-control">
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
                                             type="text"  class="form-control" v-model="otros_incluye"/>
                                    </div>
                              </div>
                              <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;">
                                  <div class="col-sm-12"><h2>Incluye</h2></div>
                                  <div class="col-sm-4">
                                        <label>Refrigeradora</label>
                                        <select v-model="refrigeradora" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Lamparas</label>
                                        <select v-model="lamparas" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Aire acondicionado</label>
                                        <select v-model="aire_acondicionado" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Estufa</label>
                                        <select v-model="estufa" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Cortinas</label>
                                        <select v-model="cortinas" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Alarma</label>
                                        <select v-model="alarma" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Estufa electrica</label>
                                        <select v-model="estufa_electrica" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Blackouts</label>
                                        <select v-model="blackouts" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Camaras de seguridad</label>
                                        <select v-model="camaras_seguridad" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Lavavajillas</label>
                                        <select v-model="lavavajillas" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Cortinas de baño</label>
                                        <select v-model="cortinas_bano" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Paneles solares</label>
                                        <select v-model="paneles_solares" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Campana</label>
                                        <select v-model="camapana" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Calentador de agua</label>
                                        <select v-model="calentador_agua" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Bomba y cisterna</label>
                                        <select v-model="bomba_cisterna" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Lavadora</label>
                                        <select v-model="lavadora" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Espejos de baño</label>
                                        <select v-model="espejo_bano" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Depositos de basura</label>
                                        <select v-model="deposito_basura" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Secadora</label>
                                        <select v-model="secadora" class="form-control">
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
                                             type="text"  class="form-control" v-model="otros_detalles"/>
                                    </div>
                              </div>
                            </tab-content>
                            <tab-content :key="2" :title="titulo_3" :icon="getIcon('tabla')">
                               <div class="row">
                                 <div class="col-sm-3">
                                        <label>Garita</label>
                                        <select v-model="garita" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Gimnasio</label>
                                        <select v-model="gimnasio" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Juegos infantiles</label>
                                        <select v-model="juegos_infantiles" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Guardiania</label>
                                        <select v-model="guardiania" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Sauna</label>
                                        <select v-model="sauna" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Psicina</label>
                                        <select v-model="piscina" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Area Social</label>
                                        <select v-model="area_social" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>SPA</label>
                                        <select v-model="spa" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Acceso silla de ruedas</label>
                                        <select v-model="acceso_silla" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Area para mascotas</label>
                                        <select v-model="area_mascotas" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Salon de belleza</label>
                                        <select v-model="salon_belleza" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Planta telefonica</label>
                                        <select v-model="planta_telefonica" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Parqueo visitas</label>
                                        <select v-model="parqueo_visitas" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Canchas deportivas</label>
                                        <select v-model="canchas_deportivas" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Razor ribbon</label>
                                        <select v-model="razor_ribbon" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Bussines center</label>
                                        <select v-model="bussines_center" class="form-control">
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
                                             type="text"  class="form-control" v-model="otras_amenidades"/>
                                    </div>
                                </div>
                                <div class="row">
                                  <label>Imagenes de propiedad</label>
                                </div>
                                <div class="row">
                                   <vue-dropzone
                                      v-on:vdropzone-success="uploadExitoso"
                                      ref="vueDropzoneArchivos"
                                      id="dropzone"
                                      :options="dropzoneOptions" style="width:1200px">
                                  </vue-dropzone>
                                </div>
                            </tab-content>
                            <tab-content :key="3" :title="titulo_4" :icon="getIcon('conclusiones')">
                               <div class="row">
                                 <div class="col-sm-3">
                                    <label>Valor del registro ($.)</label>
                                    <input type="number" class="form-control" v-model="valor_registro_dolares" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del registro (Q.)</label>
                                    <input type="number" class="form-control" v-model="valor_registro_quetzales" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IUSI Trimestral ($.)</label>
                                    <input type="number" class="form-control" v-model="iusi_trimestral_dolares" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IUSI Trimestral (Q.)</label>
                                    <input type="number" class="form-control" v-model="iusi_trimestral_quetzales" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Folio</label>
                                    <input type="number" class="form-control" v-model="folio" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Finca</label>
                                    <input type="number" class="form-control" v-model="finca" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Libro</label>
                                    <input type="number" class="form-control" v-model="libro" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Inscrito en sociedad anonima</label>
                                    <select v-model="inscrito_sociedad_anonima" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Sociedad anonima</label>
                                    <input type="text" class="form-control" v-model="sociedad_anonima" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Gravamen Hipotecario</label>
                                    <select v-model="gravamen_hipotecario" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Gravamen ($.)</label>
                                    <input type="text" class="form-control" v-model="gravamen_dolares" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Gravamen (Q.)</label>
                                    <input type="text" class="form-control" v-model="gravamen_quetzales" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Nombre del banco</label>
                                    <input type="text" class="form-control" v-model="nombre_banco" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Avaluo reciente</label>
                                    <select v-model="avalui_reciente" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del avaluo ($.)</label>
                                    <input type="number" class="form-control" v-model="avaluo_dolares" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del avaluo (Q.)</label>
                                    <input type="number" class="form-control" v-model="avaluo_quetzales" />
                                 </div>
                                  <div class="col-sm-3">
                                    <label>Tipo de avaluo</label>
                                    <select v-model="tipo_avaluo" class="form-control">
                                              <option disabled value="">Seleccione una opcion</option>
                                              <option value="1">Comercial</option>
                                              <option value="0">Bancario</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Timbres</label>
                                    <input type="number" class="form-control" v-model="timbres" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IVA</label>
                                    <input type="number" class="form-control" v-model="iva" />
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
                                             type="text"  class="form-control" v-model="descripcion_propiedad"/>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-sm-3">
                                    <label>Link del tour de la propiedad</label>
                                    <input type="text" class="form-control" v-model="link_tour" />
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
                                             type="text"  class="form-control" v-model="notas_internas"/>
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
    </div>
</template>
<script>
    import vSelect from 'vue-select'
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
            vSelect,
            FormWizard,
            TabContent,
            WizardStep,
        },
        data() {
            return {
                subtitulo:'',
                fecha_final:'',
                fecha_inicial:'',
                vendida_por:0,
                rentada_por:0,
                precio_renta_dolares:0,
                precio_renta_quetzales:0,
                honorarios_renta:0,
                precio_venta_dolares:0,
                precio_venta_quetzales:0,
                honorarios_venta:0,
                imagenes:[],
                propietario_id:0,
                lavavajillas:0,
                ambientes:0,
                terreno:0,
                consturccion:0,
                frente:0,
                fondo:0,
                ano_construccion:0,
                niveles:0,
                dormitorios:0,
                dormitorios_servicio:0,
                banos:0,
                banos_servicio:0,
                parqueos_techados:0,
                parqueos_notechados:0,
                oficinas:0,
                bodegas:0,
                locales:0,
                porton:0,
                alacena:0,
                closet_blancos:0,
                jardin_frontal:0,
                despensa:0,
                tina:0,
                jardin_trasero:0,
                desayunador:0,
                ducha:0,
                bano_visita:0,
                lavanderia:0,
                bidet:0,
                dormitorio_visita:0,
                patio:0,
                jetina:0,
                estudio:0,
                pergola:0,
                jacuzzi:0,
                sala:0,
                bodega:0,
                sauna:0,
                chimenea:0,
                bodega_jardin:0,
                balcon:0,
                sala_comedor:0,
                sala_familiar:0,
                terraza:0,
                comedor:0,
                walkin_closet:0,
                churrasquera:0,
                cocina_gabinetes:0,
                closet:0,
                otros_detalles:'',
                refrigeradora:0,
                lamparas:0,
                aire_acondicionado:0,
                estufa:0,
                cortinas:0,
                alarma:0,
                estufa_electrica:0,
                blackouts:0,
                camaras_seguridad:0,
                lavavajillas:0,
                cortinas_bano:0,
                paneles_solares:0,
                camapana:0,
                calentador_agua:0,
                bomba_cisterna:0,
                lavadora:0,
                espejo_bano:0,
                deposito_basura:0,
                secadora:0,
                otros_incluye:'',
                garita:0,
                gimnasio:0,
                juegos_infantiles:0,
                guardiania:0,
                sauna:0,
                piscina:0,
                area_social:0,
                spa:0,
                acceso_silla:0,
                area_mascotas:0,
                salon_belleza:0,
                planta_telefonica:0,
                parqueo_visitas:0,
                canchas_deportivas:0,
                razor_ribbon:0,
                bussines_center:0,
                otras_amenidades:'',
                descripcion_propiedad:'',
                valor_registro_dolares:0,
                valor_registro_quetzales:0,
                iusi_trimestral_quetzales:0,
                iusi_trimestral_dolares:0,
                folio:0,
                finca:0,
                libro:0,
                inscrito_sociedad_anonima:0,
                sociedad_anonima:0,
                gravamen_hipotecario:0,
                gravamen_quetzales:0,
                gravamen_dolares:0,
                nombre_banco:0,
                avalui_reciente:0,
                avaluo_dolares:0,
                avaluo_quetzales:0,
                tipo_avaluo:0,
                timbres:0,
                iva:0,
                link_tour:'',
                notas_internas:'',
                tipo:0,
                titulo:"",
                propietario:0,
                pais:0,
                departamento:0,
                municipio:0,
                zona:0,
                region:0,
                direccion:'',
                financiamiento:1,
                canje:0,
                especifique_canje:'',
                contacto_visita:1,
                cuota_mantenimiento:1,
                servicios:1,
                publicacion_redes:0,
                exclusividad:0,
                compartida:1,
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
                incluid_mensual:0,
                propierty_id:"",
                propietarios:[],
                propietarios_test:[{}],
                departamentos:[],
                municipios:[],
                zonas:[],
                regiones:[],
                titulo_1:"INMUEBLE",
                titulo_2:"DETALLES",
                titulo_3:"AMENIDADES",
                titulo_4:"ARBITRIOS",
                files:null,
                arrayData:[],
                update:0,
                dropzoneOptions: {
                    url: '/api/propierty/image',
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
                isLoading: false
            }
        },
        mounted: function() {
            let me = this;
            let url = '/api/propietarios' 
            axios.get(url,{}).then(function (response) {
                
                me.propietarios = response.data.records;
                console.log("propietarios");
                console.log(me.propietarios);
            })
            .catch(function (error) {
                console.log(error);
            });  
            
            let url2 = '/api/departaments' 
            axios.get(url2,{}).then(function (response) {
                me.departamentos = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  
            let url3 = '/api/municipalities' 
            axios.get(url3,{}).then(function (response) {
                me.municipios = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  

            let url4 = '/api/zones' 
            axios.get(url4,{}).then(function (response) {
                me.zonas = response.data.records;
            })
            .catch(function (error) {
                console.log(error);
            });  

            let url5 = '/api/regions' 
            axios.get(url5,{}).then(function (response) {
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
               if ($(evt.target)[0].innerText == 'Rentar') {
                 this.loadRenta($(evt.target)[0].id); 
               }
               if ($(evt.target)[0].innerText == 'Vender') {
                 this.loadVenta($(evt.target)[0].id); 
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
           getIcon(tipo_flujo){
                let icono = 'i-Map-Marker';
                switch(tipo_flujo){
                    case 'formulario':
                        icono = 'i-File-Clipboard-File--Text';
                        break;
                    case 'geoposicion':
                        icono = 'i-Map-Marker';
                        break;
                    case 'tabla':
                        icono = 'i-Receipt-4';
                        break;
                    case 'galeria':
                        icono = 'i-Camera';
                        break;
                    case 'seccion':
                        icono = 'i-Tag-2';
                        break;
                    case 'conclusiones':
                        icono = 'i-Tag-2';
                        break;
                }
                return icono
            },
            cambio_venta_usd(){
              this.precio_venta_quetzales = (this.precio_venta_dolares * 7.8).toFixed(2);
            },
            cambio_venta_gtq(){
              this.precio_venta_dolares = (this.precio_venta_quetzales / 7.8).toFixed(2);
            },
            cambio_renta_usd(){
              this.precio_renta_quetzales = (this.precio_renta_dolares * 7.8).toFixed(2);
            },
            cambio_renta_gtq(){
              this.precio_renta_dolares = (this.precio_renta_quetzales / 7.8).toFixed(2);
            },
            saveData(){
                let me =this;
                let url = '/api/propierty/create' 
                const formData  = new FormData()
                if(this.files){
                    formData.append('file', this.files, this.files.name)
                }
                formData.append('imagenes',this.imagenes) 
                formData.append('title',this.title)
                formData.append('type',this.tipo)
                formData.append('user_id',39)//usuario logeado
                formData.append('owner_id',this.propietario_id.user_id)
                formData.append('country_id',this.pais)
                formData.append('departament_id',this.departamento.departament_id)
                formData.append('municipality_id',this.municipio.municipality_id)
                formData.append('zone_id',this.zona.zone_id)
                formData.append('region_id',this.region.region_id)
                formData.append('sale_usd',this.precio_venta_dolares)
                formData.append('sale_gtq',this.precio_venta_quetzales)
                formData.append('rent_usd',this.precio_renta_dolares)
                formData.append('rent_gtq',this.precio_renta_quetzales)
                formData.append('fee_rent',this.honorarios_renta)
                formData.append('fee_sale',this.honorarios_venta)
                formData.append('lavavajillas',this.lavavajillas)
                formData.append('ambientes',this.ambientes)
                formData.append('land_vrs',this.terreno)
                formData.append('build_mts',this.construccion)
                formData.append('front_mts',this.frente)
                formData.append('bottom_mts',this.fondo)
                formData.append('build_year',this.ano_construccion)
                formData.append('levels',this.niveles)
                formData.append('rooms',this.dormitorios)
                formData.append('service_rooms',this.dormitorios_servicio)
                formData.append('bathrooms',this.banos)
                formData.append('bathrooms_service',this.banos_servicio)
                formData.append('parking_roof',this.parqueos_techados)
                formData.append('parking',this.parqueos_notechados)
                formData.append('offices',this.oficinas)
                formData.append('cellars',this.bodegas)
                formData.append('places',this.locales)
                formData.append('door',this.porton)
                formData.append('cupboard',this.alacena)
                formData.append('white_closet',this.closet_blancos)
                formData.append('gardeen_front',this.jardin_frontal)
                formData.append('pantry',this.despensa)
                formData.append('tub',this.tina)
                formData.append('jardin_trasero',this.jardin_trasero)
                formData.append('desayunador',this.desayunador)
                formData.append('ducha',this.ducha)
                formData.append('bathroom_visit',this.bano_visita)
                formData.append('laundry',this.lavanderia)
                formData.append('bidet',this.bidet)
                formData.append('room_visit',this.dormitorio_visita)
                formData.append('yard',this.patio)
                formData.append('jetina',this.jetina)
                formData.append('study',this.estudio)
                formData.append('pergola',this.pergola)
                formData.append('jacuzzi',this.jacuzzi)
                formData.append('living_room',this.sala)
                formData.append('winery',this.bodega)
                formData.append('sauna',this.sauna)
                formData.append('chimeny',this.chimenea)
                formData.append('garden_winery',this.bodega_jardin)
                formData.append('balcony',this.balcon)
                formData.append('dining_room',this.sala_comedor)
                formData.append('family_room',this.sala_familiar)
                formData.append('roof_room',this.terraza)
                formData.append('dining',this.comedor)
                formData.append('walkin_closet',this.walkin_closet)
                formData.append('grill',this.churrasquera)
                formData.append('kitchen_room',this.cocina_gabinetes)
                formData.append('closet',this.closet)
                formData.append('another_details',this.otros_detalles)
                formData.append('fridge',this.refrigeradora)
                formData.append('lamps',this.lamparas)
                formData.append('air',this.aire_acondicionado)
                formData.append('kitchen',this.estufa)
                formData.append('curtain',this.cortinas)
                formData.append('alarm',this.alarma)
                formData.append('electricy_kitchen',this.estufa_electrica)
                formData.append('blackouts',this.blackouts)
                formData.append('camera_security',this.camaras_seguridad)
                formData.append('dishwater',this.lavavajillas)
                formData.append('bathroom_curtain',this.cortinas_bano)
                formData.append('solar_panel',this.paneles_solares)
                formData.append('bell',this.campana)
                formData.append('water_heater',this.calentador_agua)
                formData.append('cistern',this.bomba_cisterna)
                formData.append('washing_machine',this.lavadora)
                formData.append('bathroom_mirros',this.espejo_bano)
                formData.append('trash_deposit',this.deposito_basura)
                formData.append('dryer',this.secadora)
                formData.append('another_include',this.otros_incluye)
                formData.append('cabin',this.garita)
                formData.append('gym',this.gimnasio)
                formData.append('kids_area',this.juegos_infantiles)
                formData.append('daycare',this.guardiania)
                formData.append('sauna_shared',this.sauna)
                formData.append('floor_shared',this.piscina)
                formData.append('social_area',this.area_social)
                formData.append('spa',this.spa)
                formData.append('acceso_silla',this.acceso_silla)
                formData.append('pet_area',this.area_mascotas)
                formData.append('beauty_salon',this.salon_belleza)
                formData.append('phone_plant',this.planta_telefonica)
                formData.append('parking_visit',this.parqueo_visitas)
                formData.append('court',this.canchas_deportivas)
                formData.append('ribbon',this.razor_ribbon)
                formData.append('bussines_center',this.bussines_center)
                formData.append('another_pleasantness',this.otras_amenidades)
                formData.append('description',this.descripcion_propiedad)
                formData.append('registry_usd',this.valor_registro_dolares)
                formData.append('registry_gtq',this.valor_registro_quetzales)
                formData.append('iusi_gtq',this.iusi_trimestral_quetzales)
                formData.append('iusi_usd',this.iusi_trimestral_dolares)
                formData.append('sheet',this.folio)
                formData.append('property',this.finca)
                formData.append('book',this.libro)
                formData.append('society',this.inscrito_sociedad_anonima)
                formData.append('name_society',this.sociedad_anonima)
                formData.append('mortgage',this.gravamen_hipotecario)
                formData.append('mortgage_gtq',this.gravamen_quetzales)
                formData.append('mortgage_usd',this.gravamen_dolares)
                formData.append('bank_id',this.nombre_banco)
                formData.append('appraisal',this.avalui_reciente)
                formData.append('appraisal_usd',this.avaluo_dolares)
                formData.append('appraisal_gtq',this.avaluo_quetzales)
                formData.append('appraisal_type',this.tipo_avaluo)
                formData.append('rings',this.timbres)
                formData.append('iva',this.iva)
                formData.append('youtube',this.link_tour)
                formData.append('internal_note',this.notas_internas)
                formData.append('title',this.titulo)
                formData.append('subtitle',this.subtitulo)
                formData.append('propietario',this.propietario)
                formData.append('adress',this.direccion)
                formData.append('finance',this.financiamiento)
                formData.append('term',this.enganche_plazo)
                formData.append('enganche_nivelado',this.enganche_nivelado)
                formData.append('term_text',this.enganche_cuota)
                formData.append('rate',this.enganche_tasa)
                formData.append('fee_gtq',this.enganche_quetzales)
                formData.append('fee_usd',this.enganche_dolares)
                formData.append('exchange',this.canje)
                formData.append('especifique_canje',this.especifique_canje)
                formData.append('maintenance',this.cuota_mantenimiento)
                formData.append('servicios',this.servicios)
                formData.append('social_media',this.publicacion_redes)
                formData.append('exclusivity',this.exclusividad)
                formData.append('share',this.compartida)
                formData.append('name_contact',this.nombre_visita)
                formData.append('telephone_contact',this.telefono_visita)
                formData.append('phone_contact',this.celular_visita)
                formData.append('email_contact',this.email_visita)
                formData.append('fee_maintenance_usd',this.mantenimiento_dolares)
                formData.append('fee_maintenance_gtq',this.mantenimiento_quetzales)
                formData.append('rate_share',this.compartida_porcentaje)
                formData.append('company_share',this.compartida_empresa)
                formData.append('partner_share',this.compartida_asesor)
                formData.append('water_service',this.agua)
                formData.append('electricy_service',this.luz)
                formData.append('security_service',this.seguridad)
                formData.append('trash_service',this.extraccion)
                formData.append('clean_service',this.limpieza_areas)
                formData.append('include_maintenance',this.incluid_mensual)
                console.log(formData);
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
            guardarRenta(){
                let me  = this;
                let url = '/api/propierty/rent' 
                const formData  = new FormData()
                formData.append('propiedad_id',this.update)
                formData.append('usuario_id',this.rentada_por)
                console.log(formData);
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
            generarExcel(){
                let me  = this;
                let url = '/api/propierty/export' 
                axios({
                  url: url,
                  method: 'GET',
                  responseType: 'blob',
              }).then((response) => {
                   var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                   var fileLink = document.createElement('a');

                   fileLink.href = fileURL;
                   fileLink.setAttribute('download', 'propiedades.xlsx');
                   document.body.appendChild(fileLink);

                   fileLink.click();
              });
              },
            guardarVenta(){
                let me  = this;
                let url = '/api/propierty/sale' 
                const formData  = new FormData()
                formData.append('propiedad_id',this.update)
                formData.append('usuario_id',this.rentada_por)
                console.log(formData);
                axios.get(url,formData,{}).then(function (response) {
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
            onCompleteWizard: async function() {
              await this.saveData();
            },
            uploadExitoso(file, response ) {
              console.log(response.records);
              this.imagenes.push(response.records.id);
              console.log(this.imagenes);
            },
            loadRenta(id){ 
              this.update = id
              $('#modalrenta').modal('show');
            }, 
            loadVenta(id){ 
                this.update = id
                $('#modalventa').modal('show');
            },     
            loadFieldsUpdate(id){ 
                $('#exampleModal').modal('show');
                this.update = id
                let me =this;
                let url = '/api/propierty/showid/';
                axios.post(url,{ 
                    'propierty_id': this.update,
                }).then(function (response) {

                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },            
            deleteData(data){
              console.log(data);
                let url = '/api/propierty/delete' 
                let me = this;
                let Data_id = data.propiertiy_id 
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