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
                                        <label>No. solicitud</label>
                                        <input type="text" class="form-control" v-model="name" disabled />
                                    </div>
                                </div>
                            </tab-content>
                            <tab-content :key="1" :title="titulo_2" >
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <label>No. solicitud</label>
                                        <input type="text" class="form-control" v-model="name" disabled />
                                    </div>
                                    <div class="col-sm-3" >
                                        <label>No. solicitud</label>
                                        <input type="text" class="form-control" v-model="name" disabled />
                                    </div>
                                </div>
                            </tab-content>
                            <tab-content :key="2" :title="titulo_3" >
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <label>ASD</label>
                                        <input type="text" class="form-control" v-model="name" disabled />
                                    </div>
                                </div>
                            </tab-content>
                            <tab-content :key="3" :title="titulo_4" >
                                <div class="row">
                                    <div class="col-sm-3" >
                                        <label>ASD</label>
                                        <input type="text" class="form-control" v-model="name" disabled />
                                    </div>
                                </div>
                            </tab-content>
                        </form-wizard>
                    </div>
                    <div class="modal-footer">
                        <div id="boton-guardar">
                            <button v-on:click.stop="onCompleteWizard" class="btn btn-primary" style="float:right;margin-right:20px;margin-bottom:20px">Guardar Cambios</button>
                        </div>
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
                titulo_1:"INMUEBLE",
                titulo_2:"DETALLES",
                titulo_3:"AMENIDADES",
                titulo_4:"ARBITRIOS",
                propierty_id:"",
                name:"",
                account:"",
                status:"",
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
                console.log("test");
            },
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
                let url = '/api/propierty/showid/';
                axios.post(url,{ 
                    'propierty_id': this.update,
                }).then(function (response) {
                    me.propierty_id          = response.data.records.propierty_id;
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