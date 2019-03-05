@extends('layouts.app')

@section('title', 'Moving Well - Dashboard')

@section('content')
<div id="app">

    <div class="container is-fluid">

{{--         @if(Session::has('status'))

            @include('messages.success')
            {{ Session::forget('status') }}

        @endif --}}

        <div class="notification is-success" v-if="confirmDeleteMessage">
            @{{confirmDeleteMessage.message}}
        </div>

        <div class="notification is-warning" v-if="searchResult.errorMessage">
            @{{searchResult.errorMessage}}
        </div>


        <div class="columns">
            <div class="column">
                <div class="field">
                  <div class="control">
                    <input class="input is-medium" type="text" placeholder="Zadejte nadpis článeku" v-on:keyup="searchit" v-model="search">
                    <p v-for="result in searchResult">
                        <a v-bind:href="result.link">@{{result.title}}</a>
                    </p>

                  </div>
                </div>
                <table class="table">
                    
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Cover picture</th>
                            <th>Category</th>
                            <th>Publish</th>
                            <th>Author</th>
                            <th>Created at</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($articles as $article)
                            <tr>
                                <th scope="row">{{ $article->id}}</th>
                                <td>{{ str_limit($article->title, 30)}}</td>
                                <td><strong>{{ ($article->cover_picture) ? 'Yes' : 'No' }}</strong></td>
                                <td><span class="tag is-light is-medium">{{ $article->category->name }}</span></td>
                                <td>

                                    @if($article->publish) 
                                        <form method="POST" action="{{route('status.publish', $article->id)}}">
                                        @csrf
                                          @method('PUT')
                                            <button v-on:click="changePublish({{json_encode($article)}})"  type="submit" class="button is-success">Active</button>
                                        </form>

                                    @else 
                                        <form method="POST" action="{{route('status.publish', $article->id)}}">
                                        @csrf
                                          @method('PUT')
                                            <button v-on:click="changePublish({{json_encode($article)}})" type="submit" class="button is-warning">Inactive</button> 
                                        </form>
                                    @endif

                                </td>
                                <td>{{ $article->author}}</td>
                                <td>{{ date("d F Y, g:i a", strtotime($article->created_at)) }}</td>
                                <td><a href="{{route('articles.show', ['kategorie'=>strtolower($article->category->name), 'clanek'=>strtolower($article->slug)])}}" target="_blank" class="button is-link">View</a></td>
                                <td>
                                    <form action="{{route('edit.article', $article->id)}}">
                                        <button class="button is-info">Edit</button>
                                    </form>
{{--                                     <button 
                                        v-on:click="openModal({{json_encode($article)}})"
                                        data-toggle="modal" 
                                        data-target="#edit" 
                                        class="button is-info">Edit
                                    </button> --}}

                                </td>
                                <td>
                                 {{--    <form action="{{ route('article.destroy', $article->id)}}" method="POST"> --}}
                                        {{-- @csrf --}}
                                 
                                        <button v-on:click="deleteArticle({{json_encode($article)}})" type="submit" class="button is-danger">Delete</button>
                               {{--      </form> --}}
                                </td>
                            </tr>
                        @endforeach
                      
                    </tbody>
                </table>
                
                {{$articles->links()}}
            </div>
        </div>
    </div>

{{--     <div class="modal" v-bind:class="[toogleModal ? 'is-active' : '']">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Edit article</p>
          <button v-on:click="closeModal" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">

            <div class="field">
              <div class="control">
                <input v-model="placeHolderArticle.title" class="input is-medium" type="text" name="title" placeholder="Primary input">
              </div>
            </div>

            <div class="field">
              <div class="control">
                <textarea v-model="placeHolderArticle.content" class="textarea is-medium" rows="15"></textarea>
              </div>
            </div>


        </section>
        <footer class="modal-card-foot">
          <button v-on:click="sendReqestUpdate(placeHolderArticle)" class="button is-success">Save changes</button>
          <button v-on:click="closeModal" class="button">Cancel</button>
        </footer>
      </div>
    </div> --}}
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>

