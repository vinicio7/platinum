<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-center" role="document" align="center">
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
                                <div class="col-md-12">
                                    <label>Nombre</label>
                                    <input v-model="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Cuenta</label>
                                    <input v-model="account" type="number" class="form-control">
                                </div>  
                                <div class="col-md-6">
                                    <label>Estado</label>
                                    <select v-model="status" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="1">Activo</option>
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
    import ImageComponent from './ImageComponent.vue';
    import EditButton from './EditButton.vue';
    import DeleteButton from './DeleteButton.vue';
    import $ from 'jquery';
    export default {
        data() {
            return {
                bank_id:"",
                name:"",
                account:"",
                status:"",
                arrayData:[],
                update:0,
                columns: [
                    {
                        label: 'Id',
                        name: 'bank_id',
                        orderable: true,
                    },
                    {
                        label: 'Nombre',
                        name: 'name',
                        orderable: true,
                    },
                    {
                        label: 'Cuenta',
                        name: 'account',
                        orderable: false,
                    },
                    {
                        label: 'Estado',
                        name: 'status',
                        orderable: true,
                    },
                    {
                        label: 'Editar',
                        name: 'Editar',
                        orderable: false,
                        classes: { 
                            'btn': true,
                            'btn-primary': true,
                            'btn-sm': true,
                        },
                        event: "click",
                        handler: this.loadFieldsUpdate,
                        component: EditButton, 
                    },
                    {
                        label: 'Eliminar',
                        name: 'Eliminar',
                        orderable: false,
                        classes: { 
                            'btn': true,
                            'btn-danger': true,
                            'btn-sm': true,
                        },
                        event: "click",
                        handler: this.deleteData,
                        component: DeleteButton, 
                    },
                ]
            }
        },
        components: {
            EditButton,
            DeleteButton,
            ImageComponent
        },
        methods:{
            saveData(){
                let me =this;
                let url = '/api/banks/create' 
                axios.post(url,{ 
                    'name': this.name,
                    'account': this.account,
                    'status': this.status,
                }).then(function (response) {
                    console.log(response.data.message);
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
                let me = this;
                let url = '/api/banks/edit' 
                axios.post(url,{ 
                    'bank_id': this.bank_id,
                    'name': this.name,
                    'account': this.account,
                    'status': this.status,
                }).then(function (response) {
                    $('#exampleModal').modal('hide');
                   me.clearFields();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ 
                $('#exampleModal').modal('show');
                this.update = data.bank_id
                let me =this;
                let url = '/api/banks/showid/';
                axios.post(url,{ 
                    'bank_id': this.update,
                }).then(function (response) {
                    me.bank_id= response.data.records.bank_id;
                    me.name= response.data.records.name;
                    me.account= response.data.records.account;
                    me.status= response.data.records.status;

                })
                .catch(function (error) {
                    console.log(error);
                }); 
            },
            deleteData(data){
                let url = '/api/banks/delete' 
                let me = this;
                let Data_id = data.bank_id
                console.log(Data_id);
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.post(url,{ 
                    'bank_id': Data_id,
                    }).then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){
                this.bank_id = "";
                this.name = "";
                this.account = "";
                this.status = "";
                this.update = 0;
                $('#exampleModal').modal('hide');
            }
        },
        previewFiles(files){
          console.log(files)
        },
    }
</script>