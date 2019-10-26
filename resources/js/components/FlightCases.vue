<template>
    <div class="container">
        <div class="row justify-content-center">
            
            <div class="col-md-8">
                    <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFlightcases(pagination.prev_page_url)">Previous</a></li>
                        <li  class="disabled"><a class="page-link text-dark"  >Page: {{pagination.current_page}} of {{pagination.last_page}} </a></li>
                        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="fetchFlightcases(pagination.next_page_url)">Next</a></li>
                    </ul>
                    </nav>
                    <div class="card card-body" v-for="flightcase in flightcases" v-bind:key="flightcase.casenumber">
                        <h3>Case number: {{ flightcase.casenumber }}</h3>
                        <p>Departure date: {{ flightcase.departuredate }}</p>
                        <p>Flight number: {{ flightcase.flightnumber }}</p>
                        <p>Booking number: {{ flightcase.bookingnumber }}</p>
                        <p>Issue type: {{ flightcase.issue }}</p>
                        <!--<button @click="deleteFlightcase" class="btn btn-danger"></button> -->
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
        }
    }

}

</script>
