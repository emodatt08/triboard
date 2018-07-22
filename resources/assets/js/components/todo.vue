    <template>
      <div>
      
        <!-- <div class ="card card-body mb-2" v-for = "todo in todos" v-bind:key ="todo.id">
            <h4>{{todo.title}}</h4>
            <p>{{todo.body}}</p>
            <hr/>
            <button class = "btn btn-danger" @click = "deleteTodo(todo.id)" >Delete</button>
        </div> -->

<div class="row" style="padding-top:15px;">
    <form class="col s12"  @submit.prevent="addTodo">
      <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">title</i>
          <input id="icon_prefix" type="text" placeholder="Title" v-model ="todo.title" class="validate">
          <label for="icon_prefix">Title</label>
        </div>
        <div class="input-field col s6">
          <i class="material-icons prefix">assignment</i>
            <textarea  placeholder="Body" class="materialize-textarea" v-model ="todo.body" ></textarea>
          <label for="icon_telephone">Body</label>
        </div>
      </div>

      <button type="submit" class = "btn bottom orange darken-3 right"> <i class="material-icons left">cloud_done</i>save</button>
    </form>
  </div>
  

<!-- <form @submit.prevent="addTodo">
 <div class="form-group">
   <input type="text" class="form-control" placeholder="Title" v-model ="todo.title" >
 </div>
 <div class="form-group">
   <textarea  placeholder="Body" class="materialize-textarea" v-model ="todo.body" ></textarea>
 </div>
<button type="submit" class = "btn bottom orange darken-3 right">store</button> -->

<!-- </form> -->
  <div class="row" v-for = "todo in todos" v-bind:key ="todo.id" style="width:420px; left:20px; display: inline-block; margin-right: 40px;">
    <div class="col s12 m4" style="width:100%;">
      
      <div class="card blue-grey darken-1 right-align "  >
       
       <div class="card-content white-text">
          <span class="card-title">{{todo.title}}</span>
          <p>{{todo.body}}</p>
        </div>
        <div class="card-action">
          <a href="#" @click = "deleteTodo(todo.id)">Delete</a>
          <a href="#" @click = "editTodo(todo)">Edit</a>
        </div>
        
      </div>
    </div>
  </div>
          <ul class="pagination">
          <li v-bind:class="[{disabled: !pagination.prev_page_url}]" ><a href="#!" @click="fetchTodos(pagination.prev_page_url)">previous</a></li>
          <li class="page-item disabled"><a href="#">Page {{pagination.current_page}} Of {{pagination.last_page}}</a></li>
          <li v-bind:class="[{disabled: !pagination.next_page_url}]"><a href="#!"  @click="fetchTodos(pagination.next_page_url)">next</a></li>
          <!-- <li> <a class="btn-floating waves-effect waves-light btn-large orange darken-3 right"><i class="material-icons">add</i></a></li> -->
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
          fetch(`api/todos/${todo_id}`, {
            method:'DELETE',

          }).then(res => res.json()).then(data => {
            alert("Todo item removed");
            this.fetchTodos();
          }).catch(err =>console.log(err));
      }
      
    },
    addTodo(){
      if(this.edit === false){
          //add
          fetch('api/todos', {
            method:'POST',
            body: JSON.stringify(this.todo),
            headers:{
              'Content-type': 'application/json'
            }
          }).then(res => res.json()).then(
            data => {
              this.todo.title = "";
              this.todo.body = "";
              alert("Todo added Successfully");
              this.fetchTodos();
            }
          ).catch(err => console.log(err))
      }else{
        //update
         fetch('api/todos', {
            method:'PUT',
            body: JSON.stringify(this.todo),
            headers:{
              'Content-type': 'application/json'
            }
          }).then(res => res.json()).then(
            data => {
              this.todo.title = "";
              this.todo.body = "";
              alert("Todo updated Successfully");
              this.fetchTodos();
              window.location.reload(true);
            }).catch(err => console.log(err))
        }
    },
    editTodo(todo){
      this.edit = true;
      this.todo.id = todo.id;
      this.todo.todo_id = todo.id;
      this.todo.title = todo.title;
      this.todo.body = todo.body;
    }
    }

  }
</script>
