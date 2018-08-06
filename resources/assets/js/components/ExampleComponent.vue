<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>

                    <ul>
                      <li v-for="topic in topics">
                        {{ topic.title }}
                      </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
          return {
            topics: []
          }
        },
        mounted() {
            // console.log('Component mounted.')
            // request data?
            axios.get('/api/topics')
               .then((response) => {
                //  console.log(response.data)
                this.topics = response.data
               })
        }
    }
</script>
