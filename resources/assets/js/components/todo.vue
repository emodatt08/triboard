    <template>
      <div>
      
        <div class ="card card-body mb-2" v-for = "todo in todos" v-bind:key ="todo.id">
            <h4>{{todo.title}}</h4>
            <p>{{todo.body}}</p>
            <hr/>
            <button class = "btn btn-danger" @click = "deleteTodo(todo.id)" >Delete</button>
        </div>
          <ul class="pagination">
          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" ><a href="#!" @click="fetchTodos(pagination.prev_page_url)">previous</a></li>
          <li class="page-item disabled"><a href="#">Page {{pagination.current_page}} Of {{pagination.last_page}}</a></li>
          <li v-bind:class="[{disabled: !pagination.next_page_url}]"><a href="#!"  @click="fetchTodos(pagination.next_page_url)">next</a></li>
        </ul>
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
      fetchTodos(page_url){
        let vm = this;
        page_url = page_url || 'api/todos';
        fetch(page_url).then(res => res.json()).then(res =>{
            this.todos = res.data;
            vm.makePagination(res.meta, res.links);
        }).catch(err => console.log(err))
      },

      makePagination(meta, links){
        let pagination = {
          current_page  : meta.current_page,
          last_page: meta.last_page,
          last_page_url : links.last,
          next_page_url : links.next,
          prev_page_url : links.prev
        };
        this.pagination = pagination;
      },
    deleteTodo(todo_id){
      if(confirm("Are you sure?")){
          fetch(`/api/todo/${todo_id}`, {
            method:'DELETE',

          }).then(res => res.json()).then(data => {
            alert("Todo item removed");
            this.fetchTodos();
          }).catch(err =>console.log(err))
      }
      
    }
    }

  }
</script>
