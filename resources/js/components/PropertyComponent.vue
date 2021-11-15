<template>
    <div class="container container-Data" style="margin-left:0px;padding-left:0px;margin-bottom:10px">
            <div class="row" >
              <div class="col-sm-3" v-if="agente.rol_id != 10">
                 <span>Fecha inicial<input type="date" name="" v-model="fecha_inicial" class="form-control"></span>
              </div>
              <div class="col-sm-3" v-if="agente.rol_id != 10">
                 <span>Fecha inicial<input type="date" name="" v-model="fecha_final" class="form-control"></span>
              </div>
               <div class="col-sm-3">
                <br>
                
              </div>
            </div>
            <br>
            <button type="button" v-if="agente.rol_id != 10" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="background-color: #12264d;border-color: #12264d;" @click="limpiarData()">
              + Crear propiedad
            </button> 
             <button type="button" v-if="agente.rol_id != 10" class="btn btn-success" @click="generarExcel()">
              -> Generar excel
                 </button>
            <button type="button" class="btn btn-danger" @click="pdf_total()">
              -> Generar PDF
            </button> 
            <button type="button" class="btn btn-warning" @click="limpiar_pdf()">
              -> Limpiar
            </button> 
        <div class="modal fade" id="modalrenta" tabindex="-1" role="dialog" aria-labelledby="modalrenta" aria-hidden="true" >
          <div class="modal-dialog modal-center modal-md" role="document" align="center">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="modalrenta">Acciones propiedad</h5>
                  <br>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-12" >
                        <label>Accion</label>
                        <select class="col-sm-12 form-control" v-model="accion_ejecutar">
                          <option value="1">Vendida</option>
                          <option value="2">Rentada</option>
                          <option value="3">Fuera de mercado</option>
                          <option value="4">Inversion</option>
                          <option value="5">Activar</option>
                        </select>
                    </div>
                    <div class="col-sm-12" v-if="accion_ejecutar == 1 || accion_ejecutar == 2 " >
                        <label>Usuario que la realizo</label>
                        <select class="form-control" v-model="rentada_por">
                            <option value="0" disabled>Seleccione una opcion</option>
                            <option v-for="vendedor in vendedores" :value="vendedor.user_id" >{{ vendedor.name }}</option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button @click="ejecutar()" class="btn btn-success" style="background-color: #12264d;border-color: #12264d;">Ejecutar</button>
                  <button @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modalventa" tabindex="-1" role="dialog" aria-labelledby="modalventa" aria-hidden="true" >
          <div class="modal-dialog modal-center modal-md" role="document" align="center">
            <div class="modal-content">
               <div class="modal-header">
                  <h5>Datos adicionales</h5>
                  <br>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <center>
                    <h5 id="modalventa">Datos propietario</h5>
                  </center>
                  <div class="row">
                    <div class="col-sm-6" >
                        <label><b>Nombre:</b></label>  
                    </div>
                    <div  class="col-sm-6">
                       {{nombre_propietario}} 
                    </div>
                    <div class="col-sm-6" >
                        <label><b>Email:</b> </label>  
                    </div>
                    <div  class="col-sm-6">
                       {{email_propietario}} 
                    </div>
                    <div class="col-sm-6" >
                        <label><b>Direccion:</b></label>  
                    </div>
                    <div  class="col-sm-6">
                       {{direccion_propietario}} 
                    </div>
                    <div class="col-sm-6" >
                        <label><b>Telefono:</b></label>  
                    </div>
                    <div  class="col-sm-6">
                       {{telefono_propietario}} 
                    </div>
                    <div class="col-sm-6" >
                        <label><b>Whatsapp:</b></label>  
                    </div>
                    <div  class="col-sm-6">
                       {{whatsapp_propietario}} 
                    </div>
                  </div>
                  <center>
                    <h5 class="modal-title" id="modalventa">Contacto de visita</h5>
                  </center>
                  <div class="row">
                    <div class="col-sm-6">
                      <label><b>Nombre:</b></label>
                    </div>
                    <div class="col-sm-6">
                        {{nombre_contacto}}
                    </div>
                    <div class="col-sm-6">
                      <label><b>Telefono:</b></label>
                    </div>
                    <div class="col-sm-6">
                        {{telefono_contacto}}
                    </div>
                    <div class="col-sm-6">
                      <label><b>Celular:</b></label>
                    </div>
                    <div class="col-sm-6">
                        {{celular_contacto}}
                    </div>
                    <div class="col-sm-6">
                      <label><b>Email:</b></label>
                    </div>
                    <div class="col-sm-6">
                        {{email_contacto}}
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button  @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="pdf_total" tabindex="-1" role="dialog" aria-labelledby="pdf_total" aria-hidden="true" >
          <div class="modal-dialog modal-center modal-md" role="document" align="center">
            <div class="modal-content">
               <div class="modal-header">
                  <h5>Generar PDF</h5>
                  <br>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-6" >
                        <label><b>Ingrese Link:</b></label>  
                    </div>
                    <div  class="col-sm-6">
                       <input type="text" name="" class="form-control" v-model="comentario">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button  @click="pdf_total()" class="btn btn-success">Generar PDF</button>
                  <button  @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="downloadPdf" tabindex="-1" role="dialog" aria-labelledby="pdf_total" aria-hidden="true" >
          <div class="modal-dialog modal-center modal-md" role="document" align="center">
            <div class="modal-content">
               <div class="modal-header">
                  <h5>Generar PDF</h5>
                  <br>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-sm-6" >
                        <label><b>Ingrese Link:</b></label>  
                    </div>
                    <div  class="col-sm-6">
                       <input type="text" name="" class="form-control" v-model="comentario">
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button  @click="downloadPdf()" class="btn btn-success">Generar PDF</button>
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
                                        <textarea class="form-control" style="height:200px" v-model="titulo">
                                          
                                        </textarea>
                                        
                                    </div>
                                    <div class="col-sm-12" style="display:none">
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
                                              <option disabled value="0">Seleccione una opción</option>
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
                                        <select class="form-control" v-model="propietario_id">
                                            <option value="0" disabled>Seleccione una opcion</option>
                                            <option v-for="propietario in propietarios" :value="propietario.user_id" >{{propietario.user_id}} {{ propietario.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Agente</label>
                                        <select class="form-control" v-model="vendedor_id">
                                            <option value="0" disabled>Seleccione una opcion</option>
                                            <option v-for="vendedor in vendedores" :value="vendedor.user_id" >{{ vendedor.name }}</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                     <div class="col-sm-3" >
                                        <label>Pais</label>
                                        <select v-model="pais" class="form-control">
                                              <option disabled value="0">Seleccione una opción</option>
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
                                        <select class="form-control" v-model="departamento">
                                            <option value="0" disabled>Seleccione una opcion</option>
                                            <option v-for="departamento in departamentos" :value="departamento.departament_id" >{{ departamento.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Municipio</label>
                                        <select class="form-control" v-model="municipio">
                                            <option value="0" disabled>Seleccione una opcion</option>
                                            <option v-for="municipio in municipios" :value="municipio.municipality_id" >{{ municipio.name }}</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Zona</label>
                                        <select class="form-control" v-model="zona">
                                            <option value="0" disabled>Seleccione una opcion</option>
                                            <option v-for="zona in zonas" :value="zona.zone_id" >{{ zona.name }}</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3" >
                                        <label>Dirección</label>
                                        <input type="text" class="form-control" v-model="direccion" />
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3" >
                                        <label>Precio de venta (Q.)</label>
                                        <input type="text" class="form-control" v-model="precio_venta_quetzales" v-on:keyup="cambio_venta_gtq"/>
                                    </div>
                                     <div class="col-sm-3" >
                                        <label>Precio de venta ($.)</label>
                                        <input type="text" class="form-control" v-model="precio_venta_dolares" v-on:keyup="cambio_venta_usd" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Honorarios venta (%)</label>
                                        <input type="text" class="form-control" v-model="honorarios_venta" />
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3" >
                                        <label>Precio de renta (Q.)</label>
                                        <input type="text" class="form-control" v-model="precio_renta_quetzales" v-on:keyup="cambio_renta_gtq" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Precio de renta ($/)</label>
                                        <input type="text" class="form-control" v-model="precio_renta_dolares" v-on:keyup="cambio_renta_usd"/>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Honorarios renta (%)</label>
                                        <input type="text" class="form-control" v-model="honorarios_renta" />
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3" >
                                        <label>Financiamiento</label>
                                        <select v-model="financiamiento" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Canje</label>
                                        <select v-model="canje" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
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
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Cuota de mantenimiento</label>
                                        <select v-model="cuota_mantenimiento" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Servicios</label>
                                        <select v-model="servicios" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-3" >
                                        <label>Publicación en redes</label>
                                        <select v-model="publicacion_redes" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Exclusividad</label>
                                        <select v-model="exclusividad" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Compartida</label>
                                        <select v-model="compartida" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Asesor externo</label>
                                        <input type="text" class="form-control" v-model="asesor_externo" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Empresa</label>
                                        <input type="text" class="form-control" v-model="empresa_externa" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Porcentaje</label>
                                        <input type="text" class="form-control" v-model="porcentaje_externa" />
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
                                        <input type="text" class="form-control" v-model="celular_visita" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control" v-model="telefono_visita" />
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
                                        <input type="text" class="form-control" v-model="enganche_dolares" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Enganche (Q.)</label>
                                        <input type="text" class="form-control" v-model="enganche_quetzales" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Tasa</label>
                                        <input type="text" class="form-control" v-model="enganche_tasa" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Cuotas niveladas ($.)</label>
                                        <input type="text" class="form-control" v-model="enganche_cuota" />
                                    </div>
                                     <div class="col-sm-3">
                                        <label>Cuotas niveladas (Q.)</label>
                                        <input type="text" class="form-control" v-model="enganche_nivelado" />
                                    </div>
                                     <div class="col-sm-3">
                                        <label>Plazo en meses</label>
                                        <input type="text" class="form-control" v-model="enganche_plazo" />
                                    </div>
                                </div>
                                <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;"  v-if="cuota_mantenimiento == 1">
                                    <div class="col-sm-12"><h2>Datos de Mantenimiento</h2></div>
                                    <div class="col-sm-3">
                                        <label>Cuota($.)</label>
                                        <input type="text" class="form-control" v-model="mantenimiento_dolares" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Cuota(Q.)</label>
                                        <input type="text" class="form-control" v-model="mantenimiento_quetzales" />
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Incluido en cuota mensual</label>
                                        <select v-model="incluid_mensual" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Agua</label>
                                        <select v-model="agua" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Seguridad</label>
                                        <select v-model="seguridad" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Limpieza areas comunes</label>
                                        <select v-model="limpieza_areas" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Luz</label>
                                        <select v-model="luz" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Extracción de basura</label>
                                        <select v-model="extraccion" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
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
                                <div class="col-sm-12"><h2>Descripción</h2></div>
                                <div class="col-sm-3" >
                                        <label>Terreno</label>
                                        <input type="text" class="form-control" v-model="terreno" />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>Construcción</label>
                                        <input type="text" class="form-control" v-model="construccion" />
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
                                        <label>Año de construcción</label>
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
                                <div class="col-sm-4">
                                      <label>Portón</label>
                                      <select v-model="porton" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Alacena</label>
                                      <select v-model="alacena" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Closet de Blancos</label>
                                      <select v-model="closet_blancos" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Jardin Frontal</label>
                                      <select v-model="jardin_frontal" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Despensa</label>
                                      <select v-model="despensa" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Tina</label>
                                      <select v-model="tina" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Jardín trasero</label>
                                      <select v-model="jardin_trasero" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Desayunador</label>
                                      <select v-model="desayunador" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Ducha</label>
                                      <select v-model="ducha" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Baño de visita</label>
                                      <select v-model="bano_visita" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-4">
                                      <label>Lavandería</label>
                                      <select v-model="lavanderia" class="form-control">
                                            <option disabled value="">Seleccione una opción</option>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Bidet</label>
                                    <select v-model="bidet" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Dormitorio de visitas</label>
                                    <select v-model="dormitorio_visita" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Patio</label>
                                    <select v-model="patio" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Jetina</label>
                                    <select v-model="jetina" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Estudio</label>
                                    <select v-model="estudio" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Pérgola</label>
                                    <select v-model="pergola" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Jacuzzi</label>
                                    <select v-model="jacuzzi" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Sala</label>
                                    <select v-model="sala" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Bodega</label>
                                    <select v-model="bodega" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Sauna</label>
                                    <select v-model="sauna" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Chimenea</label>
                                    <select v-model="chimenea" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Bodega de Jardín</label>
                                    <select v-model="bodega_jardin" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Balcón</label>
                                    <select v-model="balcon" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Sala/Comedor</label>
                                    <select v-model="sala_comedor" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Sala Familiar</label>
                                    <select v-model="sala_familiar" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Terraza</label>
                                    <select v-model="terraza" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Comedor</label>
                                    <select v-model="comedor" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Walkin Closet</label>
                                    <select v-model="walkin_closet" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Churrasquera</label>
                                    <select v-model="churrasquera" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Cocina con gabinetes</label>
                                    <select v-model="cocina_gabinetes" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Closet</label>
                                    <select v-model="closet" class="form-control">
                                          <option disabled value="">Seleccione una opción</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                    </select>
                                </div>
                              </div>
                              <div class="row">
                                    <div class="col-sm-6">
                                        <label>Otros detalles</label>
                                        <textarea class="form-control" style="height:200px" v-model="otros_incluye">
                                          
                                        </textarea>
                                    </div>
                              </div>
                              <div class="row" style="border: #20a0ff 1px solid;padding-bottom: 30px;margin-top: 20px;">
                                  <div class="col-sm-12"><h2>Incluye</h2></div>
                                  <div class="col-sm-4">
                                        <label>Refrigeradora</label>
                                        <select v-model="refrigeradora" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Lámparas</label>
                                        <select v-model="lamparas" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Aire acondicionado</label>
                                        <select v-model="aire_acondicionado" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Estufa</label>
                                        <select v-model="estufa" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Cortinas</label>
                                        <select v-model="cortinas" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Alarma</label>
                                        <select v-model="alarma" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Estufa eléctrica</label>
                                        <select v-model="estufa_electrica" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Blackouts</label>
                                        <select v-model="blackouts" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Cámaras de seguridad</label>
                                        <select v-model="camaras_seguridad" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Lavavajillas</label>
                                        <select v-model="lavavajillas" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Cortinas de baño</label>
                                        <select v-model="cortinas_bano" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Paneles solares</label>
                                        <select v-model="paneles_solares" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Campana</label>
                                        <select v-model="camapana" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Calentador de agua</label>
                                        <select v-model="calentador_agua" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Bomba y cisterna</label>
                                        <select v-model="bomba_cisterna" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Lavadora</label>
                                        <select v-model="lavadora" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Espejos de baño</label>
                                        <select v-model="espejo_bano" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Depositos de basura</label>
                                        <select v-model="deposito_basura" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Secadora</label>
                                        <select v-model="secadora" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                              </div>
                              <div class="row">
                                    <div class="col-sm-6">
                                        <label>Otros detalles</label>
                                        
                                        <textarea class="form-control" style="height:200px" v-model="otros_detalles">
                                          
                                        </textarea>
                                    </div>
                              </div>
                            </tab-content>
                            <tab-content :key="2" :title="titulo_3" :icon="getIcon('tabla')">
                               <div class="row">
                                 <div class="col-sm-4">
                                        <label>Garita</label>
                                        <select v-model="garita" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Gimnasio</label>
                                        <select v-model="gimnasio" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Juegos infantiles</label>
                                        <select v-model="juegos_infantiles" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Guardiania</label>
                                        <select v-model="guardiania" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Sauna</label>
                                        <select v-model="sauna" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Psicina</label>
                                        <select v-model="piscina" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Área Social</label>
                                        <select v-model="area_social" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>SPA</label>
                                        <select v-model="spa" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Acceso silla de ruedas</label>
                                        <select v-model="acceso_silla" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Área para mascotas</label>
                                        <select v-model="area_mascotas" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Salón de belleza</label>
                                        <select v-model="salon_belleza" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Planta telefónica</label>
                                        <select v-model="planta_telefonica" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Parqueo visitas</label>
                                        <select v-model="parqueo_visitas" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Canchas deportivas</label>
                                        <select v-model="canchas_deportivas" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Razor ribbon</label>
                                        <select v-model="razor_ribbon" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>Bussines center</label>
                                        <select v-model="bussines_center" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                    </div>
                               </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Otras amenidades</label>
                                        
                                          <textarea class="form-control" style="height:200px" v-model="otras_amenidades">
                                          
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row">
                                  <label>Imágenes de propiedad</label>
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
                                    <input type="text" class="form-control" v-model="valor_registro_dolares" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del registro (Q.)</label>
                                    <input type="text" class="form-control" v-model="valor_registro_quetzales" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IUSI Trimestral ($.)</label>
                                    <input type="text" class="form-control" v-model="iusi_trimestral_dolares" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IUSI Trimestral (Q.)</label>
                                    <input type="text" class="form-control" v-model="iusi_trimestral_quetzales" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Folio</label>
                                    <input type="text" class="form-control" v-model="folio" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Finca</label>
                                    <input type="text" class="form-control" v-model="finca" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Libro</label>
                                    <input type="text" class="form-control" v-model="libro" />
                                 </div>
                               </div>
                               <div class="row">
                                 <div class="col-sm-3">
                                    <label>Inscrito en sociedad anónima</label>
                                    <select v-model="inscrito_sociedad_anonima" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Sociedad anónima</label>
                                    <input type="text" class="form-control" v-model="sociedad_anonima" />
                                 </div>
                               </div>
                               <div class="row">
                                 <div class="col-sm-3">
                                    <label>Gravamen Hipotecario</label>
                                    <select v-model="gravamen_hipotecario" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
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
                               </div>
                               <div class="row">
                                 <div class="col-sm-3">
                                    <label>Avalúo reciente</label>
                                    <select v-model="avalui_reciente" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Si</option>
                                              <option value="0">No</option>
                                        </select>
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del avalúo ($.)</label>
                                    <input type="text" class="form-control" v-model="avaluo_dolares" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>Valor del avalúo (Q.)</label>
                                    <input type="text" class="form-control" v-model="avaluo_quetzales" />
                                 </div>
                                  <div class="col-sm-3">
                                    <label>Tipo de avalúo</label>
                                    <select v-model="tipo_avaluo" class="form-control">
                                              <option disabled value="">Seleccione una opción</option>
                                              <option value="1">Comercial</option>
                                              <option value="0">Bancario</option>
                                        </select>
                                 </div>
                               </div>
                               <div class="row">
                                 <div class="col-sm-3">
                                    <label>Timbres</label>
                                    <input type="text" class="form-control" v-model="timbres" />
                                 </div>
                                 <div class="col-sm-3">
                                    <label>IVA</label>
                                    <input type="text" class="form-control" v-model="iva" />
                                 </div>
                               </div>
                               <div class="row">
                                    <div class="col-sm-6">
                                        <label>Descripción de la propiedad</label>
                                      
                                             <textarea class="form-control" style="height:200px" v-model="description">
                                          
                                        </textarea>
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
                                        <textarea class="form-control" style="height:200px" v-model="notas_internas">
                                          
                                        </textarea>
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
      props: ['datos_usuario','datos_agente' , 'propiedad'],
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
                comentario:'',
                usuario_id:0,
                subtitulo:'',
                fecha_final:'',
                fecha_inicial:'',
                vendida_por:0,
                rentada_por:0,
                precio_renta_dolares:'',
                precio_renta_quetzales:'',
                honorarios_renta:'',
                precio_venta_dolares:'',
                precio_venta_quetzales:'',
                honorarios_venta:0,
                imagenes:[],
                propietario_id:0,
                lavavajillas:0,
                nombre_contacto:'',
                telefono_contacto:'',
                celular_contacto:'',
                email_contacto:'',
                ambientes:0,
                terreno:0,
                construccion:'',
                frente:'',
                fondo:'',
                ano_construccion:'',
                niveles:'',
                dormitorios:'',
                dormitorios_servicio:'',
                banos:'',
                banos_servicio:'',
                parqueos_techados:'',
                parqueos_notechados:'',
                oficinas:'',
                bodegas:'',
                locales:'',
                porton:0,
                telefono_propietario:'',
                email_propietario:'',
                direccion_propietario:'',
                nombre_propietario:'',
                whatsapp_propietario:'',
                alacena:0,
                closet_blancos:0,
                jardin_frontal:0,
                despensa:0,
                tina:0,
                jardin_trasero:0,
                desayunador:0,
                ducha:0,
                bano_visita:0,
                propietario_unico:0,
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
                otros_detalles:0,
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
                otros_incluye:0,
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
                description:'',
                valor_registro_dolares:'',
                valor_registro_quetzales:'',
                iusi_trimestral_quetzales:'',
                iusi_trimestral_dolares:'',
                folio:'',
                finca:'',
                libro:'',
                inscrito_sociedad_anonima:0,
                sociedad_anonima:'',
                gravamen_hipotecario:0,
                gravamen_quetzales:'',
                gravamen_dolares:'',
                nombre_banco:'',
                avalui_reciente:0,
                avaluo_dolares:'',
                avaluo_quetzales:'',
                tipo_avaluo:0,
                accion_ejecutar:0,
                timbres:'',
                iva:'',
                link_tour:'',
                notas_internas:'',
                tipo:0,
                titulo:'',
                propietario:1,
                pais:0,
                departamento:0,
                municipio:0,
                zona:0,
                region:1,
                direccion:'',
                financiamiento:0,
                canje:0,
                especifique_canje:0,
                contacto_visita:0,
                cuota_mantenimiento:0,
                servicios:0,
                agente:[],
                publicacion_redes:0,
                exclusividad:0,
                compartida:0,
                nombre_visita:'',
                telefono_visita:'',
                celular_visita:'',
                email_visita:'',
                enganche_plazo:'',
                enganche_nivelado:'',
                enganche_cuota:'',
                enganche_tasa:'',
                enganche_quetzales:'',
                enganche_dolares:'',
                mantenimiento_dolares:'',
                mantenimiento_quetzales:'',
                compartida_porcentaje:'',
                compartida_empresa:'',
                compartida_asesor:'',
                agua:0,
                luz:0,
                seguridad:0,
                extraccion:0,
                limpieza_areas:0,
                incluid_mensual:0,
                propierty_id:0,
                propietarios:[],
                propietarios_test:[{}],
                vendedores:[],
                vendedor_id:0,
                vendedores_test:[{}],
                departamentos:[],
                municipios:[],
                zonas:[],
                editar_propiedad:0,
                regiones:[],
                titulo_1:"INMUEBLE",
                titulo_2:"DETALLES",
                titulo_3:"AMENIDADES",
                titulo_4:"ARBITRIOS",
                files:null,
                arrayData:[],
                update:'',
                porcentaje_externa:'',
                empresa_externa:'',
                asesor_externo:'',
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
            this.usuario_id = this.datos_usuario
            this.agente = JSON.parse(this.datos_agente)
            this.editar_propiedad = JSON.parse(this.propiedad).propiertiy_id
            //console.log('editar ',this.editar_propiedad);
            //console.log(this.agente.rol_id);
            let me = this;
            let url = '/api/propietarios' 
            axios.get(url,{}).then(function (response) {
                
                me.propietarios = response.data.records;
                //console.log("propietarios");
                //console.log(me.propietarios);
            })
            .catch(function (error) {
                //console.log(error);
            });  

            let urlocho = '/api/vendedores' 
            axios.get(urlocho,{}).then(function (response) {
                
                me.vendedores = response.data.records;
                //console.log("vendedores");
                //console.log(me.vendedores);
            })
            .catch(function (error) {
                //console.log(error);
            });  

            if(this.editar_propiedad > 0){

             this.loadFieldsUpdate(this.editar_propiedad);  
            }
            
            let url2 = '/api/departaments' 
            axios.get(url2,{}).then(function (response) {
                me.departamentos = response.data.records;
            })
            .catch(function (error) {
                //console.log(error);
            });  
            let url3 = '/api/municipalities' 
            axios.get(url3,{}).then(function (response) {
                me.municipios = response.data.records;
            })
            .catch(function (error) {
                //console.log(error);
            });  

            let url4 = '/api/zones' 
            axios.get(url4,{}).then(function (response) {
                me.zonas = response.data.records;
            })
            .catch(function (error) {
                //console.log(error);
            });  

            let url5 = '/api/regions' 
            axios.get(url5,{}).then(function (response) {
                me.regiones = response.data.records;
            })
            .catch(function (error) {
                //console.log(error);
            });  
            $('.table-responsive').on('click', (evt) => {
                evt.stopImmediatePropagation();
               if ($(evt.target)[0].innerText == 'Editar') {
                //console.log($(evt.target)[0].id)
                 this.loadFieldsUpdate($(evt.target)[0].id); 
               }
               else if ($(evt.target)[0].innerText == 'Acciones') {
                 this.loadRenta($(evt.target)[0].id); 
               }
               else if ($(evt.target)[0].innerText == 'Añadir') {
                 let url = '/api/propierty/add_pdf' 
                    let Data_id = event.target.id
                    //console.log(Data_id);
                    if (confirm('¿Seguro que deseas agregar esta propiedad para generar el pdf?')) {
                        axios.post(url,{ 
                        'propierty_id': Data_id,
                        'usuario_id': this.usuario_id,
                        }).then(function (response) {
                            //console.log(response);
                            //location.reload();
                        })
                        .catch(function (error) {
                            //console.log(error);
                        }); 
                    }
               }
               else if ($(evt.target)[0].innerText == 'PDF') {
                 this.abrir_downloadPdf($(evt.target)[0].id); 
               }
               else if ($(evt.target)[0].innerText == 'TOUR') {
                 this.downloadTour($(evt.target)[0].id); 
               }
               else if($(evt.target)[0].innerText == 'Eliminar'){
                    let url = '/api/propierty/delete' 
                    let Data_id = event.target.id
                    //console.log(Data_id);
                    if (confirm('¿Seguro que deseas eliminar este registro?')) {
                        axios.post(url,{ 
                        'propierty_id': Data_id,
                        }).then(function (response) {
                            //console.log(response);
                        location.reload();
                        })
                        .catch(function (error) {
                            //console.log(error);
                        }); 
                    }
               }
               else{
                  var texto = $(evt.target)[0].innerText;
                  //console.log(texto.length)
                  if(texto.length > 10){
                    me.propietario_unico      =  0;
                    me.nombre_contacto        =  '';
                    me.telefono_contacto      =  '';
                    me.celular_contacto       =  '';
                    me.email_contacto         =  '';
                    me.nombre_propietario     =  '';
                    me.telefono_propietario   =  '';
                    me.direccion_propietario  =  '';
                    me.email_propietario      =  '';
                    me.whatsapp_propietario   =  '';
                    //console.log($(evt.target)[0].id);
                    this.loadVenta($(evt.target)[0].id); 
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
                this.editar_propiedad = 0;
                var url = '';
                //console.log(this.update)
                if(this.update > 0){
                   url = '/api/propierty/edit' 
                }else{
                   url = '/api/propierty/create' 
                }
                //console.log(url)
                const formData  = new FormData()
                if(this.files){
                    formData.append('file', this.files, this.files.name)
                }
                //console.log(this.imagenes)
                formData.append('propiedad_id',this.update)
                formData.append('imagenes',this.imagenes) 
                formData.append('title',this.title)
                formData.append('type',this.tipo)
                formData.append('user_id',this.vendedor_id)//usuario logeado
                formData.append('owner_id',this.propietario_id)
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
                formData.append('description',this.description)
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
                //console.log(formData);
                axios.post(url,formData,{}).then(function (response) {
                    //console.log(response.data.records);
                    if (response.data.result == false) {
                    location.reload();
                    }else{
                        //let me = this
                        //me.clearFields();
                        $('#exampleModal').modal('hide');
                    location.reload();
                    }
                })
                .catch(function (error) {
                    alert(error);
                    //console.log(error);
                });   
            },
            ejecutar(){
                let me  = this;
                let url = '/api/propierty/ejecutar' 
                const formData  = new FormData()
                //console.log(me.rentada_por)
                formData.append('accion',this.accion_ejecutar)
                formData.append('propiedad_id',this.update)
                formData.append('usuario_id',this.rentada_por)
                //console.log(formData);
                axios.post(url,formData,{}).then(function (response) {
                    //console.log(response.data.records);
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
                    //console.log(error);
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
              limpiar_pdf(){
                let me  = this;
                let url = '/api/propierty/limpiar/'+this.usuario_id  
                axios({
                    url: url,
                    method: 'GET',
                }).then((response) => {
                  if (response.data.result == false) {
                    }else{
                        me.clearFields();
                    location.reload();
                    }
                });
              },
              abrir_pdf_total(){
                $('#pdf_total').modal('show');
              },
              pdf_total(){
                let me  = this;
                let url = '/api/propierty/pdf_total/'+this.usuario_id 
                axios({
                  url: url,
                  method: 'GET',
                  responseType: 'blob',
              }).then((response) => {
                   var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                   var fileLink = document.createElement('a');
                   fileLink.href = fileURL;
                   fileLink.setAttribute('download', 'propiedades.pdf');
                   document.body.appendChild(fileLink);
                   fileLink.click();
                   //limpiar caja de texto
                   $('#pdf_total').modal('hide');
              });
              },
            guardarVenta(){
                let me  = this;
                let url = '/api/propierty/sale' 
                const formData  = new FormData()
                formData.append('propiedad_id',this.update)
                formData.append('usuario_id',this.rentada_por)
                //console.log(formData);
                axios.get(url,formData,{}).then(function (response) {
                    //console.log(response.data.records);
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
                    //console.log(error);
                });   
            },
            onCompleteWizard: async function() {
              await this.saveData();
            },
            uploadExitoso(file, response ) {
              //console.log(response.records);
              this.imagenes.push(response.records.id);
              //console.log(this.imagenes);
            },
            loadRenta(id){ 
              this.update = id
              $('#modalrenta').modal('show');
            }, 
            loadVenta(id,propiedad){
              //console.log(propiedad) 
              //console.log(id)
                this.update = id
                let me  = this;
                let url = '/api/propierty/showid';
                axios.post(url,{ 
                    'propierty_id': this.update,
                }).then(function (response) {
                  //console.log(response.data.records);
                  me.propietario_unico      = response.data.records.owner_id;
                  me.nombre_contacto        =  response.data.records.name_contact;
                  me.telefono_contacto      =  response.data.records.telefono_contacto;
                  me.celular_contacto       =  response.data.records.phone_contact;
                  me.email_contacto         =  response.data.records.email_contact;
                  
                  me.nombre_propietario     =  response.data.records.nombre_propietario;
                  me.telefono_propietario   =  response.data.records.telefono_propietario;
                  me.direccion_propietario  =  response.data.records.direccion_propietario;
                  me.email_propietario      =  response.data.records.email_propietario;
                  me.whatsapp_propietario   =  response.data.records.whatsapp_propietario;
                  $('#modalventa').modal('show');
                })
                .catch(function (error) {
                    //console.log(error);
                }); 
                
                 
                
                
            },    
            abrir_downloadPdf(id){
              this.update = id;
              $('#downloadPdf').modal('show');
            },
            downloadPdf(id){ 
                let me  = this;
                var personalizada = this.comentario.replace('https://www.facebook.com/','')
                var nueva_personalizada     = personalizada.replaceAll('/','.!.')
                if(nueva_personalizada == ''){
                  nueva_personalizada = '-';
                }
                let url = '/pdf_comentario/'+me.update+'/'+nueva_personalizada
                axios({
                  url: url,
                  method: 'GET',
                  responseType: 'blob',
              }).then((response) => {
                   var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                   var fileLink = document.createElement('a');
                   fileLink.href = fileURL;
                   fileLink.setAttribute('download', 'Información para cliente código '+this.update+'.pdf');
                   document.body.appendChild(fileLink);
                   fileLink.click();
                   $('#downloadPdf').modal('hide');
              });
            },
            downloadPdf_backup(id){ 
                let me  = this;
                let url = '/pdf/'+id 
                axios({
                  url: url,
                  method: 'GET',
                  responseType: 'blob',
              }).then((response) => {
                   var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                   var fileLink = document.createElement('a');
                   fileLink.href = fileURL;
                   fileLink.setAttribute('download', 'Información para cliente código '+id+'.pdf');
                   document.body.appendChild(fileLink);
                   fileLink.click();
                   $('#downloadPdf').modal('hide');
              });
            },
            downloadTour(id){ 
                let me  = this;
                let url = '/tour/'+id 
                axios({
                  url: url,
                  method: 'GET',
                  responseType: 'blob',
              }).then((response) => {
                   var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                   var fileLink = document.createElement('a');
                   fileLink.href = fileURL;
                   fileLink.setAttribute('download', 'Información para tour código '+id+'.pdf');
                   document.body.appendChild(fileLink);
                   fileLink.click();
              });
            },   
            loadFieldsUpdate(id){ 
                //console.log("entro");
                $('#exampleModal').modal('show');
                this.update = id
                let me  = this;
                let url = '/api/propierty/showid';
                axios.post(url,{ 
                    'propierty_id': this.update,
                }).then(function (response) {
                  //console.log(response.data.records);
                  me.titulo = response.data.records.title;
                  me.tipo =  response.data.records.type;
                  me.propietario_id =  response.data.records.owner_id;
                  console.log(me.propietario_id)
                  me.vendedor_id = response.data.records.user_id;
                  console.log(me.vendedor_id)
                  me.pais = response.data.records.country_id;
                  me.departamento = response.data.records.departament_id;
                  me.municipio = response.data.records.municipality_id;
                  me.zona =  response.data.records.zone_id;
                  me.precio_venta_dolares = response.data.records.sale_usd;
                  me.precio_venta_quetzales =  response.data.records.sale_gtq;
                  me.precio_renta_dolares =  response.data.records.rent_usd;
                  me.precio_renta_quetzales =  response.data.records.rent_gtq;
                  me.honorarios_renta =  response.data.records.fee_rent;
                  me.honorarios_venta =  response.data.records.fee_sale;
                  me.lavavajillas = 0;
                  me.terreno = response.data.records.land_vrs;          
                  me.fondo = response.data.records.bottom_mts; 
                  me.dormitorios = response.data.records.rooms;
                  me.banos = response.data.records.bathrooms;
                  me.banos_servicio = response.data.records.bathrooms_service;
                  me.parqueos_techados = response.data.records.parking_roof;
                  me.parqueos_notechados = response.data.records.parking;
                  me.oficinas =  response.data.records.offices;
                  me.bodegas = response.data.records.cellars;
                  me.locales = response.data.records.places;
                  me.porton = response.data.records.door;
                  me.alacena = response.data.records.cupboard;
                  me.closet_blancos =  response.data.records.white_closet;
                  me.jardin_frontal = response.data.records.gardeen_front;
                  me.despensa = response.data.records.pantry;
                  me.tina =  response.data.records.tub;
                  me.jardin_trasero =  response.data.records.jardin_trasero;
                  me.desayunador = response.data.records.desayunador;
                  me.ducha = response.data.records.ducha;
                  me.bano_visita = response.data.records.bathroom_visit;
                  me.lavanderia =  response.data.records.laundry;
                  me.bidet = response.data.records.bidet;
                  me.dormitorio_visita = response.data.records.room_visit;
                  me.patio = response.data.records.yard;
                  me.jetina =  response.data.records.jetina;
                  me.estudio = response.data.records.study;
                  me.pergola = response.data.records.pergola;
                  me.jacuzzi = response.data.records.jacuzzi;
                  me.sala =  response.data.records.living_room;
                  me.bodega =  response.data.records.winery;
                  me.sauna = response.data.records.sauna;
                  me.chimenea =  response.data.records.chimeny;
                  me.bodega_jardin = response.data.records.garden_winery;
                  me.balcon =  response.data.records.balcony;
                  me.sala_comedor =  response.data.records.dining_room;
                  me.sala_familiar = response.data.records.family_room;
                  me.terraza = response.data.records.roof_room;
                  me.comedor = response.data.records.dining;
                  me.walkin_closet = response.data.records.walkin_closet;
                  me.churrasquera =  response.data.records.grill;
                  me.cocina_gabinetes =  response.data.records.kitchen_room;
                  me.closet =  response.data.records.closet;
                  me.otros_detalles =  response.data.records.another_details;
                  me.refrigeradora = response.data.records.fridge;
                  me.lamparas =  response.data.records.lamps;
                  me.aire_acondicionado =  response.data.records.air;
                  me.estufa =  response.data.records.kitchen;
                  me.cortinas =  response.data.records.curtain;
                  me.alarma =  response.data.records.alarm;
                  me.estufa_electrica =  response.data.records.electricy_kitchen;
                  me.blackouts = response.data.records.blackouts;
                  me.camaras_seguridad = response.data.records.camera_security;
                  me.lavavajillas =  response.data.records.dishwater;
                  me.cortinas_bano = response.data.records.bathroom_curtain;
                  me.paneles_solares = response.data.records.solar_panel;
                  me.campana = response.data.records.bell;
                  me.calentador_agua = response.data.records.water_heater;
                  me.bomba_cisterna =  response.data.records.cistern;
                  me.lavadora =  response.data.records.washing_machine;
                  me.espejo_bano = response.data.records.bathroom_mirros;
                  me.deposito_basura = response.data.records.trash_deposit;
                  me.secadora =  response.data.records.dryer;
                  me.otros_incluye = response.data.records.another_include;
                  me.garita =  response.data.records.cabin;
                  me.gimnasio =  response.data.records.gym;
                  me.juegos_infantiles = response.data.records.kids_area;
                  me.guardiania = response.data.records.daycare;
                  me.sauna = response.data.records.sauna_shared;
                  me.piscina = response.data.records.floor_shared;
                  me.area_social = response.data.records.social_area;
                  me.spa = response.data.records.spa;
                  me.acceso_silla = response.data.records.acceso_silla;
                  me.area_mascotas = response.data.records.pet_area;
                  me.salon_belleza = response.data.records.beauty_salon;
                  me.planta_telefonica = response.data.records.phone_plant;
                  me.parqueo_visitas = response.data.records.parking_visit;
                  me.canchas_deportivas =  response.data.records.court;
                  me.razor_ribbon =  response.data.records.ribbon;
                  me.bussines_center = response.data.records.bussines_center;
                  me.otras_amenidades =  response.data.records.another_pleasantness;
                  me.description = response.data.records.description;
                  me.valor_registro_dolares =  response.data.records.registry_usd;
                  me.valor_registro_quetzales =  response.data.records.registry_gtq;
                  me.iusi_trimestral_quetzales = response.data.records.iusi_gtq;
                  me.iusi_trimestral_dolares = response.data.records.iusi_usd;
                  me.folio = response.data.records.sheet;
                  me.finca = response.data.records.property;
                  me.libro = response.data.records.book;
                  me.inscrito_sociedad_anonima = response.data.records.society;
                  me.sociedad_anonima =  response.data.records.name_society;
                  me.gravamen_hipotecario =  response.data.records.mortgage;
                  me.gravamen_quetzales = response.data.records.mortgage_gtq;
                  me.gravamen_dolares =  response.data.records.mortgage_usd;
                  me.nombre_banco =  response.data.records.bank_id;
                  me.avalui_reciente = response.data.records.appraisal;
                  me.avaluo_dolares =  response.data.records.appraisal_usd;
                  me.avaluo_quetzales =  response.data.records.appraisal_gtq;
                  me.tipo_avaluo = response.data.records.appraisal_type;
                  me.timbres = response.data.records.rings;
                  me.iva = response.data.records.iva;
                  me.link_tour = response.data.records.youtube;
                  me.notas_internas =  response.data.records.internal_note;
                  me.titulo =  response.data.records.title;
                  me.subtitulo = response.data.records.subtitle;
                  me.propietario = response.data.records.owner_id;
                  me.direccion = response.data.records.adress;
                  me.financiamiento =  response.data.records.finance;
                  me.enganche_plazo =  response.data.records.term;
                  me.enganche_nivelado = response.data.records.enganche_nivelado;
                  me.enganche_cuota =  response.data.records.term_text;
                  me.enganche_tasa = response.data.records.rate;
                  me.enganche_quetzales =  response.data.records.fee_gtq;
                  me.enganche_dolares =  response.data.records.fee_usd;
                  me.canje = response.data.records.exchange;
                  me.especifique_canje = response.data.records.especifique_canje;
                  me.cuota_mantenimiento = response.data.records.maintenance;
                  me.servicios = response.data.records.servicios;
                  me.publicacion_redes = response.data.records.social_media;
                  me.exclusividad =  response.data.records.exclusivity;
                  me.compartida =  response.data.records.share;
                  me.nombre_visita = response.data.records.name_contact;
                  me.telefono_visita = response.data.records.telephone_contact;
                  me.celular_visita =  response.data.records.phone_contact;
                  me.email_visita =  response.data.records.email_contact;
                  me.mantenimiento_dolares = response.data.records.fee_maintenance_usd;
                  me.mantenimiento_quetzales = response.data.records.fee_maintenance_gtq;
                  me.compartida_porcentaje = response.data.records.rate_share;
                  me.compartida_empresa =  response.data.records.company_share;
                  me.compartida_asesor = response.data.records.partner_share;
                  me.agua =  response.data.records.water_service;
                  me.luz = response.data.records.electricy_service;
                  me.seguridad = response.data.records.security_service;
                  me.extraccion =  response.data.records.trash_service;
                  me.limpieza_areas =  response.data.records.clean_service;
                  me.incluid_mensual = response.data.records.include_maintenance;
                })
                .catch(function (error) {
                    //console.log(error);
                }); 
            },
            limpiarData(){ 
                  //console.log(response.data.records);
                  this.titulo                    = '';
                  this.tipo                      = '';
                  this.propietario_id            = '';
                  this.vendedor_id               = '';
                  this.pais                      = '';
                  this.departamento              = '';
                  this.municipio                 = '';
                  this.zona                      = '';
                  this.precio_venta_dolares      = '';
                  this.precio_venta_quetzales    = '';
                  this.precio_renta_dolares      = '';
                  this.precio_renta_quetzales    = '';
                  this.honorarios_renta          = '';
                  this.honorarios_venta          = '';
                  this.lavavajillas              = '';
                  this.ambientes                 = '';
                  this.terreno                   = '';
                  this.construccion              = '';
                  this.frente                    = '';
                  this.fondo                     = '';
                  this.ano_construccion          = '';
                  this.niveles                   = '';
                  this.dormitorios               = '';
                  this.dormitorios_servicio      = '';
                  this.banos                     = '';
                  this.banos_servicio            = '';
                  this.parqueos_techados         = '';
                  this.parqueos_notechados       = '';
                  this.oficinas                  = '';
                  this.bodegas                   = '';
                  this.locales                   = '';
                  this.porton                    = '';
                  this.alacena                   = '';
                  this.closet_blancos            = '';
                  this.jardin_frontal            = '';
                  this.despensa                  = '';
                  this.tina                      = '';
                  this.jardin_trasero            = '';
                  this.desayunador               = '';
                  this.ducha                     = '';
                  this.bano_visita               = '';
                  this.lavanderia                = '';
                  this.bidet                     = '';
                  this.dormitorio_visita         = '';
                  this.patio                     = '';
                  this.jetina                    = '';
                  this.estudio                   = '';
                  this.pergola                   = '';
                  this.jacuzzi                   = '';
                  this.sala                      = '';
                  this.bodega                    = '';
                  this.sauna                     = '';
                  this.chimenea                  = '';
                  this.bodega_jardin             = '';
                  this.balcon                    = '';
                  this.sala_comedor              = '';
                  this.sala_familiar             = '';
                  this.terraza                   = '';
                  this.comedor                   = '';
                  this.walkin_closet             = '';
                  this.churrasquera              = '';
                  this.cocina_gabinetes          = '';
                  this.closet                    = '';
                  this.otros_detalles            = '';
                  this.refrigeradora             = '';
                  this.lamparas                  = '';
                  this.aire_acondicionado        = '';
                  this.estufa                    = '';
                  this.cortinas                  = '';
                  this.alarma                    = '';
                  this.estufa_electrica          = '';
                  this.blackouts                 = '';
                  this.camaras_seguridad         = '';
                  this.lavavajillas              = '';
                  this.cortinas_bano             = '';
                  this.paneles_solares           = '';
                  this.campana                   = '';
                  this.calentador_agua           = '';
                  this.bomba_cisterna            = '';
                  this.lavadora                  = '';
                  this.espejo_bano               = '';
                  this.deposito_basura           = '';
                  this.secadora                  = '';
                  this.otros_incluye             = '';
                  this.garita                    = '';
                  this.gimnasio                  = '';
                  this.juegos_infantiles         = '';
                  this.guardiania                = '';
                  this.sauna                     = '';
                  this.piscina                   = '';
                  this.area_social               = '';
                  this.spa                       = '';
                  this.acceso_silla              = '';
                  this.area_mascotas             = '';
                  this.salon_belleza             = '';
                  this.planta_telefonica         = '';
                  this.parqueo_visitas           = '';
                  this.canchas_deportivas        = '';
                  this.razor_ribbon              = '';
                  this.bussines_center           = '';
                  this.otras_amenidades          = '';
                  this.description               = '';
                  this.valor_registro_dolares    = '';
                  this.valor_registro_quetzales  = '';
                  this.iusi_trimestral_quetzales = '';
                  this.iusi_trimestral_dolares   = '';
                  this.folio                     = '';
                  this.finca                     = '';
                  this.libro                     = '';
                  this.inscrito_sociedad_anonima = '';
                  this.sociedad_anonima          = '';
                  this.gravamen_hipotecario      = '';
                  this.gravamen_quetzales        = '';
                  this.gravamen_dolares          = '';
                  this.nombre_banco              = '';
                  this.avalui_reciente           = '';
                  this.avaluo_dolares            = '';
                  this.avaluo_quetzales          = '';
                  this.tipo_avaluo               = '';
                  this.timbres                   = '';
                  this.iva                       = '';
                  this.link_tour                 = '';
                  this.notas_internas            = '';
                  this.titulo                    = '';
                  this.subtitulo                 = '';
                  this.propietario               = '';
                  this.direccion                 = '';
                  this.financiamiento            = '';
                  this.enganche_plazo            = '';
                  this.enganche_nivelado         = '';
                  this.enganche_cuota            = '';
                  this.enganche_tasa             = '';
                  this.enganche_quetzales        = '';
                  this.enganche_dolares          = '';
                  this.canje                     = '';
                  this.especifique_canje         = '';
                  this.cuota_mantenimiento       = '';
                  this.servicios                 = '';
                  this.publicacion_redes         = '';
                  this.exclusividad              = '';
                  this.compartida                = '';
                  this.nombre_visita             = '';
                  this.telefono_visita           = '';
                  this.celular_visita            = '';
                  this.email_visita              = '';
                  this.mantenimiento_dolares     = '';
                  this.mantenimiento_quetzales   = '';
                  this.compartida_porcentaje     = '';
                  this.compartida_empresa        = '';
                  this.compartida_asesor         = '';
                  this.agua                      = '';
                  this.luz                       = '';
                  this.seguridad                 = '';
                  this.extraccion                = '';
                  this.limpieza_areas            = '';
                  this.incluid_mensual           = '';
            },              
            deleteData(data){
              //console.log(data);
                let url = '/api/propierty/delete' 
                let me = this;
                let Data_id = data.propiertiy_id 
                //console.log(Data_id);
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.post(url,{ 
                    'propierty_id': Data_id,
                    }).then(function (response) {
                        //console.log(response);
                    })
                    .catch(function (error) {
                        //console.log(error);
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