<template xmlns="http://www.w3.org/1999/html">

    <b-card>
        Fomrulaire Artiste
        <hr>

        <div class="row">

            <b-card-group deck >
                <div class="col-md-5">
                    <b-card>
                        <b-row>
                            <b-col sm="3"><label for="lastname">LastName:</label></b-col>
                            <b-col sm="9">
                                <b-form-input  v-model="lastname"  :state="null" type="text" placeholder="Last Name"></b-form-input>
                            </b-col>
                        </b-row>
                        <b-row>
                            <b-col sm="3"><label for="firstname">FirstName:</label></b-col>
                            <b-col sm="9">
                                <b-form-input  v-model="firstname":state="true" type="text" placeholder="First Name"></b-form-input>
                            </b-col>
                        </b-row>
                        <b-row>

                            <b-col sm="3"><label for="type">Job:</label></b-col>
                            <b-col sm="9">
                                <b-form-select v-model="job" :options="options" class="mb-3">
                                    <option v-for="type in types" >{{type.type}}</option>
                                </b-form-select>
                                <br/>
                                <b-input-group-append >
                                    <b-btn size="md" text="Button" variant="success" v-on:click="save()">Save</b-btn>
                                </b-input-group-append>
                            </b-col>


                        </b-row>
                    </b-card>
                </div>
                <div class="col-md-5">
                    <b-card>
                        <b-row>
                            <b-col sm="3"><label for="type">New Job:</label></b-col>
                            <b-col sm="9">
                                <b-form-input v-model="type":state="false" type="text" placeholder="Job"></b-form-input>
                                <br/>
                                <b-input-group-append >
                                    <b-btn size="md" text="Button" variant="success" v-on:click="saveJob()">Save</b-btn>
                                </b-input-group-append>
                            </b-col>


                        </b-row>
                    </b-card>
                </div>
            </b-card-group>

        </div>
    </b-card>

</template>

<script>
    export default {
        props:['types'],
        name: "FormsArtiste",
        date (){
            return{
                artiste:[],
                lastname: '',
                firstname: '',
                job: '',
            }
        },

        methods:{
            save(){
                //save Artiste
                axios.post('/artiste', {
                    firstname: this.firstname,
                    lastname: this.lastname,
                    job:this.job,
                }).then((result)=>{this.$emit('artiste',result.data)});
            },
            saveJob(){
                axios.post('/type',{type:this.type}).then((result)=>this.types.unshift(result.data))
            }

        }
    }
</script>

