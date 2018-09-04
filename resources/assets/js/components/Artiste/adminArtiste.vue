
<template>
    <div class="container-fluid">
        <section class="content-header">

            <h1>
                Admin Artiste

            </h1>
            <div class="row">
                <b-btn v-b-toggle.collapse1 variant="primary">Formulaire Artiste</b-btn>
                <b-btn v-b-toggle.collapse2 variant="primary">Tableau des Artistes</b-btn>
                <b-btn v-b-toggle.collapse3 variant="primary">Artiste Via Api</b-btn>
            </div>
        </section>
        <br>
        <div>
            <b-collapse id="collapse1">
                <forms-artiste v-on:artiste="setItems($event)" :types="types"></forms-artiste>
            </b-collapse>
        </div>
        <div>
            <b-collapse id="collapse2" class="mt-2">
                <b-card>
                    <tab-artiste v-on:delArtiste="delArtiste($event) " v-on:artiste="updateArtiste($event)" :items="items" ></tab-artiste>
                </b-card>
            </b-collapse>
        </div>
        <div>
            <b-collapse id="collapse3" class="mt-2">
                <b-card>
                    <api-artiste v-on:artiste="setItems($event)"></api-artiste>
                </b-card>
            </b-collapse>
        </div>





    </div>

</template>

<script>

    const options = []



    export default {
        data() {
            return {
                items: [],
                update: [],
                types:[]
            }
        },

        mounted() {
            axios.get('/artiste').then(response => (this.items = response.data));
            axios.get('/type').then(response => (this.types=response.data));

        },
        methods: {
            /* saveType() {
                 //console.log("ok nouveau type");
                 axios.post('/type', {type: this.type})
                     .then((resutl) => {
                         console.log(resutl.data),
                             this.type = '',
                             this.options.unshift({
                                 type: resutl.data.type
                             })
                     })
             },*/

            setItems(artiste) {
                this.items.unshift(artiste);
            },

            updateArtiste(artiste) {
                this.update = artiste,
                    this.items[this.items.indexOf(artiste[0])] = {
                        lastname: artiste[2],
                        firstname: artiste[1],
                        id: artiste[3]
                    }
                console.log(artiste)

            },

            delItem(id){
                this.items.splice(this.items[this.items.indexOf(id)],1);
            },

            delArtiste(artiste) {
                console.log("test")
                if(Array.isArray(artiste)) {
                    var i;
                    for (i = 0; i < artiste.length; i++) {
                        this.delItem(artiste[i])
                    }

                }else {
                    this.delItem(artiste.id)
                }
            }
        }

    }



</script>
