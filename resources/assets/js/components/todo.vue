<template>
    <div>

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
      this.fetchTodos()
    }

  }
</script>
