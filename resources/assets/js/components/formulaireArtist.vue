
<template>
    <div class="container">
        <b-jumbotron>
            <template slot="header">
                Artiste
            </template>
            <div class="row">
                <b-btn v-b-toggle.collapse1 variant="primary">Tableau Artistes</b-btn>
                <b-btn v-b-toggle.collapse2 variant="primary">Artiste Via Api</b-btn>
            </div>
        </b-jumbotron>
        <!---------ARTISTE DB*************-->
        <div>

            <b-collapse id="collapse1" class="mt-2">
                <b-card>
                    <b-container fluid>
                        <!-- User Interface controls -->


                        <b-row>
                            <b-col md="4" class="my-1">
                                <b-form-group horizontal label="Filter" class="mb-0">
                                    <b-input-group>
                                        <b-form-input v-model="filter" placeholder="Type to Search" />
                                        <b-input-group-append>
                                            <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
                                        </b-input-group-append>
                                    </b-input-group>
                                </b-form-group>
                            </b-col>
                            <b-col md="4" class="my-1">
                                <b-form-group horizontal label="Sort" class="mb-0">
                                    <b-input-group>
                                        <b-form-select v-model="sortBy" :options="sortOptions">
                                            <option slot="first" :value="null">-- none --</option>
                                        </b-form-select>
                                        <b-form-select :disabled="!sortBy" v-model="sortDesc" slot="append">
                                            <option :value="false">Asc</option>
                                            <option :value="true">Desc</option>
                                        </b-form-select>
                                    </b-input-group>
                                </b-form-group>
                            </b-col>
                            <b-col md="4" class="my-1">
                                <b-form-group horizontal label="Per page" class="mb-0">
                                    <b-form-select :options="pageOptions" v-model="perPage" />
                                </b-form-group>
                            </b-col>
                            <!-- formulaire aJout Artiste-->
                            <b-col md="3" class="my-1">
                                <b-input-group>
                                    <b-form-input v-model="type" maxlength="10" placeholder="Nouveau Statut" required="required" class="form-control" />
                                    <b-input-group-append>
                                        <b-btn size="md" text="Button" variant="success" v-on:click="saveType()">Save</b-btn>
                                    </b-input-group-append>
                                </b-input-group>
                            </b-col>
                            <b-col md="3" class="my-1">
                                <b-form-select class = "mb-3" v-model="selected">
                                    <option v-for="option in options">{{option.type}}</option>
                                </b-form-select>
                            </b-col>
                            <b-col md="3" class="my-1">
                                <b-form-input v-model="nom" placeholder="nom" />
                            </b-col>
                            <b-col md="3" class="my-1">
                                <b-input-group>
                                    <b-form-input v-model="prenom" placeholder="prenom" />
                                    <b-input-group-append>
                                        <b-btn size="md" text="Button" variant="success" v-on:click="save()">Save</b-btn>
                                    </b-input-group-append>
                                </b-input-group>
                            </b-col>
                            <!-- formulaire aJout Artiste-->
                        </b-row>
                        <!-- Main table element -->
                        <b-table show-empty
                                 stacked="md"
                                 :items="items"
                                 :fields="fields"
                                 :current-page="currentPage"
                                 :per-page="perPage"
                                 :filter="filter"
                                 :sort-by.sync="sortBy"
                                 :sort-desc.sync="sortDesc"
                                 :sort-direction="sortDirection"
                                 @filtered="onFiltered"
                        >
                            <template slot="name" slot-scope="row">{{row.value.first}} {{row.value.last}}</template>

                            <template slot="actions" slot-scope="row">
                                <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->
                                <b-button size="md" variant="danger" v-on:click="suppr(row.item)">
                                    Delete
                                </b-button>
                                <b-button size="md" @click.stop="row.toggleDetails">
                                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                                </b-button>
                            </template>

                            <!--UPDATE*************************************-->
                            <template slot="row-details" slot-scope="row">
                                <b-card card-center>
                                    <b-form-group>
                                        <b-card>Id:{{ row.item.id}} <hr/>Slug:{{ row.item.slug }}</b-card>
                                        <b-card>
                                            <b-col md="6" class="my-1">
                                                <b-form-input v-model="nomup"  :value="row.item.nom" :placeholder="row.item.nom" />
                                            </b-col>
                                            <b-col md="6" class="my-1">

                                                <b-input-group>
                                                    <b-form-input v-model="prenomup" :value="row.item.prenom" :placeholder="row.item.prenom" />
                                                    <b-input-group-append>
                                                        <b-btn size="md" text="Button" variant="success" v-on:click="update(row.item)">Update</b-btn>
                                                    </b-input-group-append>
                                                </b-input-group>

                                            </b-col>
                                        </b-card>
                                    </b-form-group>
                                </b-card>
                            </template>
                            <!--Finish UPDATE*************************-->
                        </b-table>

                        <b-row>
                            <b-col md="6" class="my-1">
                                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
                            </b-col>
                        </b-row>



                    </b-container>
                </b-card>
            </b-collapse>
        </div>
        <!---------ARTISTE DB FINISH*************-->
        <!---------ARTISTE API START*************-->
        <div>

            <b-collapse id="collapse2" class="mt-2">
                <b-card>
                    <h1>test api</h1>
                    <apiartist></apiartist>
                </b-card>
            </b-collapse>

        </div>

        <!---------ARTISTE API FINISH*************-->



    </div>

