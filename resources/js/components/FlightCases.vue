<template>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-8">

                <!-- Form to add a new case -->

                <div class="card card-body">
                    <h2>Add a new case</h2><br>
                    <form @submit.prevent="addFlightcase">
                    <div class="form-group">
                        <input type="text" class="form-control" required placeholder="Case number" v-model="flightcase.casenumber">
                    </div>
                    <div class="form-group">
                        <input type="date" class="form-control" required placeholder="Departure date" v-model="flightcase.departuredate">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" required placeholder="Flight number" v-model="flightcase.flightnumber">
                    </div>
                     <div class="form-group">
                        <input type="text" class="form-control" required placeholder="Booking number" v-model="flightcase.bookingnumber">
                    </div>
                    <div class="form-group">
                         <select class="custom-select form-control" required v-model="flightcase.issue" @change="handleChange">
                            <option value="" selected disabled> Issue type</option>
                            <option value="Cancellation">Cancellation</option>
                            <option value="Delay">Delay</option>
                            <option value="Overbooking">Overbooking</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-light btn-block"> Save</button>
                    </form>
                </div>
                <br>

                <!-- Page navigation -->

                <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFlightcases(pagination.prev_page_url)">Previous</a></li>
                    <li  class="disabled"><a class="page-link text-dark"  >Page: {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFlightcases(pagination.next_page_url)">Next</a></li>
                </ul>
                </nav>

                <!-- Display cases -->

                <div  v-for="flightcase in flightcases" v-bind:key="flightcase.casenumber">
                <div class="card card-body">
                    <div class="row">
                        <div class="col">
                            <h3><strong>Case number:</strong> {{ flightcase.casenumber }}</h3>
                            <p><strong>Departure date:</strong> {{ flightcase.departuredate }}</p>
                            <p><strong>Flight number:</strong> {{ flightcase.flightnumber }}</p>
                            <p><strong>Booking number:</strong> {{ flightcase.bookingnumber }}</p>
                            <p><strong>Issue type:</strong> {{ flightcase.issue }}</p>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".add-passenger-modal">Add passenger</button>
                                    <div id="add-passenger-modal" class="modal fade add-passenger-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="card card-body">
                                            <h2>Add a new passenger</h2><br>
                                            <form @submit.prevent="addPassenger">
                                            <div class="form-group">
                                                <input type="text" class="form-control" hidden v-model="passenger.id">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Case number" v-model="passenger.casenumber">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Firstname" v-model="passenger.firstname">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Lastname" v-model="passenger.lastname">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Email" v-model="passenger.email">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Phone" v-model="passenger.phone">
                                            </div>
                                            <button type="submit" class="btn btn-light btn-block">Save</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                        </div>
                        
                        <div class="col">
                            <h3>Passengers: </h3>
                            <div v-for="passenger in flightcase.passengers" v-bind:key="passenger.id">
                                <div class="card card-body">
                                    <p><strong>First name:</strong> {{ passenger.firstname }}</p>
                                    <p><strong>Last name:</strong> {{ passenger.lastname }}</p>
                                    <p><strong>Email:</strong> {{ passenger.email }}</p>
                                    <p><strong>Mobile number:</strong> {{ passenger.phone }}</p>
                                    <button @click="editPassenger(passenger)" class="btn btn-outline-secondary" data-toggle="modal" data-target=".add-passenger-modal"> Edit</button><br>
                                    <button @click="deletePassenger(passenger.id)" class="btn btn-danger"> Delete</button> 
                                </div><br>
                            </div>
                            
                        </div>
                    </div>
                    <br>
                    <button @click="editFlightcase(flightcase)" class="btn btn-outline-secondary"> Edit</button><br>
                    <button @click="deleteFlightcase(flightcase.casenumber)" class="btn btn-danger"> Delete</button> 
                </div>
                <br>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return{
            flightcases:[],
            flightcase: {
                casenumber: '',
                departuredate: '',
                flightnumber: '',
                bookingnumber: '',
                issue: ''
            },
            passenger:{
                casenumber: '',
                firstname: '',
                lastname: '',
                email: '',
                phone: ''
            },
            flightcase_number: '',
            pagination:{},
            edit:false
        }
    },
    created(){
            this.fetchFlightcases();
    },
    methods:{
        fetchFlightcases(page_url){
            let vm = this;
            page_url = page_url || 'api/flightcases'
            fetch(page_url)
                .then(res=>res.json())
                .then(res=>{
                    this.flightcases = res.data;
                    vm.makePagination(res.meta, res.links);
                })
                .catch(err=> console.log(err))
        },
        makePagination(meta, links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }
            
            this.pagination = pagination
        },
        deleteFlightcase(id){
            if(confirm("Are you sure you would like to delete the flightcase with id " + id)){
                fetch(`api/flightcase/${id}`, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    alert('Flightcase removed')
                    this.fetchFlightcases();
                })
            }
        },
        handleChange(e) {
            if(e.target.options.selectedIndex > -1) {
                this.flightcase.issue = this.flightcase.issue;

            }
        }      
        ,
        addFlightcase(){
            if(this.edit===false){
                //ADD
                fetch('api/flightcase', {
                    method: 'post',
                    body: JSON.stringify(this.flightcase),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json)
                .then(data => {
                    this.flightcase.casenumber = '';
                    this.flightcase.departuredate = '';
                    this.flightcase.flightnumber = '';
                    this.flightcase.bookingnumber = '';
                    this.flightcase.issue = '';
                    alert('Case added');
                    this.fetchFlightcases();
                })
                .catch(err => console.log(err))
            }else{
                //UPDATE
                fetch('api/flightcase', {
                    method: 'put',
                    body: JSON.stringify(this.flightcase),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json)
                .then(data => {
                    this.flightcase.casenumber = '';
                    this.flightcase.departuredate = '';
                    this.flightcase.flightnumber = '';
                    this.flightcase.bookingnumber = '';
                    this.flightcase.issue = '';
                    alert('Case updated');
                    this.fetchFlightcases();
                })
                .catch(err => console.log(err))
            }
        },
        editFlightcase(flightcase){
            this.edit = true;
            this.flightcase.casenumber = flightcase.casenumber;
            this.flightcase.departuredate = flightcase.departuredate;
            this.flightcase.flightnumber = flightcase.flightnumber;
            this.flightcase.bookingnumber = flightcase.bookingnumber;
            this.flightcase.issue = flightcase.issue;
        },
        addPassenger(passenger){
            if(this.edit===false){
                //ADD
                delete this.passenger.id;
                fetch('api/passenger', {
                    method: 'post',
                    body: JSON.stringify(this.passenger),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json)
                .then(data => {
                    this.passenger.id = '';
                    this.passenger.casenumber = '';
                    this.passenger.firstname = '';
                    this.passenger.lastname = '';
                    this.passenger.email = '';
                    this.passenger.phone = '';
                    alert('Passenger added');
                    this.fetchFlightcases();
                })
                .catch(err => console.log(err))
            }else{
                //UPDATE
                fetch('api/passenger', {
                    method: 'put',
                    body: JSON.stringify(this.passenger),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json)
                .then(data => {
                    this.passenger.id = '';
                    this.passenger.casenumber = '';
                    this.passenger.firstname = '';
                    this.passenger.lastname = '';
                    this.passenger.email = '';
                    this.passenger.phone = '';
                    alert('Passenger updated');
                    this.fetchFlightcases();
                })
                .catch(err => console.log(err))
            }
        },
        editPassenger(passenger){
            this.edit = true;
            this.passenger.id = passenger.id;
            this.passenger.casenumber = passenger.casenumber;
            this.passenger.firstname = passenger.firstname;
            this.passenger.lastname = passenger.lastname;
            this.passenger.email = passenger.email;
            this.passenger.phone = passenger.phone;
        },
        deletePassenger(id){
            if(confirm("Are you sure you would like to delete this passenger? ")){
                fetch(`api/passenger/${id}`, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    alert('Passenger removed')
                    this.fetchFlightcases();
                })
            }
        },
    }

}

</script>
