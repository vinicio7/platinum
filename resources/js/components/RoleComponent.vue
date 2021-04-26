<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-center modal-lg" role="document" align="center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update == 0">Crear rol</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update != 0">Actualizar rol</h5>
                        <br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Nombre</label>
                                    <input v-model="name" type="text" class="form-control">
                                </div>
                                <div class="col-md-3" >
                                    <label>Dashboard</label>
                                    <select v-model="dashboard" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" >
                                    <label>Propiedades</label>
                                    <select v-model="propierties" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" >
                                    <label>Departamentos</label>
                                    <select v-model="departaments" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Municipios</label>
                                    <select v-model="municipality" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Regiones</label>
                                    <select v-model="regions" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Zonas</label>
                                    <select v-model="zones" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Bancos</label>
                                    <select v-model="banks" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Historial</label>
                                    <select v-model="history" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Roles</label>
                                    <select v-model="rols" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Usuarios</label>
                                    <select v-model="user" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Si</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="margin-top:15px">
                                    <label>Estado</label>
                                    <select v-model="status" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1" >Activo</option>
                                      <option value="0">Inactivo</option>
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button v-if="update == 0" @click="saveData()" class="btn btn-success" style="background-color: #12264d;border-color: #12264d;">Añadir</button>
                        <button v-if="update != 0" @click="updateData()" class="btn btn-warning">Actualizar</button>
                        <button v-if="update != 0" @click="clearFields()" class="btn">Atrás</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" style="background-color: #12264d;border-color: #12264d;">
          + Crear rol
        </button>
        <div class="row" style="margin-top: 10px">
            
        </div>
    </div>
</template>
<script>
    import $ from 'jquery';
    export default {
        data() {
            return {
                name:"",
                status:"",
                dashboard:0,
                propierties:0,
                departaments:0,
                municipality:0,
                regions:0,
                user:0,
                zones:0,
                banks:0,
                history:0,
                rols:0,
                arrayData:[],
                update:0,
            }
        },
        mounted: function() {
            let url = '/api/municipalities';
            let me =this;
            axios.get(url,{}).then(function (response) {
                me.municipalities   = response.data.records;
                console.log(response.data.records);
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
                    let url = '/api/rols/delete' 
                    let Data_id = event.target.id
                    console.log(Data_id);
                    if (confirm('¿Seguro que deseas eliminar este registro?')) {
                        axios.post(url,{ 
                        'rol_id': Data_id,
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
                let url = '/api/rols/create' 
                const formData  = new FormData()
                if(this.files){
                    formData.append('file', this.files, this.files.name)
                }
                formData.append('dashboard',this.dashboard)
                formData.append('propierties',this.propierties)
                formData.append('departaments',this.departaments)
                formData.append('municipality',this.municipality)
                formData.append('regions',this.regions)
                formData.append('user',this.user)
                formData.append('zones',this.zones)
                formData.append('banks',this.banks)
                formData.append('history',this.history)
                formData.append('rols',this.rols)
                formData.append('name',this.name)
                formData.append('status',this.status)
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
            updateData(){
                console.log(this.update);
                let me  = this;
                let url = '/api/rols/edit' 
                const formData  = new FormData()
                if(this.files){
                   formData.append('file', this.files, this.files.name) 
                }
                formData.append('rol_id',this.update)
                formData.append('dashboard',this.dashboard)
                formData.append('propierties',this.propierties)
                formData.append('departaments',this.departaments)
                formData.append('municipality',this.municipality)
                formData.append('regions',this.regions)
                formData.append('user',this.user)
                formData.append('zones',this.zones)
                formData.append('banks',this.banks)
                formData.append('history',this.history)
                formData.append('rols',this.rols)
                formData.append('name',this.name)
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
                let url = '/api/rols/showid/';
                axios.post(url,{ 
                    'rol_id': this.update,
                }).then(function (response) {
                    me.dashboard   = response.data.records.dashboard;
                    me.propierties   = response.data.records.propierties;
                     me.departaments   = response.data.records.departaments;
                    me.municipality   = response.data.records.municipality;
                     me.regions   = response.data.records.regions;
                    me.user   = response.data.records.user;
                     me.zones   = response.data.records.zones;
                    me.banks   = response.data.records.banks;
                     me.history   = response.data.records.history;
                    me.rols   = response.data.records.rols;
                    me.name             = response.data.records.name;
                    me.status           = response.data.records.status;

                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteData(data){
                let url = '/api/rols/delete' 
                let me = this;
                let Data_id = data.rol_id
                console.log(Data_id);
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.post(url,{ 
                    'rol_id': Data_id,
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
                this.rol_id = "";
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
</script>M