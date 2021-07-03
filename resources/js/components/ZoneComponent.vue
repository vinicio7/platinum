<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-center modal-lg" role="document" align="center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update == 0">Crear zona</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update != 0">Actualizar zona</h5>
                        <br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Municipio</label>
                                    <select class="form-control" v-model="municipality" v-on:change="selectTipo()">
                                        <option disabled value="">Seleccione una opcion</option>
                                        <option v-for="data in municipalities" :value="data.municipality_id" >{{ data.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Nombre</label>
                                    <input v-model="name" type="text" class="form-control">
                                </div>
                                <div class="col-md-4">
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
          + Crear zona
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
                zone_id:"",
                name:"",
                status:"",
                municipality:"",
                municipality_id:"",
                municipalities:[],
                arrayData:[],
                update:0,
            }
        },
        mounted: function() {
            let url = '/api/municipalities';
            let me =this;
            axios.get(url,{}).then(function (response) {
                me.municipalities   = response.data.records;
                console.log(responde.data.records);
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
                    let url = '/api/zones/delete' 
                    let Data_id = event.target.id
                    console.log(Data_id);
                    if (confirm('¿Seguro que deseas eliminar este registro?')) {
                        axios.post(url,{ 
                        'zone_id': Data_id,
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
                let url = '/api/zones/create' 
                const formData  = new FormData()
                if(this.files){
                    formData.append('file', this.files, this.files.name)
                }
                formData.append('municipality_id',this.municipality)
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
                let url = '/api/zones/edit' 
                const formData  = new FormData()
                console.log(this.files)
                if(this.files){
                   formData.append('file', this.files, this.files.name) 
                }
                formData.append('zone_id',this.update)
                formData.append('municipality_id',this.municipality)
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
                let url = '/api/zones/showid';
                axios.post(url,{ 
                    'zone_id': this.update,
                }).then(function (response) {
                    me.municipality_id   = response.data.records.municipality_id;
                    me.zone_id   = response.data.records.zone_id;
                    me.name             = response.data.records.name;
                    me.status           = response.data.records.status;

                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteData(data){
                let url = '/api/zones/delete' 
                let me = this;
                let Data_id = data.zone_id
                console.log(Data_id);
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.post(url,{ 
                    'zone_id': Data_id,
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
                this.zone_id = "";
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