<script type="text/javascript">

    const  app = new Vue({
        el: '#app',
        data: {
          toogleModal: false,
          placeHolderArticle: '',
          publishStatus: '',
          publishStatusText: '',

          alertConfirmDelete: false,
          confirmDeleteMessage: '',
          search: '',
          searchResult: '',
          test: '',

        },

        methods: {

          refreshPage: function() {

            if(this.alertConfirmDelete == true) {

              setTimeout(function(){ 
                window.location.reload(true);
              }, 2500);
            }
            
          },

          openModal: function(article) {
            //console.log(article);
            this.placeHolderArticle = article;
            this.toogleModal = true;
            
          },

          closeModal: function () {
            this.toogleModal = false;
            this.placeHolderArticle = '';
          },

          sendReqestUpdate: function (article) {
            event.preventDefault();

            const confirm = this;
            axios.post('/article/' + article.id,  {
                title:        this.placeHolderArticle.title,
                content:      this.placeHolderArticle.content,
                category_id:  this.placeHolderArticle.category_id,
                publish:      this.placeHolderArticle.publish,
              })
              .then(function (response) {
               

                if(response.status === 200 && response.statusText === 'OK') {
                  confirm.toogleModal = false;
                  confirm.placeHolderArticle = '';
                }
              })
              .catch(function (error) {
                console.log(error);
              });
          },

          changePublish: function(article) {

            //event.preventDefault();
            this.publishStatus = article.publish;
            if(article.publish == 1) {
              //axios 
              const confirm = this;
              axios.put('/publish/' + article.id,  {
                  publish:      article.publish = 0
                })
                .then(function (response) {   

                  if(response.status === 200 && response.statusText === 'OK') {
                    //confirm.toogleModal = false;
                    //confirm.placeHolderArticle = '';
                  }
                })
                .catch(function (error) {
                  console.log(error);
                });
            } else if(article.publish == 0) {
              //set articles publish to 0 and axios

              const confirm = this;
              axios.put('/publish/' + article.id,  {
                  publish:      article.publish = 1
                })
                .then(function (response) {   

                  if(response.status === 200 && response.statusText === 'OK') {
                    //confirm.toogleModal = false;
                    //confirm.placeHolderArticle = '';
                  }
                })
                .catch(function (error) {
                  console.log(error);
                });
            }
          },

          deleteArticle: function(id) {
            this.alertConfirmDelete = confirm('Are you sure that you want to remove the article? '+id.title+' ');
            
              if(this.alertConfirmDelete) {
                //do axios 

                const confirm = this;
                axios.delete('/article/' + id.id,  {
                  id: id.id
              })
              .then(function (response) {
               

                if(response.status === 200 && response.statusText === 'OK') {
                  
                  confirm.confirmDeleteMessage = response.data;
                }
              })
              .catch(function (error) {
                console.log(error);
              });

              } else {
                //do nothing

              }

              this.refreshPage();
          },

          searchit: function() {
            if(this.search !== '') { 
              axios.get('/search?q=' + this.search)

                .then((data) => {

                 this.searchResult = data.data  
                    //this.searchResult = data.data
                    setTimeout(() => this.buildLinkForResult(), 2000)
                   
                });
              } else {
                this.searchResult = "";
              }
          },

          buildLinkForResult: function() {

            //const hostName =  window.location.hostname;

           if(this.checkObjectEmptyOrNot()){
                this.searchResult.errorMessage = 'článek nebyl nalezen v databázi';
                
           }

            for(let i = 0; i< this.searchResult.length; i++){

                if(this.searchResult[i].id >=1){
                    this.searchResult[i].link = '/article/'+this.searchResult[i].id +'/edit';           
                }
            }
            this.search = "";
          },


          checkObjectEmptyOrNot: function () {

                for(var key in this.searchResult) {
                    if (this.searchResult.hasOwnProperty(key)) {
                        return false;
                    }
                }

                return true;

          }
          
        },

        watch: {
          placeHolderArticle: function() {
            
          },

          publishStatus: function() {

            if(this.publishStatus == 1) {
              this.publishStatusText = true
              //this.publishStatusText = ''; 
              this.publishStatus = '';
            } else if(this.publishStatus == 0) {
              this.publishStatusText = false
              //this.publishStatusText = ''; 
              this.publishStatus = '';
            }

          },

          confirmDeleteMessage: function() {

          }
        }

    });
</script>
@endsection