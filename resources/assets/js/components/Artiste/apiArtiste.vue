
<<template>
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
            <template slot="isActive" slot-scope="row">{{row.value?'Yes :)':'No :('}}</template>
            <template slot="actions" slot-scope="row">
                <b-input-group-append >
                    <b-btn size="md" text="Button" variant="success" v-on:click="save(row.item)">Save</b-btn>
                </b-input-group-append>
            </template>


        </b-table>

        <b-row>
            <b-col md="6" class="my-1">
                <b-pagination :total-rows="totalRows" :per-page="perPage" v-model="currentPage" class="my-0" />
            </b-col>
        </b-row>

        <!-- Info modal -->

    </b-container>
</template>

<script>
    const items = []

    export default {
        data () {
            return {
                items: items,
                fields: [
                    { key: '0', label: 'FirstName', sortable: true, sortDirection: 'desc' },
                    { key: '1', label: 'LastName', sortable: true, 'class': 'text-center' },
                    { key: '2', label: 'Job' },
                    { key: 'actions', label: 'Actions' }
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
        mounted() {
            axios.get('/ApiArtiste ').then(response => (this.items = response.data));

        },
        methods: {
            save(artiste){

                //save Artiste
                axios.post('/artiste', {
                    firstname: artiste[0],
                    lastname: artiste[1],
                    job:artiste[2],
                }).then((result)=>{this.$emit('artiste',result.data)});
                this.isFind(artiste)
            },

            isFind(artiste){
                console.log(artiste)
                var i
                for(i=0; this.items.length>i;i++){
                    if(this.items[i]==artiste){
                        this.items.splice(i,1);
                    }
                }
                console.log(this.items)

            },
            info (item, index, button) {
                this.modalInfo.title = `Row index: ${index}`
                this.modalInfo.content = JSON.stringify(item, null, 2)
                this.$root.$emit('bv::show::modal', 'modalInfo', button)
            },

            onFiltered (filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        }
    }
</script>
