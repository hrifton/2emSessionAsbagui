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
                <b-form-group horizontal label="Per page" class="mb-0">
                    <b-form-select :options="pageOptions" v-model="perPage" />
                </b-form-group>
            </b-col>
        </b-row>

        <!-- Main table element -->
        <b-table class="table table-bordered table-striped" show-empty
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
            <template slot="isActive" slot-scope="row">{{row.value?'Yes :)':'No :('}}</template>
            <template slot="actions" slot-scope="row">
                <b-button class="btn btn-success" size="sm" @click.stop="row.toggleDetails">Update</b-button>
                <b-btn  size="sm" text="Button" variant="danger" v-on:click="supp(row.item)">Delete</b-btn>


            </template>
            <template slot="delete" slot-scope="row">

                <b-form-checkbox v-model="deleteID":value="row.item.id"></b-form-checkbox>


            </template>

            <template slot="row-details" slot-scope="row">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">ID : {{row.item.id}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="lastname" class="col-sm-2 control-label">LastName</label>

                                <div class="col-sm-10">
                                    <b-form-input  v-model="lastnameup" :value="row.item.lastname" type="text"></b-form-input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="col-sm-2 control-label">FirstName</label>

                                <div class="col-sm-10">
                                    <b-form-input  v-model="firstnameup" :value="row.item.firstname" type="text"></b-form-input>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <b-btn class="pull-right" size="md" text="Button" variant="danger" v-on:click="supp(row.item)">Delete</b-btn>
                            <b-btn class="pull-right" size="md" text="Button" variant="success" v-on:click="update(row.item)">Update</b-btn>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </template>
        </b-table>
        <b-btn class="pull-right" size="md" text="Button" variant="danger" v-on:click="multiDel(deleteID)" >Delete</b-btn>
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
        props:['items'],
        data () {
            return {
                deleteID:[],
                artiste:[],
                lastname:'',
                firstname:'',
                lastnameup:'',
                firstnameup:'',
                fields: [
                    { key: 'id', label: 'ID' },
                    { key: 'lastname', label: 'LastName', sortable: true, sortDirection: 'desc' },
                    { key: 'firstname', label: 'FirstName', sortable: true, 'class': 'text-center' },
                    { key: 'actions', label: 'Actions' },
                    { key: 'delete', label: 'Delete' }
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
            }

        },

        methods: {
            update(artist){
                if(this.lastnameup==="")
                    this.lastnameup=artist.lastname;

                if(this.firstnameup==="")
                    this.firstnameup=artist.firstname;

                axios.put('/artiste/'+artist.id,{
                    firstname:this.firstnameup,
                    lastname:this.lastnameup,
                }).then(result=>{this.$emit('artiste',[artist,this.firstnameup,this.lastnameup,artist.id])
                    this.firstnameup= this.firstname
                    this.lastnameup=this.lastname

                });
            },
            supp(artist){
                console.log("delete one")
                axios.delete('/artiste/'+artist.id)
                    .then(result=>{this.$emit('delArtiste',artist)})
                console.log(result.data);
                artist=null

            },
            multiDel(del){
                console.log(del)
                axios.delete('/artiste/'+del)
                    .then(result=>{this.$emit('delArtiste',del)})

            },

            /**
             * Fonctionnalité du tableau
             * @param item
             * @param index
             * @param button
             */

            info (item, index, button) {
                this.modalInfo.title = `Row index: ${index}`
                this.modalInfo.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', 'modalInfo', button)
            },
            resetModal () {
                this.modalInfo.title = ''
                this.modalInfo.content = ''
            },
            onFiltered (filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        }
    }
</script>
