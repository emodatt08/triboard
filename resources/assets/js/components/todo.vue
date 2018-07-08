    <template>
      <div>
      
        <!-- <div class ="card card-body mb-2" v-for = "todo in todos" v-bind:key ="todo.id">
            <h4>{{todo.title}}</h4>
            <p>{{todo.body}}</p>
            <hr/>
            <button class = "btn btn-danger" @click = "deleteTodo(todo.id)" >Delete</button>
        </div> -->


  <div class="row" v-for = "todo in todos" v-bind:key ="todo.id" style="width:420px; left:20px; display: inline-block; margin-right: 40px;">
    <div class="col s12 m4" style="width:100%;">
      
      <div class="card blue-grey darken-1 right-align "  >
       
       <div class="card-content white-text">
          <span class="card-title">{{todo.title}}</span>
          <p>{{todo.body}}</p>
        </div>
        <div class="card-action">
          <a href="#" @click = "deleteTodo(todo.id)">Delete</a>
        </div>
      </div>
    </div>
  </div>
          <ul class="pagination">
          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" ><a href="#!" @click="fetchTodos(pagination.prev_page_url)">previous</a></li>
          <li class="page-item disabled"><a href="#">Page {{pagination.current_page}} Of {{pagination.last_page}}</a></li>
          <li v-bind:class="[{disabled: !pagination.next_page_url}]"><a href="#!"  @click="fetchTodos(pagination.next_page_url)">next</a></li>
        </ul>
          <a class="btn-floating waves-effect waves-light btn-large orange darken-3 right"><i class="material-icons">add</i></a>
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
          fetch(`api/todos/${todo_id}`, {
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
