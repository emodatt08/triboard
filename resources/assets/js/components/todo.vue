<template>
  <div>
    <div class ="card card-body mb-2" v-for = "todo in todos" v-bind:key ="todo.id">
        <h3>{{todo.title}}</h3>
        <p>{{todo.body}}</p>
    </div>
  </div>
</template>

<script>

  export default{
    data(){
      return{
        todos:[],
          todo:{
            'id': '',
            'title': '',
            'body' : ''
          },
          todo_id:'',
          pagination:{},
          edit: false


      }
    },

    created(){
      this.fetchTodos();
    },
    /** method to fetch all todo items */
    methods:{
      fetchTodos(){
        fetch('api/todos').then(res => res.json()).then(res =>{
            this.todos = res.data;
        })
      }
    }

  }
</script>