</template>

<script>
    const items = []
    const options = []



    export default {
        data () {
            return {
                type:'',
                selected:null,
                options:[],
                nom:'',
                prenom:'',
                nomup:'',
                prenomup:'',
                slug:'',
                items: [],
                itemtmp:[],
                parisapi:[],
                fields: [
                    { key: 'created_at', label: 'date ajouter', sortable: true,hidden:true, sortDirection: 'desc','class': 'text-center'  },
                    { key: 'nom', label: 'Nom', sortable: true, sortDirection: 'desc','class': 'text-center',  },
                    { key: 'prenom', label: 'Prenom', sortable: true, 'class': 'text-center' },
                    { key: 'actions', label: 'Actions','class': 'text-center'  }
                ],
                currentPage: 1,
                perPage: 5,
                totalRows: items.length,
                pageOptions: [ 5, 10, 15 ],
                sortBy: null,
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                modalInfo: { title: '', content: '' },

            }
        },
        computed: {
            sortOptions () {
                // Create an options list from our fields
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => { return { text: f.label, value: f.key } })
            }
        },
        mounted(){
            axios.get('/artiste').then(response=>(this.items=response.data[0]));
            axios.get('/type').then(response=>(this.options=response.data));

        },
        methods: {
            getAndFormatDate(){
                return new Date().getFullYear()+"-"+new Date().getMonth()+"-"+new Date().getDate()+" "
                    +new Date().getHours()+":"+new Date().getMinutes()+":"+new Date().getSeconds()
            },
            saveType(){
                //console.log("ok nouveau type");
                axios.post('/type',{type:this.type})
                    .then((resutl)=>{
                        console.log(resutl.data),
                            this.type='',
                            this.options.unshift({
                                type:resutl.data.type
                            })
                    })
            },
            save(){

                axios.post('/artiste', {
                    prenom: this.prenom,
                    nom: this.nom,
                    slug:this.nom+this.prenom
                }).then((result)=>{
                    console.log(result.data),
                        this.items.unshift({
                            id:result.data.id,
                            nom:result.data.nom,
                            prenom:result.data.prenom,
                            slug:result.data.slug,
                            created_at:result.data.created_at})
                    console.log("type"+this.selected)
                    // axios.post('/type',{ type:this.selected}).then((result)=>console.log(result))
                           // axios.post('/artist_type',[this.slug,this.type]).then((result)=>console.log((result.data)))
                })
            },
            suppr(artist){
                axios.delete('/artiste/'+artist.id).then(function (response) {
                    console.log(response);
                })
                    .catch(function (error) {
                        console.log(error);
                    });
                //suppression de l'element dans tableau JS
                this.items.splice(this.items.indexOf(artist),1);


            },

            update(artist){
                if(this.nomup==="")
                    this.nomup=artist.nom;

                if(this.prenomup==="")
                    this.prenomup=artist.prenom;



                axios.put('/artiste/'+artist.id,{
                    prenom:this.prenomup,
                    nom:this.nomup,
                    slug:this.nomup+this.prenomup

                }).then(response=>{console.log(response)})
                this.items[this.items.indexOf(artist)]={nom:this.nomup,prenom:this.prenomup,slug:this.slug,created_at:artist.created_at}
                console.log(this.items)

            },


        },
        onFiltered (filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length
            this.currentPage = 0
        }
    }

</script>
