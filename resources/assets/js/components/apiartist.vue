<template>
    <b-container fluid>
        <!-- User Interface controls -->
        <b-row>
            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Filter" class="mb-0">
                    <b-input-group>
                        <b-form-input v-model="filter" placeholder="Type to Search" />
                        <b-input-group-append>
                            <b-btn :disabled="!filter" @click="filter = ''">Clear</b-btn>
                        </b-input-group-append>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col md="6" class="my-1">
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
            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Sort direction" class="mb-0">
                    <b-input-group>
                        <b-form-select v-model="sortDirection" slot="append">
                            <option value="asc">Asc</option>
                            <option value="desc">Desc</option>
                            <option value="last">Last</option>
                        </b-form-select>
                    </b-input-group>
                </b-form-group>
            </b-col>
            <b-col md="6" class="my-1">
                <b-form-group horizontal label="Per page" class="mb-0">
                    <b-form-select :options="pageOptions" v-model="perPage" />
                </b-form-group>
            </b-col>
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

        >
            <template slot="name" slot-scope="row">{{row.value}} {{row.familyName}}</template>
            <template slot="actions" slot-scope="row">
                <!-- We use @click.stop here to prevent a 'row-clicked' event from also happening -->

                <b-button size="sm" @click.stop="row.toggleDetails">
                    {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
                </b-button>
                <b-button size="sm" variant="success" v-on:click="save(row.item)">
                    Ajouter
                </b-button>
            </template>
            <template slot="row-details" slot-scope="row">
                <b-card card-center>
                    <b-form-group>
                        <b-card>
                            <div class="row"><div class="col-4">Nom: {{ row.item.familyName }}</div>
                                <div class="col-4">Prnom: {{ row.item.name }}</div>
                                <div class="col-4">Slug: {{ row.item.slug }}</div><div class="col-4">jobTitle: {{ row.item.jobTitle }}</div></div>
                        </b-card>
                    </b-form-group>
                </b-card>
            </template>
        </b-table>

        <b-row>
            <b-col md="6" class="my-1">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>

        <!-- Info modal -->
        <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
            <pre>{{ modalInfo.content }}</pre>
        </b-modal>

    </b-container>
</template>

<script>
    const items = []
    export default {
        data () {
            return {
                items:'',
                fields: [
                    { key: 'familyName', label: 'Nom', sortable: true, sortDirection: 'desc' },
                    { key: 'name', label: 'Prenom', sortable: true, 'class': 'text-center' },
                    { key: 'jobTitle', label: 'statut', sortable: true, 'class': 'text-center' },
                    { key: 'actions', label: 'Actions' },

                ],
                currentPage: 1,
                perPage: 5,
                totalRows: items.length,
                pageOptions: [ 5, 10, 15 ],
                sortBy: null,
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                modalInfo: { title: '', content: '' }
            }
        },
        computed: {
            sortOptions () {
                // Create an options list from our fields
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => { return { text: f.label, value: f.key } })
            },


        },
        mounted(){
            axios.get('/artiste').then(response=>(this.items=response.data[1]));

        },
        methods: {
            savetype(artist){
                console.log("go type"),
                    axios.post('/type',{type:artist}).then((result)=>(console.log(result)))
            },
            saveArtistType(slug,type){
                console.log(slug+' +++++++   '+type)
                axios.post('/artiste_type',{slug:slug,
                    type:type}).then((result)=>(console.log(result)))
            },
            save(artist){

                axios.post('/artiste', {
                    prenom: artist.name,
                    nom: artist.familyName,
                    slug:artist.slug,
                    type:artist.jobTitle,

                }).then((result)=>{console.log(result)
                    , this.items.splice(this.items.indexOf(artist),1)
                });
                this.savetype(artist.jobTitle);

                    this.saveArtistType(artist.slug,artist.jobTitle)



            },



            info (item, index, button) {
                this.modalInfo.title = `Row index: ${index}`
                this.modalInfo.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', 'modalInfo', button)
            },
            resetModal () {
                this.modalInfo.title = ''
                this.modalInfo.content = ''
            },

        }
    }
</script>

