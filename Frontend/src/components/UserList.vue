<template>
  <div class="page">
    <div class="container">
     <CreateUserModal @getArticles="getArticles"/>
     <table class="table table-dark table-hover">
       <thead>
         <tr>
           <th>ID</th>
           <th>Name</th>
           <th>Price</th>
           <th>Image URL</th>
           <th>Actions</th>
         </tr>
       </thead>
       <tbody>
         <tr v-for="(article, index) in articles" :key="article.id">
           <td>{{ index }}</td>
           <td>{{ article.name }}</td>
           <td>{{ article.price }}</td>
           <td>{{ article.image_url }}</td>
           <td class="buttons">
             <EditUserModal :key="article.id" :article="article" @getArticles="getArticles" style="width: 70px;"/>
             <button @click="deleteArticle(article.id)" class="btn btn-outline-danger" style="width: 70px; margin-left: 10px;">Delete</button>
           </td>
         </tr>
       </tbody>
     </table>
   </div>
   <Weather/>
  </div>
</template>

<script>
import EditUserModal from './EditUserModal.vue';
import axios from 'axios';
import CreateUserModal from './CreateUserModal.vue';
import Weather from './Weather.vue';

export default {
  data() {
    return {
      articles: [],
    };
  },
  created() {
    this.getArticles();
  },
  methods: {
    getArticles() {
      axios
        .get("http://127.0.0.1:8000/api/article", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then((res) => {
          this.articles = res.data;
        })
        .catch((err) => {
          console.log(err.response.status);
          if (err.response.status == 401) {
            this.$router.push("/login");
          }
        });
    },
    deleteArticle(id) {
      if (confirm("Are you sure you want to delete the article?")) {
        axios
          .delete(`http://127.0.0.1:8000/api/article/${id}`, {
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          })
          .then(() => {
            this.getArticles();
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
  components: {
    EditUserModal,
    CreateUserModal,
    Weather,
  },
};
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');

.table {
  position: flex;
  height: 20px;
  width: 800px;
  text-align: center;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.buttons {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
}

.page {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.container {
  position: relative;
  max-width: 1000px;
  padding: 20px;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 24px;
  margin: 10px auto; /* Dodajte ovaj stil za centriranje */
}
</style>
