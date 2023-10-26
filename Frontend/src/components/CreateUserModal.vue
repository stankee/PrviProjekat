<template>
  <!-- Button trigger modal -->
  <button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#exampleModal"
    id="createbutton"
  >
    Create Article
  </button>

  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <form @submit.prevent="createArticle" class="submit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              Create New Article
            </h1>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>

          <div class="modal-body d-flex flex-column" style="gap: 5px">
            <div class="input-group" id="articleName">
              <span class="input-group-text">Name</span>
              <input v-model="articleName" type="text" aria-label="Name" class="form-control">
            </div>
            <div v-if="v$.articleName.$error" style="font-size: 12px; color:red">Name field has an error.</div>

            <div class="input-group">
              <span class="input-group-text">Price</span>
              <input v-model="articlePrice" type="text" aria-label="Price" class="form-control">
            </div>
            <div v-if="v$.articlePrice.$error" style="font-size: 12px; color:red">Price field has to be number.</div>

            <div class="input-group">
              <span class="input-group-text">Image URL</span>
              <input v-model="articleImageURL" type="text" aria-label="Image_URL" class="form-control">
            </div>
            <div v-if="v$.articleImageURL.$error" style="font-size: 12px; color:red">Image URL field has an error.</div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import { useVuelidate } from "@vuelidate/core";
import { required, numeric } from "@vuelidate/validators";

export default {
  data() {
    return {
      v$: useVuelidate(),
      articleName: "",
      articlePrice: "",
      articleImageURL: "",
    };
  },
  validations() {
    return {
      articleName: { required },
      articlePrice: { required, numeric },
      articleImageURL: { required },
    };
  },
  methods: {
    clearForm() {
      this.articleName = "";
      this.articlePrice = "";
      this.articleImageURL = "";
    },
    createArticle() {
      this.v$.$validate();
      if (!this.v$.$error) {
        axios
          .post("http://127.0.0.1:8000/api/article", {
            name: this.articleName,
            price: this.articlePrice,
            image_url: this.articleImageURL,
          }, 
          {
            headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
            },
          })
          .then((response) => {
            console.log(response);
            this.$emit("getArticles"); 
            // this.clearForm();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>

<style>
#createbutton {
  margin-bottom: 10px;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 20px;
}
</style>
