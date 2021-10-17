<template>
    <div class="container container-Data" >
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-center modal-lg" role="document" align="center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update == 0">Crear cliente</h5>
                        <h5 class="modal-title" id="exampleModalLabel" v-if="update != 0">Actualizar cliente</h5>
                        <br>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Nombre</label>
                                    <input v-model="name" type="text" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Correo</label>
                                    <input v-model="email" type="text" class="form-control">
                                </div> 
                                <div class="col-md-4">
                                    <label>Telefono</label>
                                    <input v-model="phone" type="number" class="form-control">
                                </div> 
                                <div class="col-md-4">
                                    <label>Genero</label>
                                    <select v-model="gender" class="form-control">
                                      <option disabled value="">Seleccione una opcion</option>
                                      <option value="0">Hombre</option>
                                      <option value="1">Mujer</option>
                                      <option value="2">Otro</option>
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
          + Crear Cliente
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
                user_id:"",
                name:"",
                account:"",
                status:"1",
                rol:[],
                whatsapp:'',
                instagram:'',
                twitter:'',
                email:'',
                facebook:'',
                title:'',
                birthdate:'',
                document_id:'',
                gender:'',
                password:'',
                phone:'',
                adress:'',
                marital_status:'',
                user:'',
                roles:[],
                files:null,
                arrayData:[],
                update:0,
            }
        },
        mounted: function() {
            let me = this;
            let url = '/api/roles' 
            axios.get(url,{}).then(function (response) {
                console.log(response.data.records);
                me.roles = response.data.records;
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
                    let url = '/api/users/delete' 
                    let Data_id = event.target.id
                    console.log(Data_id);
                    if (confirm('¿Seguro que deseas eliminar este registro?')) {
                        axios.post(url,{ 
                        'user_id': Data_id,
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
                let url = '/api/users/create' 
                const formData  = new FormData()
                if(this.files){
                    formData.append('file', this.files, this.files.name)
                }
                formData.append('name',this.name)
                formData.append('user',this.user)
                formData.append('rol',8)
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
                let url = '/api/users/edit' 
                const formData  = new FormData()
                console.log(this.files)
                if(this.files){
                   formData.append('file', this.files, this.files.name) 
               }
                formData.append('user_id',this.update)
                formData.append('name',this.name)
                formData.append('user',this.user)
                formData.append('rol',this.rol)
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
                let url = '/api/users/showid';
                axios.post(url,{ 
                    'user_id': this.update,
                }).then(function (response) {
                    me.user_id          = response.data.records.user_id;
                    me.name             = response.data.records.name;
                    me.rol              = response.data.records.rol_id;
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
                let url = '/api/users/delete' 
                let me = this;
                let Data_id = data.user_id
                console.log(Data_id);
                if (confirm('¿Seguro que deseas eliminar este registro?')) {
                    axios.post(url,{ 
                    'user_id': Data_id,
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
                this.user_id = "";
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